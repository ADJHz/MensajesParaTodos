<?php

namespace App\Http\Controllers;

use App\Helpers\TemplateHelper;
use App\Models\MensajePlataforma;
use App\Models\Ocasion;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MensajeController extends Controller
{
    public function crear(Request $request)
    {
        $ocasion = null;
        if ($request->has('ocasion')) {
            $ocasion = Ocasion::with('categoria')->where('slug', $request->ocasion)->firstOrFail();
        }

        $categoriaSlug  = $ocasion?->categoria?->slug;
        $ocasionSlug    = $ocasion?->slug;
        $templates      = TemplateHelper::porOcasion($ocasionSlug, $categoriaSlug);
        $templateDefault = TemplateHelper::defaultTemplate($categoriaSlug, $ocasionSlug);
        $previewConfigs = TemplateHelper::configsParaPreview();
        $previewArte    = TemplateHelper::svgArte();

        return view('mensajes.crear', compact('ocasion', 'templates', 'templateDefault', 'previewConfigs', 'previewArte'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ocasion_id'   => ['required', 'exists:ocasiones,id'],
            'destinatario' => ['required', 'string', 'max:100'],
            'mensaje'      => ['required', 'string', 'max:30000'],
            'remitente'    => ['required', 'string', 'max:100'],
            'youtube_url'  => ['nullable', 'url', 'max:500'],
            'audio_url'      => ['nullable', 'url', 'max:500'],
            'audio_titulo'   => ['nullable', 'string', 'max:200'],
            'audio_artista'  => ['nullable', 'string', 'max:200'],
            'audio_thumb'    => ['nullable', 'url', 'max:500'],
            'audio_start'    => ['nullable', 'integer', 'min:0', 'max:600'],
            'audio_end'      => ['nullable', 'integer', 'min:1', 'max:600'],
            'audio_display_mode' => ['nullable', 'string', 'in:cover,cover_lyrics,lyrics,vinyl'],
            'audio_lyrics'       => ['nullable', 'string', 'max:10000'],
            'audio_pos_x'        => ['nullable', 'integer', 'min:5', 'max:95'],
            'audio_pos_y'        => ['nullable', 'integer', 'min:5', 'max:95'],
            'audio_scale'        => ['nullable', 'integer', 'min:70', 'max:180'],
            'imagen'       => ['nullable', 'image', 'max:5120'],
            'imagen_forma' => ['nullable', 'string', 'in:ninguna,cuadrado,circulo,corazon,estrella,hexagono,diamante'],
            'imagen_marco' => ['nullable', 'string', 'in:ninguno,morado,dorado,rosa,verde,sombra,blanco'],
            'template'     => ['nullable', 'string', 'in:' . implode(',', array_keys(\App\Helpers\TemplateHelper::configsParaPreview()))],
            'personaje_origen' => ['nullable', 'string', 'in:tema,dicebear,custom,ninguno'],
            'personaje_estilo' => ['nullable', 'string', 'max:30'],
            'personaje_seed'   => ['nullable', 'string', 'max:100'],
            'personaje_imagen' => ['nullable', 'image', 'max:3072'],
        ]);

        // Sanitizar HTML del mensaje (solo tags seguros)
        $mensajeLimpio = $this->sanitizarHTML($request->mensaje);

        // Subir imagen si existe
        $imagenPath = null;
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagenPath = $this->guardarImagenMensajeSinRecorte($request->file('imagen'));
        }

        // Subir personaje custom si existe
        $personajePath = null;
        $personajeOrigen = $request->input('personaje_origen', 'tema');
        if ($request->hasFile('personaje_imagen') && $request->file('personaje_imagen')->isValid()) {
            $personajePath = $request->file('personaje_imagen')->store('personajes', 'public');
            $personajeOrigen = 'custom';
        }

        $code = strtoupper(Str::random(8));
        while (MensajePlataforma::where('code', $code)->exists()) {
            $code = strtoupper(Str::random(8));
        }

        $mensaje = MensajePlataforma::create([
            'user_id'      => Auth::id(),
            'ocasion_id'   => $request->ocasion_id,
            'code'         => $code,
            'destinatario' => $request->destinatario,
            'mensaje'      => $mensajeLimpio,
            'remitente'    => $request->remitente,
            'youtube_url'  => $request->youtube_url,
            'audio_url'      => $request->audio_url,
            'audio_titulo'   => $request->audio_titulo,
            'audio_artista'  => $request->audio_artista,
            'audio_thumb'    => $request->audio_thumb,
            'audio_start'    => (int) ($request->audio_start ?? 0),
            'audio_end'      => (int) ($request->audio_end ?? 15),
            'audio_display_mode' => $request->audio_display_mode ?? 'cover',
            'audio_lyrics'       => $request->audio_lyrics,
            'audio_pos_x'        => (int) ($request->audio_pos_x ?? 24),
            'audio_pos_y'        => (int) ($request->audio_pos_y ?? 24),
            'audio_scale'        => (int) ($request->audio_scale ?? 100),
            'estado'       => 'pendiente',
            'imagen_path'  => $imagenPath,
            'imagen_forma' => $request->imagen_forma ?? 'circulo',
            'imagen_marco' => $request->imagen_marco ?? 'ninguno',
            'template'     => $request->template ?? 'clasico',
            'personaje_origen' => $personajeOrigen,
            'personaje_path'   => $personajePath,
            'personaje_estilo' => $request->personaje_estilo,
            'personaje_seed'   => $request->personaje_seed ?: $request->destinatario,
        ]);

        return redirect()->route('pago.checkout', $mensaje->code);
    }

    private function sanitizarHTML(string $html): string
    {
        // Permitir solo tags seguros
        $limpio = strip_tags($html, '<strong><em><u><s><span><br><p><div>');

        // Quitar atributos peligrosos; solo permitir style en span
        $limpio = preg_replace('/<(strong|em|u|s|br)([^>]*)>/i', '<$1>', $limpio);
        $limpio = preg_replace('/<(p|div)([^>]*)>/i', '<$1>', $limpio);

        // En span, solo permitir color y background-color en style
        $limpio = preg_replace_callback(
            '/<span([^>]*)>/i',
            function ($m) {
                if (preg_match('/style\s*=\s*["\']([^"\']*)["\']/', $m[1], $s)) {
                    preg_match_all('/((?:background-)?color)\s*:\s*([^;"\'>]+)/i', $s[1], $props);
                    $safe = [];
                    foreach ($props[0] as $prop) {
                        $safe[] = trim($prop);
                    }
                    return $safe ? '<span style="' . implode(';', $safe) . '">' : '<span>';
                }
                return '<span>';
            },
            $limpio
        );

        return trim($limpio);
    }

    public function show(string $code)
    {
        $mensaje = MensajePlataforma::with(['ocasion.categoria', 'user'])
            ->where('code', $code)
            ->firstOrFail();

        // Reglas de acceso:
        //  - Pagado    → cualquiera con el código puede verlo (compartible).
        //  - Pendiente → en local, accesible (preview/desarrollo); en prod, solo el propietario.
        if ($mensaje->estado !== 'pagado' && !app()->isLocal()) {
            abort_unless(
                Auth::check() && (int) $mensaje->user_id === (int) Auth::id(),
                403,
                'Este mensaje aún no está disponible. Si eres el remitente, inicia sesión para previsualizarlo.'
            );
        }

        $plantilla = $mensaje->ocasion->plantilla_vista ?? 'mensajes.show';

        return view($plantilla, compact('mensaje'));
    }

    /**
     * Lista todos los mensajes del usuario autenticado (mis-mensajes).
     */
    public function mios(Request $request)
    {
        $filtro = $request->query('filtro', 'todos'); // todos | pagados | pendientes

        $query = MensajePlataforma::with('ocasion.categoria')
            ->where('user_id', Auth::id())
            ->latest();

        if ($filtro === 'pagados')   $query->where('estado', 'pagado');
        if ($filtro === 'pendientes') $query->where('estado', 'pendiente');

        $mensajes = $query->paginate(12)->withQueryString();

        $stats = [
            'total'      => MensajePlataforma::where('user_id', Auth::id())->count(),
            'pagados'    => MensajePlataforma::where('user_id', Auth::id())->where('estado', 'pagado')->count(),
            'pendientes' => MensajePlataforma::where('user_id', Auth::id())->where('estado', 'pendiente')->count(),
        ];

        return view('mensajes.mios', compact('mensajes', 'stats', 'filtro'));
    }

    /**
     * Vista de edición de un mensaje (cualquier estado del propio usuario).
     * El usuario YA pagó: editar es gratuito.
     */
    public function edit(string $code)
    {
        $mensaje = MensajePlataforma::with('ocasion.categoria')
            ->where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $ocasion        = $mensaje->ocasion;
        $categoriaSlug  = $ocasion?->categoria?->slug;
        $ocasionSlug    = $ocasion?->slug;
        $templates      = TemplateHelper::porOcasion($ocasionSlug, $categoriaSlug);
        $previewConfigs = TemplateHelper::configsParaPreview();
        $previewArte    = TemplateHelper::svgArte();

        return view('mensajes.editar', compact('mensaje', 'ocasion', 'templates', 'previewConfigs', 'previewArte'));
    }

    /**
     * Actualiza el mensaje (gratis, sin nuevo cobro).
     */
    public function update(Request $request, string $code)
    {
        $mensaje = MensajePlataforma::where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'destinatario' => ['required', 'string', 'max:100'],
            'mensaje'      => ['required', 'string', 'max:30000'],
            'remitente'    => ['required', 'string', 'max:100'],
            'youtube_url'  => ['nullable', 'url', 'max:500'],
            'audio_url'      => ['nullable', 'url', 'max:500'],
            'audio_titulo'   => ['nullable', 'string', 'max:200'],
            'audio_artista'  => ['nullable', 'string', 'max:200'],
            'audio_thumb'    => ['nullable', 'url', 'max:500'],
            'audio_start'    => ['nullable', 'integer', 'min:0', 'max:600'],
            'audio_end'      => ['nullable', 'integer', 'min:1', 'max:600'],
            'audio_display_mode' => ['nullable', 'string', 'in:cover,cover_lyrics,lyrics,vinyl'],
            'audio_lyrics'       => ['nullable', 'string', 'max:10000'],
            'audio_pos_x'        => ['nullable', 'integer', 'min:5', 'max:95'],
            'audio_pos_y'        => ['nullable', 'integer', 'min:5', 'max:95'],
            'audio_scale'        => ['nullable', 'integer', 'min:70', 'max:180'],
            'imagen'       => ['nullable', 'image', 'max:5120'],
            'imagen_forma' => ['nullable', 'string', 'in:ninguna,cuadrado,circulo,corazon,estrella,hexagono,diamante'],
            'imagen_marco' => ['nullable', 'string', 'in:ninguno,morado,dorado,rosa,verde,sombra,blanco'],
            'template'     => ['nullable', 'string', 'in:' . implode(',', array_keys(TemplateHelper::configsParaPreview()))],
            'eliminar_imagen' => ['nullable', 'boolean'],
            'personaje_origen' => ['nullable', 'string', 'in:tema,dicebear,custom,ninguno'],
            'personaje_estilo' => ['nullable', 'string', 'max:30'],
            'personaje_seed'   => ['nullable', 'string', 'max:100'],
            'personaje_imagen' => ['nullable', 'image', 'max:3072'],
            'eliminar_personaje' => ['nullable', 'boolean'],
        ]);

        $datos = [
            'destinatario' => $request->destinatario,
            'mensaje'      => $this->sanitizarHTML($request->mensaje),
            'remitente'    => $request->remitente,
            'youtube_url'  => $request->youtube_url,
            'audio_url'      => $request->audio_url,
            'audio_titulo'   => $request->audio_titulo,
            'audio_artista'  => $request->audio_artista,
            'audio_thumb'    => $request->audio_thumb,
            'audio_start'    => (int) ($request->audio_start ?? $mensaje->audio_start ?? 0),
            'audio_end'      => (int) ($request->audio_end   ?? $mensaje->audio_end   ?? 15),
            'audio_display_mode' => $request->audio_display_mode ?? ($mensaje->audio_display_mode ?? 'cover'),
            'audio_lyrics'       => $request->audio_lyrics,
            'audio_pos_x'        => (int) ($request->audio_pos_x ?? $mensaje->audio_pos_x ?? 24),
            'audio_pos_y'        => (int) ($request->audio_pos_y ?? $mensaje->audio_pos_y ?? 24),
            'audio_scale'        => (int) ($request->audio_scale ?? $mensaje->audio_scale ?? 100),
            'imagen_forma' => $request->imagen_forma ?? $mensaje->imagen_forma,
            'imagen_marco' => $request->imagen_marco ?? $mensaje->imagen_marco,
            'template'     => $request->template ?? $mensaje->template,
            'personaje_origen' => $request->personaje_origen ?? $mensaje->personaje_origen,
            'personaje_estilo' => $request->personaje_estilo ?? $mensaje->personaje_estilo,
            'personaje_seed'   => $request->personaje_seed ?? $mensaje->personaje_seed,
        ];

        if ($request->boolean('eliminar_personaje') && $mensaje->personaje_path) {
            Storage::disk('public')->delete($mensaje->personaje_path);
            $datos['personaje_path']   = null;
            if (($datos['personaje_origen'] ?? null) === 'custom') {
                $datos['personaje_origen'] = 'tema';
            }
        }

        if ($request->hasFile('personaje_imagen') && $request->file('personaje_imagen')->isValid()) {
            if ($mensaje->personaje_path) {
                Storage::disk('public')->delete($mensaje->personaje_path);
            }
            $datos['personaje_path']   = $request->file('personaje_imagen')->store('personajes', 'public');
            $datos['personaje_origen'] = 'custom';
        }

        if ($request->boolean('eliminar_imagen') && $mensaje->imagen_path) {
            Storage::disk('public')->delete($mensaje->imagen_path);
            $datos['imagen_path'] = null;
        }

        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            if ($mensaje->imagen_path) {
                Storage::disk('public')->delete($mensaje->imagen_path);
            }
            $datos['imagen_path'] = $this->guardarImagenMensajeSinRecorte($request->file('imagen'));
        }

        $mensaje->update($datos);

        return redirect()->route('mensajes.mios')
            ->with('success', '✨ Mensaje actualizado. ¡Tus cambios ya están listos para compartir!');
    }

    private function guardarImagenMensajeSinRecorte(UploadedFile $file): string
    {
        $fallbackPath = $file->store('mensajes', 'public');
        $tmpPath = $file->getRealPath();
        if (!$tmpPath || !extension_loaded('gd')) {
            return $fallbackPath;
        }

        $info = @getimagesize($tmpPath);
        if (!$info || !isset($info[2])) {
            return $fallbackPath;
        }

        $src = null;
        switch ((int) $info[2]) {
            case IMAGETYPE_JPEG:
                $src = @imagecreatefromjpeg($tmpPath);
                break;
            case IMAGETYPE_PNG:
                $src = @imagecreatefrompng($tmpPath);
                break;
            case IMAGETYPE_GIF:
                $src = @imagecreatefromgif($tmpPath);
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagecreatefromwebp')) {
                    $src = @imagecreatefromwebp($tmpPath);
                }
                break;
        }

        if (!$src) {
            return $fallbackPath;
        }

        try {
            $srcW = imagesx($src);
            $srcH = imagesy($src);
            if ($srcW <= 0 || $srcH <= 0) {
                imagedestroy($src);
                return $fallbackPath;
            }

            $maxSide = 1600;
            $scale = min(1, $maxSide / max($srcW, $srcH));
            $dstW = max(1, (int) round($srcW * $scale));
            $dstH = max(1, (int) round($srcH * $scale));
            $canvasSize = max($dstW, $dstH);

            $canvas = imagecreatetruecolor($canvasSize, $canvasSize);
            if (!$canvas) {
                imagedestroy($src);
                return $fallbackPath;
            }

            // Fondo blanco para conservar imagen completa sin recortes en contenedores cuadrados.
            $bg = imagecolorallocate($canvas, 255, 255, 255);
            imagefill($canvas, 0, 0, $bg);
            imagealphablending($canvas, true);

            $dstX = (int) floor(($canvasSize - $dstW) / 2);
            $dstY = (int) floor(($canvasSize - $dstH) / 2);
            imagecopyresampled($canvas, $src, $dstX, $dstY, 0, 0, $dstW, $dstH, $srcW, $srcH);

            $relativePath = 'mensajes/' . (string) Str::uuid() . '.jpg';
            $absolutePath = Storage::disk('public')->path($relativePath);
            $dir = dirname($absolutePath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $ok = imagejpeg($canvas, $absolutePath, 88);
            imagedestroy($canvas);
            imagedestroy($src);

            if (!$ok) {
                return $fallbackPath;
            }

            Storage::disk('public')->delete($fallbackPath);
            return $relativePath;
        } catch (\Throwable $e) {
            if (is_resource($src) || (is_object($src) && get_class($src) === 'GdImage')) {
                imagedestroy($src);
            }
            return $fallbackPath;
        }
    }

    /**
     * Elimina un mensaje del propio usuario.
     */
    public function destroy(string $code)
    {
        $mensaje = MensajePlataforma::where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($mensaje->imagen_path) {
            Storage::disk('public')->delete($mensaje->imagen_path);
        }
        if ($mensaje->personaje_path) {
            Storage::disk('public')->delete($mensaje->personaje_path);
        }
        $mensaje->delete();

        return redirect()->route('mensajes.mios')
            ->with('success', '🗑️ Mensaje eliminado.');
    }
}
