<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Una invitación de princesa para los XV años de {{ $mensaje->destinatario }} 👑">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#E89BB1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Cormorant+Garamond:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root{
            --c-rosa:#F4C2C2; --c-rubor:#E89BB1; --c-dorado:#E5C28A;
            --c-lila:#E8C5FF; --c-perla:#FFF5F8; --c-vino:#9D5F70;
        }
        body{
            font-family:'Cormorant Garamond', serif;
            background:
                radial-gradient(ellipse at 20% 10%, #FFE4EC 0%, transparent 55%),
                radial-gradient(ellipse at 80% 90%, #F3E0FF 0%, transparent 55%),
                linear-gradient(180deg, #FFF5F8 0%, #FCE4EE 50%, #F8E1F0 100%);
            min-height:100vh; overflow-x:hidden; color:#5A3D4A;
        }
        .font-script{ font-family:'Great Vibes', cursive; }
        .font-elegant{ font-family:'Playfair Display', serif; font-style:italic; }

        /* ── Brillos cayendo ── */
        @keyframes sparkle-fall{
            0%{transform:translateY(-10vh) rotate(0); opacity:0;}
            10%{opacity:1;}
            100%{transform:translateY(110vh) rotate(360deg); opacity:0;}
        }
        .sparkle{
            position:fixed; top:-20px; pointer-events:none; z-index:1;
            animation: sparkle-fall linear infinite;
            color:#E5C28A; font-size:14px;
            text-shadow: 0 0 8px rgba(229,194,138,.8);
        }

        /* ── Tul flotando ── */
        @keyframes tul-float{
            0%,100%{transform:translateY(0) rotate(0); opacity:.5;}
            50%{transform:translateY(-30px) rotate(8deg); opacity:.75;}
        }
        .tul{
            position:absolute; pointer-events:none;
            animation: tul-float 8s ease-in-out infinite;
            filter: blur(.4px);
        }

        /* ── Mariposas ── */
        @keyframes butterfly-fly{
            0%  {transform:translate(0,0) rotate(-10deg);}
            25% {transform:translate(40px,-30px) rotate(15deg);}
            50% {transform:translate(80px,10px) rotate(-8deg);}
            75% {transform:translate(40px,40px) rotate(12deg);}
            100%{transform:translate(0,0) rotate(-10deg);}
        }
        @keyframes wing-flap{
            0%,100%{transform:scaleX(1);}
            50%{transform:scaleX(.55);}
        }
        .butterfly{ position:absolute; pointer-events:none; animation: butterfly-fly 12s ease-in-out infinite; }
        .butterfly svg{ animation: wing-flap .35s ease-in-out infinite; transform-origin:center; }

        /* ── Tiara con brillo pulsante ── */
        @keyframes tiara-glow{
            0%,100%{ filter: drop-shadow(0 0 8px rgba(229,194,138,.6)) drop-shadow(0 0 16px rgba(229,194,138,.4)); }
            50%    { filter: drop-shadow(0 0 18px rgba(229,194,138,1)) drop-shadow(0 0 32px rgba(255,215,150,.7)); }
        }
        .tiara-glow{ animation: tiara-glow 2.5s ease-in-out infinite; }

        /* ── Tarjeta princesa ── */
        .princess-card{
            background:
                radial-gradient(circle at top, #FFFFFF 0%, #FFF5F8 100%);
            border-radius: 14px;
            position:relative;
            box-shadow:
                0 0 0 1px #E5C28A,
                0 0 0 8px #FFF5F8,
                0 0 0 9px #E5C28A,
                0 25px 80px rgba(157,95,112,.25);
        }
        .princess-card::before{
            content:''; position:absolute; inset:14px;
            border:1px dashed rgba(229,194,138,.6);
            border-radius:8px; pointer-events:none;
        }

        @keyframes fade-up{
            from{opacity:0; transform:translateY(30px);}
            to  {opacity:1; transform:translateY(0);}
        }
        .fade-up{ animation: fade-up 1s cubic-bezier(.22,1,.36,1) forwards; opacity:0; }

        @keyframes scale-in{
            from{opacity:0; transform:scale(.7);}
            to  {opacity:1; transform:scale(1);}
        }
        .scale-in{ animation: scale-in 1.2s cubic-bezier(.34,1.56,.64,1) forwards; opacity:0; }

        /* ── Imagen forma/marco ── */
        .img-shape{ width:160px; height:160px; object-fit:cover; }
        .shape-circulo  { border-radius:50%; }
        .shape-cuadrado { border-radius:8px; }
        .shape-corazon  { clip-path: path('M80 145 C 35 110, 0 78, 0 45 C 0 18, 24 0, 42 0 C 62 0, 75 14, 80 28 C 85 14, 98 0, 118 0 C 136 0, 160 18, 160 45 C 160 78, 125 110, 80 145 Z'); border-radius:0; }
        .shape-hexagono { clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); border-radius:0; }

        .marco-dorado   { box-shadow: 0 0 0 6px #E5C28A, 0 8px 30px rgba(157,95,112,.3); }
        .marco-plateado { box-shadow: 0 0 0 6px #D6CFE0, 0 8px 30px rgba(157,95,112,.3); }
        .marco-flores   { box-shadow: 0 0 0 6px #E89BB1, 0 0 0 10px #FBE4EE, 0 8px 30px rgba(157,95,112,.3); }
        .marco-vintage  { box-shadow: 0 0 0 6px #B8860B, 0 0 0 10px #F4E4BC, 0 8px 30px rgba(157,95,112,.3); filter: sepia(.15); }
    </style>
</head>
<body x-data="{ revelado:false }" x-init="setTimeout(()=>{revelado=true; window.fxCelebrar?.('nina'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta'))}, 600)">
    @include('mensajes.partials.efectos', ['tema' => 'quinceanera'])

{{-- ── Brillos cayendo ── --}}
@for($i=0; $i<25; $i++)
    <span class="sparkle"
          style="left:{{ random_int(0,100) }}%;
                 animation-duration:{{ random_int(8,16) }}s;
                 animation-delay:{{ random_int(0,10) }}s;
                 font-size:{{ random_int(10,20) }}px;">✦</span>
@endfor

{{-- ── Tul/velo flotando ── --}}
<svg class="tul" style="top:5%; left:-30px; width:200px; opacity:.4;" viewBox="0 0 200 200" aria-hidden="true">
    <path d="M0 0 Q 100 60 200 0 L 200 200 Q 100 140 0 200 Z" fill="url(#tulgrad1)"/>
    <defs><linearGradient id="tulgrad1"><stop offset="0%" stop-color="#FFF5F8"/><stop offset="100%" stop-color="#F4C2C2" stop-opacity=".5"/></linearGradient></defs>
</svg>
<svg class="tul" style="top:60%; right:-40px; width:240px; opacity:.4; animation-delay:3s;" viewBox="0 0 200 200" aria-hidden="true">
    <path d="M0 0 Q 100 80 200 0 L 200 200 Q 100 120 0 200 Z" fill="url(#tulgrad2)"/>
    <defs><linearGradient id="tulgrad2"><stop offset="0%" stop-color="#E8C5FF" stop-opacity=".4"/><stop offset="100%" stop-color="#F4C2C2" stop-opacity=".3"/></linearGradient></defs>
</svg>

{{-- ── Mariposas ── --}}
<div class="butterfly hidden sm:block" style="top:18%; right:8%; animation-delay:1s;" aria-hidden="true">
    <svg width="44" height="34" viewBox="0 0 44 34">
        <ellipse cx="14" cy="14" rx="13" ry="11" fill="#E89BB1" opacity=".85"/>
        <ellipse cx="30" cy="14" rx="13" ry="11" fill="#E89BB1" opacity=".85"/>
        <ellipse cx="14" cy="22" rx="9" ry="7" fill="#E8C5FF" opacity=".85"/>
        <ellipse cx="30" cy="22" rx="9" ry="7" fill="#E8C5FF" opacity=".85"/>
        <rect x="21" y="10" width="2" height="18" rx="1" fill="#9D5F70"/>
    </svg>
</div>
<div class="butterfly hidden sm:block" style="top:55%; left:5%; animation-delay:4s;" aria-hidden="true">
    <svg width="38" height="30" viewBox="0 0 44 34">
        <ellipse cx="14" cy="14" rx="13" ry="11" fill="#F4C2C2" opacity=".85"/>
        <ellipse cx="30" cy="14" rx="13" ry="11" fill="#F4C2C2" opacity=".85"/>
        <ellipse cx="14" cy="22" rx="9" ry="7" fill="#E5C28A" opacity=".85"/>
        <ellipse cx="30" cy="22" rx="9" ry="7" fill="#E5C28A" opacity=".85"/>
        <rect x="21" y="10" width="2" height="18" rx="1" fill="#9D5F70"/>
    </svg>
</div>
<div class="butterfly" style="bottom:10%; right:15%; animation-delay:7s;" aria-hidden="true">
    <svg width="34" height="28" viewBox="0 0 44 34">
        <ellipse cx="14" cy="14" rx="13" ry="11" fill="#E8C5FF" opacity=".85"/>
        <ellipse cx="30" cy="14" rx="13" ry="11" fill="#E8C5FF" opacity=".85"/>
        <rect x="21" y="10" width="2" height="18" rx="1" fill="#9D5F70"/>
    </svg>
</div>

<main class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-10">

    {{-- Tiara superior --}}
    <div class="flex justify-center mb-2 scale-in tiara-glow" aria-hidden="true">
        <svg width="180" height="90" viewBox="0 0 180 90">
            {{-- base --}}
            <path d="M10 70 Q 90 95 170 70 L 165 80 Q 90 100 15 80 Z" fill="#E5C28A"/>
            <path d="M10 70 Q 90 95 170 70" fill="none" stroke="#B8860B" stroke-width="1.5"/>
            {{-- picos --}}
            <path d="M30 70 L 45 30 L 60 70 Z" fill="#E5C28A" stroke="#B8860B" stroke-width="1"/>
            <path d="M70 70 L 90 10 L 110 70 Z" fill="#E5C28A" stroke="#B8860B" stroke-width="1"/>
            <path d="M120 70 L 135 30 L 150 70 Z" fill="#E5C28A" stroke="#B8860B" stroke-width="1"/>
            {{-- joyas --}}
            <circle cx="45" cy="40" r="5" fill="#E89BB1" stroke="#FFF" stroke-width="1.2"/>
            <circle cx="90" cy="22" r="7" fill="#F4C2C2" stroke="#FFF" stroke-width="1.5"/>
            <circle cx="135" cy="40" r="5" fill="#E89BB1" stroke="#FFF" stroke-width="1.2"/>
            <circle cx="90" cy="60" r="3" fill="#FFF5F8"/>
            <circle cx="60" cy="65" r="2" fill="#FFF5F8"/>
            <circle cx="120" cy="65" r="2" fill="#FFF5F8"/>
        </svg>
    </div>

    <header class="text-center mb-8 fade-up" style="animation-delay:.4s;">
        <p class="font-elegant text-base sm:text-lg tracking-[.3em] uppercase" style="color:var(--c-vino);">
            {{ $mensaje->ocasion->emoji ?? '👑' }} {{ $mensaje->ocasion->nombre }}
        </p>
        <h1 class="font-script text-6xl sm:text-8xl mt-3" style="color:#E89BB1; line-height:1;">
            {{ $mensaje->destinatario }}
        </h1>
        <div class="flex items-center justify-center gap-3 mt-3 text-amber-700/70">
            <span class="h-px w-16 bg-gradient-to-r from-transparent via-amber-600 to-transparent"></span>
            <span class="font-elegant text-sm">XV años</span>
            <span class="h-px w-16 bg-gradient-to-r from-transparent via-amber-600 to-transparent"></span>
        </div>
    </header>

    {{-- Tarjeta princesa --}}
    <section class="princess-card p-6 sm:p-12 fade-up" style="animation-delay:.7s;">

        {{-- Esquinas florales --}}
        <svg class="absolute top-3 left-3 w-12 h-12 opacity-70" viewBox="0 0 50 50" aria-hidden="true">
            <circle cx="15" cy="15" r="6" fill="#E89BB1"/>
            <circle cx="25" cy="10" r="4" fill="#F4C2C2"/>
            <circle cx="10" cy="25" r="4" fill="#F4C2C2"/>
            <circle cx="20" cy="20" r="3" fill="#E5C28A"/>
            <path d="M30 30 Q 40 20 45 35" stroke="#84CC16" stroke-width="1.5" fill="none" opacity=".6"/>
        </svg>
        <svg class="absolute top-3 right-3 w-12 h-12 opacity-70" style="transform:scaleX(-1);" viewBox="0 0 50 50" aria-hidden="true">
            <circle cx="15" cy="15" r="6" fill="#E89BB1"/>
            <circle cx="25" cy="10" r="4" fill="#F4C2C2"/>
            <circle cx="10" cy="25" r="4" fill="#F4C2C2"/>
            <circle cx="20" cy="20" r="3" fill="#E5C28A"/>
        </svg>
        <svg class="absolute bottom-3 left-3 w-12 h-12 opacity-70" style="transform:scaleY(-1);" viewBox="0 0 50 50" aria-hidden="true">
            <circle cx="15" cy="15" r="6" fill="#E89BB1"/>
            <circle cx="25" cy="10" r="4" fill="#F4C2C2"/>
            <circle cx="10" cy="25" r="4" fill="#F4C2C2"/>
        </svg>
        <svg class="absolute bottom-3 right-3 w-12 h-12 opacity-70" style="transform:scale(-1,-1);" viewBox="0 0 50 50" aria-hidden="true">
            <circle cx="15" cy="15" r="6" fill="#E89BB1"/>
            <circle cx="25" cy="10" r="4" fill="#F4C2C2"/>
            <circle cx="10" cy="25" r="4" fill="#F4C2C2"/>
        </svg>

        <div class="text-center fade-up" style="animation-delay:1s;">
            <p class="font-elegant text-lg sm:text-xl" style="color:var(--c-vino);">
                Una carta para una princesa
            </p>
            <div class="my-4 flex justify-center">
                <span class="text-3xl">🌸</span>
                <span class="text-3xl mx-2">👑</span>
                <span class="text-3xl">🌸</span>
            </div>
        </div>

        {{-- Imagen --}}
        @if(!empty($mensaje->imagen_path))
            <div class="flex justify-center my-6 scale-in" style="animation-delay:1.2s;">
                <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                     alt="Foto de {{ $mensaje->destinatario }}"
                     class="img-shape shape-{{ $mensaje->imagen_forma ?? 'circulo' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}">
            </div>
        @endif

        {{-- Mensaje --}}
        <article class="prose prose-lg max-w-none mt-6 mx-auto fade-up"
                 style="animation-delay:1.4s; font-family:'Cormorant Garamond', serif; font-size:1.2rem; line-height:1.85; color:#5A3D4A; text-align:justify;">
            <span class="float-left font-script text-7xl mr-3 leading-none" style="color:#E89BB1;">"</span>
            {!! $mensaje->mensaje !!}
        </article>

        {{-- Firma --}}
        <div class="mt-10 text-right fade-up" style="animation-delay:1.7s;">
            <p class="font-script text-4xl sm:text-5xl" style="color:#9D5F70;">
                {{ $mensaje->remitente }}
            </p>
            <p class="font-elegant text-sm mt-1 tracking-widest uppercase" style="color:var(--c-vino); opacity:.7;">
                Con todo el cariño
            </p>
        </div>
    </section>

    {{-- Bloque de código + compartir --}}
    <section class="mt-12 fade-up" style="animation-delay:2s;"
             x-data="{ copiado:false, copiar(){ navigator.clipboard.writeText(window.location.href).then(()=>{this.copiado=true;setTimeout(()=>this.copiado=false,2000);}); } }">
        <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg text-center"
             style="border: 2px solid #E5C28A;">
            <p class="font-elegant text-xs uppercase tracking-[.3em] mb-2" style="color:var(--c-vino);">Código del mensaje</p>
            <p class="font-script text-3xl" style="color:#E89BB1;">{{ $mensaje->code }}</p>
            <button @click="copiar()"
                    class="mt-4 inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-bold text-white shadow-md hover:scale-105 transition tracking-wider text-sm uppercase"
                    style="background: linear-gradient(135deg, #E89BB1, #E5C28A);"
                    :aria-label="copiado ? 'Enlace copiado' : 'Copiar enlace'">
                <span x-show="!copiado">✦ Copiar enlace</span>
                <span x-show="copiado">✓ ¡Copiado!</span>
            </button>
        </div>
    </section>

    <footer class="mt-10 text-center text-sm" style="color:var(--c-vino); opacity:.7;">
        <p class="font-elegant">{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        <p class="text-xs mt-1">Creado el {{ $mensaje->created_at->format('d/m/Y') }}</p>
    </footer>
</main>

@include('mensajes.partials.music-player', ['accent' => '#E89BB1'])

</body>
</html>
