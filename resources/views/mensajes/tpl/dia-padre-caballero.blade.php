<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Un mensaje para {{ $mensaje->destinatario }} — Día del Padre">
    <title>{{ $mensaje->destinatario }} — Caballero Clásico</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#0F1B2D">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Cormorant+Garamond:wght@400;500;700&family=Cinzel:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --azul-noche: #0F1B2D;
            --azul-medio: #1E3A5F;
            --dorado: #C9A961;
            --dorado-hi: #F0D78A;
            --crema: #F8F4E9;
            --tinta: #1A1A1A;
        }
        body {
            font-family: 'Cormorant Garamond', serif;
            background:
                radial-gradient(circle at 20% 10%, #2A4A75 0%, transparent 45%),
                radial-gradient(circle at 80% 90%, #1A2F4A 0%, transparent 45%),
                linear-gradient(180deg, #0F1B2D 0%, #07101D 100%);
            min-height: 100vh; overflow-x: hidden; color: var(--crema);
        }
        .cinzel { font-family: 'Cinzel', serif; letter-spacing: .12em; }
        .serif  { font-family: 'Playfair Display', serif; }

        /* Patrón herringbone (tela de traje) */
        .herringbone {
            background-color: #1A2A45;
            background-image:
                repeating-linear-gradient(45deg, rgba(201,169,97,.05) 0 2px, transparent 2px 8px),
                repeating-linear-gradient(-45deg, rgba(201,169,97,.05) 0 2px, transparent 2px 8px);
        }

        /* Marco con monograma */
        .monogram {
            border: 2px solid var(--dorado);
            box-shadow: 0 0 0 1px var(--azul-noche), 0 0 0 4px var(--dorado), 0 30px 70px rgba(0,0,0,.6);
        }

        /* Reloj de bolsillo */
        @keyframes tick {
            0%,100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }
        .pocket-watch { animation: tick 2.6s ease-in-out infinite; transform-origin: 50% 0; }

        /* Caja sastre */
        .suit-box-wrap { perspective: 2200px; }
        .suit-box {
            position: relative; max-width: 600px; margin: 0 auto;
            transform-style: preserve-3d;
        }
        .suit-lid {
            position: relative;
            background: linear-gradient(135deg, #14253D 0%, #0A1626 100%);
            border-radius: 4px;
            padding: 50px 30px;
            border: 2px solid var(--dorado);
            box-shadow:
                inset 0 0 0 4px rgba(15,27,45,1),
                inset 0 0 0 5px rgba(201,169,97,.6),
                0 35px 80px rgba(0,0,0,.65);
            transform-origin: top center;
            transition: transform 1.4s cubic-bezier(.7,.05,.2,1), opacity .9s;
            cursor: pointer;
        }
        .suit-box.opened .suit-lid {
            transform: rotateX(165deg) translateY(-10px);
            opacity: 0;
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
        .suit-content {
            background:
                linear-gradient(180deg, #F8F4E9 0%, #ECE2C7 100%);
            border-radius: 4px;
            color: var(--tinta);
            max-height: 0; overflow: hidden;
            transition: max-height 1.5s ease, padding 1.5s ease;
            border: 1px solid rgba(201,169,97,.4);
        }
        .suit-box.opened .suit-content { max-height: 5000px; padding: 50px 36px; }

        /* Sello dorado */
        .seal {
            display: inline-flex; align-items: center; justify-content: center;
            width: 70px; height: 70px; border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, var(--dorado-hi), var(--dorado) 60%, #8C7235 100%);
            box-shadow: 0 6px 18px rgba(0,0,0,.5), inset 0 -3px 8px rgba(0,0,0,.4);
            color: var(--azul-noche); font-family: 'Cinzel', serif; font-weight: 700; font-size: 1.4rem;
        }

        @keyframes fade-up { from { opacity:0; transform:translateY(24px);} to { opacity:1; transform:translateY(0);} }
        .fade-up { animation: fade-up 1s ease both; }

        .img-circulo  { border-radius: 50%; }
        .img-cuadrado { border-radius: 4px; }
        .img-corazon  { clip-path: path('M50,90 C20,65 0,40 15,20 C28,5 45,10 50,25 C55,10 72,5 85,20 C100,40 80,65 50,90 Z'); }
        .img-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
        .marco-dorado   { border:5px solid var(--dorado); box-shadow:0 0 22px rgba(201,169,97,.55); }
        .marco-plateado { border:5px solid #C0C0C0; box-shadow:0 0 22px rgba(192,192,192,.55); }
        .marco-flores   { border:5px solid var(--dorado); box-shadow:0 0 0 3px var(--azul-noche); }
        .marco-vintage  { border:6px double var(--dorado); box-shadow:0 4px 22px rgba(0,0,0,.5); }

        /* Iniciales monograma */
        .initial-bg {
            position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif; font-weight: 900; font-size: 22rem;
            color: rgba(201,169,97,.06); pointer-events: none; user-select: none;
        }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'papa'])

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-6 sm:py-10">

        {{-- Encabezado --}}
        <header class="text-center mb-7 fade-up relative">
            <span class="initial-bg" aria-hidden="true">{{ mb_substr($mensaje->destinatario, 0, 1) }}</span>
            {{-- Reloj de bolsillo --}}
            <svg class="mx-auto mb-4 pocket-watch" width="70" height="100" viewBox="0 0 80 110" aria-hidden="true">
                <line x1="40" y1="0" x2="40" y2="14" stroke="#C9A961" stroke-width="2"/>
                <rect x="36" y="10" width="8" height="6" rx="1" fill="#C9A961"/>
                <circle cx="40" cy="55" r="38" fill="#0F1B2D" stroke="#C9A961" stroke-width="3"/>
                <circle cx="40" cy="55" r="32" fill="#F8F4E9"/>
                <text x="40" y="32" text-anchor="middle" font-family="Cinzel" font-size="8" fill="#0F1B2D">XII</text>
                <text x="63" y="59" text-anchor="middle" font-family="Cinzel" font-size="8" fill="#0F1B2D">III</text>
                <text x="40" y="84" text-anchor="middle" font-family="Cinzel" font-size="8" fill="#0F1B2D">VI</text>
                <text x="17" y="59" text-anchor="middle" font-family="Cinzel" font-size="8" fill="#0F1B2D">IX</text>
                <line x1="40" y1="55" x2="40" y2="35" stroke="#0F1B2D" stroke-width="2" stroke-linecap="round"/>
                <line x1="40" y1="55" x2="55" y2="55" stroke="#C9A961" stroke-width="1.5" stroke-linecap="round"/>
                <circle cx="40" cy="55" r="2.5" fill="#C9A961"/>
            </svg>
            <p class="cinzel text-xs sm:text-sm text-[#C9A961] uppercase">{{ $mensaje->ocasion->nombre }}</p>
            <div class="flex items-center justify-center gap-3 mt-2">
                <span class="h-px w-10 bg-[#C9A961]/60"></span>
                <span class="cinzel text-xs text-[#C9A961]/80">est.</span>
                <span class="h-px w-10 bg-[#C9A961]/60"></span>
            </div>
            <h1 class="serif text-5xl sm:text-7xl text-[#F8F4E9] mt-3 font-black tracking-tight">{{ $mensaje->destinatario }}</h1>
            <p class="cinzel text-xs text-[#C9A961] mt-4 tracking-[.5em] uppercase">{{ $mensaje->created_at->format('d · M · Y') }}</p>
        </header>

        {{-- Caja de sastre --}}
        <section x-data="{ opened:false }" class="suit-box-wrap mb-6">
            <div class="suit-box" :class="opened && 'opened'">
                <div class="suit-lid herringbone"
                     @click="if(!opened){ opened=true; window.fxCelebrar?.('estrellas'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 1100);}"
                     role="button" tabindex="0" aria-label="Abrir caja"
                     @keydown.enter="opened=true; window.fxCelebrar?.('estrellas'); setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')), 1100)">
                    <div class="text-center">
                        <div class="seal mx-auto mb-4">{{ mb_strtoupper(mb_substr($mensaje->destinatario, 0, 1)) }}</div>
                        <p class="cinzel text-2xl sm:text-3xl text-[#C9A961] uppercase">Para Caballero</p>
                        <p class="serif italic text-[#F8F4E9] text-2xl mt-2">{{ $mensaje->destinatario }}</p>
                        <div class="flex items-center justify-center gap-2 mt-5">
                            <span class="h-px w-8 bg-[#C9A961]/60"></span>
                            <span class="cinzel text-[10px] text-[#C9A961]/80 uppercase">Tap para abrir</span>
                            <span class="h-px w-8 bg-[#C9A961]/60"></span>
                        </div>
                    </div>
                </div>

                <div class="suit-content">
                    <p class="cinzel text-xl text-[#0F1B2D] mb-1 uppercase tracking-widest">Sr.</p>
                    <p class="serif italic text-3xl text-[#1E3A5F] mb-6">{{ $mensaje->destinatario }},</p>

                    @if($mensaje->imagen_path)
                        <figure class="flex justify-center my-6">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($mensaje->imagen_path) }}"
                                 alt="Foto de {{ $mensaje->destinatario }}"
                                 class="img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'dorado' }}"
                                 style="width:220px;height:220px;object-fit:cover;">
                        </figure>
                    @endif

                    <div class="serif text-xl leading-relaxed text-[#1A1A1A]">
                        {!! $mensaje->mensaje !!}
                    </div>

                    @if($mensaje->remitente)
                        <div class="text-right mt-10">
                            <p class="cinzel text-xs text-[#C9A961] uppercase tracking-[.4em]">Atentamente</p>
                            <p class="serif italic text-2xl text-[#0F1B2D] mt-2">— {{ $mensaje->remitente }}</p>
                        </div>
                    @endif

                    <div class="cinzel text-[10px] text-[#0F1B2D]/60 text-center mt-10 border-t border-[#C9A961]/40 pt-4 uppercase tracking-[.4em]">
                        {{ $mensaje->created_at->format('d / m / Y') }}
                    </div>
                </div>
            </div>
        </section>

        {{-- Código --}}
        <section class="herringbone monogram rounded-sm p-6 text-center">
            <p class="cinzel text-xs text-[#C9A961] mb-3 uppercase tracking-[.5em]">Código del Caballero</p>
            <p class="serif text-3xl font-bold text-[#F8F4E9] tracking-widest mb-5">{{ $mensaje->code }}</p>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{ this.textContent='COPIADO ✓'; setTimeout(()=>this.textContent='COPIAR ENLACE',2000);})"
                    class="cinzel uppercase px-7 py-3 rounded-sm bg-[#C9A961] text-[#0F1B2D] font-bold hover:bg-[#F0D78A] transition shadow-lg tracking-[.3em] text-xs">
                Copiar enlace
            </button>
        </section>

        <footer class="text-center text-[10px] text-[#C9A961]/60 mt-10 cinzel uppercase tracking-[.5em]">
            {{ config('app.name') }} &copy; {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#C9A961'])
</body>
</html>
