{{--
    Partial reutilizable para narración de voz natural en español.
    Variables esperadas:
      - $textoVoz   string  Texto plano que se va a leer
      - $colorBoton string  Clase tailwind del botón
      - $genero     string  'femenino' | 'masculino'
--}}
@php
    $textoVoz   = $textoVoz   ?? '';
    $colorBoton = $colorBoton ?? 'bg-violet-600 hover:bg-violet-700';
    $genero     = $genero     ?? 'femenino';
    $voz        = $voz        ?? null;   // ej. 'es-MX-JorgeNeural'
    $rate       = $rate       ?? null;   // ej. 8 (±50)
    $pitch      = $pitch      ?? null;   // ej. -2 (±50)
@endphp

<div x-data='narradorVoz({
        texto: @json(trim($textoVoz)),
        genero: @json($genero),
        voz: @json($voz),
        rate: @json($rate),
        pitch: @json($pitch),
        endpoint: @json(route("tts.speak"))
    })'
     x-init="init()"
     class="text-center">

    <button @click="alternar()" type="button"
            :disabled="cargando"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-white text-sm font-bold transition shadow-md disabled:opacity-60 disabled:cursor-wait {{ $colorBoton }}">
        <template x-if="cargando">
            <svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity=".25" stroke-width="3"/>
                <path d="M12 2a10 10 0 0 1 10 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            </svg>
        </template>
        <template x-if="!cargando && !reproduciendo">
            <span aria-hidden="true">🔊</span>
        </template>
        <template x-if="reproduciendo">
            <span aria-hidden="true">⏸️</span>
        </template>

        <span x-show="!cargando && !reproduciendo">Escuchar mensaje</span>
        <span x-show="cargando">Preparando voz...</span>
        <span x-show="reproduciendo && !cargando">Pausar</span>
    </button>

    <p x-show="error" x-text="error" x-cloak class="text-xs text-red-500 mt-2"></p>

    <audio x-ref="audio"
           preload="none"
           @ended="reproduciendo=false"
           @pause="reproduciendo=false"
           @play="reproduciendo=true"
           class="hidden"></audio>
</div>

@once
<script>
    window.narradorVoz = function(cfg){
        return {
            cargando: false,
            reproduciendo: false,
            error: '',
            audioUrl: null,
            voces: [],

            init(){
                if ('speechSynthesis' in window) {
                    const cargar = () => { this.voces = window.speechSynthesis.getVoices() || []; };
                    cargar();
                    window.speechSynthesis.onvoiceschanged = cargar;
                }
            },

            limpiarTexto(t){
                return (t || '')
                    .replace(/[\u{1F300}-\u{1FAFF}]/gu, '')
                    .replace(/[\u{2600}-\u{27BF}]/gu, '')
                    .replace(/<[^>]+>/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim();
            },

            alternar(){
                const audio = this.$refs.audio;
                if (this.reproduciendo) { audio.pause(); return; }
                if (this.audioUrl && audio.src) {
                    audio.currentTime = 0;
                    audio.play().catch(() => this.fallbackWebSpeech());
                    return;
                }
                this.reproducir();
            },

            async reproducir(){
                this.error = '';
                const texto = this.limpiarTexto(cfg.texto);
                if (!texto) { this.error = 'No hay texto para leer.'; return; }

                const textoCorto = texto.length > 1500 ? texto.slice(0, 1497) + '...' : texto;

                this.cargando = true;
                try {
                    const url = await this.obtenerAudioBackend(textoCorto);
                    await this.reproducirUrl(url);
                } catch (e) {
                    console.warn('TTS backend falló, usando Web Speech', e);
                    this.fallbackWebSpeech(textoCorto);
                } finally {
                    this.cargando = false;
                }
            },

            async obtenerAudioBackend(texto){
                // Voz neural: usa la indicada por el partial; si no, una por género
                const voz = cfg.voz || (cfg.genero === 'masculino'
                    ? 'es-MX-JorgeNeural'
                    : 'es-MX-DaliaNeural');

                let url = cfg.endpoint
                    + '?voice=' + encodeURIComponent(voz)
                    + '&genero=' + encodeURIComponent(cfg.genero)
                    + '&lang=es-MX'
                    + '&text=' + encodeURIComponent(texto);

                if (cfg.rate  !== null && cfg.rate  !== undefined) url += '&rate='  + encodeURIComponent(cfg.rate);
                if (cfg.pitch !== null && cfg.pitch !== undefined) url += '&pitch=' + encodeURIComponent(cfg.pitch);

                const resp = await fetch(url, { credentials: 'same-origin' });
                if (!resp.ok) throw new Error('TTS HTTP ' + resp.status);
                const blob = await resp.blob();
                if (!blob || blob.size < 200) throw new Error('TTS empty blob');
                return URL.createObjectURL(blob);
            },

            async reproducirUrl(url){
                this.audioUrl = url;
                const audio = this.$refs.audio;
                audio.src = url;
                audio.playbackRate = 1.0;
                audio.preservesPitch = true;

                // Pasar el audio por Web Audio API para darle calidez (voz neural ya es muy humana,
                // sólo aplicamos un realce sutil de presencia + warmth).
                this.aplicarFiltroWarmth(audio);

                audio.load();
                await audio.play();
            },

            aplicarFiltroWarmth(audio){
                try {
                    if (audio._warmthApplied) return;
                    const Ctx = window.AudioContext || window.webkitAudioContext;
                    if (!Ctx) return;
                    const ctx = window._fxAudioCtx || (window._fxAudioCtx = new Ctx());
                    if (ctx.state === 'suspended') ctx.resume();

                    const src = ctx.createMediaElementSource(audio);

                    // Realce de presencia (aire en agudos)
                    const presence = ctx.createBiquadFilter();
                    presence.type = 'peaking';
                    presence.frequency.value = 3200;
                    presence.Q.value = 1.1;
                    presence.gain.value = 2.5;

                    // Calidez (medios bajos)
                    const warmth = ctx.createBiquadFilter();
                    warmth.type = 'peaking';
                    warmth.frequency.value = 220;
                    warmth.Q.value = 0.9;
                    warmth.gain.value = 2.0;

                    // Quitar zumbidos graves y agudos chillones
                    const hp = ctx.createBiquadFilter();
                    hp.type = 'highpass'; hp.frequency.value = 80;
                    const lp = ctx.createBiquadFilter();
                    lp.type = 'lowshelf'; lp.frequency.value = 8500; lp.gain.value = -2;

                    // Compresión suave para parejar dinámica
                    const comp = ctx.createDynamicsCompressor();
                    comp.threshold.value = -22;
                    comp.knee.value = 18;
                    comp.ratio.value = 2.2;
                    comp.attack.value = 0.01;
                    comp.release.value = 0.18;

                    const gain = ctx.createGain();
                    gain.gain.value = 1.15;

                    src.connect(hp).connect(warmth).connect(presence).connect(lp).connect(comp).connect(gain).connect(ctx.destination);
                    audio._warmthApplied = true;
                } catch (e) {
                    // Si el navegador bloquea el AudioContext, simplemente reproducimos sin filtro
                    console.debug('Warmth filter no disponible:', e);
                }
            },

            fallbackWebSpeech(textoOpcional){
                if (!('speechSynthesis' in window)) {
                    this.error = 'Tu navegador no soporta voz. Intenta en Chrome o Edge.';
                    return;
                }
                const texto = this.limpiarTexto(textoOpcional || cfg.texto);
                if (!texto) return;

                const voz = this.elegirVozNavegador(cfg.genero);
                const bloques = texto.match(/[^.!?]+[.!?]*/g) || [texto];

                window.speechSynthesis.cancel();
                this.reproduciendo = true;

                bloques.forEach((bloque, i) => {
                    const u = new SpeechSynthesisUtterance(bloque.trim());
                    u.lang  = (voz && voz.lang) || 'es-MX';
                    if (voz) u.voice = voz;
                    u.rate  = cfg.genero === 'femenino' ? 0.95 : 0.9;
                    u.pitch = cfg.genero === 'femenino' ? 1.2  : 0.85;
                    u.volume = 1;
                    if (i === bloques.length - 1) {
                        u.onend = () => { this.reproduciendo = false; };
                    }
                    window.speechSynthesis.speak(u);
                });
            },

            elegirVozNavegador(genero){
                const voces = this.voces || [];
                if (!voces.length) return null;

                const femeninoHints  = ['mia','sabina','helena','laura','paulina','elena','dalia','female','mujer','femenina'];
                const masculinoHints = ['miguel','jorge','enrique','diego','pablo','male','hombre','masculino'];
                const hints = genero === 'femenino' ? femeninoHints : masculinoHints;

                const puntuar = (v) => {
                    let p = 0;
                    const lang = (v.lang || '').toLowerCase();
                    const name = (v.name || '').toLowerCase();
                    if (lang.startsWith('es-mx')) p += 120;
                    else if (lang.startsWith('es-419')) p += 110;
                    else if (lang.startsWith('es-us')) p += 100;
                    else if (lang.startsWith('es')) p += 80;
                    if (hints.some(h => name.includes(h))) p += 50;
                    if (name.includes('natural') || name.includes('neural') || name.includes('online')) p += 40;
                    if (name.includes('google') || name.includes('microsoft')) p += 20;
                    return p;
                };

                return [...voces].sort((a,b) => puntuar(b) - puntuar(a))[0] || null;
            }
        };
    };
</script>
@endonce
