<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Un mensaje para {{ $mensaje->destinatario }} — Día del Padre">
    <title>{{ $mensaje->destinatario }} — Roble Fuerte</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#3E2A14">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Patrick+Hand&family=Roboto+Slab:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --madera-osc: #3E2A14;
            --madera-med: #6B3F1B;
            --madera-cl: #A56C3D;
            --madera-hi: #C99467;
            --kraft: #E8D4A6;
            --hierro: #2C2825;
            --cobre: #C77F3D;
            --tinta: #2A1810;
        }
        body {
            font-family: 'Roboto Slab', serif;
            background:
                radial-gradient(ellipse at top, #5A3A1A 0%, transparent 60%),
                radial-gradient(ellipse at bottom, #2A1B08 0%, transparent 60%),
                #3E2A14;
            min-height: 100vh; overflow-x: hidden; color: var(--kraft);
        }
        .slab { font-family: 'Roboto Slab', serif; }
        .bree { font-family: 'Bree Serif', serif; }
        .hand { font-family: 'Patrick Hand', cursive; }

        /* Madera con vetas */
        .wood-grain {
            background-color: #6B3F1B;
            background-image:
                repeating-linear-gradient(90deg, rgba(0,0,0,.18) 0 1px, transparent 1px 5px),
                repeating-linear-gradient(90deg, rgba(255,255,255,.04) 0 2px, transparent 2px 9px),
                linear-gradient(180deg, #8B5826 0%, #5A3217 50%, #8B5826 100%);
        }

        /* Anillos del árbol (decoración) */
        .tree-rings {
            position: absolute; width: 200px; height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle,
                transparent 18%,
                rgba(62,42,20,.25) 19%, rgba(62,42,20,.25) 21%,
                transparent 22%,
                rgba(62,42,20,.2) 32%, rgba(62,42,20,.2) 34%,
                transparent 35%,
                rgba(62,42,20,.18) 46%, rgba(62,42,20,.18) 48%,
                transparent 49%,
                rgba(62,42,20,.15) 60%, rgba(62,42,20,.15) 62%,
                transparent 63%);
            opacity: .35; pointer-events: none;
        }

        /* Caja taller */
        .toolbox-wrap { perspective: 2200px; max-width: 620px; margin: 0 auto; }
        .toolbox {
            position: relative;
            transform-style: preserve-3d;
        }
        .toolbox-lid {
            position: relative;
            border-radius: 10px 10px 4px 4px;
            padding: 50px 32px;
            box-shadow:
                0 35px 80px rgba(0,0,0,.65),
                inset 0 0 0 4px rgba(199,127,61,.6),
                inset 0 0 0 6px rgba(0,0,0,.3),
                inset 0 0 80px rgba(0,0,0,.4);
            transform-origin: top center;
            transition: transform 1.4s cubic-bezier(.65,.05,.3,1), opacity 1s;
            cursor: pointer;
            border: 3px solid #2A1B08;
        }
        .toolbox.opened .toolbox-lid {
            transform: rotateX(-145deg) translateY(-20px);
            opacity: 0;
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
        /* Bisagras de hierro */
        .hinge {
            position: absolute; top: 8px; width: 30px; height: 18px;
            background: linear-gradient(180deg, #4A4540, #1F1B17);
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.15);
        }
        .hinge::before { content: ''; position: absolute; top: 50%; left: 50%; width: 6px; height: 6px; background: #C77F3D; border-radius: 50%; transform: translate(-50%,-50%); box-shadow: 0 0 0 1px rgba(0,0,0,.4); }
        .hinge.left  { left: 30px; }
        .hinge.right { right: 30px; }

        /* Cerradura de cobre */
        .lock {
            position: absolute; top: -16px; left: 50%; transform: translateX(-50%);
            width: 56px; height: 70px;
            background: linear-gradient(180deg, #C77F3D 0%, #8B5320 100%);
            border-radius: 30px 30px 8px 8px;
            box-shadow: 0 6px 14px rgba(0,0,0,.5), inset 0 -3px 6px rgba(0,0,0,.4), inset 0 2px 4px rgba(255,255,255,.25);
            border: 2px solid #2A1B08;
            display: flex; align-items: flex-end; justify-content: center; padding-bottom: 8px;
        }
        .lock::before {
            content: ''; position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
            width: 36px; height: 36px;
            border: 5px solid #C77F3D;
            border-bottom: none;
            border-radius: 18px 18px 0 0;
            box-shadow: 0 -2px 4px rgba(0,0,0,.3);
        }
        .lock-hole {
            width: 8px; height: 14px;
            background: #1A0F05;
            border-radius: 50% 50% 4px 4px;
            box-shadow: inset 0 0 4px rgba(0,0,0,.8);
        }

        /* Contenido (papel kraft viejo) */
        .toolbox-content {
            position: relative;
            background:
                linear-gradient(180deg, #F4E4C1 0%, #E0CB9F 100%);
            color: var(--tinta);
            border-radius: 6px;
            box-shadow: 0 25px 60px rgba(0,0,0,.4), inset 0 0 60px rgba(107,63,27,.18);
            max-height: 0; overflow: hidden;
            transition: max-height 1.4s ease, padding 1.4s ease;
            border: 2px solid #6B3F1B;
        }
        .toolbox.opened .toolbox-content { max-height: 5000px; padding: 50px 36px; }

        /* Etiqueta colgante */
        .tag {
            display: inline-block;
            background: #E8D4A6;
            color: var(--tinta);
            padding: 8px 16px 8px 22px;
            font-family: 'Patrick Hand', cursive;
            font-size: 1.05rem;
            position: relative;
            border: 1.5px solid #6B3F1B;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,.25);
            transform: rotate(-2deg);
        }
        .tag::before {
            content: ''; position: absolute; left: -10px; top: 50%; transform: translateY(-50%);
            width: 0; height: 0;
            border-top: 14px solid transparent;
            border-bottom: 14px solid transparent;
            border-right: 12px solid #E8D4A6;
        }
        .tag::after {
            content: ''; position: absolute; left: 4px; top: 50%; transform: translateY(-50%);
            width: 6px; height: 6px; background: var(--tinta); border-radius: 50%;
            box-shadow: inset 0 0 2px rgba(255,255,255,.3);
        }

        /* Tornillos en las esquinas */
        .screw {
            position: absolute; width: 12px; height: 12px;
            background: radial-gradient(circle at 30% 30%, #B5B0AA, #4A4540 70%, #1F1B17 100%);
            border-radius: 50%;
            box-shadow: inset 0 0 0 1px rgba(0,0,0,.4), 0 1px 2px rgba(0,0,0,.4);
        }
        .screw::before {
            content: ''; position: absolute; top: 50%; left: 50%;
            width: 8px; height: 1.5px; background: #1F1B17;
            transform: translate(-50%,-50%) rotate(45deg);
        }

        @keyframes hammer-swing {
            0%,100% { transform: rotate(-15deg); }
            50% { transform: rotate(8deg); }
        }
        .hammer { transform-origin: 80% 80%; animation: hammer-swing 2.6s ease-in-out infinite; }

        @keyframes fade-up { from { opacity:0; transform:translateY(24px);} to { opacity:1; transform:translateY(0);} }
        .fade-up { animation: fade-up 1s ease both; }

        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 4px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
        .marco-dorado   { border:5px solid #C9A961; box-shadow:0 0 22px rgba(201,169,97,.55); }
        .marco-plateado { border:5px solid #C0C0C0; box-shadow:0 0 22px rgba(192,192,192,.55); }
        .marco-flores   { border:5px solid var(--madera-med); box-shadow:0 0 0 3px var(--madera-osc); }
        .marco-vintage  { border:6px double var(--madera-osc); box-shadow:0 4px 22px rgba(0,0,0,.5); }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'papa'])

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-6 sm:py-10">

        {{-- Encabezado --}}
        <header class="text-center mb-7 fade-up relative">
            <div class="tree-rings" style="left: -100px; top: -40px;"></div>
            <div class="tree-rings" style="right: -100px; bottom: -40px;"></div>

            {{-- Martillo + clavo --}}
            <div class="relative mx-auto mb-3 hammer" style="width:80px;height:80px;">
                <svg width="80" height="80" viewBox="0 0 80 80" aria-hidden="true">
                    <rect x="36" y="20" width="8" height="50" fill="#8B5826" rx="1"/>
                    <rect x="20" y="14" width="40" height="16" fill="#4A4540" rx="2" stroke="#1F1B17" stroke-width="1.5"/>
                    <rect x="58" y="18" width="6" height="8" fill="#2C2825"/>
                </svg>
            </div>
            <p class="bree text-sm text-[#C99467] uppercase tracking-widest">{{ $mensaje->ocasion->nombre }}</p>
            <h1 class="bree text-5xl sm:text-7xl text-[#F4E4C1] mt-3 font-black drop-shadow-[0_3px_8px_rgba(0,0,0,.6)]">{{ $mensaje->destinatario }}</h1>
            <p class="hand text-xl text-[#C99467] mt-3">~ Hecho a mano · {{ $mensaje->created_at->format('Y') }} ~</p>
        </header>

        {{-- Caja de herramientas --}}
        <section x-data="{ opened:false }" class="toolbox-wrap mb-6">
            <div class="toolbox" :class="opened && 'opened'">
                <div class="toolbox-lid wood-grain"
                     @click="if(!opened){ opened=true; window.fxCelebrar?.('estrellas'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 1200);}"
                     role="button" tabindex="0" aria-label="Abrir caja de herramientas"
                     @keydown.enter="opened=true; window.fxCelebrar?.('estrellas'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 1200)">
                    <span class="hinge left"></span>
                    <span class="hinge right"></span>
                    <span class="screw" style="top:14px;left:14px;"></span>
                    <span class="screw" style="top:14px;right:14px;"></span>
                    <span class="screw" style="bottom:14px;left:14px;"></span>
                    <span class="screw" style="bottom:14px;right:14px;"></span>
                    <div class="lock"><div class="lock-hole"></div></div>

                    <div class="text-center mt-4">
                        <p class="bree text-3xl text-[#F4E4C1] uppercase tracking-wide">Para Papá</p>
                        <p class="hand text-2xl text-[#E8D4A6] mt-2">{{ $mensaje->destinatario }}</p>
                        <div class="mt-5 inline-block px-4 py-1 border border-[#C77F3D]/70 rounded-sm">
                            <p class="hand text-sm text-[#C99467] uppercase tracking-widest">› Abre la caja ‹</p>
                        </div>
                    </div>
                </div>

                <div class="toolbox-content">
                    <span class="screw" style="top:8px;left:8px;"></span>
                    <span class="screw" style="top:8px;right:8px;"></span>
                    <span class="screw" style="bottom:8px;left:8px;"></span>
                    <span class="screw" style="bottom:8px;right:8px;"></span>

                    <div class="mb-5">
                        <span class="tag">PARA: {{ $mensaje->destinatario }}</span>
                    </div>

                    <p class="bree text-2xl text-[#3E2A14] mb-2 uppercase">Querido viejo,</p>

                    @if($mensaje->imagen_path)
                        <figure class="flex justify-center my-6">
                            <div class="p-3 bg-[#E8D4A6] border-2 border-[#6B3F1B] shadow-lg" style="transform:rotate(-2deg);">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                                     alt="Foto de {{ $mensaje->destinatario }}"
                                     class="img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'vintage' }}"
                                     style="width:220px;height:220px;object-fit:contain;background:#fff;">
                                <p class="hand text-sm text-[#3E2A14] text-center mt-2">{{ $mensaje->destinatario }}</p>
                            </div>
                        </figure>
                    @endif

                    <div class="slab text-lg leading-relaxed text-[#2A1810]">
                        {!! $mensaje->mensaje !!}
                    </div>

                    @if($mensaje->remitente)
                        <div class="mt-10 pt-6 border-t-2 border-dashed border-[#6B3F1B]/50 flex items-center justify-between">
                            <div>
                                <p class="bree text-sm text-[#6B3F1B] uppercase">Hecho con amor por</p>
                                <p class="hand text-3xl text-[#3E2A14] mt-1">— {{ $mensaje->remitente }}</p>
                            </div>
                            <svg width="50" height="50" viewBox="0 0 50 50" aria-hidden="true">
                                <circle cx="25" cy="25" r="20" fill="#C77F3D" stroke="#3E2A14" stroke-width="2"/>
                                <text x="25" y="30" text-anchor="middle" font-family="Bree Serif" font-size="11" fill="#3E2A14" font-weight="700">★</text>
                            </svg>
                        </div>
                    @endif

                    <div class="hand text-xs text-[#6B3F1B]/80 text-center mt-8 border-t border-[#6B3F1B]/30 pt-4">
                        Forjado el {{ $mensaje->created_at->format('d / m / Y') }}
                    </div>
                </div>
            </div>
        </section>

        {{-- Código --}}
        <section class="wood-grain rounded-xl p-6 text-center shadow-2xl border-2 border-[#2A1B08] relative">
            <span class="screw" style="top:10px;left:10px;"></span>
            <span class="screw" style="top:10px;right:10px;"></span>
            <span class="screw" style="bottom:10px;left:10px;"></span>
            <span class="screw" style="bottom:10px;right:10px;"></span>
            <div class="bg-[#F4E4C1]/95 rounded-lg p-5 border-2 border-[#6B3F1B]">
                <p class="bree text-xs text-[#6B3F1B] mb-2 uppercase tracking-widest">Folio del taller</p>
                <p class="slab text-2xl font-bold text-[#3E2A14] tracking-widest mb-4">{{ $mensaje->code }}</p>
                <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='¡Copiado! ✓'; setTimeout(()=>this.textContent='Copiar enlace',2000);})"
                        class="bree uppercase px-6 py-2.5 rounded-sm bg-[#3E2A14] text-[#F4E4C1] font-bold hover:bg-[#6B3F1B] transition shadow-lg tracking-widest text-sm border-2 border-[#C77F3D]">
                    Copiar enlace
                </button>
            </div>
        </section>

        <footer class="text-center text-xs text-[#C99467]/80 mt-10 hand">
            {{ config('app.name') }} &copy; {{ date('Y') }} · Sólido como un roble
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#C77F3D'])
</body>
</html>
