<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje de amistad para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Día de la Amistad' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#FF6B9D">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @php
        $formas = [
            'ninguna'=>'','cuadrado'=>'border-radius:8px;','circulo'=>'border-radius:50%;',
            'corazon'=>'clip-path:url(#cp-heart);','estrella'=>'clip-path:url(#cp-star);',
            'hexagono'=>'clip-path:url(#cp-hexagon);','diamante'=>'clip-path:url(#cp-diamond);',
        ];
        $marcos = [
            'ninguno'=>'','rosa'=>'filter:drop-shadow(0 0 12px #FF6B9D);','dorado'=>'filter:drop-shadow(0 0 12px #FFE066);',
            'morado'=>'filter:drop-shadow(0 0 12px #B197FC);','verde'=>'filter:drop-shadow(0 0 12px #69DB7C);',
            'sombra'=>'filter:drop-shadow(4px 8px 16px rgba(0,0,0,.25));','blanco'=>'filter:drop-shadow(0 0 10px #fff);',
        ];
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';
    @endphp
    <style>
        :root {
            --c1:#FF6B9D; --c2:#FFA94D; --c3:#FFE066; --c4:#69DB7C; --c5:#74C0FC; --c6:#B197FC;
        }
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #FFF0F6 0%, #FFF4E6 25%, #FFFBEB 50%, #E6FCF5 75%, #E7F5FF 100%);
            min-height: 100vh;
        }
        .font-round { font-family: 'Comfortaa', cursive; }

        /* Arcoíris superior progresivo */
        @keyframes rainbow-grow {
            from { transform: scale(0); opacity:0; }
            to   { transform: scale(1); opacity:.8; }
        }
        .rainbow-arc {
            width: 600px; height: 300px; border-radius: 600px 600px 0 0;
            border: 30px solid; border-bottom: 0;
            position: absolute; top: -180px; left: 50%; transform: translateX(-50%);
            transform-origin: bottom center;
            animation: rainbow-grow 1.4s cubic-bezier(.34,1.56,.64,1) .3s both;
        }
        .ra-1 { border-color: var(--c1); width: 700px; height: 350px; top: -200px; }
        .ra-2 { border-color: var(--c2); width: 620px; height: 310px; top: -170px; animation-delay:.5s;}
        .ra-3 { border-color: var(--c3); width: 540px; height: 270px; top: -140px; animation-delay:.7s;}
        .ra-4 { border-color: var(--c4); width: 460px; height: 230px; top: -110px; animation-delay:.9s;}
        .ra-5 { border-color: var(--c5); width: 380px; height: 190px; top: -80px;  animation-delay:1.1s;}
        .ra-6 { border-color: var(--c6); width: 300px; height: 150px; top: -50px;  animation-delay:1.3s;}

        /* Círculos de color flotando */
        @keyframes float-up { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-15px);} }
        .blob { position:absolute; border-radius:50%; filter:blur(2px); opacity:.6; animation: float-up 4s ease-in-out infinite; pointer-events:none; }

        /* Polaroid */
        .polaroid {
            background:#fff;
            padding: 18px 18px 60px 18px;
            box-shadow: 0 18px 40px rgba(0,0,0,.18), 0 4px 12px rgba(0,0,0,.1);
            transform: rotate(-3deg);
            position: relative;
            border-radius: 4px;
        }
        @keyframes wash-tape-in { from{opacity:0; transform:translate(-50%,-30px) rotate(-12deg);} to{opacity:.9; transform:translate(-50%,0) rotate(-8deg);} }
        .washi {
            position:absolute; top:-18px; left:50%;
            width: 130px; height: 36px;
            background: repeating-linear-gradient(45deg, rgba(255,107,157,.85) 0 8px, rgba(177,151,252,.85) 8px 16px);
            transform: translateX(-50%) rotate(-8deg);
            box-shadow: 0 2px 6px rgba(0,0,0,.1);
            animation: wash-tape-in .8s ease-out .5s both;
        }

        @keyframes pop-in { from{opacity:0; transform:scale(.7) rotate(-8deg);} to{opacity:1; transform:scale(1) rotate(-3deg);} }
        .pop-in { animation: pop-in 1s cubic-bezier(.34,1.56,.64,1) .8s both; }

        /* Estrellas pequeñas */
        @keyframes star-twinkle { 0%,100%{opacity:.4;} 50%{opacity:1;} }
        .twinkle { animation: star-twinkle 2s ease-in-out infinite; }

        .img-poly { width: 100%; max-width: 280px; aspect-ratio: 1; object-fit: contain; background:#fff; }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden relative">
    @include('mensajes.partials.efectos', ['tema' => 'amistad'])

    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>

            {{-- Patrón pulsera trenzada --}}
            <pattern id="trenza" x="0" y="0" width="20" height="10" patternUnits="userSpaceOnUse">
                <path d="M0 5 Q5 0 10 5 T20 5" stroke="#FF6B9D" stroke-width="2.5" fill="none"/>
                <path d="M0 5 Q5 10 10 5 T20 5" stroke="#74C0FC" stroke-width="2.5" fill="none"/>
            </pattern>
            <pattern id="trenza2" x="0" y="0" width="20" height="10" patternUnits="userSpaceOnUse">
                <path d="M0 5 Q5 0 10 5 T20 5" stroke="#FFE066" stroke-width="2.5" fill="none"/>
                <path d="M0 5 Q5 10 10 5 T20 5" stroke="#69DB7C" stroke-width="2.5" fill="none"/>
            </pattern>
        </defs>
    </svg>

    {{-- Arcoíris superior --}}
    <div class="absolute top-0 left-0 right-0 overflow-hidden pointer-events-none" style="height:280px; z-index:0;" aria-hidden="true">
        <div class="rainbow-arc ra-1"></div>
        <div class="rainbow-arc ra-2"></div>
        <div class="rainbow-arc ra-3"></div>
        <div class="rainbow-arc ra-4"></div>
        <div class="rainbow-arc ra-5"></div>
        <div class="rainbow-arc ra-6"></div>
    </div>

    {{-- Blobs de color dispersos --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        <div class="blob" style="width:120px;height:120px;background:var(--c1);top:30%;left:5%;"></div>
        <div class="blob" style="width:80px;height:80px;background:var(--c4);top:50%;right:8%;animation-delay:1s;"></div>
        <div class="blob" style="width:100px;height:100px;background:var(--c6);bottom:20%;left:10%;animation-delay:2s;"></div>
        <div class="blob" style="width:70px;height:70px;background:var(--c3);top:65%;right:15%;animation-delay:.5s;"></div>
        {{-- Estrellas --}}
        <span class="absolute twinkle" style="top:18%;left:15%;font-size:20px;">⭐</span>
        <span class="absolute twinkle" style="top:25%;right:20%;font-size:16px;animation-delay:.6s;">✨</span>
        <span class="absolute twinkle" style="top:55%;left:50%;font-size:18px;animation-delay:1.2s;">⭐</span>
        <span class="absolute twinkle" style="bottom:30%;right:25%;font-size:22px;animation-delay:.3s;">✨</span>
    </div>

    <div x-data="{ copiado:false, copiarLink(){ navigator.clipboard.writeText(window.location.href).then(()=>{ this.copiado=true; setTimeout(()=>this.copiado=false,2000); }); } }"
         x-init="setTimeout(()=>{ window.fxCelebrar?.('estrellas'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta')); }, 600);"
         class="relative z-10 max-w-2xl mx-auto px-4 pt-32 sm:pt-40 pb-16">

        {{-- Title --}}
        <header class="text-center mb-6">
            <div class="text-6xl mb-3 inline-block" style="animation: float-up 3s ease-in-out infinite;">
                {{ $mensaje->ocasion->emoji ?? '🤝' }}
            </div>
            <h1 class="font-round font-bold text-3xl sm:text-4xl bg-gradient-to-r from-pink-500 via-orange-400 to-purple-400 bg-clip-text text-transparent">
                {{ $mensaje->ocasion->nombre ?? 'Día de la Amistad' }}
            </h1>
        </header>

        {{-- Pulseras de hilo trenzadas --}}
        <div class="flex justify-center mb-8 gap-1" aria-hidden="true">
            <svg width="200" height="20"><rect width="200" height="10" y="3" fill="url(#trenza)" rx="5"/></svg>
        </div>

        {{-- Tarjeta polaroid --}}
        <article class="polaroid pop-in mx-auto" style="max-width: 360px;">
            <div class="washi" aria-hidden="true"></div>

            {{-- Foto --}}
            @if($mensaje->imagen_path)
            <div class="overflow-hidden">
                <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                     alt="Foto de {{ $mensaje->destinatario }}"
                     class="img-poly" style="{{ $eForma }} {{ $eMarco }}">
            </div>
            @else
            <div class="img-poly mx-auto bg-gradient-to-br from-pink-300 via-yellow-200 to-blue-300 flex items-center justify-center text-7xl">
                🤜🤛
            </div>
            @endif

            {{-- Caption polaroid --}}
            <div class="text-center mt-4">
                <p class="font-round text-xl text-gray-800">
                    {{ $mensaje->destinatario }} <span class="text-pink-500">♥</span> {{ $mensaje->remitente }}
                </p>
                <p class="text-xs text-gray-500 mt-1">{{ $mensaje->created_at?->format('d/m/Y') }}</p>
            </div>
        </article>

        {{-- Mensaje --}}
        <article class="mt-12 bg-white/85 backdrop-blur-sm rounded-3xl p-7 shadow-xl border-2 border-pink-200 pop-in" style="animation-delay:1.2s;">
            <div class="flex items-center gap-2 mb-4 text-pink-500 font-round font-bold">
                <span class="text-2xl">💌</span>
                <span>Para mi gran amig@</span>
            </div>
            <div class="prose prose-pink max-w-none font-round text-gray-700 leading-relaxed">
                {!! $mensaje->mensaje !!}
            </div>
            <div class="mt-6 text-right">
                <p class="font-round text-sm text-gray-500">Con todo mi cariño,</p>
                <p class="font-round font-bold text-xl text-purple-500">~ {{ $mensaje->remitente }}</p>
            </div>
        </article>

        {{-- Pulseras decorativas inferior --}}
        <div class="flex justify-center my-8 gap-1" aria-hidden="true">
            <svg width="200" height="20"><rect width="200" height="10" y="3" fill="url(#trenza2)" rx="5"/></svg>
        </div>

        {{-- Botones "amigos por siempre" --}}
        <div class="flex flex-wrap justify-center gap-3 my-6" aria-hidden="true">
            @php $tags = ['🔒 Amig@s por siempre','💖 BFF','🌈 Mi crew','✨ Vibes únicas']; @endphp
            @foreach($tags as $i => $t)
            <span class="font-round font-semibold text-sm px-4 py-2 rounded-full text-white shadow-md"
                  style="background: linear-gradient(135deg, {{ ['#FF6B9D','#FFA94D','#74C0FC','#B197FC'][$i] }}, {{ ['#B197FC','#FFE066','#69DB7C','#FF6B9D'][$i] }});">
                {{ $t }}
            </span>
            @endforeach
        </div>

        {{-- Code + compartir --}}
        <section class="bg-white/85 backdrop-blur-sm rounded-3xl p-6 mt-8 text-center shadow-xl border-2 border-purple-200">
            <p class="font-round text-sm text-gray-500 mb-2">Código de tu mensaje</p>
            <p class="font-round font-bold text-3xl bg-gradient-to-r from-pink-500 via-orange-400 to-purple-400 bg-clip-text text-transparent tracking-widest mb-4">
                {{ $mensaje->code }}
            </p>
            <button @click="copiarLink()"
                    class="font-round font-semibold text-white px-6 py-3 rounded-full shadow-md hover:scale-105 active:scale-95 transition-all"
                    style="background: linear-gradient(135deg, #FF6B9D, #B197FC);">
                <span x-show="!copiado">🔗 Copiar enlace</span>
                <span x-show="copiado">✅ ¡Listo!</span>
            </button>
        </section>

        <footer class="text-center mt-10 font-round text-sm text-gray-500">
            <p>Hecho con 💕 en {{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </footer>
    </div>

    @include('mensajes.partials.music-player', ['accent' => '#FF6B9D'])
</body>
</html>
