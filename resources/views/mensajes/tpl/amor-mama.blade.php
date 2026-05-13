<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Un mensaje de amor para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#B8E6C1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Caveat:wght@500;700&family=Lora:wght@400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --menta: #B8E6C1;
            --menta-deep: #6FB37A;
            --lavanda: #D4B8E8;
            --lavanda-deep: #8E6BB0;
            --ocre: #E8B86F;
            --crema: #FAFAFA;
        }
        body {
            font-family: 'Lora', serif;
            background:
                radial-gradient(ellipse at top, #E8F5EC 0%, transparent 60%),
                radial-gradient(ellipse at bottom, #F0E5F8 0%, transparent 60%),
                linear-gradient(180deg, #FAFCF7 0%, #F5F0FA 100%);
            min-height: 100vh; overflow-x: hidden;
        }
        .caveat   { font-family: 'Caveat', cursive; }
        .cormorant{ font-family: 'Cormorant Garamond', serif; }

        /* Mariposas volando */
        @keyframes butterfly-fly {
            0%   { transform: translate(0,0) rotate(0); }
            25%  { transform: translate(80px,-40px) rotate(15deg); }
            50%  { transform: translate(150px,20px) rotate(-10deg); }
            75%  { transform: translate(60px,60px) rotate(20deg); }
            100% { transform: translate(0,0) rotate(0); }
        }
        @keyframes wing-flap {
            0%,100% { transform: scaleX(1); }
            50%     { transform: scaleX(.5); }
        }
        .butterfly {
            position: fixed; pointer-events: none; z-index: 1;
            animation: butterfly-fly 20s ease-in-out infinite;
        }
        .butterfly .wing { animation: wing-flap .25s ease-in-out infinite; transform-origin: center; }

        /* Pergamino */
        .scroll-wrap { perspective: 1400px; }
        .scroll {
            position: relative; max-width: 600px; margin: 0 auto;
        }
        .scroll-roll-top, .scroll-roll-bot {
            height: 26px;
            background: linear-gradient(180deg, #E8B86F 0%, #B8843E 50%, #E8B86F 100%);
            border-radius: 13px;
            box-shadow: 0 4px 12px rgba(184,132,62,.3), inset 0 -3px 6px rgba(0,0,0,.2);
            position: relative; z-index: 2;
        }
        .scroll-paper {
            background: linear-gradient(180deg, #FFFEF5 0%, #FAF6E8 100%);
            padding: 0;
            box-shadow: inset 0 0 60px rgba(184,132,62,.15);
            border-left: 2px solid rgba(184,132,62,.25);
            border-right: 2px solid rgba(184,132,62,.25);
            overflow: hidden;
            transition: max-height 1.4s cubic-bezier(.5,.1,.3,1), padding 1.4s ease;
            max-height: 0;
        }
        .scroll.opened .scroll-paper { max-height: 4000px; padding: 40px 32px; }

        /* Marco floral */
        .floral-frame {
            position: relative;
            padding: 16px;
        }
        .floral-frame::before, .floral-frame::after {
            content: '';
            position: absolute; width: 60px; height: 60px;
            background-image: radial-gradient(circle at 30% 30%, #D4B8E8 18%, transparent 19%),
                              radial-gradient(circle at 70% 30%, #B8E6C1 16%, transparent 17%),
                              radial-gradient(circle at 50% 70%, #E8B86F 16%, transparent 17%);
        }
        .floral-frame::before { top: -8px; left: -8px; }
        .floral-frame::after  { bottom: -8px; right: -8px; transform: rotate(180deg); }

        @keyframes fade-up { from { opacity:0; transform:translateY(24px);} to { opacity:1; transform:translateY(0);} }
        .fade-up { animation: fade-up .9s ease both; }

        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 8px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
        .marco-dorado   { border:5px solid #D4AF37; box-shadow:0 0 18px rgba(212,175,55,.45); }
        .marco-plateado { border:5px solid #C0C0C0; box-shadow:0 0 18px rgba(192,192,192,.45); }
        .marco-flores   { border:5px solid #B8E6C1; box-shadow:0 0 0 3px #D4B8E8, 0 4px 18px rgba(0,0,0,.1); }
        .marco-vintage  { border:5px double #8B5A2B; box-shadow:0 4px 18px rgba(139,90,43,.35); }
    </style>
</head>
<body class="text-gray-700">
    @include('mensajes.partials.efectos', ['tema' => 'mama'])

    {{-- Mariposas --}}
    <div aria-hidden="true">
        @php $bColors = ['#D4B8E8','#E8B86F','#B8E6C1','#F4A0BF']; @endphp
        @for($i=0;$i<6;$i++)
            @php $top=rand(10,80); $left=rand(5,85); $delay=rand(0,15); $dur=rand(18,28); $c=$bColors[$i % 4]; @endphp
            <svg class="butterfly" style="top:{{ $top }}%; left:{{ $left }}%; width:36px; animation-delay:-{{ $delay }}s; animation-duration:{{ $dur }}s;" viewBox="0 0 40 30">
                <ellipse class="wing" cx="12" cy="15" rx="10" ry="12" fill="{{ $c }}" opacity=".85"/>
                <ellipse class="wing" cx="28" cy="15" rx="10" ry="12" fill="{{ $c }}" opacity=".85"/>
                <rect x="19" y="10" width="2" height="14" rx="1" fill="#5C3A00"/>
            </svg>
        @endfor
    </div>

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-12 sm:py-16">

        {{-- Encabezado --}}
        <header class="text-center mb-6 fade-up">
            <div class="text-4xl mb-2" aria-hidden="true">🌿 {{ $mensaje->ocasion->emoji ?? '💚' }} 🌸</div>
            <p class="caveat text-3xl text-[#6FB37A]">Para ti, siempre</p>
            <h1 class="cormorant text-5xl sm:text-6xl text-[#5C3A6B] italic mt-2">{{ $mensaje->destinatario }}</h1>
            <p class="text-gray-500 mt-3 text-sm tracking-widest uppercase">{{ $mensaje->ocasion->nombre }}</p>
        </header>

        {{-- Jardín de flores --}}
        <div class="flex justify-center gap-3 mb-8 flex-wrap" aria-hidden="true">
            @for($i=0;$i<8;$i++)
            <svg width="40" height="50" viewBox="0 0 40 50">
                <line x1="20" y1="50" x2="20" y2="22" stroke="#6FB37A" stroke-width="2"/>
                <ellipse cx="14" cy="35" rx="6" ry="3" fill="#B8E6C1" transform="rotate(-30 14 35)"/>
                <circle cx="20" cy="20" r="4" fill="{{ ['#F4C842','#E8B86F','#FFB7CB','#D4B8E8'][$i % 4] }}"/>
                <circle cx="14" cy="14" r="4" fill="{{ ['#F4C842','#E8B86F','#FFB7CB','#D4B8E8'][$i % 4] }}" opacity=".85"/>
                <circle cx="26" cy="14" r="4" fill="{{ ['#F4C842','#E8B86F','#FFB7CB','#D4B8E8'][$i % 4] }}" opacity=".85"/>
                <circle cx="14" cy="26" r="4" fill="{{ ['#F4C842','#E8B86F','#FFB7CB','#D4B8E8'][$i % 4] }}" opacity=".85"/>
                <circle cx="26" cy="26" r="4" fill="{{ ['#F4C842','#E8B86F','#FFB7CB','#D4B8E8'][$i % 4] }}" opacity=".85"/>
                <circle cx="20" cy="20" r="2.5" fill="#E8B86F"/>
            </svg>
            @endfor
        </div>

        {{-- Pergamino --}}
        <section x-data="{ opened:false }" class="scroll-wrap mb-10">
            <div class="scroll" :class="opened && 'opened'">
                <div class="scroll-roll-top cursor-pointer"
                     @click="if(!opened){ opened=true; window.fxCelebrar?.('amor'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 800);}"
                     role="button" tabindex="0" aria-label="Desenrollar pergamino"
                     @keydown.enter="opened=true; window.fxCelebrar?.('amor'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 800)"></div>

                <div class="scroll-paper">
                    <div class="floral-frame">
                        <p class="caveat text-3xl text-[#8E6BB0] mb-6">Mi querida {{ $mensaje->destinatario }},</p>

                        @if($mensaje->imagen_path)
                            <figure class="flex justify-center my-6">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                                     alt="Foto de {{ $mensaje->destinatario }}"
                                     class="img-{{ $mensaje->imagen_forma ?? 'circulo' }} marco-{{ $mensaje->imagen_marco ?? 'flores' }}"
                                     style="width:200px;height:200px;object-fit:contain;background:#fff;">
                            </figure>
                        @endif

                        <div class="cormorant text-xl leading-relaxed text-gray-700 italic">
                            {!! $mensaje->mensaje !!}
                        </div>

                        @if($mensaje->remitente)
                            <p class="caveat text-2xl text-[#6FB37A] text-right mt-8">Con todo mi amor, {{ $mensaje->remitente }}</p>
                        @endif
                    </div>
                </div>

                <div x-show="opened" class="scroll-roll-bot mt-0"></div>
            </div>
            <p x-show="!opened" class="text-center caveat text-xl text-[#6FB37A] mt-3">Toca el rollo para desenrollarlo 🌿</p>
        </section>

        {{-- Código --}}
        <section class="bg-white/70 backdrop-blur rounded-2xl p-6 text-center shadow border border-[#B8E6C1]">
            <p class="text-sm text-gray-600 mb-2">Código del mensaje</p>
            <p class="cormorant text-2xl font-semibold text-[#5C3A6B] tracking-widest mb-4">{{ $mensaje->code }}</p>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='¡Copiado! ✓'; setTimeout(()=>this.textContent='Copiar enlace',2000);})"
                    class="px-6 py-2.5 rounded-full bg-[#6FB37A] text-white font-semibold hover:bg-[#5C9966] transition shadow">
                Copiar enlace
            </button>
        </section>

        <footer class="text-center text-xs text-gray-500 mt-10">
            {{ config('app.name') }} &copy; {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#6FB37A'])
</body>
</html>
