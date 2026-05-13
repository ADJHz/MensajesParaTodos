<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Feliz cumpleaños {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#F4C842">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;600;700&family=Fredoka:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --durazno: #FFD9B7;
            --coral: #FFB7B7;
            --lila: #E8C5FF;
            --dorado: #F4C842;
        }
        body {
            font-family: 'Quicksand', sans-serif;
            background:
                radial-gradient(circle at 15% 20%, #FFE9D6 0%, transparent 45%),
                radial-gradient(circle at 85% 80%, #F1DFFF 0%, transparent 45%),
                linear-gradient(180deg, #FFF7EE 0%, #FFEFE0 100%);
            min-height: 100vh; overflow-x: hidden;
        }
        .pacifico { font-family: 'Pacifico', cursive; }
        .fredoka  { font-family: 'Fredoka', sans-serif; }

        /* Globos */
        @keyframes balloon-float {
            0%   { transform: translateY(110vh) translateX(0) rotate(-2deg); }
            50%  { transform: translateY(50vh)  translateX(20px) rotate(3deg); }
            100% { transform: translateY(-20vh) translateX(0) rotate(-2deg); }
        }
        .balloon {
            position: fixed; bottom: -120px; pointer-events: none; z-index: 1;
            animation: balloon-float linear infinite;
        }

        /* Confeti */
        @keyframes confetti-fall {
            0%   { transform: translateY(-40px) rotate(0); opacity: 0; }
            10%  { opacity: 1; }
            100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
        }
        .confetti {
            position: fixed; top:-30px; width:8px; height:14px; pointer-events:none;
            animation: confetti-fall linear infinite; z-index: 1;
        }

        /* Vela titilante */
        @keyframes flicker {
            0%,100% { transform: scaleY(1) scaleX(1); opacity: 1; }
            50%     { transform: scaleY(1.15) scaleX(.9); opacity: .85; }
        }
        .flame { animation: flicker .4s ease-in-out infinite; transform-origin: bottom center; }

        /* Caja regalo */
        .gift-box { perspective: 1400px; }
        .gift {
            position: relative; width: 100%; max-width: 460px;
            aspect-ratio: 1; margin: 0 auto;
            transform-style: preserve-3d;
        }
        .gift-base {
            position: absolute; inset: 18% 0 0 0;
            background: linear-gradient(160deg, #FFB7B7 0%, #E89393 100%);
            border-radius: 12px;
            box-shadow: 0 25px 50px rgba(232,147,147,.4), inset 0 -15px 30px rgba(0,0,0,.1);
        }
        .gift-lid {
            position: absolute; top:0; left:-3%; right:-3%; height: 28%;
            background: linear-gradient(160deg, #FFC8C8 0%, #F09494 100%);
            border-radius: 12px;
            box-shadow: 0 8px 18px rgba(0,0,0,.15);
            transform-origin: bottom center;
            transition: transform 1s cubic-bezier(.6,-.3,.3,1.5);
            z-index: 3;
        }
        .gift.opened .gift-lid { transform: translateY(-180%) rotateZ(-15deg); }
        .ribbon-v {
            position: absolute; top: 0; bottom: 0; left: 50%; width: 30px;
            transform: translateX(-50%);
            background: linear-gradient(180deg, #F4C842 0%, #D4A412 100%);
            z-index: 2;
        }
        .ribbon-h {
            position: absolute; left: 0; right: 0; top: 18%; height: 30px;
            background: linear-gradient(90deg, #F4C842 0%, #D4A412 100%);
            z-index: 2;
        }
        .bow {
            position: absolute; top: 8%; left: 50%; transform: translateX(-50%);
            font-size: 70px; z-index: 4; transition: opacity .4s;
        }
        .gift.opened .bow { opacity: 0; }

        /* Tarjeta */
        .card-bday {
            background: #FFFEFB;
            border-radius: 18px;
            box-shadow: 0 30px 80px rgba(232,147,147,.25);
            border: 2px dashed #E8C5FF;
        }
        @keyframes pop-in {
            0%   { opacity: 0; transform: scale(.7) translateY(40px); }
            70%  { transform: scale(1.05) translateY(-5px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .pop-in { animation: pop-in .7s cubic-bezier(.5,1.6,.5,1) both; }

        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 14px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
        .marco-dorado   { border:6px solid #F4C842; box-shadow:0 0 24px rgba(244,200,66,.55); }
        .marco-plateado { border:6px solid #C0C0C0; box-shadow:0 0 24px rgba(192,192,192,.55); }
        .marco-flores   { border:6px solid #FFB7B7; box-shadow:0 0 0 3px #E8C5FF; }
        .marco-vintage  { border:6px double #8B5A2B; box-shadow:0 4px 20px rgba(139,90,43,.4); }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'mama'])

    {{-- Globos --}}
    <div aria-hidden="true">
        @php $balloonColors = ['#FFB7B7','#FFD9B7','#E8C5FF','#F4C842','#B7E0FF']; @endphp
        @for($i=0;$i<10;$i++)
            @php $left = rand(2,95); $dur = rand(14,26); $delay = rand(0,18); $c = $balloonColors[$i % 5]; @endphp
            <svg class="balloon" style="left:{{ $left }}%; width:50px; animation-duration:{{ $dur }}s; animation-delay:-{{ $delay }}s;" viewBox="0 0 50 70">
                <ellipse cx="25" cy="25" rx="22" ry="26" fill="{{ $c }}" opacity=".9"/>
                <path d="M25 51 L22 58 L28 58 Z" fill="{{ $c }}"/>
                <line x1="25" y1="58" x2="25" y2="70" stroke="#999" stroke-width="1"/>
                <ellipse cx="18" cy="18" rx="5" ry="8" fill="rgba(255,255,255,.4)"/>
            </svg>
        @endfor
    </div>

    {{-- Confeti --}}
    <div aria-hidden="true">
        @php $confColors = ['#F4C842','#FFB7B7','#E8C5FF','#FFD9B7','#B7E0FF']; @endphp
        @for($i=0;$i<25;$i++)
            @php $left = rand(0,100); $dur = rand(6,14); $delay = rand(0,15); $c = $confColors[$i % 5]; @endphp
            <span class="confetti" style="left:{{ $left }}%; background:{{ $c }}; animation-duration:{{ $dur }}s; animation-delay:-{{ $delay }}s;"></span>
        @endfor
    </div>

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-8 sm:py-14">

        {{-- Encabezado con corona --}}
        <header class="text-center mb-8">
            <svg class="mx-auto mb-2" width="80" height="50" viewBox="0 0 80 50" aria-hidden="true">
                <path d="M5 45 L15 15 L25 35 L40 5 L55 35 L65 15 L75 45 Z" fill="#F4C842" stroke="#D4A412" stroke-width="2"/>
                <circle cx="15" cy="15" r="4" fill="#FF5A8E"/>
                <circle cx="40" cy="5" r="5" fill="#E8C5FF"/>
                <circle cx="65" cy="15" r="4" fill="#B7E0FF"/>
                <rect x="5" y="42" width="70" height="6" fill="#D4A412"/>
            </svg>
            <p class="pacifico text-3xl text-[#E89393]">¡Feliz Cumpleaños!</p>
            <h1 class="fredoka text-4xl sm:text-5xl md:text-6xl text-[#8B4A8B] mt-2">{{ $mensaje->destinatario }}</h1>
            <p class="text-gray-500 mt-2">{{ $mensaje->ocasion->emoji ?? '🎂' }} {{ $mensaje->ocasion->nombre }}</p>
        </header>

        {{-- Pastel decorativo --}}
        <div class="flex justify-center mb-6" aria-hidden="true">
            <svg width="140" height="120" viewBox="0 0 140 120">
                <ellipse cx="70" cy="105" rx="55" ry="8" fill="rgba(0,0,0,.08)"/>
                <rect x="20" y="60" width="100" height="45" rx="4" fill="#FFB7B7"/>
                <path d="M20 60 Q35 70 50 60 T80 60 T110 60 T120 60 L120 70 L20 70 Z" fill="#E89393"/>
                <rect x="30" y="40" width="80" height="25" rx="3" fill="#FFD9B7"/>
                <path d="M30 40 Q45 48 60 40 T90 40 T110 40 L110 48 L30 48 Z" fill="#E8C5FF"/>
                <rect x="66" y="20" width="8" height="22" fill="#FFFEFB"/>
                <ellipse class="flame" cx="70" cy="18" rx="4" ry="8" fill="#F4C842"/>
                <ellipse class="flame" cx="70" cy="20" rx="2" ry="5" fill="#FF5A8E"/>
            </svg>
        </div>

        {{-- Caja regalo --}}
        @include('mensajes.partials.reveal-fx')
        <section x-data="revealOpener({ tema: 'cumple', delayHide: 1100, delayReveal: 2000, delayUnmount: 2300 })"
                 x-show="!hidden"
                 class="gift-box reveal-opener mb-10">
            <div class="gift" :class="{ 'opened': opened }"
                 @click="abrir()"
                 role="button" tabindex="0" aria-label="Desempacar regalo"
                 @keydown.enter="abrir()">
                <div class="gift-base"></div>
                <div class="ribbon-v"></div>
                <div class="ribbon-h"></div>
                <div class="gift-lid"></div>
                <div class="bow" aria-hidden="true">🎀</div>
            </div>
            <p x-show="!opened" class="text-center pacifico text-2xl text-[#E89393] mt-3">¡Toca para desempacar!</p>
        </section>

        {{-- Tarjeta --}}
        <article x-data="revealLetter()"
                 x-show="show"
                 :class="{ 'is-revealing': show }"
                 class="card-bday reveal-letter px-6 py-10 sm:px-12 sm:py-12 mb-10" style="display:none;">
            <p class="pacifico text-3xl text-[#E89393] text-center mb-6">¡Feliz día, {{ $mensaje->destinatario }}!</p>

            @if($mensaje->imagen_path)
                <figure class="flex justify-center my-6">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                         alt="Foto de {{ $mensaje->destinatario }}"
                         class="img-{{ $mensaje->imagen_forma ?? 'circulo' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}"
                         style="width:220px;height:220px;object-fit:cover;">
                </figure>
            @endif

            <div class="fredoka text-lg leading-relaxed text-gray-700 max-w-none">
                {!! $mensaje->mensaje !!}
            </div>

            @if($mensaje->remitente)
                <p class="pacifico text-2xl text-[#8B4A8B] text-right mt-8">Con cariño, {{ $mensaje->remitente }}</p>
            @endif
        </article>

        {{-- Código --}}
        <section class="bg-white/80 backdrop-blur rounded-2xl p-6 text-center shadow-lg border-2 border-dashed border-[#F4C842]">
            <p class="text-sm text-gray-600 mb-2">Código del mensaje</p>
            <p class="fredoka text-2xl font-bold text-[#8B4A8B] tracking-widest mb-4">{{ $mensaje->code }}</p>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='¡Copiado! ✓'; setTimeout(()=>this.textContent='Copiar enlace',2000);})"
                    class="px-6 py-2.5 rounded-full bg-[#F4C842] text-[#5C3A00] font-bold hover:bg-[#D4A412] transition shadow-md">
                Copiar enlace
            </button>
        </section>

        <footer class="text-center text-xs text-gray-500 mt-10">
            {{ config('app.name') }} &copy; {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#F4C842'])
</body>
</html>
