<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje especial para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Día del Niño' }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Día del Niño' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#EF4444">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Bubblegum+Sans&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @php
        $formas = [
            'ninguna'=>'','cuadrado'=>'border-radius:18px;','circulo'=>'border-radius:50%;',
            'corazon'=>'clip-path:url(#cp-heart);','estrella'=>'clip-path:url(#cp-star);',
            'hexagono'=>'clip-path:url(#cp-hexagon);','diamante'=>'clip-path:url(#cp-diamond);',
        ];
        $marcos = [
            'ninguno'=>'','dorado'=>'filter:drop-shadow(0 0 10px #FCD34D) drop-shadow(0 0 20px rgba(252,211,77,.5));',
            'rosa'=>'filter:drop-shadow(0 0 10px #FF6B9D);','sombra'=>'filter:drop-shadow(4px 8px 18px rgba(0,0,0,.35));',
            'morado'=>'filter:drop-shadow(0 0 10px #B197FC);','verde'=>'filter:drop-shadow(0 0 10px #4ADE80);',
            'blanco'=>'filter:drop-shadow(0 0 10px #fff);',
        ];
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';
    @endphp
    <style>
        :root { --rojo:#EF4444; --amarillo:#FCD34D; --azul:#60A5FA; --verde:#4ADE80; }
        body { font-family: 'Nunito', sans-serif; background: #FFFBEB; }
        .font-circus { font-family: 'Fredoka One', cursive; }
        .font-bubble { font-family: 'Bubblegum Sans', cursive; }

        /* Carpa de circo: franjas rojo/blanco */
        .carpa-techo {
            background: repeating-linear-gradient(90deg, var(--rojo) 0 40px, #fff 40px 80px);
            clip-path: polygon(0 0, 100% 0, 100% 60%, 90% 100%, 75% 70%, 60% 100%, 45% 70%, 30% 100%, 15% 70%, 0 60%);
        }

        /* Globos */
        @keyframes globo-fly { 0%{transform:translateY(110vh) rotate(-3deg);} 100%{transform:translateY(-200px) rotate(3deg);} }
        .globo { position: fixed; bottom: -120px; pointer-events:none; z-index:1; animation: globo-fly linear infinite; will-change: transform; }
        @keyframes sway { 0%,100%{transform:translateX(-8px);} 50%{transform:translateX(8px);} }

        /* Confeti cayendo */
        @keyframes confeti-fall { 0%{transform:translateY(-50px) rotate(0);opacity:0;} 10%{opacity:1;} 100%{transform:translateY(110vh) rotate(720deg);opacity:.6;} }
        .confeti { position:fixed; top:-50px; width:10px; height:14px; pointer-events:none; z-index:1; animation: confeti-fall linear infinite; }

        /* Estrellas titilando */
        @keyframes twinkle { 0%,100%{opacity:.3;transform:scale(.8);} 50%{opacity:1;transform:scale(1.2);} }
        .star { animation: twinkle 1.6s ease-in-out infinite; }

        /* Tarjeta festoneada */
        .scallop {
            background: #fff;
            position: relative;
            border-radius: 24px;
            box-shadow: 0 18px 60px rgba(239,68,68,.18), 0 6px 20px rgba(0,0,0,.08);
        }
        .scallop::before, .scallop::after {
            content:''; position:absolute; left:0; right:0; height:18px;
            background-image: radial-gradient(circle at 9px 0, transparent 9px, #fff 10px);
            background-size: 18px 18px; background-repeat: repeat-x;
        }
        .scallop::before { top:-9px; transform: rotate(180deg); }
        .scallop::after  { bottom:-9px; }

        /* Burbujas cómic */
        .speech {
            background:#fff; border:3px solid #1f2937; border-radius:22px; padding:1rem 1.25rem;
            position:relative; box-shadow: 4px 4px 0 #1f2937;
        }
        .speech::after {
            content:''; position:absolute; left:30px; bottom:-16px; width:0;height:0;
            border:14px solid transparent; border-top-color:#1f2937; border-bottom:0;
        }
        .speech::before {
            content:''; position:absolute; left:33px; bottom:-11px; width:0;height:0;
            border:11px solid transparent; border-top-color:#fff; border-bottom:0; z-index:1;
        }

        /* Animación entrada */
        @keyframes pop-in { from{transform:scale(.6) rotate(-5deg);opacity:0;} to{transform:scale(1) rotate(0);opacity:1;} }
        .pop-in { animation: pop-in .7s cubic-bezier(.34,1.56,.64,1) both; }
        @keyframes wobble { 0%,100%{transform:rotate(-2deg);} 50%{transform:rotate(2deg);} }
        .wobble { animation: wobble 3s ease-in-out infinite; }

        .img-shape { width:170px; height:170px; object-fit:cover; }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">
    @include('mensajes.partials.efectos', ['tema' => 'dia-nino'])

    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>
        </defs>
    </svg>

    {{-- Techo de carpa de circo --}}
    <div class="carpa-techo fixed top-0 left-0 right-0 h-32 sm:h-40 z-0" aria-hidden="true"></div>

    {{-- Globos volando --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        @php $globos = [['#EF4444',7,'5%'],['#FCD34D',9,'18%'],['#60A5FA',6,'32%'],['#4ADE80',10,'48%'],['#EF4444',8,'62%'],['#B197FC',7,'78%'],['#FCD34D',11,'90%']]; @endphp
        @foreach($globos as $i => $g)
        <div class="globo" style="left:{{ $g[2] }};animation-duration:{{ $g[1] }}s;animation-delay:{{ $i * .8 }}s;">
            <div style="animation: sway 2.5s ease-in-out infinite;">
                <svg width="44" height="58" viewBox="0 0 44 58">
                    <ellipse cx="22" cy="22" rx="20" ry="22" fill="{{ $g[0] }}"/>
                    <ellipse cx="16" cy="14" rx="5" ry="3" fill="rgba(255,255,255,.5)"/>
                    <polygon points="22,44 19,48 25,48" fill="{{ $g[0] }}"/>
                    <line x1="22" y1="48" x2="22" y2="58" stroke="#1f2937" stroke-width="1"/>
                </svg>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Confeti --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        @php $colores=['#EF4444','#FCD34D','#60A5FA','#4ADE80','#B197FC','#FF6B9D']; @endphp
        @foreach(range(0,18) as $i)
            <span class="confeti" style="left:{{ ($i*5+3) % 100 }}%;background:{{ $colores[$i % count($colores)] }};animation-duration:{{ 4 + ($i % 5) }}s;animation-delay:{{ $i * .3 }}s;border-radius:{{ $i%2 ? '50%' : '2px' }};"></span>
        @endforeach
    </div>

    <div x-data="{ abierto:false, copiado:false, copiarLink(){ navigator.clipboard.writeText(window.location.href).then(()=>{ this.copiado=true; setTimeout(()=>this.copiado=false,2000); }); } }"
         class="relative z-10 max-w-2xl mx-auto px-4 pt-44 sm:pt-52 pb-20">

        {{-- Cabecera con título --}}
        <header class="text-center mb-8 pop-in">
            <div class="inline-block bg-white border-4 border-gray-900 rounded-3xl px-6 py-3 shadow-[6px_6px_0_#1f2937] wobble">
                <div class="text-5xl mb-1">{{ $mensaje->ocasion->emoji ?? '🎪' }}</div>
                <h1 class="font-circus text-2xl sm:text-3xl text-red-500">{{ $mensaje->ocasion->nombre ?? 'Día del Niño' }}</h1>
            </div>
        </header>

        {{-- Botón abrir / "regalo" --}}
        <div x-show="!abierto" class="text-center my-12">
            <button @click="abierto=true; window.fxCelebrar?.('nino'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta'));"
                    class="font-circus text-2xl text-white bg-red-500 hover:bg-red-600 active:scale-95 transition-all px-10 py-5 rounded-full shadow-[6px_6px_0_#1f2937] border-4 border-gray-900 wobble"
                    aria-label="Abrir mensaje">
                🎁 ¡Toca para abrir tu sorpresa!
            </button>
            <p class="mt-4 font-bubble text-lg text-blue-500">Tienes un mensaje especial 🌟</p>
        </div>

        {{-- Tarjeta principal --}}
        <article x-show="abierto" x-transition:enter="transition duration-700"
                 x-transition:enter-start="opacity-0 scale-50 -rotate-12"
                 x-transition:enter-end="opacity-100 scale-100 rotate-0"
                 class="scallop p-8 sm:p-10 my-10" x-cloak>

            {{-- Estrellas titilando --}}
            <div class="flex justify-center gap-3 mb-6 text-2xl" aria-hidden="true">
                <span class="star" style="color:#FCD34D">⭐</span>
                <span class="star" style="color:#60A5FA;animation-delay:.3s">✨</span>
                <span class="star" style="color:#EF4444;animation-delay:.6s">⭐</span>
                <span class="star" style="color:#4ADE80;animation-delay:.9s">✨</span>
                <span class="star" style="color:#FCD34D;animation-delay:1.2s">⭐</span>
            </div>

            {{-- Para: --}}
            <div class="text-center mb-6">
                <p class="font-bubble text-blue-500 text-xl">¡Para ti,</p>
                <h2 class="font-circus text-4xl sm:text-5xl text-red-500 leading-tight">
                    {{ $mensaje->destinatario }}!
                </h2>
            </div>

            {{-- Imagen --}}
            @if($mensaje->imagen_path)
            <div class="flex justify-center my-6">
                <div class="bg-yellow-300 p-3 rounded-3xl border-4 border-gray-900 shadow-[5px_5px_0_#1f2937]" style="transform:rotate(-3deg);">
                    <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                         alt="Foto de {{ $mensaje->destinatario }}"
                         class="img-shape" style="{{ $eForma }} {{ $eMarco }}">
                </div>
            </div>
            @endif

            {{-- Oso de peluche SVG --}}
            <div class="flex justify-center my-4" aria-hidden="true">
                <svg width="80" height="80" viewBox="0 0 80 80">
                    <circle cx="20" cy="22" r="10" fill="#92400E"/>
                    <circle cx="60" cy="22" r="10" fill="#92400E"/>
                    <circle cx="20" cy="22" r="5" fill="#FBBF24"/>
                    <circle cx="60" cy="22" r="5" fill="#FBBF24"/>
                    <circle cx="40" cy="42" r="26" fill="#A16207"/>
                    <circle cx="32" cy="38" r="3" fill="#1f2937"/>
                    <circle cx="48" cy="38" r="3" fill="#1f2937"/>
                    <ellipse cx="40" cy="48" rx="6" ry="4" fill="#FBBF24"/>
                    <ellipse cx="40" cy="48" rx="2" ry="1" fill="#1f2937"/>
                    <path d="M34 54 Q40 60 46 54" stroke="#1f2937" stroke-width="2" fill="none" stroke-linecap="round"/>
                </svg>
            </div>

            {{-- Mensaje en burbuja cómic --}}
            <div class="speech my-8">
                <div class="prose prose-sm max-w-none text-gray-800 font-bubble text-lg leading-relaxed">
                    {!! $mensaje->mensaje !!}
                </div>
            </div>

            {{-- Lazo del payaso --}}
            <div class="flex justify-center my-4" aria-hidden="true">
                <svg width="100" height="40" viewBox="0 0 100 40">
                    <path d="M10 20 Q25 5 40 20 Q25 35 10 20" fill="#EF4444" stroke="#1f2937" stroke-width="2"/>
                    <path d="M90 20 Q75 5 60 20 Q75 35 90 20" fill="#EF4444" stroke="#1f2937" stroke-width="2"/>
                    <rect x="40" y="14" width="20" height="12" fill="#FCD34D" stroke="#1f2937" stroke-width="2" rx="2"/>
                    <circle cx="50" cy="20" r="3" fill="#fff" stroke="#1f2937" stroke-width="1.5"/>
                </svg>
            </div>

            {{-- Firma --}}
            <div class="text-right mt-6">
                <p class="font-bubble text-gray-600 text-sm">Con muchísimo cariño,</p>
                <p class="font-circus text-2xl text-blue-500">{{ $mensaje->remitente }} 🤡</p>
            </div>
        </article>

        {{-- Code + compartir --}}
        <section x-show="abierto" class="bg-gradient-to-br from-yellow-300 via-red-400 to-blue-400 rounded-3xl p-6 my-8 text-center shadow-xl border-4 border-white" x-cloak>
            <p class="font-bubble text-white text-lg mb-2">Código de tu mensaje 🎟️</p>
            <p class="font-circus text-3xl text-white tracking-widest mb-4">{{ $mensaje->code }}</p>
            <button @click="copiarLink()" class="bg-white text-red-500 font-bubble text-lg px-6 py-3 rounded-full shadow-md hover:scale-105 active:scale-95 transition-all border-2 border-gray-900">
                <span x-show="!copiado">📋 Copiar enlace</span>
                <span x-show="copiado">✅ ¡Copiado!</span>
            </button>
        </section>

        <footer class="text-center mt-12 text-gray-500 text-sm font-bubble">
            <p>Hecho con 💖 en {{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </footer>
    </div>

    @include('mensajes.partials.music-player', ['accent' => '#EF4444'])
</body>
</html>
