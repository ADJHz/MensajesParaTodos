<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Diploma de honor para {{ $mensaje->destinatario }} 🎓 — ¡Por su gran logro!">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#1E3A8A">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root{
            --c-azul:#1E3A8A; --c-azul-osc:#172554; --c-dorado:#FCD34D;
            --c-dorado-osc:#B45309; --c-diploma:#FFFEF7; --c-granate:#7F1D1D;
        }
        body{
            font-family:'EB Garamond', 'Times New Roman', serif;
            background:
                radial-gradient(ellipse at top, rgba(252,211,77,.15) 0%, transparent 50%),
                radial-gradient(ellipse at bottom, rgba(127,29,29,.15) 0%, transparent 50%),
                linear-gradient(180deg, #0F172A 0%, #1E3A8A 60%, #172554 100%);
            min-height:100vh; overflow-x:hidden; color:#FFFEF7;
        }
        .font-academic{ font-family:'Cinzel', serif; letter-spacing:.05em; }

        /* ── Estrellas pulsantes ── */
        @keyframes star-pulse{
            0%,100%{ opacity:.3; transform:scale(.8); }
            50%   { opacity:1;  transform:scale(1.2); }
        }
        .star{
            position:absolute; pointer-events:none;
            color:#FCD34D; font-size:14px;
            animation: star-pulse 2.5s ease-in-out infinite;
            text-shadow: 0 0 10px rgba(252,211,77,.7);
        }

        /* ── Birrete volando ── */
        @keyframes cap-fly{
            0%  { transform: translate(-150px, 80vh) rotate(-30deg); opacity:0; }
            10% { opacity:1; }
            45% { transform: translate(50vw, 20vh) rotate(180deg); }
            90% { opacity:1; }
            100%{ transform: translate(110vw, -10vh) rotate(420deg); opacity:0; }
        }
        .flying-cap{
            position:fixed; top:0; left:0; pointer-events:none; z-index:2;
            animation: cap-fly 5s ease-in-out infinite;
            animation-delay: 1s;
        }

        /* ── Laureles ── */
        .laurel{ position:absolute; pointer-events:none; opacity:.85; }

        /* ── Diploma desenrollándose ── */
        .scroll-wrapper{ perspective: 2000px; }
        .scroll-top, .scroll-bottom{
            background: linear-gradient(180deg, #92400E 0%, #B45309 50%, #92400E 100%);
            box-shadow: inset 0 4px 8px rgba(0,0,0,.3), 0 4px 12px rgba(0,0,0,.4);
            border-radius: 8px;
            position: relative; z-index:3;
            transition: transform 1.4s cubic-bezier(.5,.05,.3,1);
        }
        .scroll-top::before, .scroll-bottom::before,
        .scroll-top::after, .scroll-bottom::after{
            content:''; position:absolute; top:50%; transform:translateY(-50%);
            width:24px; height:24px; border-radius:50%;
            background: radial-gradient(circle, #FCD34D 30%, #92400E 100%);
            box-shadow: 0 2px 6px rgba(0,0,0,.4);
        }
        .scroll-top::before, .scroll-bottom::before{ left:-12px; }
        .scroll-top::after,  .scroll-bottom::after{ right:-12px; }

        .scroll-paper{
            background:
                radial-gradient(ellipse at center, #FFFEF7 0%, #F5EFD8 100%);
            color:#3F2A14;
            position:relative;
            box-shadow: inset 0 0 80px rgba(180,131,9,.2), 0 20px 60px rgba(0,0,0,.5);
            transform-origin: top center;
            transition: max-height 1.4s ease, padding 1.4s ease, opacity .6s ease .4s;
            overflow:hidden;
        }
        .scroll-paper.closed{ max-height: 0; padding-top:0 !important; padding-bottom:0 !important; opacity:0; }
        .scroll-paper.opened{ max-height: 2400px; opacity:1; }

        .scroll-paper::before{
            content:''; position:absolute; inset:18px;
            border: 3px double #B45309;
            pointer-events:none;
        }
        .scroll-paper::after{
            content:''; position:absolute; inset:26px;
            border: 1px solid rgba(180,131,9,.5);
            pointer-events:none;
        }

        @keyframes fade-up{
            from{opacity:0; transform:translateY(20px);}
            to  {opacity:1; transform:translateY(0);}
        }
        .fade-up{ animation: fade-up .8s ease forwards; opacity:0; }

        /* ── Sello dorado ── */
        @keyframes seal-stamp{
            0%  { transform: scale(3) rotate(-30deg); opacity:0; }
            60% { transform: scale(1.1) rotate(-12deg); opacity:1; }
            100%{ transform: scale(1) rotate(-12deg); opacity:1; }
        }
        .seal{
            animation: seal-stamp .9s cubic-bezier(.34,1.56,.64,1) 1.6s both;
        }

        /* ── Imagen forma/marco ── */
        .img-shape{ width:140px; height:140px; object-fit:cover; }
        .shape-circulo  { border-radius:50%; }
        .shape-cuadrado { border-radius:8px; }
        .shape-corazon  { clip-path: path('M70 130 C 30 100, 0 70, 0 40 C 0 15, 20 0, 35 0 C 55 0, 65 15, 70 25 C 75 15, 85 0, 105 0 C 120 0, 140 15, 140 40 C 140 70, 110 100, 70 130 Z'); border-radius:0; }
        .shape-hexagono { clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); border-radius:0; }

        .marco-dorado   { box-shadow: 0 0 0 6px #FCD34D, 0 0 0 8px #B45309, 0 8px 24px rgba(0,0,0,.35); }
        .marco-plateado { box-shadow: 0 0 0 6px #D1D5DB, 0 0 0 8px #6B7280, 0 8px 24px rgba(0,0,0,.35); }
        .marco-flores   { box-shadow: 0 0 0 6px #FCD34D, 0 0 0 10px #FEF3C7, 0 8px 24px rgba(0,0,0,.35); }
        .marco-vintage  { box-shadow: 0 0 0 6px #92400E, 0 0 0 10px #FCD34D, 0 8px 24px rgba(0,0,0,.35); filter: sepia(.25); }

        /* ── Cinta granate ── */
        .ribbon{
            position:absolute; top:-8px; right:30px;
            background: linear-gradient(180deg, #991B1B 0%, #7F1D1D 50%, #991B1B 100%);
            color:#FCD34D; padding: 18px 14px 28px;
            font-family:'Cinzel', serif; font-weight:700; font-size:.7rem;
            letter-spacing:.2em; text-align:center;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 80%, 0 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,.4);
        }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'graduacion'])

{{-- ── Estrellas de fondo ── --}}
@for($i=0; $i<30; $i++)
    <span class="star"
          style="top:{{ random_int(2,95) }}%;
                 left:{{ random_int(2,98) }}%;
                 font-size:{{ random_int(8,18) }}px;
                 animation-delay:{{ random_int(0,30)/10 }}s;">★</span>
@endfor

{{-- ── Laureles esquinas ── --}}
<svg class="laurel" style="top:6%; left:2%; width:80px;" viewBox="0 0 80 120" aria-hidden="true">
    <path d="M40 0 Q 20 60 40 120" stroke="#FCD34D" stroke-width="2" fill="none"/>
    @for($k=0; $k<8; $k++)
        <ellipse cx="{{ 30 - ($k%2)*4 }}" cy="{{ 15 + $k*13 }}" rx="10" ry="5" fill="#FCD34D" opacity=".85" transform="rotate({{ -30 - $k*3 }} {{ 30 }} {{ 15 + $k*13 }})"/>
    @endfor
</svg>
<svg class="laurel" style="top:6%; right:2%; width:80px; transform:scaleX(-1);" viewBox="0 0 80 120" aria-hidden="true">
    <path d="M40 0 Q 20 60 40 120" stroke="#FCD34D" stroke-width="2" fill="none"/>
    @for($k=0; $k<8; $k++)
        <ellipse cx="{{ 30 - ($k%2)*4 }}" cy="{{ 15 + $k*13 }}" rx="10" ry="5" fill="#FCD34D" opacity=".85" transform="rotate({{ -30 - $k*3 }} {{ 30 }} {{ 15 + $k*13 }})"/>
    @endfor
</svg>

{{-- ── Birrete volando ── --}}
<div class="flying-cap" aria-hidden="true">
    <svg width="80" height="80" viewBox="0 0 80 80">
        <polygon points="40,8 76,28 40,48 4,28" fill="#0F172A"/>
        <polygon points="40,8 76,28 40,32 4,28" fill="#1E3A8A"/>
        <rect x="38" y="28" width="4" height="20" fill="#0F172A"/>
        <circle cx="40" cy="28" r="4" fill="#FCD34D"/>
        <path d="M40 30 Q 60 38 62 60 L 58 62 Q 56 42 40 34 Z" fill="#FCD34D"/>
        <circle cx="60" cy="60" r="4" fill="#B45309"/>
    </svg>
</div>

<main class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-10"
      x-data="{ open:false, abrir(){ this.open=true; window.fxCelebrar?.('graduacion'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta')) } }"
      x-init="setTimeout(abrir, 500)">

    {{-- Header --}}
    <header class="text-center mb-8 fade-up" style="animation-delay:.1s;">
        <p class="font-academic text-sm sm:text-base uppercase" style="color:#FCD34D;">
            {{ $mensaje->ocasion->emoji ?? '🎓' }} {{ $mensaje->ocasion->nombre }}
        </p>
        <h1 class="font-academic text-4xl sm:text-6xl mt-2 font-black"
            style="color:#FFFEF7; text-shadow: 0 0 20px rgba(252,211,77,.6);">
            POR SU GRAN LOGRO
        </h1>
        <div class="flex items-center justify-center gap-3 mt-3">
            <span class="h-px w-20 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></span>
            <span class="text-amber-300 font-academic text-xs tracking-[.3em]">CLASE {{ $mensaje->created_at->format('Y') }}</span>
            <span class="h-px w-20 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></span>
        </div>
    </header>

    {{-- Botón abrir manual (si hace falta) --}}
    <div class="text-center mb-6 fade-up" style="animation-delay:.4s;" x-show="!open">
        <button type="button" @click="abrir()"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-md font-academic font-bold text-sm uppercase tracking-widest shadow-lg hover:scale-105 transition"
                style="background: linear-gradient(135deg,#FCD34D,#B45309); color:#172554;">
            📜 Abrir diploma
        </button>
    </div>

    {{-- Diploma scroll --}}
    <section class="scroll-wrapper relative">

        {{-- Cilindro superior --}}
        <div class="scroll-top mx-auto" style="width:90%; max-width:620px; height:26px;"></div>

        {{-- Pergamino --}}
        <article class="scroll-paper mx-auto px-6 sm:px-12 relative"
                 :class="open ? 'opened' : 'closed'"
                 style="width:92%; max-width:640px; padding-top:50px; padding-bottom:50px;">

            {{-- Cinta granate --}}
            <div class="ribbon" aria-hidden="true">
                HONOR<br>{{ $mensaje->created_at->format('Y') }}
            </div>

            <div class="text-center fade-up" style="animation-delay:1s;">
                <p class="font-academic uppercase text-xs sm:text-sm tracking-[.4em]" style="color:#7F1D1D;">
                    Certificado de Reconocimiento
                </p>
                <p class="mt-2 italic text-sm sm:text-base" style="color:#92400E;">Otorgado a</p>

                <h2 class="font-academic font-black mt-3 text-3xl sm:text-5xl" style="color:#1E3A8A;">
                    {{ strtoupper($mensaje->destinatario) }}
                </h2>

                <div class="flex items-center justify-center gap-3 mt-2">
                    <span class="h-px w-20 bg-amber-700"></span>
                    <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true">
                        <polygon points="10,1 12,7 19,7 13,11 15,18 10,14 5,18 7,11 1,7 8,7" fill="#B45309"/>
                    </svg>
                    <span class="h-px w-20 bg-amber-700"></span>
                </div>

                <p class="italic mt-5 text-base sm:text-lg" style="color:#3F2A14;">
                    En reconocimiento por su esfuerzo, dedicación y excelencia académica.
                </p>
            </div>

            {{-- Imagen --}}
            @if(!empty($mensaje->imagen_path))
                <div class="flex justify-center my-8 fade-up" style="animation-delay:1.3s;">
                    <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                         alt="Foto de {{ $mensaje->destinatario }}"
                         class="img-shape shape-{{ $mensaje->imagen_forma ?? 'circulo' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}">
                </div>
            @endif

            {{-- Mensaje --}}
            <div class="mt-6 fade-up" style="animation-delay:1.5s;">
                <article class="prose prose-lg max-w-none mx-auto"
                         style="font-family:'EB Garamond', serif; font-size:1.15rem; line-height:1.85; color:#3F2A14; text-align:justify;">
                    {!! $mensaje->mensaje !!}
                </article>
            </div>

            {{-- Sello + firma --}}
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-6 fade-up" style="animation-delay:1.8s;">
                <div class="seal relative" style="width:120px; height:120px;" aria-hidden="true">
                    <svg viewBox="0 0 120 120" width="120" height="120">
                        <circle cx="60" cy="60" r="55" fill="none" stroke="#7F1D1D" stroke-width="3"/>
                        <circle cx="60" cy="60" r="48" fill="#7F1D1D"/>
                        <circle cx="60" cy="60" r="44" fill="none" stroke="#FCD34D" stroke-width="1.5"/>
                        <text x="60" y="50" text-anchor="middle" fill="#FCD34D" font-family="Cinzel, serif" font-weight="900" font-size="11">HONOR</text>
                        <polygon points="60,55 64,67 76,67 66,75 70,87 60,79 50,87 54,75 44,67 56,67" fill="#FCD34D"/>
                        <text x="60" y="100" text-anchor="middle" fill="#FCD34D" font-family="Cinzel, serif" font-size="8">{{ $mensaje->created_at->format('Y') }}</text>
                    </svg>
                </div>

                <div class="text-center sm:text-right">
                    <p class="font-academic italic text-2xl sm:text-3xl" style="color:#1E3A8A; border-bottom:1px solid #92400E; padding-bottom:6px; display:inline-block;">
                        {{ $mensaje->remitente }}
                    </p>
                    <p class="font-academic text-xs uppercase tracking-widest mt-2" style="color:#7F1D1D;">
                        Con orgullo
                    </p>
                </div>
            </div>

            {{-- Toga + birrete decorativos --}}
            <div class="flex justify-center mt-8 gap-4 fade-up" style="animation-delay:2s;" aria-hidden="true">
                <span class="text-3xl">🎓</span>
                <span class="text-3xl">📜</span>
                <span class="text-3xl">🏆</span>
            </div>
        </article>

        {{-- Cilindro inferior --}}
        <div class="scroll-bottom mx-auto mt-2" style="width:90%; max-width:620px; height:26px;"></div>
    </section>

    {{-- Bloque de código + compartir --}}
    <section class="mt-12 fade-up" style="animation-delay:2.3s;"
             x-data="{ copiado:false, copiar(){ navigator.clipboard.writeText(window.location.href).then(()=>{this.copiado=true;setTimeout(()=>this.copiado=false,2000);}); } }">
        <div class="bg-white/5 backdrop-blur rounded-md p-6 text-center"
             style="border: 1px solid #FCD34D;">
            <p class="font-academic text-xs uppercase tracking-[.3em]" style="color:#FCD34D;">Código del diploma</p>
            <p class="font-academic text-2xl font-bold mt-2" style="color:#FFFEF7;">{{ $mensaje->code }}</p>
            <button @click="copiar()"
                    class="mt-4 inline-flex items-center gap-2 px-6 py-3 rounded-md font-academic font-bold uppercase tracking-widest text-sm shadow-lg hover:scale-105 transition"
                    style="background: linear-gradient(135deg,#FCD34D,#B45309); color:#172554;"
                    :aria-label="copiado ? 'Enlace copiado' : 'Copiar enlace'">
                <span x-show="!copiado">🔗 Copiar enlace</span>
                <span x-show="copiado">✓ ¡Copiado!</span>
            </button>
        </div>
    </section>

    <footer class="mt-10 text-center text-sm text-amber-200/70">
        <p class="font-academic tracking-widest">{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        <p class="text-xs mt-1 italic">Emitido el {{ $mensaje->created_at->format('d / m / Y') }}</p>
    </footer>
</main>

@include('mensajes.partials.music-player', ['accent' => '#FCD34D'])

</body>
</html>
