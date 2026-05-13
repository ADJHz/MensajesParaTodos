{{--
    Reproductor de música del destinatario.
    Modo PRINCIPAL (100% confiable):
      - Si $mensaje->audio_url: usa <audio> HTML5 con loop del fragmento
        elegido (audio_start → audio_end). Sin restricciones de embed.
    Modo FALLBACK:
      - Si solo hay youtube_url: iframe simple (puede ser bloqueado por el sello).

    Variables: $mensaje, $accent, $accent2.
    Auto-arranca al evento 'tpl-carta-abierta' (gesto del usuario al abrir la carta).
--}}
@php
    $accent  = $accent  ?? '#7C3AED';
    $accent2 = $accent2 ?? $accent;
    $tieneAudio   = !empty($mensaje->audio_url);
    $tieneYoutube = !empty($mensaje->youtube_url);
    $audioDisplayMode = $mensaje->audio_display_mode ?? 'cover';
    $audioLyrics = $mensaje->audio_lyrics ?? '';
@endphp

@if($tieneAudio || $tieneYoutube)
<div x-data="reproductorMensaje({
        modo:    @js($tieneAudio ? 'audio' : 'yt'),
        url:     @js($mensaje->audio_url ?? $mensaje->youtube_url),
        titulo:  @js($mensaje->audio_titulo  ?? ''),
        artista: @js($mensaje->audio_artista ?? ''),
        thumb:   @js($mensaje->audio_thumb   ?? ''),
        start:   {{ (int)($mensaje->audio_start ?? 0) }},
        end:     {{ (int)($mensaje->audio_end ?? 15) }},
        displayMode: @js($audioDisplayMode),
        lyrics: @js($audioLyrics),
        posX: {{ (int)($mensaje->audio_pos_x ?? 24) }},
        posY: {{ (int)($mensaje->audio_pos_y ?? 24) }},
        scale: {{ (int)($mensaje->audio_scale ?? 100) }},
     })"
     x-init="init()"
     @tpl-carta-abierta.window="autoArranque()"
     class="fixed z-[60]"
            :style="`top:max(env(safe-area-inset-top),0.75rem); right:max(env(safe-area-inset-right),0.75rem); transform:scale(${Math.min((scale/100),1.15).toFixed(2)}); transform-origin:top right;`"
     role="region"
     aria-label="Reproductor de música">

    {{-- Audio HTML5 (modo principal) --}}
    <template x-if="modo === 'audio'">
        <audio x-ref="audio" :src="url" preload="auto" crossorigin="anonymous" loop="false"
               @timeupdate="onTime()"
               @ended="onEnded()"></audio>
    </template>

    {{-- Iframe YouTube (fallback) --}}
    <template x-if="modo === 'yt'">
        <iframe x-ref="ytFrame"
                allow="autoplay; encrypted-media; picture-in-picture"
                allowfullscreen
                style="position:fixed;left:-9999px;top:0;width:1px;height:1px;border:0;opacity:.01;pointer-events:none;"
                title="Música de fondo"></iframe>
    </template>

    {{-- Vinyl: tocadiscos en esquina superior derecha, responsivo --}}
    <template x-if="modo === 'audio' && displayMode === 'vinyl'">
        <button type="button" @click="toggle()"
                :aria-label="playing ? 'Pausar música' : 'Reproducir música'"
                class="tpl-vinyl-wrap block cursor-pointer transition-transform hover:scale-105 active:scale-95">
            <div class="tpl-vinyl" :class="playing ? 'is-playing' : ''">
                <img :src="thumb" alt="Disco" class="tpl-vinyl-cover">
            </div>
        </button>
    </template>

    {{-- Cover: solo carátula, sin caja blanca --}}
    <template x-if="modo === 'audio' && displayMode === 'cover' && thumb">
        <button type="button" @click="toggle()"
                :aria-label="playing ? 'Pausar música' : 'Reproducir música'"
                class="block rounded-full overflow-hidden shadow-2xl ring-2 ring-white/70 transition-transform hover:scale-105 active:scale-95">
            <img :src="thumb" alt="Carátula"
                 class="w-[clamp(56px,10vw,92px)] h-[clamp(56px,10vw,92px)] object-cover">
        </button>
    </template>

    {{-- Resto de modos: panel informativo --}}
    <div x-show="modo === 'audio' && (displayMode === 'cover_lyrics' || displayMode === 'lyrics')" x-cloak
            class="absolute top-full right-0 mt-2 w-[260px] sm:w-[320px] rounded-2xl border border-violet-200 bg-white/95 backdrop-blur p-3 shadow-xl">
        <div class="flex items-center justify-between mb-2">
            <p class="text-[11px] font-semibold" style="color: {{ $accent }};" x-text="titulo || 'Canción seleccionada'"></p>
            <span class="text-[10px] text-gray-500" x-text="`${start}s - ${end}s`"></span>
        </div>

        <template x-if="displayMode === 'cover' && thumb">
            <div class="flex items-center justify-center py-1">
                <img :src="thumb" alt="Carátula" class="w-36 h-36 rounded-2xl object-cover shadow-lg">
            </div>
        </template>

        <template x-if="displayMode === 'cover_lyrics'">
            <div class="flex gap-3 items-start">
                <img :src="thumb" alt="Carátula" class="w-20 h-20 rounded-xl object-cover bg-gray-200 shadow" x-show="thumb">
                <div class="text-[11px] leading-relaxed max-h-24 overflow-y-auto pr-1 space-y-1 flex-1">
                    <template x-for="(line, idx) in lyricLines" :key="idx">
                        <p :class="idx === activeLyricIndex ? 'text-violet-700 font-bold' : 'text-gray-500'" x-text="line.text"></p>
                    </template>
                    <p x-show="!lyricLines.length" class="text-gray-400">No hay letra disponible para mostrar.</p>
                </div>
            </div>
        </template>

        <template x-if="displayMode === 'lyrics'">
            <div class="text-[11px] leading-relaxed max-h-32 overflow-y-auto pr-1 rounded-xl bg-violet-50 p-2 space-y-1">
                <template x-for="(line, idx) in lyricLines" :key="idx">
                    <p :class="idx === activeLyricIndex ? 'text-violet-700 font-bold' : 'text-gray-600'" x-text="line.text"></p>
                </template>
                <p x-show="!lyricLines.length" class="text-gray-400">No hay letra disponible para mostrar.</p>
            </div>
        </template>
    </div>

    <button x-show="displayMode !== 'vinyl' && displayMode !== 'cover'" @click="toggle()"
            :aria-label="playing ? 'Pausar música' : 'Reproducir música'"
            class="flex items-center gap-2 sm:gap-3 pl-3 pr-4 sm:pl-4 sm:pr-5 py-2.5 sm:py-3 rounded-full shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95 select-none"
            style="background: rgba(255,255,255,0.92); backdrop-filter: blur(16px); border: 1.5px solid {{ $accent }};">

        {{-- Cover si hay --}}
        <template x-if="thumb">
            <img :src="thumb" alt="" class="w-7 h-7 sm:w-9 sm:h-9 rounded-full object-cover shadow-inner">
        </template>

        {{-- Ecualizador --}}
        <div class="flex items-end gap-[3px] h-5 sm:h-6" aria-hidden="true">
            <span class="tpl-eq-bar" :class="!playing && 'tpl-eq-paused'" style="background:{{ $accent }};height:8px;"></span>
            <span class="tpl-eq-bar" :class="!playing && 'tpl-eq-paused'" style="background:{{ $accent }};height:14px;animation-delay:.15s"></span>
            <span class="tpl-eq-bar" :class="!playing && 'tpl-eq-paused'" style="background:{{ $accent }};height:6px;animation-delay:.30s"></span>
            <span class="tpl-eq-bar" :class="!playing && 'tpl-eq-paused'" style="background:{{ $accent }};height:18px;animation-delay:.45s"></span>
            <span class="tpl-eq-bar" :class="!playing && 'tpl-eq-paused'" style="background:{{ $accent }};height:10px;animation-delay:.60s"></span>
        </div>

        {{-- Texto --}}
        <div class="flex flex-col items-start text-[10px] sm:text-xs leading-tight max-w-[120px] sm:max-w-[180px]">
            <span class="font-bold truncate w-full" style="color: {{ $accent }};"
                  x-text="titulo || (playing ? 'Sonando' : 'Música')"></span>
            <span class="text-gray-500 truncate w-full" x-show="artista" x-text="artista"></span>
        </div>
    </button>

    <p x-show="hint && displayMode !== 'vinyl' && displayMode !== 'cover'" x-cloak x-transition
       class="absolute top-full right-0 mt-2 px-3 py-2 rounded-xl bg-amber-900/90 border border-amber-400/40 text-amber-100 text-[11px] shadow-lg whitespace-nowrap">
        Toca el botón para escuchar la canción 🔊
    </p>
</div>

<style>
.tpl-eq-bar {
    width: 3px;
    border-radius: 2px;
    display: inline-block;
    animation: tplEq 1.1s ease-in-out infinite;
}
.tpl-eq-paused { animation-play-state: paused !important; opacity: .45; }
@keyframes tplEq {
    0%, 100% { transform: scaleY(.4); }
    50%      { transform: scaleY(1); }
}

.tpl-vinyl {
    width: clamp(60px, 11vw, 100px);
    height: clamp(60px, 11vw, 100px);
    border-radius: 9999px;
    background: radial-gradient(circle at center, #111827 0 22%, #030712 22% 100%);
    border: 3px solid #0f172a;
    position: relative;
    box-shadow: 0 10px 25px rgba(2, 6, 23, 0.35);
    box-sizing: border-box;
    flex-shrink: 0;
}

.tpl-vinyl-wrap {
    flex-shrink: 0;
}

.tpl-vinyl::before {
    content: '';
    position: absolute;
    inset: 8px;
    border-radius: 9999px;
    border: 1px solid rgba(255, 255, 255, 0.12);
}

.tpl-vinyl-cover {
    position: absolute;
    inset: 26%;
    width: 48%;
    height: 48%;
    border-radius: 9999px;
    object-fit: cover;
    border: 3px solid #111827;
}

.tpl-vinyl.is-playing {
    animation: tplSpin 3.2s linear infinite;
}

@keyframes tplSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<script>
window.reproductorMensaje = function (cfg) {
    return {
        modo: cfg.modo,
        url: cfg.url,
        titulo: cfg.titulo,
        artista: cfg.artista,
        thumb: cfg.thumb,
        start: cfg.start | 0,
        end: cfg.end | 0,
        displayMode: cfg.displayMode || 'cover',
        lyrics: cfg.lyrics || '',
        posX: Math.max(5, Math.min(95, cfg.posX || 24)),
        posY: Math.max(5, Math.min(95, cfg.posY || 24)),
        scale: Math.max(70, Math.min(180, cfg.scale || 100)),
        playing: false,
        hint: false,
        lyricLines: [],
        activeLyricIndex: -1,

        init() {
            this.prepareLyrics();
            this.cartaAbiertaRecibida = false;
            // Si la plantilla dispara el evento de apertura, lo marcamos para no duplicar el arranque
            window.addEventListener('tpl-carta-abierta', () => { this.cartaAbiertaRecibida = true; }, { once: true });
            // Fallback: si la plantilla NO tiene interacción de apertura (no llegó el evento),
            // intentamos reproducir automáticamente al cargar.
            setTimeout(() => {
                if (!this.cartaAbiertaRecibida && !this.playing) {
                    this.autoArranque();
                }
            }, 1200);
            // mostrar hint después de 6s si aun no se reproduce
            setTimeout(() => { if (!this.playing) this.hint = true; }, 6000);
        },

        autoArranque() {
            // Disparado por apertura de carta o por fallback automático para plantillas sin interacción
            this.play();
        },

        toggle() { this.playing ? this.pause() : this.play(); },

        play() {
            this.hint = false;
            if (this.modo === 'audio') {
                const a = this.$refs.audio;
                if (!a) return;
                if (a.currentTime < this.start || a.currentTime >= this.end) {
                    a.currentTime = this.start;
                }
                a.volume = 0.85;
                a.play()
                 .then(() => { this.playing = true; })
                 .catch(err => { console.warn('audio play bloqueado', err); this.hint = true; });
            } else {
                // fallback YT
                const f = this.$refs.ytFrame;
                if (!f) return;
                f.src = this.buildYt(this.url, true);
                this.playing = true;
            }
        },

        pause() {
            if (this.modo === 'audio') {
                if (this.$refs.audio) this.$refs.audio.pause();
            } else {
                if (this.$refs.ytFrame) this.$refs.ytFrame.src = this.buildYt(this.url, false);
            }
            this.playing = false;
        },

        onTime() {
            const a = this.$refs.audio;
            if (!a || !this.playing) return;
            this.updateActiveLyric(a.currentTime);
            // loop dentro del fragmento
            if (a.currentTime >= this.end) {
                a.currentTime = this.start;
            }
        },

        onEnded() {
            const a = this.$refs.audio;
            if (!a) return;
            a.currentTime = this.start;
            a.play().catch(() => {});
        },

        buildYt(url, autoplay) {
            try {
                const u = new URL(url);
                let id = '';
                if (u.hostname.includes('youtu.be')) id = u.pathname.replace('/', '');
                else id = u.searchParams.get('v') || '';
                if (!id) return '';
                const ap = autoplay ? 1 : 0;
                return `https://www.youtube-nocookie.com/embed/${id}?autoplay=${ap}&loop=1&playlist=${id}&controls=0&modestbranding=1&rel=0&playsinline=1`;
            } catch { return ''; }
        },

        prepareLyrics() {
            const raw = String(this.lyrics || '').trim();
            if (!raw) {
                this.lyricLines = [];
                this.activeLyricIndex = -1;
                return;
            }

            const parsed = this.parseLrc(raw);
            if (parsed.length) {
                this.lyricLines = parsed;
                return;
            }

            const lines = raw
                .split(/\r?\n/)
                .map(l => l.trim())
                .filter(Boolean)
                .slice(0, 8);

            if (!lines.length) {
                this.lyricLines = [];
                return;
            }

            const duration = Math.max(1, this.end - this.start);
            const step = duration / Math.max(1, lines.length);
            this.lyricLines = lines.map((text, idx) => ({
                t: this.start + (idx * step),
                text,
            }));
        },

        parseLrc(raw) {
            const lines = raw.split(/\r?\n/);
            const out = [];
            for (const line of lines) {
                const m = line.match(/^\[(\d{1,2}):(\d{2})(?:[\.:](\d{1,3}))?\]\s*(.*)$/);
                if (!m) continue;
                const min = Number(m[1] || 0);
                const sec = Number(m[2] || 0);
                const fracRaw = m[3] || '0';
                const text = String(m[4] || '').trim();
                if (!text) continue;
                const frac = fracRaw.length === 3 ? Number(fracRaw) / 1000 : Number(fracRaw) / 100;
                out.push({ t: (min * 60) + sec + frac, text });
            }
            return out;
        },

        updateActiveLyric(currentTime) {
            if (!this.lyricLines.length) {
                this.activeLyricIndex = -1;
                return;
            }

            let idx = -1;
            for (let i = 0; i < this.lyricLines.length; i++) {
                if (currentTime >= this.lyricLines[i].t) idx = i;
                else break;
            }
            this.activeLyricIndex = idx;
        },
    };
};
</script>
@endif
