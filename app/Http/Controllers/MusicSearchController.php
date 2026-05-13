<?php

namespace App\Http\Controllers;

use App\Models\Ocasion;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Búsqueda de canciones (preview de 30s) para el reproductor estilo "stories".
 * Usa Deezer (gratis, sin auth, MP3 30s) con fallback a iTunes Search.
 * Ambas devuelven URLs de audio MP3/M4A directas que reproducen en cualquier <audio>.
 */
class MusicSearchController extends Controller
{
    private const KEYWORDS_BY_OCASION = [
        'dia-de-las-madres'   => ['dia de las madres', 'mama', 'mother love', 'balada romantica'],
        'cumple-mama'         => ['cumpleanos feliz', 'mama fiesta', 'alegria latina'],
        'amor-sin-fecha-mama' => ['amor incondicional', 'mama para siempre', 'acustico emotivo'],
        'dia-del-padre'       => ['dia del padre', 'papa orgullo', 'rock clasico'],
        'cumple-papa'         => ['cumpleanos papa', 'fiesta retro', 'energia positiva'],
        'dia-del-hermano'     => ['hermano amistad', 'brother vibes', 'pop latino'],
        'cumple-hermano'      => ['cumpleanos hermano', 'fiesta urbana', 'reggaeton alegre'],
        'san-valentin'        => ['love songs', 'romantica pareja', 'balada amor'],
        'aniversario'         => ['aniversario pareja', 'romantic classics', 'amor eterno'],
        'solo-porque-si'      => ['indie love', 'good vibes', 'chill romantico'],
        'dia-del-nino'        => ['ninos diversion', 'kids party', 'musica infantil'],
        'dia-del-abuelo'      => ['abuelo nostalgia', 'bolero clasico', 'recuerdos bonitos'],
        'dia-de-la-amistad'   => ['amistad canciones', 'friends forever', 'pop alegre'],
        'navidad'             => ['navidad', 'christmas songs', 'villancicos'],
        'año-nuevo'           => ['ano nuevo fiesta', 'new year party', 'celebration hits'],
        'ano-nuevo'           => ['ano nuevo fiesta', 'new year party', 'celebration hits'],
        'cumpleanos-especial' => ['cumpleanos', 'birthday party', 'fiesta happy'],
        'quinceanera'         => ['quinceanera', 'fiesta latina', 'pop femenino'],
        'graduacion'          => ['graduacion exito', 'motivacion', 'future vibes'],
        'mensaje-para-nino'   => ['superheroe kids', 'aventura infantil', 'fun songs'],
        'mensaje-para-nina'   => ['princesa songs', 'magia infantil', 'pop kids'],
        'mensaje-peques-normal' => ['musica infantil feliz', 'kids mix', 'family friendly'],
    ];

    private const MOOD_BY_TEXT = [
        'agradecimiento' => ['gracias', 'agradezco', 'agradecimiento', 'thank you'],
        'romantico'      => ['amor', 'te amo', 'mi vida', 'corazon', 'beso'],
        'feliz'          => ['feliz', 'alegria', 'sonrisa', 'celebrar', 'fiesta'],
        'nostalgico'     => ['recuerdo', 'extrano', 'nostalgia', 'siempre', 'memorias'],
        'motivador'      => ['orgullo', 'logro', 'meta', 'futuro', 'adelante'],
    ];

    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:120'],
        ]);

        $q = trim($request->input('q'));
        $cacheKey = 'music-search:v2:' . md5(mb_strtolower($q));

        $resultados = Cache::remember($cacheKey, now()->addMinutes(20), function () use ($q) {
            // 1) Deezer
            $items = $this->buscarDeezer($q);
            // 2) Si Deezer falla o devuelve poco, complementar con iTunes
            if (count($items) < 8) {
                $items = array_merge($items, $this->buscarItunes($q, 12 - count($items)));
            }
            // Deduplicar por (titulo + artista)
            $seen = [];
            $clean = [];
            foreach ($items as $it) {
                $key = mb_strtolower($it['titulo'] . '|' . $it['artista']);
                if (isset($seen[$key])) continue;
                $seen[$key] = true;
                $clean[] = $it;
                if (count($clean) >= 18) break;
            }
            return $clean;
        });

        return response()->json(['items' => $resultados]);
    }

    public function suggest(Request $request): JsonResponse
    {
        $request->validate([
            'ocasion_id'   => ['nullable', 'integer', 'exists:ocasiones,id'],
            'ocasion_slug' => ['nullable', 'string', 'max:120'],
            'mensaje'      => ['nullable', 'string', 'max:800'],
        ]);

        $slug = $this->resolverSlugOcasion(
            $request->input('ocasion_slug'),
            $request->input('ocasion_id')
        );

        $mensaje = trim((string) $request->input('mensaje', ''));
        $queries = $this->buildSuggestionQueries($slug, $mensaje);

        $cacheKey = 'music-suggest:v2:' . md5(json_encode([$slug, $queries], JSON_UNESCAPED_UNICODE));
        $resultados = Cache::remember($cacheKey, now()->addMinutes(20), function () use ($queries) {
            $items = [];
            foreach ($queries as $q) {
                if (count($items) >= 18) {
                    break;
                }

                $batch = $this->buscarDeezer($q, 8);
                if (count($batch) < 5) {
                    $batch = array_merge($batch, $this->buscarItunes($q, 6));
                }
                $items = array_merge($items, $batch);
            }

            return $this->dedupeItems($items, 18);
        });

        return response()->json([
            'items' => $resultados,
            'meta'  => [
                'ocasion_slug' => $slug,
                'queries'      => $queries,
            ],
        ]);
    }

    public function lyrics(Request $request): JsonResponse
    {
        $request->validate([
            'titulo'  => ['required', 'string', 'max:200'],
            'artista' => ['required', 'string', 'max:200'],
            'start'   => ['required', 'integer', 'min:0', 'max:600'],
            'end'     => ['required', 'integer', 'min:1', 'max:600'],
        ]);

        $titulo = trim((string) $request->input('titulo'));
        $artista = trim((string) $request->input('artista'));
        $start = (int) $request->input('start');
        $end = max($start + 1, (int) $request->input('end'));

        $cacheKey = 'music-lyrics:v2:' . md5(mb_strtolower($titulo . '|' . $artista));

        $payload = Cache::remember($cacheKey, now()->addHours(12), function () use ($titulo, $artista) {
            return $this->fetchBestLyricsPayload($titulo, $artista);
        });

        if (!$payload || (!isset($payload['syncedLyrics']) && !isset($payload['plainLyrics']))) {
            $hardFallback = "♪ {$titulo} - {$artista} ♪";
            return response()->json([
                'lyrics' => $hardFallback,
                'plain' => $hardFallback,
                'lrc' => $hardFallback,
                'synced' => false,
                'message' => 'No se encontró letra sincronizada en línea. Mostrando fallback.',
            ]);
        }

        $syncedRaw = (string) ($payload['syncedLyrics'] ?? '');
        if ($syncedRaw !== '') {
            $timed = $this->extractTimedSegment($syncedRaw, $start, $end);
            if (!empty($timed)) {
                $plain = implode("\n", array_map(fn ($row) => $row['text'], $timed));
                $lrc = implode("\n", array_map(function ($row) {
                    $sec = (int) floor($row['t']);
                    $min = (int) floor($sec / 60);
                    $s = $sec % 60;
                    return sprintf('[%02d:%02d] %s', $min, $s, $row['text']);
                }, $timed));
                return response()->json([
                    'lyrics' => $plain,
                    'plain' => $plain,
                    'lrc' => $lrc,
                    'timed' => $timed,
                    'synced' => true,
                    'message' => null,
                ]);
            }
        }

        $plainRaw = trim((string) ($payload['plainLyrics'] ?? ''));
        if ($plainRaw !== '') {
            $timed = $this->segmentPlainLyrics($plainRaw, $start, $end);
            $plain = implode("\n", array_map(fn ($row) => $row['text'], $timed));
            $lrc = implode("\n", array_map(function ($row) {
                $sec = (int) floor($row['t']);
                $min = (int) floor($sec / 60);
                $s = $sec % 60;
                return sprintf('[%02d:%02d] %s', $min, $s, $row['text']);
            }, $timed));

            return response()->json([
                'lyrics' => $plain,
                'plain' => $plain,
                'lrc' => $lrc,
                'timed' => $timed,
                'synced' => false,
                'message' => 'Letra aproximada segmentada automáticamente para este fragmento.',
            ]);
        }

        $hardFallback = "♪ {$titulo} - {$artista} ♪";
        return response()->json([
            'lyrics' => $hardFallback,
            'plain' => $hardFallback,
            'lrc' => $hardFallback,
            'synced' => false,
            'message' => 'No hay letra disponible en proveedores externos. Mostrando fallback.',
        ]);
    }

    private function buscarDeezer(string $q, int $limit = 18): array
    {
        try {
            $resp = Http::timeout(6)->get('https://api.deezer.com/search', [
                'q'     => $q,
                'limit' => $limit,
            ]);
            if (!$resp->ok()) return [];
            $data = $resp->json('data') ?? [];
            return array_values(array_filter(array_map(function ($t) {
                $preview = (string) ($t['preview'] ?? '');
                if (!$this->isStablePreviewUrl($preview)) return null;
                return [
                    'fuente'   => 'deezer',
                    'id'       => 'dz-' . ($t['id'] ?? ''),
                    'titulo'   => $t['title'] ?? '',
                    'artista'  => $t['artist']['name'] ?? '',
                    'album'    => $t['album']['title'] ?? '',
                    'thumb'    => $t['album']['cover_medium'] ?? ($t['album']['cover'] ?? ''),
                    'audio'    => $preview,
                    'duracion' => 30,
                ];
            }, $data)));
        } catch (\Throwable $e) {
            report($e);
            return [];
        }
    }

    private function buscarItunes(string $q, int $limit = 10): array
    {
        try {
            $resp = Http::timeout(6)->get('https://itunes.apple.com/search', [
                'term'    => $q,
                'media'   => 'music',
                'entity'  => 'song',
                'limit'   => $limit,
            ]);
            if (!$resp->ok()) return [];
            $data = $resp->json('results') ?? [];
            return array_values(array_filter(array_map(function ($t) {
                if (empty($t['previewUrl'])) return null;
                $thumb = $t['artworkUrl100'] ?? '';
                if ($thumb) $thumb = str_replace('100x100bb', '300x300bb', $thumb);
                return [
                    'fuente'   => 'itunes',
                    'id'       => 'it-' . ($t['trackId'] ?? ''),
                    'titulo'   => $t['trackName'] ?? '',
                    'artista'  => $t['artistName'] ?? '',
                    'album'    => $t['collectionName'] ?? '',
                    'thumb'    => $thumb,
                    'audio'    => $t['previewUrl'],
                    'duracion' => 30,
                ];
            }, $data)));
        } catch (\Throwable $e) {
            report($e);
            return [];
        }
    }

    private function resolverSlugOcasion(?string $slug, mixed $ocasionId): ?string
    {
        $slug = trim((string) $slug);
        if ($slug !== '') {
            return mb_strtolower($slug);
        }

        if ($ocasionId) {
            $dbSlug = Ocasion::query()->where('id', (int) $ocasionId)->value('slug');
            return $dbSlug ? mb_strtolower($dbSlug) : null;
        }

        return null;
    }

    private function buildSuggestionQueries(?string $slug, string $mensaje): array
    {
        $queries = [];

        if ($slug && isset(self::KEYWORDS_BY_OCASION[$slug])) {
            $queries = array_merge($queries, self::KEYWORDS_BY_OCASION[$slug]);
        }

        $moodTerms = $this->extractMoodTerms($mensaje);
        if (!empty($moodTerms)) {
            $queries = array_merge($queries, $moodTerms);
        }

        if (empty($queries)) {
            $queries = ['canciones para dedicar', 'baladas romanticas', 'pop latino'];
        }

        return array_values(array_slice(array_unique($queries), 0, 5));
    }

    private function extractMoodTerms(string $mensaje): array
    {
        $mensajeNorm = mb_strtolower($mensaje);
        $terms = [];

        foreach (self::MOOD_BY_TEXT as $bucket => $triggers) {
            foreach ($triggers as $trigger) {
                if (str_contains($mensajeNorm, mb_strtolower($trigger))) {
                    $terms[] = match ($bucket) {
                        'agradecimiento' => 'canciones de agradecimiento',
                        'romantico'      => 'baladas de amor',
                        'feliz'          => 'canciones alegres',
                        'nostalgico'     => 'clasicos nostalgicos',
                        'motivador'      => 'canciones motivadoras',
                        default          => 'canciones para dedicar',
                    };
                    break;
                }
            }
        }

        return $terms;
    }

    private function dedupeItems(array $items, int $limit): array
    {
        $seen = [];
        $clean = [];
        foreach ($items as $it) {
            $key = mb_strtolower(($it['titulo'] ?? '') . '|' . ($it['artista'] ?? ''));
            if ($key === '|' || isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;
            $clean[] = $it;
            if (count($clean) >= $limit) {
                break;
            }
        }

        return $clean;
    }

    private function extractTimedSegment(string $syncedLyrics, int $start, int $end): array
    {
        $lines = preg_split('/\R/u', $syncedLyrics) ?: [];
        $entries = [];

        foreach ($lines as $line) {
            if (!preg_match('/^\[(\d{1,2}):(\d{2})(?:[\.:](\d{1,3}))?\]\s*(.*)$/u', trim($line), $m)) {
                continue;
            }

            $min = (int) $m[1];
            $sec = (int) $m[2];
            $msRaw = $m[3] ?? '0';
            $text = trim((string) ($m[4] ?? ''));

            if ($text === '') {
                continue;
            }

            $fraction = 0.0;
            if ($msRaw !== '0') {
                $len = strlen($msRaw);
                $fraction = $len === 3 ? ((int) $msRaw / 1000) : ((int) $msRaw / 100);
            }

            $time = ($min * 60) + $sec + $fraction;
            $entries[] = ['t' => $time, 'text' => $text];
        }

        if (empty($entries)) {
            return [];
        }

        $picked = [];
        foreach ($entries as $entry) {
            if ($entry['t'] >= $start && $entry['t'] <= $end) {
                $picked[] = $entry;
            }
        }

        if (empty($picked)) {
            // Fallback: línea más cercana al inicio + 2 líneas siguientes.
            $closestIdx = 0;
            $closestDiff = PHP_FLOAT_MAX;
            foreach ($entries as $idx => $entry) {
                $diff = abs($entry['t'] - $start);
                if ($diff < $closestDiff) {
                    $closestDiff = $diff;
                    $closestIdx = $idx;
                }
            }
            $picked = array_slice($entries, $closestIdx, 4);
        }

        $final = [];
        $seen = [];
        foreach ($picked as $row) {
            $k = mb_strtolower($row['text']);
            if (isset($seen[$k])) continue;
            $seen[$k] = true;
            $final[] = $row;
            if (count($final) >= 6) break;
        }

        return $final;
    }

    private function segmentPlainLyrics(string $plainLyrics, int $start, int $end): array
    {
        $lines = array_values(array_filter(array_map('trim', preg_split('/\R/u', $plainLyrics) ?: [])));
        if (empty($lines)) {
            return [];
        }

        $lines = array_slice($lines, 0, 8);
        $duration = max(1, $end - $start);
        $step = $duration / max(1, count($lines));
        $out = [];

        foreach ($lines as $i => $text) {
            $out[] = [
                't' => $start + ($i * $step),
                'text' => $text,
            ];
        }

        return $out;
    }

    private function fetchBestLyricsPayload(string $titulo, string $artista): ?array
    {
        $fromLrc = $this->fetchLyricsFromLrcLib($titulo, $artista);
        if ($fromLrc) {
            return $fromLrc;
        }

        $fromOvh = $this->fetchPlainLyricsFromOvh($titulo, $artista);
        if ($fromOvh) {
            return ['plainLyrics' => $fromOvh];
        }

        return null;
    }

    private function fetchLyricsFromLrcLib(string $titulo, string $artista): ?array
    {
        try {
            $resp = Http::timeout(3)
                ->connectTimeout(2)
                ->retry(1, 120)
                ->get('https://lrclib.net/api/search', [
                    'track_name'  => $titulo,
                    'artist_name' => $artista,
                ]);

            if (!$resp->ok()) {
                return null;
            }

            $rows = $resp->json();
            if (!is_array($rows) || empty($rows)) {
                return null;
            }

            usort($rows, function (array $a, array $b) use ($titulo, $artista) {
                $score = function (array $row) use ($titulo, $artista): int {
                    $s = 0;
                    if (!empty($row['syncedLyrics'])) $s += 10;
                    if (!empty($row['plainLyrics'])) $s += 2;

                    $rowTitle = mb_strtolower((string) ($row['trackName'] ?? ''));
                    $rowArtist = mb_strtolower((string) ($row['artistName'] ?? ''));
                    $titleNeedle = mb_strtolower($titulo);
                    $artistNeedle = mb_strtolower($artista);

                    if ($rowTitle !== '' && str_contains($rowTitle, $titleNeedle)) $s += 4;
                    if ($rowArtist !== '' && str_contains($rowArtist, $artistNeedle)) $s += 4;
                    return $s;
                };

                return $score($b) <=> $score($a);
            });

            return $rows[0] ?? null;
        } catch (ConnectionException $e) {
            // Timeout/red inestable: devolver null sin ensuciar logs.
            return null;
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }

    private function fetchPlainLyricsFromOvh(string $titulo, string $artista): ?string
    {
        try {
            $artist = rawurlencode($artista);
            $title = rawurlencode($titulo);
            $url = "https://api.lyrics.ovh/v1/{$artist}/{$title}";

            $resp = Http::timeout(3)
                ->connectTimeout(2)
                ->retry(1, 120)
                ->get($url);

            if (!$resp->ok()) {
                return null;
            }

            $lyrics = trim((string) $resp->json('lyrics', ''));
            return $lyrics !== '' ? $lyrics : null;
        } catch (ConnectionException $e) {
            return null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function isStablePreviewUrl(string $url): bool
    {
        if ($url === '' || !filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $query = parse_url($url, PHP_URL_QUERY) ?: '';
        // Deezer puede devolver URLs firmadas (hdnea) que expiran rápido y causan 403.
        // Es mejor descartarlas y usar fallback de iTunes.
        if (stripos($query, 'hdnea=') !== false || stripos($query, 'exp=') !== false) {
            return false;
        }

        return true;
    }
}
