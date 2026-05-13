<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Un mensaje especial para {{ $mensaje->destinatario }} — Feliz Día de las Madres">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#D4467A">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Dancing+Script:wght@500;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --rosa-bg: #FFD6E0;
            --rosa-mid: #F4A0BF;
            --rosa-deep: #D4467A;
            --dorado: #FFE4BA;
            --dorado-deep: #D4AF37;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background:
                radial-gradient(circle at 20% 10%, #FFE9F0 0%, transparent 50%),
                radial-gradient(circle at 80% 90%, #FFEED4 0%, transparent 50%),
                linear-gradient(180deg, #FFF5F8 0%, #FFE9F0 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        .handwriting { font-family: 'Dancing Script', cursive; }
        .serif { font-family: 'Playfair Display', serif; }

        /* Pétalos */
        @keyframes petals-fall {
            0%   { transform: translateY(-80px) rotate(0deg); opacity: 0; }
            10%  { opacity: .9; }
            100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
        }
        .petal {
            position: fixed; top: -80px; pointer-events: none; z-index: 1;
            animation: petals-fall linear infinite; will-change: transform;
        }

        /* ========= SOBRE ========= */
        .envelope-wrap { perspective: 1600px; position: relative; }
        .envelope {
            position: relative;
            width: 100%; max-width: 460px;
            aspect-ratio: 16 / 11;
            margin: 0 auto;
            cursor: pointer;
            filter: drop-shadow(0 25px 35px rgba(212,70,122,.30));
            transform-style: preserve-3d;
            transition: transform .5s cubic-bezier(.22,.61,.36,1), filter .6s ease;
            will-change: transform, opacity, filter;
        }
        .envelope:hover:not(.opened) { transform: translateY(-6px) scale(1.015); filter: drop-shadow(0 32px 42px rgba(212,70,122,.38)); }
        .envelope.opened { cursor: default; }

        /* Despedida del sobre: flota hacia arriba con leve giro y se desvanece */
        @keyframes envelope-leave {
            0%   { transform: translateY(0)   rotate(0deg)  scale(1);   opacity: 1; filter: drop-shadow(0 25px 35px rgba(212,70,122,.30)) blur(0); }
            40%  { transform: translateY(-14px) rotate(-1.5deg) scale(1.01); opacity: 1; }
            100% { transform: translateY(-90px) rotate(2deg)   scale(.82);  opacity: 0; filter: drop-shadow(0 8px 14px rgba(212,70,122,.0)) blur(1px); }
        }
        .envelope.leaving { animation: envelope-leave 1.1s cubic-bezier(.45,.05,.35,1) forwards; }

        /* Cuerpo / fondo del sobre */
        .envelope-body {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #F4A0BF 0%, #D4467A 60%, #B83560 100%);
            border-radius: 10px;
            box-shadow: inset 0 0 0 2px rgba(255,255,255,.18), inset 0 -20px 40px rgba(0,0,0,.15);
        }
        /* Solapa frontal triangular inferior */
        .envelope-front {
            position: absolute; bottom: 0; left:0; right:0; height: 62%;
            background: linear-gradient(180deg, #C03868 0%, #8E1F40 100%);
            clip-path: polygon(0 35%, 50% 0%, 100% 35%, 100% 100%, 0 100%);
            z-index: 2;
            box-shadow: inset 0 -3px 8px rgba(0,0,0,.15);
        }
        /* Solapa superior — apertura suave (sin rebote, ease natural) */
        .envelope-flap {
            position: absolute; top:0; left:0; right:0; height: 65%;
            background: linear-gradient(160deg, #E68AAE 0%, #C03868 100%);
            clip-path: polygon(0 0, 100% 0, 50% 100%);
            transform-origin: top center;
            transform: rotateX(0deg);
            transition: transform 1.1s cubic-bezier(.4,.0,.2,1), z-index 0s 1.1s;
            z-index: 4;
            box-shadow: 0 4px 8px rgba(0,0,0,.12);
            backface-visibility: hidden;
        }
        .envelope.opened .envelope-flap {
            transform: rotateX(-178deg);
            z-index: 1;
        }

        /* Sello de cera — micro-animación: hover late, click se rompe y cae */
        .wax-seal {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 78px; height: 78px; border-radius: 50%;
            background: radial-gradient(circle at 32% 28%, #FF5C8A 0%, #B81F47 65%, #6B0F2A 100%);
            display: flex; align-items: center; justify-content: center;
            color: #FFE4BA;
            font-family: 'Playfair Display', serif; font-weight: 900; font-size: 34px;
            text-shadow: 0 2px 4px rgba(0,0,0,.35);
            box-shadow: 0 6px 14px rgba(0,0,0,.35), inset 3px 3px 8px rgba(255,255,255,.30), inset -3px -3px 8px rgba(0,0,0,.40);
            z-index: 6;
            animation: seal-heartbeat 2.4s ease-in-out infinite;
        }
        .wax-seal::before {
            content:''; position:absolute; inset:6px; border-radius:50%;
            border: 1.5px dashed rgba(255,228,186,.55);
        }
        @keyframes seal-heartbeat {
            0%,100% { transform: translate(-50%,-50%) scale(1); }
            50%     { transform: translate(-50%,-50%) scale(1.06); box-shadow: 0 8px 18px rgba(184,31,71,.45), inset 3px 3px 8px rgba(255,255,255,.30), inset -3px -3px 8px rgba(0,0,0,.40); }
        }
        @keyframes seal-break {
            0%   { transform: translate(-50%,-50%) scale(1)   rotate(0);   opacity: 1; }
            25%  { transform: translate(-50%,-50%) scale(1.15) rotate(-6deg); opacity: 1; }
            60%  { transform: translate(-50%, -10%) scale(.85) rotate(14deg); opacity: .8; }
            100% { transform: translate(-50%,  60%) scale(.55) rotate(28deg); opacity: 0; }
        }
        .envelope.opened .wax-seal { animation: seal-break .7s cubic-bezier(.4,0,.6,1) forwards; }

        /* Hint de tocar */
        .envelope-hint {
            position: absolute; bottom: -36px; left: 50%; transform: translateX(-50%);
            color: #D4467A; font-family: 'Dancing Script', cursive; font-size: 1.25rem;
            white-space: nowrap;
            animation: hint-bob 2s ease-in-out infinite;
        }
        @keyframes hint-bob { 0%,100% { transform: translateX(-50%) translateY(0); } 50% { transform: translateX(-50%) translateY(-6px); } }

        /* Hoja de papel asomando — detrás del cuerpo, se alza al abrir */
        .envelope-paper {
            position: absolute; left: 8%; right: 8%; top: 14%; height: 72%;
            background: linear-gradient(180deg, #FFFCF5 0%, #FFF3E0 100%);
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,.10);
            transform: translateY(0);
            opacity: 0;
            transition: transform 1s cubic-bezier(.22,.61,.36,1) .25s, opacity .4s ease .25s;
            z-index: 3;
        }
        .envelope.opened .envelope-paper {
            transform: translateY(-22%);
            opacity: 1;
        }

        /* ========= CARTA ========= */
        .letter {
            background: linear-gradient(180deg, #FFFCF5 0%, #FFF8EE 100%);
            border-radius: 8px;
            box-shadow: 0 2px 0 #ecdfc8, 0 6px 0 #e0d4bc, 0 30px 80px rgba(74,55,40,.20);
            position: relative; overflow: hidden;
            border: 1px solid rgba(212,70,122,.15);
        }
        @keyframes letter-rise {
            0%   { opacity: 0; transform: translateY(60px) scale(.96); filter: blur(3px); }
            60%  { opacity: 1; filter: blur(0); }
            100% { opacity: 1; transform: translateY(0)    scale(1);   filter: blur(0); }
        }
        .letter.is-revealing { animation: letter-rise 1.1s cubic-bezier(.22,.61,.36,1) both; }

        /* ========= CARTA ========= */
        .letter {
            background:
                linear-gradient(180deg, #FFFCF5 0%, #FFF8EE 100%);
            border-radius: 8px;
            box-shadow:
                0 2px 0 #ecdfc8,
                0 6px 0 #e0d4bc,
                0 30px 80px rgba(74,55,40,.20);
            position: relative; overflow: hidden;
            border: 1px solid rgba(212,70,122,.15);
        }
        /* Líneas de cuaderno suaves */
        .letter::before {
            content:''; position:absolute; left:0; right:0; top:90px; bottom:60px;
            background: repeating-linear-gradient(to bottom, transparent 0 33px, rgba(212,70,122,.07) 33px 34px);
            pointer-events:none;
        }
        /* Margen vertical decorativo */
        .letter::after {
            content:''; position:absolute; top:24px; bottom:24px; left:48px; width:1px;
            background: linear-gradient(to bottom, transparent, rgba(212,70,122,.30), transparent);
            pointer-events:none;
        }
        @media (max-width: 640px) {
            .letter::after { left: 28px; }
        }
        /* Esquinas decorativas */
        .letter-corner {
            position: absolute; width: 56px; height: 56px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56 56'%3E%3Cg fill='none' stroke='%23D4467A' stroke-width='1.2' opacity='.55'%3E%3Cpath d='M2 28 Q2 2 28 2'/%3E%3Cpath d='M8 28 Q8 8 28 8'/%3E%3Ccircle cx='14' cy='14' r='2.5' fill='%23D4467A' opacity='.6'/%3E%3C/g%3E%3C/svg%3E");
            background-size: contain; background-repeat: no-repeat;
        }
        .letter-corner.tl { top: 8px;    left: 8px; }
        .letter-corner.tr { top: 8px;    right: 8px; transform: scaleX(-1); }
        .letter-corner.bl { bottom: 8px; left: 8px; transform: scaleY(-1); }
        .letter-corner.br { bottom: 8px; right: 8px; transform: scale(-1,-1); }

        .letter-divider {
            display: flex; align-items: center; gap: 12px;
            color: #D4467A; opacity: .7;
            margin: 24px 0;
        }
        .letter-divider::before, .letter-divider::after {
            content:''; flex:1; height:1px;
            background: linear-gradient(to right, transparent, rgba(212,70,122,.4), transparent);
        }
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up { animation: fade-up .8s ease both; }

        /* Imagen formas */
        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 10px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }

        .marco-dorado   { border:6px solid #D4AF37; box-shadow:0 0 24px rgba(212,175,55,.55); }
        .marco-plateado { border:6px solid #C0C0C0; box-shadow:0 0 24px rgba(192,192,192,.55); }
        .marco-flores   { border:6px solid #F4A0BF; box-shadow:0 0 0 3px #FFE4BA, 0 0 28px rgba(244,160,191,.6); }
        .marco-vintage  { border:6px double #8B5A2B; box-shadow:0 4px 20px rgba(139,90,43,.4); }
    </style>
</head>
<body class="text-gray-800">
    @include('mensajes.partials.efectos', ['tema' => 'mama'])

    {{-- Pétalos cayendo --}}
    <div aria-hidden="true">
        @for($i=0;$i<15;$i++)
            @php
                $left = rand(0,100); $size = rand(14,28); $dur = rand(8,16); $delay = rand(0,12);
                $colors = ['#FFB7CB','#F4A0BF','#FFD6E0','#E83A6B','#FFC9DA'];
                $c = $colors[$i % 5];
            @endphp
            <svg class="petal" style="left:{{ $left }}%; width:{{ $size }}px; height:{{ $size }}px; animation-duration:{{ $dur }}s; animation-delay:-{{ $delay }}s;" viewBox="0 0 24 24" fill="{{ $c }}">
                <path d="M12 2 C6 6 4 12 8 18 C10 21 14 21 16 18 C20 12 18 6 12 2 Z" opacity=".85"/>
            </svg>
        @endfor
    </div>

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-6 sm:py-10">

        {{-- Encabezado --}}
        <header class="text-center mb-6 anim-fade-up">
            <div class="text-5xl mb-2" aria-hidden="true">{{ $mensaje->ocasion->emoji ?? '💐' }}</div>
            <p class="handwriting text-2xl sm:text-3xl text-[#D4467A]">{{ $mensaje->ocasion->nombre }}</p>
            <h1 class="serif text-4xl sm:text-5xl md:text-6xl text-[#8E1F40] mt-2">
                Para {{ $mensaje->destinatario }}
            </h1>
            <div class="flex items-center justify-center gap-3 mt-4" aria-hidden="true">
                <span class="h-px w-12 bg-[#D4467A]/40"></span>
                <span class="text-[#D4467A]">❀</span>
                <span class="h-px w-12 bg-[#D4467A]/40"></span>
            </div>
        </header>

        {{-- Sobre --}}
        @include('mensajes.partials.reveal-fx')
        <section x-data="revealOpener({ tema: 'amor', delayHide: 1300, delayReveal: 2200, delayUnmount: 2500 })"
                 x-show="!hidden"
                 class="envelope-wrap reveal-opener mb-12 sm:mb-16 anim-fade-up" style="animation-delay:.1s">
            <div class="envelope"
                 :class="{ 'opened': opened, 'leaving': leaving }"
                 @click="abrir()"
                 role="button" tabindex="0" aria-label="Abrir sobre"
                 @keydown.enter="abrir()">
                <div class="envelope-body"></div>
                <div class="envelope-paper" aria-hidden="true"></div>
                <div class="envelope-front"></div>
                <div class="envelope-flap"></div>
                <div class="wax-seal" aria-hidden="true">M</div>
            </div>
            <p x-show="!opened" x-transition class="envelope-hint">Toca el sobre para abrir ✨</p>
        </section>

        {{-- Carta --}}
        <article x-data="{ show: false }"
                 x-init="window.addEventListener('tpl-carta-abierta', () => show = true)"
                 x-show="show"
                 :class="{ 'is-revealing': show }"
                 class="letter px-6 py-10 sm:px-14 sm:py-14 mb-10">

            <span class="letter-corner tl" aria-hidden="true"></span>
            <span class="letter-corner tr" aria-hidden="true"></span>
            <span class="letter-corner bl" aria-hidden="true"></span>
            <span class="letter-corner br" aria-hidden="true"></span>

            <div class="relative z-10">
                <div class="text-center mb-2" aria-hidden="true">
                    <span class="text-3xl text-[#D4467A]">❦</span>
                </div>
                <p class="handwriting text-3xl sm:text-4xl text-[#D4467A] mb-6 text-center">Querida {{ $mensaje->destinatario }},</p>

                @if($mensaje->imagen_path)
                    <figure class="my-8 flex justify-center">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                             alt="Foto de {{ $mensaje->destinatario }}"
                             class="img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}"
                             style="width:240px;height:240px;object-fit:cover;">
                    </figure>
                @endif

                <div class="prose prose-lg max-w-none text-gray-800 leading-loose serif text-center sm:text-left text-lg sm:text-xl">
                    {!! nl2br(e($mensaje->mensaje)) !!}
                </div>

                <div class="letter-divider" aria-hidden="true">
                    <span class="text-xl">✿</span>
                </div>

                @if($mensaje->remitente)
                    <p class="handwriting text-3xl text-[#D4467A] text-right mt-4">— con cariño, {{ $mensaje->remitente }}</p>
                @endif
            </div>
        </article>

        {{-- Código + compartir --}}
        <section class="bg-white/70 backdrop-blur rounded-2xl p-6 text-center shadow-lg border border-[#F4A0BF]/30">
            <p class="text-sm text-gray-600 mb-2">Código del mensaje</p>
            <p class="serif text-2xl font-bold text-[#8E1F40] tracking-widest mb-4">{{ $mensaje->code }}</p>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='¡Copiado! ✓'; setTimeout(()=>this.textContent='Copiar enlace',2000);})"
                    class="px-5 py-2.5 rounded-full bg-[#D4467A] text-white font-semibold hover:bg-[#8E1F40] transition shadow-md">
                Copiar enlace
            </button>
        </section>

        <footer class="text-center text-xs text-gray-500 mt-10">
            {{ config('app.name') }} &copy; {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#D4467A'])
</body>
</html>
