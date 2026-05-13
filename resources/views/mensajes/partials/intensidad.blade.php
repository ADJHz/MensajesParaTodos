{{--
    Editor visual de intensidad de efectos.
    Botón flotante (esquina inferior izquierda) con 4 niveles:
        off, suave, normal, fiesta
    Persiste en localStorage. Llama window.fxAplicarIntensidad().
    Uso: @include('mensajes.partials.intensidad')
--}}
<div x-data="fxIntensidad()" x-cloak class="fx-intensidad-widget" aria-label="Intensidad de efectos">
    {{-- Botón flotante --}}
    <button type="button"
            @click="abierto = !abierto"
            class="fx-intensidad-btn"
            :class="abierto ? 'is-open' : ''"
            :title="'Efectos: ' + nivel">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2 L14 8 L20 8 L15 12 L17 18 L12 14 L7 18 L9 12 L4 8 L10 8 Z"/>
        </svg>
    </button>

    {{-- Panel --}}
    <div class="fx-intensidad-panel" x-show="abierto" @click.outside="abierto=false" x-transition>
        <p class="fx-intensidad-titulo">✨ Efectos visuales</p>
        <template x-for="opt in niveles" :key="opt.id">
            <button type="button"
                    @click="cambiar(opt.id)"
                    class="fx-intensidad-opt"
                    :class="nivel === opt.id ? 'is-active' : ''">
                <span class="fx-intensidad-emoji" x-text="opt.emoji"></span>
                <span class="fx-intensidad-label">
                    <strong x-text="opt.label"></strong>
                    <small x-text="opt.desc"></small>
                </span>
            </button>
        </template>
        <button type="button" @click="lanzarConfeti" class="fx-intensidad-festejar">
            🎉 ¡Lanzar confeti!
        </button>
    </div>
</div>

@once
    <style>
        [x-cloak] { display: none !important; }
        .fx-intensidad-widget {
            position: fixed; left: 16px; bottom: 16px; z-index: 60;
            font-family: ui-sans-serif, system-ui, sans-serif;
        }
        .fx-intensidad-btn {
            width: 44px; height: 44px; border-radius: 9999px;
            background: rgba(255,255,255,.92);
            color: #be185d;
            border: 2px solid #f9a8d4;
            box-shadow: 0 6px 18px rgba(0,0,0,.18);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: transform .2s, box-shadow .2s;
        }
        .fx-intensidad-btn:hover { transform: scale(1.08); box-shadow: 0 8px 22px rgba(190,24,93,.35); }
        .fx-intensidad-btn.is-open { background: #be185d; color: #fff; border-color: #be185d; }

        .fx-intensidad-panel {
            position: absolute; bottom: 56px; left: 0;
            background: rgba(255,255,255,.97);
            backdrop-filter: blur(8px);
            border-radius: 14px;
            padding: 12px;
            min-width: 240px;
            box-shadow: 0 18px 40px rgba(0,0,0,.25);
            border: 1px solid rgba(190,24,93,.2);
        }
        .fx-intensidad-titulo {
            font-weight: 700; color: #be185d; margin: 0 0 8px; font-size: 14px;
            text-align: center;
        }
        .fx-intensidad-opt {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 8px 10px; margin-bottom: 4px;
            border-radius: 10px; border: 1px solid transparent;
            background: #fdf2f8; cursor: pointer;
            transition: background .15s, border-color .15s;
            text-align: left;
        }
        .fx-intensidad-opt:hover { background: #fce7f3; }
        .fx-intensidad-opt.is-active {
            background: linear-gradient(135deg, #fbcfe8, #fef3c7);
            border-color: #be185d;
        }
        .fx-intensidad-emoji { font-size: 22px; line-height: 1; }
        .fx-intensidad-label strong { display: block; font-size: 13px; color: #831843; }
        .fx-intensidad-label small  { display: block; font-size: 11px; color: #6b7280; }
        .fx-intensidad-festejar {
            margin-top: 8px; width: 100%; padding: 8px;
            border: 0; border-radius: 10px; cursor: pointer;
            background: linear-gradient(135deg, #ec4899, #f59e0b);
            color: #fff; font-weight: 700;
        }
        .fx-intensidad-festejar:hover { filter: brightness(1.05); }

        /* Reglas de intensidad globales */
        body[data-fx-intensidad="off"]   .fx-particles,
        body[data-fx-intensidad="off"]   .fx-overlay,
        body[data-fx-intensidad="off"]   .fx-sticker,
        body[data-fx-intensidad="off"]   .fx-halo { display: none !important; }
        body[data-fx-intensidad="suave"] .fx-overlay { opacity: .55; }
        body[data-fx-intensidad="suave"] .fx-sticker { opacity: .6; }
        body[data-fx-intensidad="fiesta"] .fx-overlay { opacity: 1; filter: saturate(1.2); }
        body[data-fx-intensidad="fiesta"] .fx-sticker .personaje { animation-duration: 1.6s !important; }

        @media print { .fx-intensidad-widget { display: none !important; } }
    </style>
@endonce

@once
    <script>
        function fxIntensidad() {
            return {
                abierto: false,
                nivel: localStorage.getItem('fx-intensidad') || 'normal',
                niveles: [
                    { id: 'off',     emoji: '🚫', label: 'Sin efectos', desc: 'Solo el mensaje, limpio.' },
                    { id: 'suave',   emoji: '🌸', label: 'Suave',       desc: 'Pocos detalles, relajado.' },
                    { id: 'normal',  emoji: '✨', label: 'Normal',      desc: 'Equilibrio recomendado.' },
                    { id: 'fiesta',  emoji: '🎉', label: '¡Fiesta!',    desc: 'Más partículas y brillo.' },
                ],
                init() {
                    document.body.dataset.fxIntensidad = this.nivel;
                },
                cambiar(id) {
                    this.nivel = id;
                    window.fxAplicarIntensidad?.(id);
                    this.abierto = false;
                },
                lanzarConfeti() {
                    window.fxConfettiBurst?.({ duration: 2000 });
                    this.abierto = false;
                },
            };
        }
    </script>
@endonce
