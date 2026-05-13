<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="¡Feliz cumpleaños, Papá! Para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#C53030">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@500;700&family=Roboto+Slab:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --rojo: #C53030;
            --rojo-deep: #8B1F1F;
            --ambar: #D69E2E;
            --marron: #744210;
            --crema: #FFF8DC;
            --pizarra: #2A1F18;
        }
        body {
            font-family: 'Roboto Slab', serif;
            background:
                radial-gradient(circle at 20% 30%, #4A2818 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, #6B3410 0%, transparent 50%),
                linear-gradient(180deg, #2A1F18 0%, #1A1410 100%);
            min-height: 100vh; overflow-x: hidden; color: #FFF8DC;
        }
        .bebas   { font-family: 'Bebas Neue', sans-serif; letter-spacing: .05em; }
        .caveat  { font-family: 'Caveat', cursive; }

        /* Pizarra de menú */
        .chalkboard {
            background:
                radial-gradient(ellipse at center, #2A4A2A 0%, #1A2F1A 100%);
            border: 14px solid #5C3A1F;
            border-radius: 12px;
            box-shadow:
                0 30px 80px rgba(0,0,0,.6),
                inset 0 0 60px rgba(0,0,0,.5),
                inset 0 0 0 2px rgba(0,0,0,.4);
            padding: 36px 28px;
            position: relative;
        }
        .chalkboard::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255,255,255,.015) 0 1px, transparent 1px 3px),
                repeating-linear-gradient(-45deg, rgba(255,255,255,.015) 0 1px, transparent 1px 3px);
            border-radius: 4px; pointer-events: none;
        }
        .chalk { color: #FFF8DC; text-shadow: 0 0 1px rgba(255,248,220,.5); }
        .chalk-yellow { color: #F4D67A; text-shadow: 0 0 2px rgba(244,214,122,.6); }
        .chalk-orange { color: #E89854; text-shadow: 0 0 2px rgba(232,152,84,.6); }

        /* Humo */
        @keyframes smoke-rise {
            0%   { transform: translateY(0) scale(1); opacity: 0; }
            20%  { opacity: .5; }
            100% { transform: translateY(-260px) scale(2.4); opacity: 0; }
        }
        .smoke {
            position: absolute; bottom: 0;
            width: 30px; height: 30px;
            background: radial-gradient(circle, rgba(200,200,200,.5) 0%, transparent 70%);
            border-radius: 50%;
            animation: smoke-rise 4s ease-out infinite;
        }

        /* Espuma cerveza */
        @keyframes foam-bubble {
            0%,100% { transform: translateY(0); }
            50%     { transform: translateY(-3px); }
        }
        .foam-bubble { animation: foam-bubble 1.4s ease-in-out infinite; }

        /* Brasas */
        @keyframes ember-pulse {
            0%,100% { opacity: .5; transform: scale(1); }
            50%     { opacity: 1; transform: scale(1.4); }
        }
        .ember { animation: ember-pulse 1.2s ease-in-out infinite; }

        @keyframes fade-up { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }
        .fade-up { animation: fade-up .9s ease both; }
        @keyframes plate-in {
            0%   { opacity: 0; transform: scale(.85) rotate(-3deg); }
            100% { opacity: 1; transform: scale(1) rotate(0); }
        }
        .plate-in { animation: plate-in .8s cubic-bezier(.4,1.4,.5,1) both; }

        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 6px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
        .marco-dorado   { border:5px solid #D69E2E; box-shadow:0 0 24px rgba(214,158,46,.65); }
        .marco-plateado { border:5px solid #C0C0C0; box-shadow:0 0 24px rgba(192,192,192,.55); }
        .marco-flores   { border:5px solid #C53030; box-shadow:0 0 0 3px #D69E2E; }
        .marco-vintage  { border:6px double #744210; box-shadow:0 4px 22px rgba(0,0,0,.6); }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'papa'])

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-6 sm:py-10">

        {{-- Encabezado --}}
        <header class="text-center mb-8 fade-up">
            {{-- Gorro de chef --}}
            <svg class="mx-auto mb-2" width="80" height="70" viewBox="0 0 80 70" aria-hidden="true">
                <ellipse cx="20" cy="25" rx="16" ry="20" fill="#FFF8DC"/>
                <ellipse cx="40" cy="20" rx="18" ry="22" fill="#FFF8DC"/>
                <ellipse cx="60" cy="25" rx="16" ry="20" fill="#FFF8DC"/>
                <rect x="14" y="42" width="52" height="22" rx="2" fill="#FFF8DC"/>
                <rect x="14" y="48" width="52" height="2" fill="#C53030" opacity=".5"/>
            </svg>
            <p class="caveat text-3xl text-[#D69E2E]">¡Feliz Cumpleaños!</p>
            <h1 class="bebas text-5xl sm:text-6xl md:text-7xl text-[#FFF8DC] mt-2">{{ $mensaje->destinatario }}</h1>
            <p class="text-[#D69E2E] mt-2 text-sm tracking-widest uppercase">{{ $mensaje->ocasion->emoji ?? '🍻' }} {{ $mensaje->ocasion->nombre }}</p>
        </header>

        {{-- Decoraciones BBQ --}}
        <div class="flex items-end justify-center gap-8 mb-8 relative" aria-hidden="true" style="height:140px;">
            {{-- Parrilla con humo --}}
            <div class="relative" style="width:120px;height:140px;">
                <div class="smoke" style="left:35%; animation-delay:0s;"></div>
                <div class="smoke" style="left:55%; animation-delay:1s;"></div>
                <div class="smoke" style="left:45%; animation-delay:2s;"></div>
                <svg class="absolute bottom-0" width="120" height="80" viewBox="0 0 120 80">
                    <ellipse cx="60" cy="35" rx="50" ry="12" fill="#2A1F18" stroke="#5C3A1F" stroke-width="2"/>
                    <ellipse cx="60" cy="32" rx="48" ry="10" fill="#1A1410"/>
                    {{-- Brasas --}}
                    <circle class="ember" cx="40" cy="32" r="3" fill="#F4D67A" style="animation-delay:0s;"/>
                    <circle class="ember" cx="60" cy="34" r="3" fill="#E89854" style="animation-delay:.3s;"/>
                    <circle class="ember" cx="80" cy="31" r="3" fill="#F4D67A" style="animation-delay:.6s;"/>
                    <circle class="ember" cx="50" cy="36" r="2" fill="#C53030" style="animation-delay:.9s;"/>
                    <circle class="ember" cx="70" cy="36" r="2" fill="#E89854" style="animation-delay:1.1s;"/>
                    {{-- Patas --}}
                    <line x1="20" y1="40" x2="15" y2="78" stroke="#5C3A1F" stroke-width="3"/>
                    <line x1="100" y1="40" x2="105" y2="78" stroke="#5C3A1F" stroke-width="3"/>
                </svg>
            </div>

            {{-- Jarra de cerveza --}}
            <svg width="80" height="120" viewBox="0 0 80 120" aria-hidden="true">
                {{-- Espuma --}}
                <g class="foam-bubble">
                    <ellipse cx="20" cy="20" rx="12" ry="8" fill="#FFF8DC"/>
                    <ellipse cx="40" cy="15" rx="14" ry="10" fill="#FFF8DC"/>
                    <ellipse cx="58" cy="20" rx="12" ry="8" fill="#FFF8DC"/>
                </g>
                {{-- Cerveza --}}
                <rect x="10" y="25" width="55" height="80" rx="3" fill="#D69E2E" opacity=".9"/>
                <rect x="10" y="25" width="55" height="80" rx="3" fill="none" stroke="#FFF8DC" stroke-width="2" opacity=".4"/>
                {{-- Burbujas internas --}}
                <circle cx="22" cy="60" r="2" fill="#FFF8DC" opacity=".7"/>
                <circle cx="35" cy="80" r="1.5" fill="#FFF8DC" opacity=".7"/>
                <circle cx="50" cy="50" r="2" fill="#FFF8DC" opacity=".7"/>
                {{-- Asa --}}
                <path d="M65 40 Q78 40 78 60 Q78 80 65 80" fill="none" stroke="#FFF8DC" stroke-width="4" opacity=".5"/>
            </svg>
        </div>

        {{-- Pizarra menú --}}
        <section x-data="{ shown:false }" x-init="setTimeout(()=>{shown=true; window.fxCelebrar?.('cumple'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta'))}, 400)"
                 class="chalkboard mb-10">
            <div x-show="shown" class="plate-in relative z-10">
                <div class="text-center border-b-2 border-dashed border-[#FFF8DC]/30 pb-4 mb-6">
                    <p class="bebas chalk-yellow text-2xl">— Especial del día —</p>
                    <h2 class="bebas chalk text-4xl sm:text-5xl mt-1">Para {{ $mensaje->destinatario }}</h2>
                    <p class="caveat chalk-orange text-2xl mt-1">¡Salud, Papá! 🍻</p>
                </div>

                @if($mensaje->imagen_path)
                    <figure class="flex justify-center my-6">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                             alt="Foto de {{ $mensaje->destinatario }}"
                             class="img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}"
                             style="width:220px;height:220px;object-fit:cover;">
                    </figure>
                @endif

                <div class="caveat text-2xl leading-relaxed chalk px-2">
                    {!! $mensaje->mensaje !!}
                </div>

                @if($mensaje->remitente)
                    <p class="caveat chalk-yellow text-2xl text-right mt-8">— {{ $mensaje->remitente }}</p>
                @endif

                <div class="border-t-2 border-dashed border-[#FFF8DC]/30 mt-6 pt-3 flex justify-between bebas chalk-orange text-sm">
                    <span>Mesa #{{ substr($mensaje->code, 0, 4) }}</span>
                    <span>{{ $mensaje->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </section>

        {{-- Código --}}
        <section class="bg-[#5C3A1F] rounded-xl p-6 text-center shadow-2xl border-4 border-[#D69E2E]">
            <p class="bebas text-[#FFF8DC] uppercase tracking-widest mb-2">Código del mensaje</p>
            <p class="bebas text-3xl text-[#D69E2E] tracking-widest mb-4">{{ $mensaje->code }}</p>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='¡Copiado! ✓'; setTimeout(()=>this.textContent='Copiar enlace',2000);})"
                    class="bebas uppercase px-7 py-3 rounded bg-[#C53030] text-[#FFF8DC] font-bold hover:bg-[#8B1F1F] transition shadow-lg tracking-widest">
                Copiar enlace
            </button>
        </section>

        <footer class="text-center text-xs text-[#D69E2E]/70 mt-10 bebas tracking-widest">
            {{ config('app.name') }} &copy; {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#C53030'])
</body>
</html>
