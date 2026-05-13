<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Un mensaje para {{ $mensaje->destinatario }} — Día del Padre">
    <title>{{ $mensaje->destinatario }} — Aventurero</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#3D2817">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Special+Elite&family=Lora:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --kraft: #D9B380;
            --kraft-dk: #A87842;
            --kraft-deep: #6B3F1B;
            --tinta-sepia: #3D2817;
            --rojo-mapa: #B63E2A;
            --verde-musgo: #5D6E3A;
            --crema-papel: #F4E4C1;
        }
        body {
            font-family: 'Lora', serif;
            background:
                radial-gradient(ellipse at top, #6B4226 0%, transparent 60%),
                radial-gradient(ellipse at bottom, #4A2D14 0%, transparent 60%),
                #3D2817;
            min-height: 100vh; overflow-x: hidden; color: var(--crema-papel);
        }
        /* Textura papel envejecido */
        body::before {
            content: ''; position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image:
                radial-gradient(circle at 12% 18%, rgba(0,0,0,.15) 0%, transparent 8%),
                radial-gradient(circle at 78% 82%, rgba(0,0,0,.18) 0%, transparent 10%),
                radial-gradient(circle at 60% 30%, rgba(255,220,160,.08) 0%, transparent 15%);
        }
        .typewriter { font-family: 'Special Elite', serif; }
        .cinzel { font-family: 'Cinzel', serif; letter-spacing: .1em; }
        .serif { font-family: 'Lora', serif; }

        /* Mapa textura */
        .map-paper {
            background-color: var(--kraft);
            background-image:
                repeating-linear-gradient(0deg, rgba(168,120,66,.12) 0 1px, transparent 1px 14px),
                repeating-linear-gradient(90deg, rgba(168,120,66,.12) 0 1px, transparent 1px 14px),
                radial-gradient(circle at 30% 70%, rgba(107,63,27,.25) 0%, transparent 25%);
            color: var(--tinta-sepia);
        }
        .map-paper::before {
            content: ''; position: absolute; inset: 0;
            background-image:
                radial-gradient(circle at 18% 22%, rgba(166,85,40,.4) 0%, transparent 5%),
                radial-gradient(circle at 82% 78%, rgba(166,85,40,.4) 0%, transparent 5%);
            pointer-events: none;
        }

        /* Brújula girando */
        @keyframes compass-needle {
            0%   { transform: rotate(-12deg); }
            25%  { transform: rotate(45deg); }
            55%  { transform: rotate(-25deg); }
            80%  { transform: rotate(15deg); }
            100% { transform: rotate(-12deg); }
        }
        .compass-arrow { transform-origin: 50% 50%; animation: compass-needle 6s ease-in-out infinite; }

        /* Pergamino enrollado */
        .scroll-wrap { perspective: 2000px; max-width: 620px; margin: 0 auto; }
        .scroll {
            position: relative;
            transform-style: preserve-3d;
        }
        .scroll-cover {
            position: relative;
            border-radius: 14px;
            padding: 60px 36px;
            box-shadow:
                0 30px 70px rgba(0,0,0,.5),
                inset 0 0 0 4px rgba(107,63,27,.25),
                inset 0 0 80px rgba(107,63,27,.4);
            cursor: pointer;
            transform-origin: center;
            transition: transform 1.3s cubic-bezier(.65,.05,.3,1), opacity 1s;
            border: 3px solid var(--kraft-dk);
            overflow: hidden;
        }
        .scroll-cover::after {
            content: ''; position: absolute; left: 0; right: 0; top: 0; height: 18px;
            background: linear-gradient(180deg, rgba(0,0,0,.35), transparent);
        }
        .scroll-cover::before {
            content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 18px;
            background: linear-gradient(0deg, rgba(0,0,0,.35), transparent);
        }
        .scroll.opened .scroll-cover {
            transform: rotateX(80deg) translateY(-30px) scale(.9);
            opacity: 0;
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
        .scroll-content {
            position: relative;
            background: linear-gradient(180deg, var(--crema-papel) 0%, #E8D4A6 100%);
            color: var(--tinta-sepia);
            border-radius: 8px;
            box-shadow: 0 25px 60px rgba(0,0,0,.4), inset 0 0 50px rgba(107,63,27,.15);
            max-height: 0; overflow: hidden;
            transition: max-height 1.4s ease, padding 1.4s ease;
            border: 2px solid var(--kraft-dk);
        }
        .scroll.opened .scroll-content { max-height: 5000px; padding: 50px 36px; }
        /* Bordes irregulares (rasgado) */
        .scroll-content::before, .scroll-content::after {
            content: ''; position: absolute; left: -2px; right: -2px; height: 14px;
            background: var(--kraft-dk);
            -webkit-mask-image: radial-gradient(circle 5px at 8px 0, transparent 98%, #000);
            -webkit-mask-size: 16px 14px;
        }
        .scroll-content::before { top: -1px; }
        .scroll-content::after { bottom: -1px; transform: rotate(180deg); }

        /* Sello cera */
        .wax-seal {
            display: inline-flex; align-items: center; justify-content: center;
            width: 90px; height: 90px; border-radius: 50%;
            background: radial-gradient(circle at 35% 30%, #D14B36, #8B2818 70%, #5C1810 100%);
            box-shadow: 0 8px 22px rgba(0,0,0,.55), inset 0 -4px 10px rgba(0,0,0,.45), inset 0 4px 10px rgba(255,255,255,.15);
            color: var(--crema-papel); font-family: 'Cinzel', serif; font-weight: 700; font-size: 1.6rem;
            transform: rotate(-8deg);
        }
        .wax-seal::before {
            content: ''; position: absolute; width: 110px; height: 110px; border-radius: 50%;
            background: radial-gradient(circle, rgba(139,40,24,.35) 0%, transparent 70%);
            z-index: -1;
        }

        @keyframes float-leaf {
            0%,100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(8deg); }
        }
        .floaty { animation: float-leaf 4s ease-in-out infinite; }

        @keyframes fade-up { from { opacity:0; transform:translateY(24px);} to { opacity:1; transform:translateY(0);} }
        .fade-up { animation: fade-up 1s ease both; }

        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 6px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
        .marco-dorado   { border:5px solid #C9A961; box-shadow:0 0 22px rgba(201,169,97,.55); }
        .marco-plateado { border:5px solid #C0C0C0; box-shadow:0 0 22px rgba(192,192,192,.55); }
        .marco-flores   { border:5px solid var(--kraft-dk); box-shadow:0 0 0 3px var(--kraft-deep); }
        .marco-vintage  { border:6px double var(--kraft-deep); box-shadow:0 4px 22px rgba(0,0,0,.5); }

        /* Coordenadas decorativas */
        .coord {
            font-family: 'Special Elite', serif;
            color: var(--kraft);
            opacity: .7;
            font-size: .7rem;
            letter-spacing: .2em;
        }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'papa'])

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-6 sm:py-10">

        {{-- Encabezado --}}
        <header class="text-center mb-6 fade-up">
            <p class="coord">N 19°25'42" · O 99°07'59"</p>
            {{-- Brújula --}}
            <svg class="mx-auto mt-2 mb-4 floaty" width="100" height="100" viewBox="0 0 110 110" aria-hidden="true">
                <circle cx="55" cy="55" r="50" fill="#A87842" stroke="#6B3F1B" stroke-width="3"/>
                <circle cx="55" cy="55" r="42" fill="#D9B380" stroke="#6B3F1B" stroke-width="1.5"/>
                <circle cx="55" cy="55" r="34" fill="none" stroke="#6B3F1B" stroke-width=".7" stroke-dasharray="2 3"/>
                <text x="55" y="20" text-anchor="middle" fill="#3D2817" font-family="Cinzel" font-size="11" font-weight="700">N</text>
                <text x="92" y="59" text-anchor="middle" fill="#3D2817" font-family="Cinzel" font-size="9">E</text>
                <text x="55" y="98" text-anchor="middle" fill="#3D2817" font-family="Cinzel" font-size="9">S</text>
                <text x="18" y="59" text-anchor="middle" fill="#3D2817" font-family="Cinzel" font-size="9">O</text>
                <g class="compass-arrow" style="transform-origin: 55px 55px;">
                    <polygon points="55,22 50,55 55,60 60,55" fill="#B63E2A"/>
                    <polygon points="55,88 50,55 55,50 60,55" fill="#3D2817"/>
                </g>
                <circle cx="55" cy="55" r="3.5" fill="#6B3F1B"/>
            </svg>
            <p class="cinzel text-sm text-[#D9B380] uppercase">{{ $mensaje->ocasion->nombre }} · Expedición</p>
            <h1 class="typewriter text-5xl sm:text-6xl text-[#F4E4C1] mt-4 font-bold">{{ $mensaje->destinatario }}</h1>
            <p class="coord mt-3">{{ $mensaje->created_at->format('d · m · Y') }} · BITÁCORA</p>
        </header>

        {{-- Pergamino --}}
        <section x-data="{ opened:false }" class="scroll-wrap mb-6">
            <div class="scroll" :class="opened && 'opened'">
                <div class="scroll-cover map-paper"
                     @click="if(!opened){ opened=true; window.fxCelebrar?.('estrellas'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 1100);}"
                     role="button" tabindex="0" aria-label="Abrir pergamino"
                     @keydown.enter="opened=true; window.fxCelebrar?.('estrellas'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 1100)">
                    {{-- Líneas de mapa decorativas --}}
                    <svg class="absolute inset-0 w-full h-full opacity-30 pointer-events-none" viewBox="0 0 400 200" preserveAspectRatio="none">
                        <path d="M0 80 Q60 60 120 90 T240 70 T400 100" stroke="#6B3F1B" stroke-width="1.5" fill="none" stroke-dasharray="4 6"/>
                        <path d="M0 140 Q80 120 160 150 T320 130 T400 150" stroke="#6B3F1B" stroke-width="1" fill="none" stroke-dasharray="3 4"/>
                        <circle cx="80" cy="80" r="6" fill="none" stroke="#B63E2A" stroke-width="1.5"/>
                        <circle cx="320" cy="140" r="6" fill="none" stroke="#B63E2A" stroke-width="1.5"/>
                        <text x="80" y="105" font-family="Special Elite" font-size="8" fill="#3D2817">▲ Casa</text>
                        <text x="295" y="165" font-family="Special Elite" font-size="8" fill="#3D2817">★ X marca el lugar</text>
                    </svg>
                    <div class="text-center relative z-10">
                        <div class="wax-seal mx-auto mb-4">{{ mb_strtoupper(mb_substr($mensaje->destinatario, 0, 1)) }}</div>
                        <p class="typewriter text-2xl text-[#3D2817] uppercase">— Bitácora del Capitán —</p>
                        <p class="cinzel text-xl text-[#6B3F1B] mt-3">{{ $mensaje->destinatario }}</p>
                        <p class="typewriter text-xs text-[#3D2817] mt-5 italic">› Desenrolla el pergamino ‹</p>
                    </div>
                </div>

                <div class="scroll-content">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="cinzel text-xs text-[#A87842] uppercase tracking-widest">Capítulo Único</p>
                            <p class="typewriter text-3xl text-[#3D2817] mt-1">{{ $mensaje->destinatario }}</p>
                        </div>
                        <div class="text-right">
                            <p class="coord text-[#6B3F1B]">DIARIO N° {{ str_pad($mensaje->id ?? '001', 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>

                    @if($mensaje->imagen_path)
                        <figure class="flex justify-center my-6 floaty">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                                 alt="Foto de {{ $mensaje->destinatario }}"
                                 class="img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'vintage' }}"
                                 style="width:220px;height:220px;object-fit:cover;transform:rotate(-2deg);">
                        </figure>
                    @endif

                    <div class="serif text-lg leading-relaxed text-[#3D2817]" style="text-shadow: 0 1px 0 rgba(255,228,193,.3);">
                        {!! $mensaje->mensaje !!}
                    </div>

                    @if($mensaje->remitente)
                        <div class="mt-10 pt-6 border-t border-dashed border-[#A87842]/60">
                            <p class="typewriter text-sm text-[#A87842] uppercase">— Firmado por —</p>
                            <p class="serif italic text-2xl text-[#3D2817] mt-1">{{ $mensaje->remitente }}</p>
                        </div>
                    @endif

                    <div class="coord text-[#6B3F1B] text-center mt-8 border-t border-[#A87842]/40 pt-4">
                        FECHA · {{ $mensaje->created_at->format('d / m / Y') }} · COORD. CONFIRMADAS
                    </div>
                </div>
            </div>
        </section>

        {{-- Código --}}
        <section class="map-paper rounded-xl p-6 text-center shadow-2xl border-2 border-[#6B3F1B] relative">
            <p class="cinzel text-xs text-[#3D2817] mb-2 uppercase tracking-widest">Coordenadas del mensaje</p>
            <p class="typewriter text-2xl font-bold text-[#3D2817] tracking-widest mb-4">{{ $mensaje->code }}</p>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='¡COPIADO! ✓'; setTimeout(()=>this.textContent='COPIAR ENLACE',2000);})"
                    class="typewriter uppercase px-6 py-2.5 rounded-md bg-[#3D2817] text-[#F4E4C1] font-bold hover:bg-[#6B3F1B] transition shadow-lg tracking-widest text-sm">
                Copiar enlace
            </button>
        </section>

        <footer class="text-center text-xs text-[#D9B380]/70 mt-10 typewriter">
            {{ config('app.name') }} &copy; {{ date('Y') }} · Todos los caminos llevan a casa
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#B63E2A'])
</body>
</html>
