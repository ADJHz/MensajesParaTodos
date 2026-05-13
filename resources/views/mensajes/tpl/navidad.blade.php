<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje navideño para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Navidad' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#C41E3A">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mountains+of+Christmas:wght@400;700&family=Great+Vibes&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @php
        $formas = [
            'ninguna'=>'','cuadrado'=>'border-radius:12px;','circulo'=>'border-radius:50%;',
            'corazon'=>'clip-path:url(#cp-heart);','estrella'=>'clip-path:url(#cp-star);',
            'hexagono'=>'clip-path:url(#cp-hexagon);','diamante'=>'clip-path:url(#cp-diamond);',
        ];
        $marcos = [
            'ninguno'=>'','dorado'=>'filter:drop-shadow(0 0 12px #D4AF37) drop-shadow(0 0 24px rgba(212,175,55,.6));',
            'rosa'=>'filter:drop-shadow(0 0 10px #C41E3A);','sombra'=>'filter:drop-shadow(4px 8px 18px rgba(0,0,0,.5));',
            'morado'=>'filter:drop-shadow(0 0 10px #2D5A3D);','verde'=>'filter:drop-shadow(0 0 12px #2D5A3D);',
            'blanco'=>'filter:drop-shadow(0 0 12px #fff) drop-shadow(0 0 22px rgba(255,255,255,.7));',
        ];
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';
    @endphp
    <style>
        :root { --rojo:#C41E3A; --pino:#2D5A3D; --dorado:#D4AF37; --nieve:#FAFAFA; }
        body {
            font-family: 'Nunito', sans-serif;
            background:
                radial-gradient(ellipse at top, #1a3a2a 0%, #0f2418 50%, #060d09 100%);
            color: #FAFAFA;
            min-height: 100vh;
        }
        .font-xmas { font-family: 'Mountains of Christmas', cursive; }
        .font-vibes { font-family: 'Great Vibes', cursive; }

        /* Copos de nieve */
        @keyframes snow-fall {
            0%   { transform: translateY(-50px) translateX(0) rotate(0); opacity:0; }
            10%  { opacity:1; }
            100% { transform: translateY(110vh) translateX(40px) rotate(360deg); opacity:.6; }
        }
        .snow { position:fixed; top:-50px; pointer-events:none; z-index:1; animation: snow-fall linear infinite; will-change: transform; color: #fff; text-shadow: 0 0 6px rgba(255,255,255,.7); }

        /* Caja regalo */
        .regalo {
            width: 280px; height: 280px;
            background: linear-gradient(135deg, #C41E3A 0%, #9B1530 100%);
            position: relative;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 25px 60px rgba(0,0,0,.5), inset 0 0 30px rgba(0,0,0,.2);
            cursor: pointer;
        }
        .regalo::before, .regalo::after {
            content: ''; position: absolute; background: #D4AF37;
            box-shadow: 0 0 15px rgba(212,175,55,.6);
        }
        .regalo::before { left:50%; top:0; bottom:0; width:36px; transform:translateX(-50%); }
        .regalo::after  { top:50%; left:0; right:0; height:36px; transform:translateY(-50%); }
        .moño {
            position: absolute; top: -45px; left: 50%; transform: translateX(-50%);
            width: 100px; height: 60px;
        }
        @keyframes regalo-bounce { 0%,100%{transform:translateY(0) rotate(-1deg);} 50%{transform:translateY(-8px) rotate(1deg);} }
        .regalo-bounce { animation: regalo-bounce 2.5s ease-in-out infinite; }

        /* Pino con luces titilando */
        @keyframes light-blink {
            0%,100% { opacity:1; filter: drop-shadow(0 0 4px currentColor); }
            50%     { opacity:.4; filter: drop-shadow(0 0 1px currentColor); }
        }
        .xmas-light { animation: light-blink 1.5s ease-in-out infinite; }

        /* Tarjeta navideña */
        .xmas-card {
            background: linear-gradient(135deg, #FAFAFA 0%, #F0E8D8 100%);
            color: #2D5A3D;
            border-radius: 12px;
            box-shadow: 0 30px 80px rgba(0,0,0,.6), inset 0 0 0 6px #C41E3A, inset 0 0 0 8px #D4AF37;
            position: relative;
        }

        /* Marco de pino y bayas */
        .pine-corner { position:absolute; width:80px; height:80px; }

        @keyframes fade-scale { from{opacity:0;transform:scale(.85);} to{opacity:1;transform:scale(1);} }
        .fade-scale { animation: fade-scale .8s cubic-bezier(.34,1.56,.64,1) both; }

        @keyframes star-glow { 0%,100%{filter: drop-shadow(0 0 8px #FFD700);} 50%{filter: drop-shadow(0 0 20px #FFD700);} }
        .star-top { animation: star-glow 2s ease-in-out infinite; }

        .img-shape { width: 180px; height: 180px; object-fit: cover; }

        /* Guirnalda */
        .guirnalda {
            display:flex; justify-content:space-around; align-items:center;
            border-bottom: 3px wavy rgba(212,175,55,.4);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    @include('mensajes.partials.efectos', ['tema' => 'navidad'])

    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>
        </defs>
    </svg>

    {{-- Copos de nieve cayendo --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        @php $copos = ['❄','❅','❆','❄','❅']; @endphp
        @foreach(range(0,14) as $i)
        <span class="snow" style="left:{{ ($i*7+3) % 100 }}%; font-size:{{ 12 + ($i % 4)*5 }}px; animation-duration:{{ 6 + ($i % 5) }}s; animation-delay:{{ $i * .6 }}s;">
            {{ $copos[$i % count($copos)] }}
        </span>
        @endforeach
    </div>

    <div x-data="{ abierto:false, abrir(){ this.abierto=true; window.fxCelebrar?.('navidad'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta')); }, copiado:false, copiarLink(){ navigator.clipboard.writeText(window.location.href).then(()=>{ this.copiado=true; setTimeout(()=>this.copiado=false,2000); }); } }"
         class="relative z-10 max-w-2xl mx-auto px-4 py-12">

        {{-- Header --}}
        <header class="text-center mb-10 fade-scale">
            <div class="text-6xl mb-2 star-top inline-block">⭐</div>
            <h1 class="font-xmas font-bold text-4xl sm:text-5xl" style="color:#D4AF37; text-shadow: 0 4px 12px rgba(0,0,0,.5);">
                {{ $mensaje->ocasion->nombre ?? '¡Feliz Navidad!' }}
            </h1>
            <p class="font-vibes text-2xl mt-2" style="color:#FAFAFA;">
                Para {{ $mensaje->destinatario }}
            </p>
        </header>

        {{-- Pino navideño con luces --}}
        @if(!$abierto ?? true)
        <div class="flex justify-center my-8" aria-hidden="true">
            <svg width="120" height="160" viewBox="0 0 120 160">
                <polygon points="60,5 90,50 75,50 100,95 80,95 110,150 10,150 40,95 20,95 45,50 30,50" fill="#2D5A3D" stroke="#1a3a2a" stroke-width="1.5"/>
                <rect x="50" y="150" width="20" height="12" fill="#5C4033"/>
                {{-- Estrella arriba --}}
                <polygon class="star-top" points="60,0 64,8 72,8 66,14 68,22 60,17 52,22 54,14 48,8 56,8" fill="#FFD700"/>
                {{-- Luces --}}
                <circle class="xmas-light" cx="60" cy="35" r="3" fill="#EF4444" style="color:#EF4444"/>
                <circle class="xmas-light" cx="50" cy="60" r="3" fill="#FCD34D" style="color:#FCD34D; animation-delay:.3s"/>
                <circle class="xmas-light" cx="72" cy="65" r="3" fill="#60A5FA" style="color:#60A5FA; animation-delay:.6s"/>
                <circle class="xmas-light" cx="42" cy="85" r="3" fill="#EF4444" style="color:#EF4444; animation-delay:.2s"/>
                <circle class="xmas-light" cx="80" cy="90" r="3" fill="#FCD34D" style="color:#FCD34D; animation-delay:.5s"/>
                <circle class="xmas-light" cx="60" cy="105" r="3" fill="#A78BFA" style="color:#A78BFA; animation-delay:.8s"/>
                <circle class="xmas-light" cx="35" cy="125" r="3" fill="#60A5FA" style="color:#60A5FA; animation-delay:.4s"/>
                <circle class="xmas-light" cx="85" cy="130" r="3" fill="#EF4444" style="color:#EF4444; animation-delay:.7s"/>
                <circle class="xmas-light" cx="60" cy="140" r="3" fill="#FCD34D" style="color:#FCD34D; animation-delay:.1s"/>
            </svg>
        </div>
        @endif

        {{-- Regalo (cerrado) --}}
        <div x-show="!abierto" class="my-12">
            <button @click="abrir()" class="block mx-auto regalo-bounce" aria-label="Abrir regalo">
                <div class="regalo">
                    {{-- Moño --}}
                    <svg class="moño" viewBox="0 0 100 60" aria-hidden="true">
                        <ellipse cx="20" cy="30" rx="20" ry="22" fill="#D4AF37" stroke="#9B7A1A" stroke-width="1.5"/>
                        <ellipse cx="80" cy="30" rx="20" ry="22" fill="#D4AF37" stroke="#9B7A1A" stroke-width="1.5"/>
                        <ellipse cx="20" cy="30" rx="8" ry="10" fill="#B89020"/>
                        <ellipse cx="80" cy="30" rx="8" ry="10" fill="#B89020"/>
                        <rect x="40" y="22" width="20" height="16" fill="#D4AF37" stroke="#9B7A1A" stroke-width="1.5" rx="3"/>
                    </svg>
                </div>
            </button>
            <p class="text-center mt-6 font-xmas text-xl" style="color:#D4AF37;">
                🎁 ¡Toca el regalo para desenvolver tu mensaje!
            </p>
        </div>

        {{-- Tarjeta navideña abierta --}}
        <article x-show="abierto"
                 x-transition:enter="transition duration-1000"
                 x-transition:enter-start="opacity-0 scale-50 rotate-12"
                 x-transition:enter-end="opacity-100 scale-100 rotate-0"
                 class="xmas-card p-8 sm:p-12 my-8" x-cloak>

            {{-- Esquinas pino --}}
            <svg class="pine-corner" style="top:-12px;left:-12px;" viewBox="0 0 80 80" aria-hidden="true">
                <polygon points="10,40 30,10 50,40 35,40 55,70 5,70 25,40" fill="#2D5A3D"/>
                <circle cx="35" cy="55" r="4" fill="#C41E3A"/><circle cx="20" cy="65" r="3" fill="#C41E3A"/>
            </svg>
            <svg class="pine-corner" style="top:-12px;right:-12px;transform:scaleX(-1);" viewBox="0 0 80 80" aria-hidden="true">
                <polygon points="10,40 30,10 50,40 35,40 55,70 5,70 25,40" fill="#2D5A3D"/>
                <circle cx="35" cy="55" r="4" fill="#C41E3A"/><circle cx="20" cy="65" r="3" fill="#C41E3A"/>
            </svg>

            {{-- Guirnalda --}}
            <div class="guirnalda mb-6 pb-3" aria-hidden="true">
                <span style="color:#C41E3A">●</span><span style="color:#2D5A3D">❋</span>
                <span style="color:#D4AF37">★</span><span style="color:#2D5A3D">❋</span>
                <span style="color:#C41E3A">●</span>
            </div>

            <h2 class="font-vibes text-5xl sm:text-6xl text-center mb-2" style="color:#C41E3A;">
                Querid@ {{ $mensaje->destinatario }}
            </h2>
            <p class="text-center font-xmas text-xl mb-6" style="color:#2D5A3D;">~ ¡Feliz Navidad! ~</p>

            {{-- Imagen --}}
            @if($mensaje->imagen_path)
            <div class="flex justify-center my-6">
                <div style="background:#D4AF37; padding:6px; border-radius:14px; box-shadow: 0 0 20px rgba(212,175,55,.5);">
                    <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                         alt="Foto de {{ $mensaje->destinatario }}"
                         class="img-shape" style="{{ $eForma }} {{ $eMarco }}">
                </div>
            </div>
            @endif

            {{-- Mensaje --}}
            <div class="prose max-w-none my-8 leading-relaxed text-lg" style="color:#1f3a28; font-family:'Nunito',sans-serif;">
                {!! $mensaje->mensaje !!}
            </div>

            {{-- Guirnalda inferior --}}
            <div class="guirnalda mt-6 pt-3" aria-hidden="true" style="border-bottom:0; border-top: 3px wavy rgba(212,175,55,.4);">
                <span style="color:#2D5A3D">❋</span><span style="color:#C41E3A">●</span>
                <span style="color:#D4AF37">★</span><span style="color:#C41E3A">●</span>
                <span style="color:#2D5A3D">❋</span>
            </div>

            <div class="text-right mt-6">
                <p class="font-xmas text-base" style="color:#2D5A3D;">Con cariño navideño,</p>
                <p class="font-vibes text-3xl" style="color:#C41E3A;">{{ $mensaje->remitente }}</p>
            </div>
        </article>

        {{-- Regalos en la parte inferior decorativos --}}
        <div x-show="abierto" class="flex justify-center gap-3 my-8" aria-hidden="true">
            @php $colors = [['#C41E3A','#D4AF37'],['#2D5A3D','#D4AF37'],['#D4AF37','#C41E3A'],['#FAFAFA','#C41E3A']]; @endphp
            @foreach($colors as $c)
            <div style="width:40px;height:40px;background:{{ $c[0] }};position:relative;border-radius:4px;box-shadow:0 4px 10px rgba(0,0,0,.3);">
                <div style="position:absolute;left:50%;top:0;bottom:0;width:6px;transform:translateX(-50%);background:{{ $c[1] }};"></div>
                <div style="position:absolute;top:50%;left:0;right:0;height:6px;transform:translateY(-50%);background:{{ $c[1] }};"></div>
            </div>
            @endforeach
        </div>

        {{-- Code + compartir --}}
        <section x-show="abierto" class="bg-white/10 backdrop-blur-sm border-2 rounded-2xl p-6 mt-8 text-center" style="border-color:#D4AF37;" x-cloak>
            <p class="font-xmas text-sm mb-2" style="color:#D4AF37;">~ Código de tu mensaje ~</p>
            <p class="font-xmas text-3xl mb-4" style="color:#FAFAFA; letter-spacing:.15em;">{{ $mensaje->code }}</p>
            <button @click="copiarLink()"
                    class="font-xmas text-lg px-6 py-3 rounded-full transition-all hover:scale-105 active:scale-95"
                    style="background:#C41E3A; color:#FAFAFA; box-shadow:0 0 20px rgba(196,30,58,.5);">
                <span x-show="!copiado">🎄 Copiar enlace</span>
                <span x-show="copiado">✨ ¡Copiado!</span>
            </button>
        </section>

        <footer class="text-center mt-12 font-xmas text-sm" style="color:#D4AF37;">
            <p>🎅 {{ config('app.name') }} &copy; {{ date('Y') }} ⛄</p>
        </footer>
    </div>

    @include('mensajes.partials.music-player', ['accent' => '#D4AF37'])
</body>
</html>
