<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TtsController extends Controller
{
    /**
     * Proxy de TTS neural (Microsoft Edge Read Aloud) con fallback a Google Translate TTS.
     * Voces neuronales gratuitas, calidad humana.
     *
     * GET /tts?text=...&voice=es-MX-DaliaNeural
     *     ?text=...&genero=femenino|masculino    (voz auto)
     *     ?text=...&lang=es-419                  (compat: deduce voz)
     */
    public function speak(Request $request)
    {
        $texto  = trim((string) $request->query('text', ''));
        $voice  = (string) $request->query('voice', '');
        $genero = (string) $request->query('genero', 'femenino');
        $lang   = (string) $request->query('lang', 'es-MX');
        $rate   = (int) $request->query('rate', -8);
        $pitch  = (int) $request->query('pitch', 0);

        // Clamp
        $rate  = max(-50, min(50, $rate));
        $pitch = max(-50, min(50, $pitch));

        if ($texto === '') {
            return response()->json(['error' => 'texto vacío'], 422);
        }

        // Whitelist de voces neurales soportadas (Microsoft Edge Read Aloud)
        $vocesPermitidas = [
            // Femeninas mexicanas (recomendadas para mensajes dulces)
            'es-MX-DaliaNeural', 'es-MX-CarlotaNeural', 'es-MX-LarissaNeural',
            'es-MX-RenataNeural', 'es-MX-NuriaNeural',  'es-MX-MarinaNeural',
            'es-MX-CandelaNeural', 'es-MX-BeatrizNeural', 'es-MX-YolandaNeural',
            // Masculinas mexicanas
            'es-MX-JorgeNeural', 'es-MX-LibertoNeural', 'es-MX-PelayoNeural',
            'es-MX-CecilioNeural', 'es-MX-GerardoNeural', 'es-MX-LucianoNeural',
            // Latino US
            'es-US-PalomaNeural', 'es-US-AlonsoNeural',
            // España (por compatibilidad)
            'es-ES-ElviraNeural', 'es-ES-AlvaroNeural',
        ];

        if ($voice === '' || ! in_array($voice, $vocesPermitidas, true)) {
            $voice = $genero === 'masculino' ? 'es-MX-JorgeNeural' : 'es-MX-DaliaNeural';
        }

        // Limitar texto
        if (mb_strlen($texto) > 2000) {
            $texto = mb_substr($texto, 0, 1997) . '...';
        }

        // Cache por hash(voz + rate + pitch + texto)
        $hash      = md5('edge|' . $voice . '|' . $rate . '|' . $pitch . '|' . $texto);
        $cachePath = storage_path('app/tts-cache/' . $hash . '.mp3');

        if (! is_dir(dirname($cachePath))) {
            @mkdir(dirname($cachePath), 0775, true);
        }

        $audio = null;
        if (is_file($cachePath) && filesize($cachePath) > 200) {
            $audio = file_get_contents($cachePath);
        } else {
            // 1) Edge TTS neural (mejor calidad)
            $audio = $this->generarAudioEdge($texto, $voice, $cachePath, $rate, $pitch);

            // 2) Fallback Google Translate TTS si Edge falla
            if ($audio === null) {
                $audio = $this->generarAudio($texto, $lang);
                if ($audio !== null && strlen($audio) > 200) {
                    @file_put_contents($cachePath, $audio);
                }
            }
        }

        if (! $audio) {
            return response()->json(['error' => 'No se pudo generar el audio'], 502);
        }

        return response($audio, 200, [
            'Content-Type'  => 'audio/mpeg',
            'Cache-Control' => 'public, max-age=86400',
            'Content-Length'=> strlen($audio),
            'X-Tts-Voice'   => $voice,
        ]);
    }

    /**
     * Genera audio neural via Microsoft Edge Read Aloud (vía script Node).
     * Devuelve el contenido MP3 o null si falla.
     */
    private function generarAudioEdge(string $texto, string $voice, string $cachePath, int $rate = -8, int $pitch = 0): ?string
    {
        $script = base_path('scripts' . DIRECTORY_SEPARATOR . 'edge-tts.cjs');
        if (! is_file($script)) {
            return null;
        }

        // Localizar Node — preferir el del PATH; permitir override via env
        $node = env('NODE_BIN', 'node');

        // Construir comando seguro (escapeshellarg evita inyección)
        $cmd = sprintf(
            '%s %s --text %s --voice %s --output %s --rate %s --pitch %s --volume 0 2>&1',
            escapeshellcmd($node),
            escapeshellarg($script),
            escapeshellarg($texto),
            escapeshellarg($voice),
            escapeshellarg($cachePath),
            escapeshellarg((string) $rate),
            escapeshellarg((string) $pitch)
        );

        $output  = [];
        $exitCode = 0;
        @exec($cmd, $output, $exitCode);

        if ($exitCode !== 0) {
            Log::warning('Edge TTS falló', ['cmd' => $cmd, 'output' => $output]);
            return null;
        }

        if (! is_file($cachePath) || filesize($cachePath) < 200) {
            return null;
        }

        return file_get_contents($cachePath);
    }

    private function generarAudio(string $texto, string $lang): ?string
    {
        $chunks = $this->dividirTexto($texto, 180);
        $total  = count($chunks);
        $audio  = '';

        foreach ($chunks as $i => $chunk) {
            $url = 'https://translate.google.com/translate_tts'
                . '?ie=UTF-8'
                . '&client=tw-ob'
                . '&tl=' . urlencode($lang)
                . '&total=' . $total
                . '&idx=' . $i
                . '&textlen=' . mb_strlen($chunk)
                . '&q=' . urlencode($chunk);

            try {
                $resp = Http::timeout(15)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 '
                            . '(KHTML, like Gecko) Chrome/124.0 Safari/537.36',
                        'Referer' => 'https://translate.google.com/',
                        'Accept'  => 'audio/mpeg, */*',
                    ])
                    ->get($url);

                if (! $resp->ok()) {
                    return null;
                }

                $audio .= $resp->body();
            } catch (\Throwable $e) {
                return null;
            }
        }

        return $audio !== '' ? $audio : null;
    }

    /**
     * Divide el texto en trozos <= $max chars, intentando cortar en
     * signos de puntuación o espacios para que la voz suene fluida.
     */
    private function dividirTexto(string $texto, int $max = 180): array
    {
        $texto = preg_replace('/\s+/u', ' ', $texto) ?? $texto;
        $texto = trim($texto);
        if ($texto === '') return [];

        $chunks = [];
        while (mb_strlen($texto) > $max) {
            $slice = mb_substr($texto, 0, $max);

            // Buscar un buen punto de corte (de mayor a menor preferencia)
            $cortes = ['. ', '? ', '! ', '; ', ', ', ' '];
            $pos = false;
            foreach ($cortes as $c) {
                $p = mb_strrpos($slice, $c);
                if ($p !== false && $p > 40) {
                    $pos = $p + mb_strlen($c);
                    break;
                }
            }
            if ($pos === false) $pos = $max;

            $chunks[] = trim(mb_substr($texto, 0, $pos));
            $texto    = trim(mb_substr($texto, $pos));
        }
        if ($texto !== '') $chunks[] = $texto;

        return $chunks;
    }
}
