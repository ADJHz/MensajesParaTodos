{{--
  Buscador de música tipo "stories" (Facebook/Instagram).
  - Busca en Deezer/iTunes (preview MP3 30s).
  - Deja seleccionar fragmento de 5–15s con dual range.

  Variables disponibles:
    $audio   = array con datos previos (audio_url, audio_titulo, audio_artista, audio_thumb, audio_start, audio_end)
--}}
@php
  $audio   = $audio   ?? [
    'audio_url'     => old('audio_url'),
    'audio_titulo'  => old('audio_titulo'),
    'audio_artista' => old('audio_artista'),
    'audio_thumb'   => old('audio_thumb'),
    'audio_start'   => old('audio_start', 0),
    'audio_end'     => old('audio_end', 15),
    'audio_display_mode' => old('audio_display_mode', 'cover'),
    'audio_lyrics'  => old('audio_lyrics', ''),
    'audio_pos_x'   => old('audio_pos_x', 24),
    'audio_pos_y'   => old('audio_pos_y', 24),
    'audio_scale'   => old('audio_scale', 100),
  ];
  $ocasionId = $ocasionId ?? old('ocasion_id');
  $mensajeTexto = $mensajeTexto ?? old('mensaje', '');
@endphp

<div x-data="musicaPicker({
        url:    @js($audio['audio_url']),
        titulo: @js($audio['audio_titulo']),
        artista:@js($audio['audio_artista']),
        thumb:  @js($audio['audio_thumb']),
        displayMode: @js($audio['audio_display_mode'] ?? 'cover'),
        lyrics: @js($audio['audio_lyrics'] ?? ''),
          posX: {{ (int)($audio['audio_pos_x'] ?? 24) }},
          posY: {{ (int)($audio['audio_pos_y'] ?? 24) }},
          scale: {{ (int)($audio['audio_scale'] ?? 100) }},
          ocasionId: @js($ocasionId),
          mensaje: @js($mensajeTexto),
        start:  {{ (int)($audio['audio_start'] ?? 0) }},
        end:    {{ (int)($audio['audio_end'] ?? 15) }},
     })"
     class="space-y-3">

  <input type="hidden" name="audio_url"     x-bind:value="seleccion.url">
  <input type="hidden" name="audio_titulo"  x-bind:value="seleccion.titulo">
  <input type="hidden" name="audio_artista" x-bind:value="seleccion.artista">
  <input type="hidden" name="audio_thumb"   x-bind:value="seleccion.thumb">
  <input type="hidden" name="audio_start"   x-bind:value="seleccion.start">
  <input type="hidden" name="audio_end"     x-bind:value="seleccion.end">
  <input type="hidden" name="audio_display_mode" x-bind:value="displayMode">
  <input type="hidden" name="audio_pos_x" x-bind:value="posX">
  <input type="hidden" name="audio_pos_y" x-bind:value="posY">
  <input type="hidden" name="audio_scale" x-bind:value="scale">

  <label class="block text-sm font-semibold text-gray-700">
    🎵 Música de fondo <span class="font-normal text-gray-400 text-xs">(opcional — fragmento de 5 a 15 seg)</span>
  </label>

  {{-- Buscador --}}
  <div class="relative">
    <input type="search" x-model="q" @focus="cargarSugerencias(true)" @input.debounce.350ms="buscar()" maxlength="120"
           placeholder="Busca tu canción: artista, título, género…"
           class="w-full ps-11 pe-24 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-400 transition text-sm bg-white">
    <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" aria-hidden="true">
      <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="7"></circle>
        <path d="m20 20-3.5-3.5"></path>
      </svg>
    </span>
    <span x-show="cargando" class="absolute right-3 top-1/2 -translate-y-1/2 text-violet-500 text-xs animate-pulse">Buscando…</span>
  </div>

  {{-- Sugerencias por ocasión/mensaje --}}
  <div x-show="q.length < 2 && sugerencias.length > 0" x-cloak class="space-y-2">
    <div class="flex items-center justify-between">
      <p class="text-xs font-semibold text-violet-700">Sugeridas para este mensaje</p>
      <button type="button" @click="cargarSugerencias(true)" class="text-[11px] text-violet-600 hover:text-violet-800">Actualizar</button>
    </div>
    <div class="max-h-56 overflow-y-auto rounded-xl border border-violet-100 bg-violet-50/40 divide-y divide-violet-100">
      <template x-for="item in sugerencias" :key="'s-' + item.id">
        <button type="button" @click="elegir(item)"
                class="w-full flex items-center gap-3 px-3 py-2 hover:bg-violet-100/70 transition text-left">
          <img :src="item.thumb" alt="" class="w-10 h-10 rounded-lg object-cover bg-gray-200" loading="lazy">
          <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-800 truncate" x-text="item.titulo"></p>
            <p class="text-xs text-gray-500 truncate" x-text="item.artista"></p>
          </div>
          <span class="text-violet-500 text-sm">Sugerida</span>
        </button>
      </template>
    </div>
  </div>

  {{-- Resultados --}}
  <div x-show="resultados.length > 0" x-cloak
       class="max-h-64 overflow-y-auto rounded-xl border border-gray-100 bg-gray-50 divide-y divide-gray-100">
    <template x-for="item in resultados" :key="item.id">
      <button type="button" @click="elegir(item)"
              class="w-full flex items-center gap-3 px-3 py-2 hover:bg-violet-50 transition text-left">
        <img :src="item.thumb" alt="" class="w-12 h-12 rounded-lg object-cover bg-gray-200" loading="lazy">
        <div class="flex-1 min-w-0">
          <p class="text-sm font-semibold text-gray-800 truncate" x-text="item.titulo"></p>
          <p class="text-xs text-gray-500 truncate" x-text="item.artista"></p>
        </div>
        <span class="text-violet-500 text-lg" :class="seleccion.url === item.audio ? 'opacity-100' : 'opacity-40 group-hover:opacity-100'">
          <span x-show="seleccion.url !== item.audio">▶</span>
          <span x-show="seleccion.url === item.audio">✓</span>
        </span>
      </button>
    </template>
  </div>
  <p x-show="!cargando && q.length >= 2 && resultados.length === 0" x-cloak
     class="text-xs text-gray-400 italic">Sin resultados. Prueba otra búsqueda.</p>

  {{-- Canción seleccionada + recortador --}}
  <div x-show="seleccion.url" x-cloak
       class="rounded-2xl border-2 border-violet-200 bg-gradient-to-br from-violet-50 to-pink-50 p-4 space-y-3">
    <div class="flex items-center gap-3">
      <img :src="seleccion.thumb" alt="" class="w-14 h-14 rounded-xl object-cover shadow">
      <div class="flex-1 min-w-0">
        <p class="text-sm font-bold text-gray-800 truncate" x-text="seleccion.titulo"></p>
        <p class="text-xs text-gray-500 truncate" x-text="seleccion.artista"></p>
      </div>
      <button type="button" @click="quitar()"
              class="text-xs px-2 py-1 rounded-lg text-rose-600 hover:bg-rose-100 transition">✕ Quitar</button>
    </div>

    <audio x-ref="audio" :src="seleccion.url" preload="metadata" crossorigin="anonymous"
           @loadedmetadata="duracion = Math.floor($refs.audio.duration) || 30"
           @timeupdate="onTimeUpdate()"></audio>

    <div class="space-y-2">
      <div class="flex items-center justify-between text-[11px] text-gray-600 font-mono">
        <span>Inicio: <b x-text="seleccion.start + 's'"></b></span>
        <span class="text-violet-600">Fragmento: <b x-text="(seleccion.end - seleccion.start) + 's'"></b></span>
        <span>Fin: <b x-text="seleccion.end + 's'"></b></span>
      </div>

      {{-- Dual range hecho con dos sliders apilados --}}
      <div class="relative h-8 px-1 select-none">
        <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 h-2 bg-gray-200 rounded-full"></div>
        <div class="absolute top-1/2 -translate-y-1/2 h-2 bg-violet-500 rounded-full"
             :style="`left:${(seleccion.start/duracion)*100}%; right:${100-(seleccion.end/duracion)*100}%`"></div>
        <input type="range" min="0" :max="duracion - 5" step="1"
               x-model.number="seleccion.start"
               @pointerdown="activo='start'"
               @input="ajustarStart()"
               class="absolute inset-0 w-full appearance-none bg-transparent pointer-events-none range-handle"
               :style="`z-index:${activo === 'start' ? 30 : 20}`"
               style="-webkit-appearance:none">
        <input type="range" min="5" :max="duracion" step="1"
               x-model.number="seleccion.end"
               @pointerdown="activo='end'"
               @input="ajustarEnd()"
               class="absolute inset-0 w-full appearance-none bg-transparent pointer-events-none range-handle"
               :style="`z-index:${activo === 'end' ? 30 : 20}`"
               style="-webkit-appearance:none">
      </div>

      <div class="grid grid-cols-2 gap-2">
        <button type="button" @click="nudge('start', -1)" class="rounded-lg border border-violet-200 text-violet-700 text-xs py-1.5 hover:bg-violet-50">-1s inicio</button>
        <button type="button" @click="nudge('end', 1)" class="rounded-lg border border-violet-200 text-violet-700 text-xs py-1.5 hover:bg-violet-50">+1s fin</button>
      </div>

      <div class="flex items-center justify-between gap-2">
        <button type="button" @click="probar()"
                class="flex-1 py-2 rounded-full bg-violet-600 text-white text-sm font-bold hover:bg-violet-700 transition shadow">
          <span x-show="!reproduciendo">▶ Probar fragmento</span>
          <span x-show="reproduciendo">⏸ Detener</span>
        </button>
      </div>
      <p x-show="audioError" x-cloak x-text="audioError"
         class="text-[11px] text-rose-700 bg-rose-50 border border-rose-200 rounded-lg px-2 py-1"></p>
      <p class="text-[10px] text-gray-400 text-center">Vista previa de 30 s vía Deezer · Recorta de 5 a 15 s para tu mensaje.</p>
    </div>
  </div>

  <div x-show="seleccion.url" x-cloak class="rounded-2xl border border-violet-200 bg-white p-4 space-y-3">
    <p class="text-sm font-semibold text-gray-700">🎛️ Cómo mostrar la canción en la carta</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <button type="button" @click="setDisplayMode('cover')"
              :class="displayMode==='cover' ? 'bg-violet-600 text-white border-violet-600' : 'bg-white text-violet-700 border-violet-200'"
              class="rounded-xl border px-3 py-2 text-xs font-semibold transition">Carátula</button>
        <button type="button" @click="setDisplayMode('cover_lyrics')"
              :class="displayMode==='cover_lyrics' ? 'bg-violet-600 text-white border-violet-600' : 'bg-white text-violet-700 border-violet-200'"
              class="rounded-xl border px-3 py-2 text-xs font-semibold transition">Carátula + letra</button>
        <button type="button" @click="setDisplayMode('lyrics')"
              :class="displayMode==='lyrics' ? 'bg-violet-600 text-white border-violet-600' : 'bg-white text-violet-700 border-violet-200'"
              class="rounded-xl border px-3 py-2 text-xs font-semibold transition">Solo letra</button>
        <button type="button" @click="setDisplayMode('vinyl')"
              :class="displayMode==='vinyl' ? 'bg-violet-600 text-white border-violet-600' : 'bg-white text-violet-700 border-violet-200'"
              class="rounded-xl border px-3 py-2 text-xs font-semibold transition">Disco de acetato</button>
    </div>

    <div x-show="displayMode==='lyrics' || displayMode==='cover_lyrics'" x-cloak>
        <label class="block text-xs font-semibold text-gray-600 mb-1">Letra automática según el rango seleccionado</label>
        <div class="w-full rounded-xl border border-violet-200 bg-violet-50/40 text-sm px-3 py-2 min-h-[84px]">
    <p x-show="lyricsLoading" class="text-violet-600 text-xs animate-pulse">Buscando letra sincronizada...</p>
    <p x-show="!lyricsLoading && !lyricsPlain && !lyricsError" class="text-gray-400 text-xs">Se cargará automáticamente según los segundos del slider.</p>
    <p x-show="!lyricsLoading && lyricsError" x-text="lyricsError" class="text-amber-700 text-xs"></p>
    <p x-show="!lyricsLoading && lyricsPlain" x-text="lyricsPlain" class="whitespace-pre-line text-gray-700 leading-relaxed"></p>
        </div>
      <input type="hidden" name="audio_lyrics" x-bind:value="lyricsLrc || lyricsPlain">
    </div>

    <p class="text-[11px] text-gray-500 border-t border-violet-100 pt-3">La posición del reproductor se aplica automáticamente y puedes afinarla arrastrando el elemento en la vista previa.</p>
  </div>
</div>

@once
<script>
window.musicaPicker = function (inicial) {
  return {
    q: '',
    activo: 'end',
    cargando: false,
    audioError: '',
    lyricsLoading: false,
    lyricsError: '',
    lyricsTimer: null,
    resultados: [],
    sugerencias: [],
    sugerenciasCargadas: false,
    duracion: 30,
    reproduciendo: false,
    displayMode: inicial.displayMode || 'cover',
    lyricsPlain: inicial.lyrics || '',
    lyricsLrc: inicial.lyrics || '',
    posX: Number.isFinite(inicial.posX) ? inicial.posX : 24,
    posY: Number.isFinite(inicial.posY) ? inicial.posY : 24,
    scale: Number.isFinite(inicial.scale) ? inicial.scale : 100,
    showGuide: false,
    snapGuide: true,
    ocasionId: inicial.ocasionId || null,
    mensaje: inicial.mensaje || '',
    seleccion: {
      url:     inicial.url     || '',
      titulo:  inicial.titulo  || '',
      artista: inicial.artista || '',
      thumb:   inicial.thumb   || '',
      start:   Number.isFinite(inicial.start) ? inicial.start : 0,
      end:     Number.isFinite(inicial.end)   ? inicial.end   : 15,
    },
    init() {
      this.cargarSugerencias();
      this.normalizarPos();
      this.normalizarScale();
      this.programarActualizacionLetra();
      this.emitPreviewUpdate();
      window.addEventListener('preview-music-position', (e) => {
        const x = Number(e.detail?.x);
        const y = Number(e.detail?.y);
        if (!Number.isNaN(x) && !Number.isNaN(y)) {
          this.posX = x;
          this.posY = y;
          this.normalizarPos();
          this.normalizarScale();
          this.emitPreviewUpdate();
        }
      });
    },
    async buscar() {
      const term = this.q.trim();
      if (term.length < 2) {
        this.resultados = [];
        if (!this.sugerenciasCargadas) {
          this.cargarSugerencias();
        }
        return;
      }
      this.cargando = true;
      try {
        const r = await fetch('/api/musica/buscar?q=' + encodeURIComponent(term), {
          headers: { 'Accept': 'application/json' }
        });
        if (!r.ok) throw new Error('http ' + r.status);
        const data = await r.json();
        this.resultados = data.items || [];
      } catch (e) {
        console.warn('musica buscar fallo', e);
        this.resultados = [];
      } finally {
        this.cargando = false;
      }
    },
    resolverOcasionId() {
      if (this.ocasionId) return this.ocasionId;
      const node = document.querySelector('input[name="ocasion_id"], select[name="ocasion_id"]');
      return node ? node.value : null;
    },
    resolverMensajeTexto() {
      const editor = document.getElementById('mensaje-editor');
      if (editor && editor.innerText && editor.innerText.trim().length > 0) {
        return editor.innerText.trim().slice(0, 600);
      }
      const textarea = document.getElementById('mensaje');
      if (textarea && textarea.value) {
        return textarea.value.trim().slice(0, 600);
      }
      return String(this.mensaje || '').trim().slice(0, 600);
    },
    async cargarSugerencias(force = false) {
      if (this.sugerenciasCargadas && !force) return;
      this.cargando = true;
      this.sugerenciasCargadas = true;
      try {
        const params = new URLSearchParams();
        const ocasionId = this.resolverOcasionId();
        const mensaje = this.resolverMensajeTexto();
        if (ocasionId) params.set('ocasion_id', ocasionId);
        if (mensaje) params.set('mensaje', mensaje);

        const r = await fetch('/api/musica/sugerencias?' + params.toString(), {
          headers: { 'Accept': 'application/json' }
        });
        if (!r.ok) throw new Error('http ' + r.status);
        const data = await r.json();
        this.sugerencias = (data.items || []).slice(0, 10);
      } catch (e) {
        console.warn('musica sugerencias fallo', e);
        this.sugerencias = [];
      } finally {
        this.cargando = false;
      }
    },
    elegir(item) {
      this.audioError = '';
      this.lyricsError = '';
      this.lyricsPlain = '';
      this.lyricsLrc = '';
      this.seleccion = {
        url: item.audio,
        titulo: item.titulo,
        artista: item.artista,
        thumb: item.thumb,
        start: 0,
        end: 15,
      };
      this.normalizarRango();
      this.reproduciendo = false;
      this.$nextTick(() => {
        if (this.$refs.audio) {
          this.$refs.audio.load();
        }
      });
      this.programarActualizacionLetra();
      this.emitPreviewUpdate();
    },
    quitar() {
      this.pause();
      this.audioError = '';
      this.lyricsError = '';
      this.lyricsPlain = '';
      this.lyricsLrc = '';
      this.seleccion = { url:'', titulo:'', artista:'', thumb:'', start:0, end:15 };
      this.emitPreviewUpdate();
    },
    ajustarStart() {
      this.normalizarRango('start');
      this.syncAudioToSelection('start');
      this.programarActualizacionLetra();
    },
    ajustarEnd() {
      this.normalizarRango('end');
      this.syncAudioToSelection('end');
      this.programarActualizacionLetra();
    },
    nudge(which, delta) {
      if (which === 'start') {
        this.seleccion.start += delta;
        this.normalizarRango('start');
        this.syncAudioToSelection('start');
      } else {
        this.seleccion.end += delta;
        this.normalizarRango('end');
        this.syncAudioToSelection('end');
      }
      this.programarActualizacionLetra();
      this.emitPreviewUpdate();
    },
    setDisplayMode(mode) {
      this.displayMode = mode;
      if (mode === 'lyrics' || mode === 'cover_lyrics') {
        this.programarActualizacionLetra();
      }
      this.emitPreviewUpdate();
    },
    programarActualizacionLetra() {
      clearTimeout(this.lyricsTimer);
      if (!this.seleccion.url || (this.displayMode !== 'lyrics' && this.displayMode !== 'cover_lyrics')) {
        return;
      }
      this.lyricsTimer = setTimeout(() => this.actualizarLetraAutomatica(), 350);
    },
    async actualizarLetraAutomatica() {
      if (!this.seleccion.titulo || !this.seleccion.artista) return;

      this.lyricsLoading = true;
      this.lyricsError = '';
      try {
        const params = new URLSearchParams({
          titulo: this.seleccion.titulo,
          artista: this.seleccion.artista,
          start: String(this.seleccion.start),
          end: String(this.seleccion.end),
        });

        const r = await fetch('/api/musica/letra?' + params.toString(), {
          headers: { 'Accept': 'application/json' }
        });
        if (!r.ok) throw new Error('http ' + r.status);

        const data = await r.json();
        this.lyricsPlain = data.plain || data.lyrics || '';
        this.lyricsLrc = data.lrc || this.lyricsPlain || '';
        if (!data.synced) {
          this.lyricsError = data.message || 'No hay letra sincronizada para ese fragmento.';
        }
      } catch (e) {
        this.lyricsPlain = '';
        this.lyricsLrc = '';
        this.lyricsError = 'No se pudo obtener la letra automática en este momento.';
        console.warn('musica lyrics fallo', e);
      } finally {
        this.lyricsLoading = false;
        this.emitPreviewUpdate();
      }
    },
    setPreset(x, y) {
      this.posX = x;
      this.posY = y;
      this.normalizarPos();
      this.emitPreviewUpdate();
    },
    normalizarPos() {
      this.posX = Math.max(5, Math.min(95, Math.round(this.posX)));
      this.posY = Math.max(5, Math.min(95, Math.round(this.posY)));
    },
    normalizarScale() {
      this.scale = Math.max(70, Math.min(180, Math.round(this.scale)));
    },
    emitPreviewUpdate() {
      window.dispatchEvent(new CustomEvent('music-preview-update', {
        detail: {
          hasAudio: !!this.seleccion.url,
          titulo: this.seleccion.titulo || 'Música',
          artista: this.seleccion.artista || '',
          thumb: this.seleccion.thumb || '',
          displayMode: this.displayMode,
          lyrics: this.lyricsPlain || '',
          posX: this.posX,
          posY: this.posY,
          scale: this.scale,
          showGuide: this.showGuide,
          snapGuide: this.snapGuide,
        }
      }));
    },
    syncAudioToSelection(changed) {
      const a = this.$refs.audio;
      if (!a) return;

      if (this.reproduciendo) {
        if (changed === 'start' || a.currentTime < this.seleccion.start || a.currentTime > this.seleccion.end) {
          a.currentTime = this.seleccion.start;
        }
      } else {
        a.currentTime = this.seleccion.start;
      }
    },
    normalizarRango(prefer = 'end') {
      this.seleccion.start = Math.max(0, Math.min(this.seleccion.start, this.duracion - 5));
      this.seleccion.end = Math.max(5, Math.min(this.seleccion.end, this.duracion));

      let width = this.seleccion.end - this.seleccion.start;
      if (width < 5) {
        if (prefer === 'start') this.seleccion.end = Math.min(this.duracion, this.seleccion.start + 5);
        else this.seleccion.start = Math.max(0, this.seleccion.end - 5);
      }
      width = this.seleccion.end - this.seleccion.start;
      if (width > 15) {
        if (prefer === 'start') this.seleccion.end = this.seleccion.start + 15;
        else this.seleccion.start = this.seleccion.end - 15;
      }

      this.seleccion.start = Math.max(0, Math.min(this.seleccion.start, this.duracion - 5));
      this.seleccion.end = Math.max(5, Math.min(this.seleccion.end, this.duracion));
    },
    probar() {
      const a = this.$refs.audio;
      if (!a || !this.seleccion.url) return;
      if (this.reproduciendo) { this.pause(); return; }
      this.audioError = '';
      a.currentTime = this.seleccion.start;
      a.play().then(() => { this.reproduciendo = true; })
              .catch(err => {
                this.reproduciendo = false;
                this.audioError = 'No se pudo reproducir esta vista previa (URL expirada o bloqueada). Elige otra canción.';
                console.warn('audio play err', err);
              });
    },
    pause() {
      if (this.$refs.audio) this.$refs.audio.pause();
      this.reproduciendo = false;
    },
    onTimeUpdate() {
      const a = this.$refs.audio;
      if (!a || !this.reproduciendo) return;
      if (a.currentTime >= this.seleccion.end) {
        a.currentTime = this.seleccion.start;
      }
    },
  };
};
</script>

<style>
.range-handle::-webkit-slider-runnable-track {
  height: 8px;
  background: transparent;
}
.range-handle::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 18px;
  height: 18px;
  margin-top: -5px;
  border-radius: 9999px;
  background: #1f2937;
  border: 2px solid #ffffff;
  box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.35);
  pointer-events: auto;
  cursor: pointer;
}
.range-handle::-moz-range-track {
  height: 8px;
  background: transparent;
}
.range-handle::-moz-range-thumb {
  width: 18px;
  height: 18px;
  border-radius: 9999px;
  background: #1f2937;
  border: 2px solid #ffffff;
  box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.35);
  pointer-events: auto;
  cursor: pointer;
}
</style>
@endonce
