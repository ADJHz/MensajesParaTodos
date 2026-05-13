<?php

namespace App\Http\Controllers;

use App\Models\Ocasion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Asistente de redacción IA vía OpenRouter.
 * - generar(): crea un mensaje completo según ocasión, destinatario, remitente y tono.
 * - corregir(): corrige ortografía y mejora redacción manteniendo intención.
 */
class AiAsistenteController extends Controller
{
    private const ENDPOINT = 'https://openrouter.ai/api/v1/chat/completions';
    private const GROQ_ENDPOINT = 'https://api.groq.com/openai/v1/chat/completions';

    public function generar(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ocasion_id'   => ['nullable', 'integer', 'exists:ocasiones,id'],
            'ocasion_slug' => ['nullable', 'string', 'max:120'],
            'destinatario' => ['nullable', 'string', 'max:120'],
            'remitente'    => ['nullable', 'string', 'max:120'],
            'tono'         => ['nullable', 'string', 'max:40'],
            'instrucciones'=> ['nullable', 'string', 'max:500'],
        ]);

        $ocasion = $this->resolverOcasion($data['ocasion_id'] ?? null, $data['ocasion_slug'] ?? null);
        $contextoOcasion = $ocasion
            ? trim(($ocasion->categoria?->nombre ? $ocasion->categoria->nombre . ' · ' : '') . $ocasion->nombre . ($ocasion->descripcion ? ' — ' . $ocasion->descripcion : ''))
            : 'Mensaje genérico';

        $destinatario = trim($data['destinatario'] ?? '') ?: 'la persona destinataria';
        $remitente    = trim($data['remitente']    ?? '') ?: 'quien escribe';
        $tono         = trim($data['tono']         ?? '') ?: 'cálido y sincero';
        $extra        = trim($data['instrucciones']?? '');

        $system = "Eres un asistente experto en redactar mensajes personales en español, con calidez, naturalidad y buena ortografía. "
            . "Devuelves SOLO el texto del mensaje, sin saludos meta ni comillas, sin explicaciones, sin firmar al final. "
            . "Usa entre 60 y 140 palabras. Evita clichés excesivos. No incluyas emojis a menos que aporten. "
            . "No incluyas el nombre del remitente al final (la firma se agrega aparte).";

        $user = "Ocasión: {$contextoOcasion}\n"
            . "Destinatario: {$destinatario}\n"
            . "Remitente (no firmar): {$remitente}\n"
            . "Tono deseado: {$tono}\n"
            . ($extra !== '' ? "Indicaciones adicionales: {$extra}\n" : '')
            . "\nRedacta el mensaje ahora.";

        $resp = $this->llamarOpenRouter($system, $user, 0.85, 600);
        if ($resp['ok'] === false) {
            return response()->json(['error' => $resp['error'], 'detalle' => $resp['detalle'] ?? []], 502);
        }

        return response()->json([
            'mensaje' => $this->limpiarSalida($resp['texto']),
            'modelo'  => $resp['modelo'] ?? null,
        ]);
    }

    public function corregir(Request $request): JsonResponse
    {
        $data = $request->validate([
            'texto' => ['required', 'string', 'max:8000'],
        ]);

        $texto = trim($data['texto']);
        if ($texto === '') {
            return response()->json(['error' => 'Texto vacío.'], 422);
        }

        $system = "Eres un corrector experto en español. Recibirás un texto y debes devolverlo CORREGIDO: "
            . "ortografía, acentos, puntuación y redacción más natural. "
            . "Conserva la intención, el tono, los nombres propios y la longitud aproximada. "
            . "No agregues comentarios, no expliques cambios. Devuelve SOLO el texto corregido.";

        $resp = $this->llamarOpenRouter($system, $texto, 0.2, 1200);
        if ($resp['ok'] === false) {
            return response()->json(['error' => $resp['error'], 'detalle' => $resp['detalle'] ?? []], 502);
        }

        return response()->json([
            'mensaje' => $this->limpiarSalida($resp['texto']),
            'modelo'  => $resp['modelo'] ?? null,
        ]);
    }

    private function resolverOcasion(?int $id, ?string $slug): ?Ocasion
    {
        if ($id) {
            return Ocasion::with('categoria')->find($id);
        }
        if ($slug) {
            return Ocasion::with('categoria')->where('slug', $slug)->first();
        }
        return null;
    }

    /**
     * Intenta primero Groq (rápido y estable) y si falla cae a OpenRouter.
     * @return array{ok:bool, texto?:string, modelo?:string, error?:string, detalle?:array}
     */
    private function llamarOpenRouter(string $system, string $user, float $temperature, int $maxTokens): array
    {
        $errores = [];

        // 1) Groq primero
        $groq = $this->llamarGroq($system, $user, $temperature, $maxTokens);
        if ($groq['ok']) {
            return $groq;
        }
        if (! empty($groq['detalle'])) {
            $errores = array_merge($errores, $groq['detalle']);
        } elseif (! empty($groq['error'])) {
            $errores[] = 'groq: ' . $groq['error'];
        }

        // 2) OpenRouter como respaldo
        $or = $this->llamarOpenRouterDirecto($system, $user, $temperature, $maxTokens);
        if ($or['ok']) {
            return $or;
        }
        if (! empty($or['detalle'])) {
            $errores = array_merge($errores, $or['detalle']);
        } elseif (! empty($or['error'])) {
            $errores[] = 'openrouter: ' . $or['error'];
        }

        return [
            'ok'      => false,
            'error'   => 'No se pudo generar el mensaje. Intenta de nuevo en unos segundos.',
            'detalle' => $errores,
        ];
    }

    /**
     * @return array{ok:bool, texto?:string, modelo?:string, error?:string, detalle?:array}
     */
    private function llamarGroq(string $system, string $user, float $temperature, int $maxTokens): array
    {
        $apiKey = (string) config('services.groq.key');
        if ($apiKey === '') {
            return ['ok' => false, 'error' => 'Groq no configurado.'];
        }

        $modelos = collect(explode(',', (string) config('services.groq.models')))
            ->map(fn ($m) => trim($m))->filter()->values();
        if ($modelos->isEmpty()) {
            return ['ok' => false, 'error' => 'No hay modelos Groq configurados.'];
        }

        $errores = [];
        foreach ($modelos as $modelo) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ])
                    ->timeout(35)
                    ->connectTimeout(8)
                    ->post(self::GROQ_ENDPOINT, [
                        'model'       => $modelo,
                        'temperature' => $temperature,
                        'max_tokens'  => $maxTokens,
                        'messages'    => [
                            ['role' => 'system', 'content' => $system],
                            ['role' => 'user',   'content' => $user],
                        ],
                    ]);

                if (! $response->successful()) {
                    $errores[] = 'groq:' . $modelo . ' → HTTP ' . $response->status();
                    Log::warning('[Groq] '.$modelo.' HTTP '.$response->status(), ['body' => $response->body()]);
                    continue;
                }

                $json = $response->json();
                $texto = $json['choices'][0]['message']['content'] ?? '';
                if (! is_string($texto) || trim($texto) === '') {
                    $errores[] = 'groq:' . $modelo . ' → respuesta vacía';
                    continue;
                }

                return ['ok' => true, 'texto' => $texto, 'modelo' => 'groq:' . $modelo];
            } catch (\Throwable $e) {
                $errores[] = 'groq:' . $modelo . ' → ' . $e->getMessage();
                Log::warning('[Groq] excepción '.$modelo.': '.$e->getMessage());
                continue;
            }
        }

        return ['ok' => false, 'error' => 'Groq no disponible.', 'detalle' => $errores];
    }

    /**
     * @return array{ok:bool, texto?:string, modelo?:string, error?:string, detalle?:array}
     */
    private function llamarOpenRouterDirecto(string $system, string $user, float $temperature, int $maxTokens): array
    {
        $apiKey = (string) config('services.openrouter.key');
        if ($apiKey === '') {
            return ['ok' => false, 'error' => 'OpenRouter no configurado.'];
        }

        $modelos = collect(explode(',', (string) config('services.openrouter.models')))
            ->map(fn ($m) => trim($m))
            ->filter()
            ->values();
        if ($modelos->isEmpty()) {
            return ['ok' => false, 'error' => 'No hay modelos configurados.'];
        }

        $referer = (string) config('services.openrouter.referer');
        $title   = (string) config('services.openrouter.title');
        // session_id ayuda a OpenRouter a agrupar invocaciones del mismo flujo
        $sessionId = 'mensajes-ia-' . substr(md5(($title ?: 'app') . '|' . ($referer ?: 'local')), 0, 12);

        $errores = [];

        foreach ($modelos as $modelo) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'HTTP-Referer'  => $referer,
                    'X-Title'       => $title,
                    'Content-Type'  => 'application/json',
                ])
                    ->timeout(35)
                    ->connectTimeout(8)
                    ->post(self::ENDPOINT, [
                        'model'       => $modelo,
                        'session_id'  => $sessionId,
                        'temperature' => $temperature,
                        'max_tokens'  => $maxTokens,
                        'messages'    => [
                            ['role' => 'system', 'content' => $system],
                            ['role' => 'user',   'content' => $user],
                        ],
                    ]);

                if (! $response->successful()) {
                    $errores[] = 'openrouter:' . $modelo . ' → HTTP ' . $response->status();
                    Log::warning('[OpenRouter] '.$modelo.' HTTP '.$response->status(), ['body' => $response->body()]);
                    continue;
                }

                $json = $response->json();
                $texto = $json['choices'][0]['message']['content'] ?? '';
                if (! is_string($texto) || trim($texto) === '') {
                    $errores[] = 'openrouter:' . $modelo . ' → respuesta vacía';
                    continue;
                }

                return ['ok' => true, 'texto' => $texto, 'modelo' => 'openrouter:' . $modelo];
            } catch (\Throwable $e) {
                $errores[] = 'openrouter:' . $modelo . ' → ' . $e->getMessage();
                Log::warning('[OpenRouter] excepción '.$modelo.': '.$e->getMessage());
                continue;
            }
        }

        return ['ok' => false, 'error' => 'OpenRouter no disponible.', 'detalle' => $errores];
    }

    private function limpiarSalida(string $texto): string
    {
        $t = trim($texto);
        // Quitar comillas envolventes
        $t = preg_replace('/^["“”\']+|["“”\']+$/u', '', $t);
        // Quitar bloques de código accidentales
        $t = preg_replace('/^```[a-zA-Z]*\s*|\s*```$/u', '', $t);
        return trim($t);
    }
}
