<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Una tarjeta de cumpleaños muy especial para {{ $mensaje->destinatario }} 🎂">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#EC4899">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root{
            --c-fucsia:#EC4899; --c-naranja:#F97316; --c-amarillo:#FACC15;
            --c-lima:#84CC16;   --c-cian:#06B6D4;    --c-violeta:#A855F7;
        }
        body{
            font-family:'Quicksand',sans-serif;
            background:
                radial-gradient(circle at 20% 10%, #FFF1F8 0%, transparent 50%),
                radial-gradient(circle at 80% 30%, #FEF3C7 0%, transparent 50%),
                radial-gradient(circle at 50% 90%, #DBEAFE 0%, transparent 60%),
                linear-gradient(135deg,#FFE4F1 0%, #FDF2D8 50%, #DBF4FF 100%);
            min-height:100vh; overflow-x:hidden;
        }
        .font-festive{font-family:'Pacifico',cursive;}

        /* ── Confeti cayendo ── */
        @keyframes confetti-fall{
            0%{transform:translateY(-10vh) rotate(0deg);opacity:0;}
            10%{opacity:1;}
            100%{transform:translateY(110vh) rotate(720deg);opacity:.4;}
        }
        .confetti{
            position:fixed; top:-20px; width:10px; height:14px;
            border-radius:2px; pointer-events:none; z-index:1;
            animation: confetti-fall linear infinite;
            will-change:transform;
        }

        /* ── Serpentinas ── */
        @keyframes serp-sway{
            0%,100%{transform:rotate(-8deg);}
            50%{transform:rotate(8deg);}
        }
        .serpentina{
            position:absolute; width:6px; border-radius:6px;
            transform-origin:top center;
            animation:serp-sway 4s ease-in-out infinite;
        }

        /* ── Globos ── */
        @keyframes balloon-float{
            0%,100%{transform:translateY(0) rotate(-3deg);}
            50%{transform:translateY(-12px) rotate(3deg);}
        }
        .balloon{
            position:absolute; animation: balloon-float 5s ease-in-out infinite;
            filter: drop-shadow(0 6px 8px rgba(0,0,0,.15));
        }

        /* ── Flama de la vela ── */
        @keyframes flame-flicker{
            0%,100%{transform:scaleY(1) scaleX(1) translateX(0); opacity:1;}
            25%{transform:scaleY(1.15) scaleX(0.92) translateX(-1px); opacity:.95;}
            50%{transform:scaleY(0.9)  scaleX(1.08) translateX(1px); opacity:1;}
            75%{transform:scaleY(1.1)  scaleX(0.95) translateX(-.5px); opacity:.9;}
        }
        .flame{
            transform-origin:center bottom;
            animation: flame-flicker .35s ease-in-out infinite;
            filter: drop-shadow(0 0 8px rgba(252,211,77,.9));
        }
        .flame-out{ opacity:0 !important; transition: opacity .4s; }
        .flame-out + .flame-glow{ opacity:0 !important; }
        .flame-glow{
            transform-origin:center;
            animation: flame-flicker .35s ease-in-out infinite reverse;
            mix-blend-mode:screen;
        }
        @keyframes smoke-rise{
            0%{transform:translateY(0) scale(.5); opacity:.7;}
            100%{transform:translateY(-50px) scale(1.6); opacity:0;}
        }
        .smoke{ animation: smoke-rise 1.4s ease-out forwards; }

        /* ── Tarjeta tipo pop-up ── */
        .card-3d{ perspective: 1800px; }
        .card-cover{
            transform-origin: bottom center;
            transition: transform 1.2s cubic-bezier(.6,.05,.28,1.05), opacity .6s ease .8s;
            transform-style:preserve-3d;
        }
        .card-cover.opened{
            transform: rotateX(-178deg);
            opacity: 0;
            pointer-events:none;
        }
        @keyframes pop-rise{
            0%{transform: translateY(120px) scale(.4) rotateX(80deg); opacity:0;}
            60%{transform: translateY(-15px) scale(1.05) rotateX(0deg); opacity:1;}
            100%{transform: translateY(0) scale(1) rotateX(0deg); opacity:1;}
        }
        .pop-rise{ animation: pop-rise 1s cubic-bezier(.34,1.56,.64,1) .9s both; }

        @keyframes fade-in-up{
            from{opacity:0; transform:translateY(20px);}
            to  {opacity:1; transform:translateY(0);}
        }
        .fade-in-up{ animation: fade-in-up .8s ease forwards; opacity:0; }

        /* ── Imagen forma/marco ── */
        .img-shape{ width:140px; height:140px; object-fit:cover; }
        .shape-circulo  { border-radius:50%; }
        .shape-cuadrado { border-radius:8px; }
        .shape-corazon  { clip-path: path('M70 130 C 30 100, 0 70, 0 40 C 0 15, 20 0, 35 0 C 55 0, 65 15, 70 25 C 75 15, 85 0, 105 0 C 120 0, 140 15, 140 40 C 140 70, 110 100, 70 130 Z'); border-radius:0; }
        .shape-hexagono { clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); border-radius:0; }

        .marco-dorado   { box-shadow: 0 0 0 6px #FACC15, 0 8px 28px rgba(0,0,0,.18); }
        .marco-plateado { box-shadow: 0 0 0 6px #D1D5DB, 0 8px 28px rgba(0,0,0,.18); }
        .marco-flores   { box-shadow: 0 0 0 6px #EC4899, 0 0 0 10px #FBCFE8, 0 8px 28px rgba(0,0,0,.18); }
        .marco-vintage  { box-shadow: 0 0 0 6px #92400E, 0 0 0 10px #FCD34D, 0 8px 28px rgba(0,0,0,.18); filter: sepia(.2); }

        @keyframes wobble{
            0%,100%{transform:rotate(-1deg);}
            50%{transform:rotate(1deg);}
        }
        .wobble{ animation: wobble 3s ease-in-out infinite; }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'cumpleanos'])

{{-- ── Confeti ── --}}
@php
    $confettiColors = ['#EC4899','#F97316','#FACC15','#84CC16','#06B6D4','#A855F7'];
@endphp
@for($i=0; $i<40; $i++)
    <span class="confetti"
          style="left:{{ random_int(0,100) }}%;
                 background:{{ $confettiColors[$i % count($confettiColors)] }};
                 animation-duration:{{ random_int(6,14) }}s;
                 animation-delay:{{ random_int(0,8) }}s;
                 transform:rotate({{ random_int(0,360) }}deg);"></span>
@endfor

{{-- ── Globos decorativos esquinas ── --}}
<div class="balloon" style="top:8%; left:4%; animation-delay:.2s;" aria-hidden="true">
    <svg width="60" height="80" viewBox="0 0 60 80">
        <ellipse cx="30" cy="30" rx="22" ry="28" fill="#EC4899"/>
        <ellipse cx="22" cy="22" rx="6" ry="9" fill="#F9A8D4" opacity=".7"/>
        <polygon points="26,57 34,57 30,62" fill="#9D174D"/>
        <path d="M30 62 Q 25 70 30 80" stroke="#9D174D" stroke-width="1.2" fill="none"/>
    </svg>
</div>
<div class="balloon" style="top:14%; right:6%; animation-delay:.8s;" aria-hidden="true">
    <svg width="55" height="75" viewBox="0 0 60 80">
        <ellipse cx="30" cy="30" rx="22" ry="28" fill="#06B6D4"/>
        <ellipse cx="22" cy="22" rx="6" ry="9" fill="#A5F3FC" opacity=".7"/>
        <polygon points="26,57 34,57 30,62" fill="#0E7490"/>
        <path d="M30 62 Q 35 72 28 80" stroke="#0E7490" stroke-width="1.2" fill="none"/>
    </svg>
</div>
<div class="balloon hidden sm:block" style="bottom:18%; left:3%; animation-delay:1.4s;" aria-hidden="true">
    <svg width="50" height="70" viewBox="0 0 60 80">
        <ellipse cx="30" cy="30" rx="22" ry="28" fill="#FACC15"/>
        <polygon points="26,57 34,57 30,62" fill="#A16207"/>
        <path d="M30 62 Q 28 75 33 80" stroke="#A16207" stroke-width="1.2" fill="none"/>
    </svg>
</div>
<div class="balloon hidden sm:block" style="bottom:22%; right:4%; animation-delay:.5s;" aria-hidden="true">
    <svg width="55" height="75" viewBox="0 0 60 80">
        <ellipse cx="30" cy="30" rx="22" ry="28" fill="#84CC16"/>
        <polygon points="26,57 34,57 30,62" fill="#3F6212"/>
        <path d="M30 62 Q 33 72 27 80" stroke="#3F6212" stroke-width="1.2" fill="none"/>
    </svg>
</div>

{{-- ── Serpentinas ── --}}
<div class="serpentina" style="top:0; left:18%; height:90px; background:linear-gradient(#EC4899,#F97316); animation-delay:.3s;" aria-hidden="true"></div>
<div class="serpentina" style="top:0; left:35%; height:130px; background:linear-gradient(#06B6D4,#84CC16); animation-delay:1.2s;" aria-hidden="true"></div>
<div class="serpentina" style="top:0; right:28%; height:110px; background:linear-gradient(#A855F7,#EC4899); animation-delay:.7s;" aria-hidden="true"></div>
<div class="serpentina" style="top:0; right:12%; height:80px;  background:linear-gradient(#FACC15,#F97316); animation-delay:1.5s;" aria-hidden="true"></div>

<main class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-10"
      x-data="{ open:false, blowing:false, soplar(){ this.blowing=true; setTimeout(()=>this.blowing=false, 1800); } }">

    {{-- Header --}}
    <header class="text-center mb-8 fade-in-up" style="animation-delay:.1s;">
        <p class="text-sm sm:text-base font-semibold uppercase tracking-widest" style="color:#9D174D;">
            {{ $mensaje->ocasion->emoji ?? '🎂' }} {{ $mensaje->ocasion->nombre }}
        </p>
        <h1 class="font-festive text-5xl sm:text-7xl mt-2"
            style="background:linear-gradient(90deg,#EC4899,#F97316,#FACC15,#84CC16,#06B6D4);-webkit-background-clip:text;background-clip:text;color:transparent;">
            ¡Feliz Cumpleaños!
        </h1>
        <p class="mt-3 text-lg sm:text-xl text-gray-700">
            Para <strong style="color:#EC4899;">{{ $mensaje->destinatario }}</strong>
        </p>
    </header>

    {{-- Tarjeta pop-up --}}
    <section class="card-3d relative mx-auto" style="max-width: 640px;">
        <div class="relative" style="min-height: 560px;">

            {{-- Cubierta de la tarjeta --}}
            <button type="button"
                    @click="open = true; window.fxCelebrar?.('cumple'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta'))"
                    :class="open && 'opened'"
                    class="card-cover absolute inset-0 rounded-3xl shadow-2xl flex flex-col items-center justify-center p-8 cursor-pointer wobble"
                    style="background: linear-gradient(135deg,#EC4899 0%, #F97316 50%, #FACC15 100%); z-index:5;"
                    aria-label="Abrir tarjeta de cumpleaños">
                <div class="absolute inset-3 rounded-2xl border-4 border-dashed border-white/40"></div>
                <span class="text-7xl sm:text-8xl mb-4" aria-hidden="true">🎂</span>
                <span class="font-festive text-white text-4xl sm:text-5xl drop-shadow-lg">¡Ábreme!</span>
                <span class="mt-3 text-white/90 font-semibold tracking-wider uppercase text-xs sm:text-sm">
                    Toca para abrir tu sorpresa
                </span>
                <div class="mt-6 flex gap-2" aria-hidden="true">
                    <span class="text-3xl">🎈</span><span class="text-3xl">🎁</span><span class="text-3xl">🎉</span>
                </div>
            </button>

            {{-- Contenido revelado --}}
            <div x-show="open" x-cloak class="relative bg-white rounded-3xl shadow-2xl p-6 sm:p-10 pop-rise"
                 style="border:6px solid #FACC15; min-height:560px;">

                {{-- Pastel SVG 3 pisos con velas --}}
                <div class="flex justify-center -mt-2 mb-4 relative" aria-hidden="true">
                    <svg width="240" height="220" viewBox="0 0 240 220">
                        {{-- velas --}}
                        <g>
                            <rect x="92"  y="26" width="8" height="28" fill="#EC4899" rx="2"/>
                            <rect x="118" y="18" width="8" height="36" fill="#06B6D4" rx="2"/>
                            <rect x="144" y="26" width="8" height="28" fill="#84CC16" rx="2"/>
                        </g>
                        {{-- llamas --}}
                        <g :class="blowing && 'flame-out'" class="flame">
                            <ellipse cx="96"  cy="20" rx="5" ry="9"  fill="#FACC15"/>
                            <ellipse cx="122" cy="12" rx="5" ry="9"  fill="#F97316"/>
                            <ellipse cx="148" cy="20" rx="5" ry="9"  fill="#FACC15"/>
                        </g>
                        <g :class="blowing && 'flame-out'" class="flame-glow">
                            <circle cx="96"  cy="22" r="3" fill="#FFFBEB"/>
                            <circle cx="122" cy="14" r="3" fill="#FFFBEB"/>
                            <circle cx="148" cy="22" r="3" fill="#FFFBEB"/>
                        </g>
                        {{-- humo (al soplar) --}}
                        <template x-if="blowing">
                            <g>
                                <circle class="smoke" cx="96"  cy="18" r="4" fill="#9CA3AF" opacity=".6"/>
                                <circle class="smoke" cx="122" cy="10" r="4" fill="#9CA3AF" opacity=".6"/>
                                <circle class="smoke" cx="148" cy="18" r="4" fill="#9CA3AF" opacity=".6"/>
                            </g>
                        </template>

                        {{-- piso 3 (top) --}}
                        <rect x="80"  y="55" width="80" height="40" rx="6" fill="#FBCFE8"/>
                        <path d="M80 65 Q 90 75 100 65 T 120 65 T 140 65 T 160 65" stroke="#EC4899" stroke-width="3" fill="none"/>
                        {{-- piso 2 --}}
                        <rect x="55" y="100" width="130" height="50" rx="6" fill="#FDE68A"/>
                        <path d="M55 110 Q 70 120 85 110 T 115 110 T 145 110 T 175 110 T 185 110" stroke="#F59E0B" stroke-width="3" fill="none"/>
                        {{-- piso 1 --}}
                        <rect x="30" y="155" width="180" height="55" rx="6" fill="#A5F3FC"/>
                        <path d="M30 165 Q 50 175 70 165 T 110 165 T 150 165 T 190 165 T 210 165" stroke="#06B6D4" stroke-width="3" fill="none"/>
                        {{-- toppings --}}
                        <circle cx="70"  cy="158" r="4" fill="#EC4899"/>
                        <circle cx="120" cy="158" r="4" fill="#84CC16"/>
                        <circle cx="170" cy="158" r="4" fill="#A855F7"/>
                        <circle cx="95"  cy="103" r="4" fill="#06B6D4"/>
                        <circle cx="145" cy="103" r="4" fill="#EC4899"/>
                        <circle cx="120" cy="58"  r="4" fill="#F97316"/>
                    </svg>
                </div>

                <div class="text-center">
                    <button type="button" @click="soplar()"
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-bold text-white shadow-md hover:scale-105 transition"
                            style="background:linear-gradient(135deg,#EC4899,#F97316);"
                            aria-label="Soplar las velas">
                        💨 Soplar las velas
                    </button>
                </div>

                {{-- Imagen del destinatario --}}
                @if(!empty($mensaje->imagen_path))
                    <div class="flex justify-center my-6 fade-in-up" style="animation-delay:1.4s;">
                        <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                             alt="Foto de {{ $mensaje->destinatario }}"
                             class="img-shape shape-{{ $mensaje->imagen_forma ?? 'circulo' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}">
                    </div>
                @endif

                {{-- Mensaje --}}
                <article class="prose prose-lg max-w-none mt-6 text-gray-800 fade-in-up"
                         style="animation-delay:1.6s; font-family:'Quicksand',sans-serif; line-height:1.8;">
                    {!! $mensaje->mensaje !!}
                </article>

                {{-- Firma --}}
                <p class="mt-8 text-right font-festive text-2xl sm:text-3xl fade-in-up" style="color:#EC4899; animation-delay:1.9s;">
                    — {{ $mensaje->remitente }}
                </p>
            </div>
        </div>
    </section>

    {{-- Bloque de código + compartir --}}
    <section class="mt-12 fade-in-up" style="animation-delay:2.2s;"
             x-data="{ copiado:false, copiar(){ navigator.clipboard.writeText(window.location.href).then(()=>{this.copiado=true;setTimeout(()=>this.copiado=false,2000);}); } }">
        <div class="bg-white/80 backdrop-blur rounded-2xl p-6 shadow-lg border-2 border-dashed" style="border-color:#EC4899;">
            <p class="text-xs uppercase tracking-widest font-bold text-gray-500 mb-2">Código del mensaje</p>
            <p class="font-mono text-lg sm:text-xl font-bold" style="color:#9D174D;">{{ $mensaje->code }}</p>
            <button @click="copiar()"
                    class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-white font-bold shadow-md hover:scale-105 transition"
                    style="background:linear-gradient(135deg,#06B6D4,#84CC16);"
                    :aria-label="copiado ? 'Enlace copiado' : 'Copiar enlace'">
                <span x-show="!copiado">🔗 Copiar enlace</span>
                <span x-show="copiado">✅ ¡Copiado!</span>
            </button>
        </div>
    </section>

    <footer class="mt-10 text-center text-sm text-gray-500">
        {{ config('app.name') }} &copy; {{ date('Y') }}
        <span class="block mt-1 text-xs">Creado el {{ $mensaje->created_at->format('d/m/Y') }}</span>
    </footer>
</main>

@include('mensajes.partials.music-player', ['accent' => '#EC4899'])

</body>
</html>
