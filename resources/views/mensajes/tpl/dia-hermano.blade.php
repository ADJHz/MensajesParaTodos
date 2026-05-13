<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#2DD4BF">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Caveat:wght@500;700&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body{font-family:'Nunito',sans-serif;background:#F5F1E8;color:#1F2937;min-height:100vh;overflow-x:hidden;}
        .scrap-bg{
            background-color:#F5F1E8;
            background-image:
                radial-gradient(circle at 20% 10%, rgba(45,212,191,.07) 0, transparent 35%),
                radial-gradient(circle at 80% 90%, rgba(251,146,60,.08) 0, transparent 35%),
                repeating-linear-gradient(45deg, rgba(31,41,55,.015) 0 2px, transparent 2px 14px);
        }
        .marker{font-family:'Permanent Marker',cursive;}
        .handw{font-family:'Caveat',cursive;}
        .polaroid{
            background:#fff;padding:14px 14px 56px 14px;
            box-shadow:0 8px 22px rgba(31,41,55,.18), 0 2px 6px rgba(31,41,55,.08);
            transition:transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s;
            position:relative;
        }
        .polaroid:hover{transform:rotate(0deg) scale(1.06) translateY(-6px);box-shadow:0 18px 36px rgba(31,41,55,.25);z-index:5;}
        .polaroid .ph{
            width:100%;aspect-ratio:1/1;background:linear-gradient(135deg,#2DD4BF 0%,#0EA5A4 100%);
            display:flex;align-items:center;justify-content:center;color:#fff;font-size:42px;
        }
        .washi{
            position:absolute;top:-10px;left:50%;transform:translateX(-50%) rotate(-3deg);
            width:80px;height:22px;background:repeating-linear-gradient(45deg,#FB923C 0 6px,#FDBA74 6px 12px);
            opacity:.85;border-radius:1px;box-shadow:0 2px 4px rgba(0,0,0,.1);
        }
        .clip{
            position:absolute;top:-18px;left:50%;transform:translateX(-50%);
            width:42px;height:48px;
            background:linear-gradient(180deg,#94A3B8,#64748B);
            clip-path:polygon(50% 0,100% 25%,85% 100%,15% 100%,0 25%);
            box-shadow:0 4px 8px rgba(0,0,0,.2);
        }
        .pin{
            width:18px;height:18px;border-radius:50%;
            background:radial-gradient(circle at 35% 30%, #FCA5A5, #DC2626 70%);
            box-shadow:0 2px 4px rgba(0,0,0,.3),inset -2px -2px 4px rgba(0,0,0,.25);
        }
        .footprint{position:absolute;width:38px;height:60px;opacity:.18;pointer-events:none;}
        @keyframes drop-in{from{opacity:0;transform:translateY(-40px) rotate(var(--r,0deg)) scale(.7);}to{opacity:1;transform:translateY(0) rotate(var(--r,0deg)) scale(1);}}
        .drop-in{animation:drop-in .8s cubic-bezier(.34,1.56,.64,1) both;}
        @keyframes wiggle{0%,100%{transform:rotate(var(--r,0deg));}50%{transform:rotate(calc(var(--r,0deg) + 2deg));}}
        .wiggle{animation:wiggle 4s ease-in-out infinite;}
        .sheet{
            background:#FFFEF7;
            background-image:repeating-linear-gradient(to bottom,transparent 0 27px,rgba(45,212,191,.18) 27px 28px);
            box-shadow:0 12px 30px rgba(31,41,55,.15),0 2px 0 #E7E1D0;
        }
        .stamp{
            border:3px dashed #FB923C;color:#FB923C;
            transform:rotate(-8deg);font-family:'Permanent Marker',cursive;
        }
        .img-circulo{clip-path:circle(50% at 50% 50%);}
        .img-cuadrado{clip-path:inset(0 round 8px);}
        .img-corazon{clip-path:path('M50,88 C20,66 4,46 4,28 C4,12 16,2 30,2 C40,2 47,8 50,18 C53,8 60,2 70,2 C84,2 96,12 96,28 C96,46 80,66 50,88 Z');}
        .img-hexagono{clip-path:polygon(25% 5%,75% 5%,98% 50%,75% 95%,25% 95%,2% 50%);}
        .marco-clasico{border:6px solid #fff;box-shadow:0 0 0 2px #FB923C,0 8px 20px rgba(0,0,0,.2);}
        .marco-vintage{filter:sepia(.4) contrast(1.05);border:8px double #92400E;}
        .marco-moderno{box-shadow:0 0 0 4px #2DD4BF,0 10px 24px rgba(0,0,0,.2);}
        .marco-ninguno{box-shadow:0 6px 16px rgba(0,0,0,.18);}
        .reveal-mask{display:flex;flex-direction:column;align-items:center;}
    </style>
</head>
<body class="scrap-bg" x-data="{revealed:false}" x-init="setTimeout(()=>{revealed=true;window.fxCelebrar?.('confeti');window.dispatchEvent(new CustomEvent('tpl-carta-abierta'))},900)">
    @include('mensajes.partials.efectos', ['tema' => 'hermano'])
    {{-- Huellas decorativas --}}
    <svg class="footprint" style="top:8%;left:4%;transform:rotate(-20deg);" viewBox="0 0 38 60" aria-hidden="true">
        <ellipse cx="19" cy="40" rx="14" ry="18" fill="#1F2937"/>
        <circle cx="11" cy="14" r="4" fill="#1F2937"/><circle cx="20" cy="9" r="4" fill="#1F2937"/><circle cx="29" cy="14" r="4" fill="#1F2937"/>
    </svg>
    <svg class="footprint" style="top:22%;left:8%;transform:rotate(15deg);" viewBox="0 0 38 60" aria-hidden="true">
        <ellipse cx="19" cy="40" rx="14" ry="18" fill="#1F2937"/>
        <circle cx="11" cy="14" r="4" fill="#1F2937"/><circle cx="20" cy="9" r="4" fill="#1F2937"/><circle cx="29" cy="14" r="4" fill="#1F2937"/>
    </svg>
    <svg class="footprint" style="bottom:10%;right:5%;transform:rotate(170deg);" viewBox="0 0 38 60" aria-hidden="true">
        <ellipse cx="19" cy="40" rx="14" ry="18" fill="#1F2937"/>
        <circle cx="11" cy="14" r="4" fill="#1F2937"/><circle cx="20" cy="9" r="4" fill="#1F2937"/><circle cx="29" cy="14" r="4" fill="#1F2937"/>
    </svg>

    <main class="relative max-w-5xl mx-auto px-4 py-6 sm:py-10">
        <header class="text-center mb-6">
            <div class="inline-block bg-[#FB923C] text-white px-5 py-1.5 marker text-sm tracking-wider rotate-[-3deg] shadow-lg">SCRAPBOOK · {{ $mensaje->ocasion->emoji ?? '🤝' }}</div>
            <h1 class="marker text-5xl sm:text-7xl text-[#1F2937] mt-4 leading-none">¡{{ $mensaje->destinatario }}!</h1>
            <p class="handw text-2xl sm:text-3xl text-[#FB923C] mt-2">{{ $mensaje->ocasion->nombre }}</p>
        </header>

        {{-- Polaroids dispersas --}}
        <section class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-4 mb-12 max-w-3xl mx-auto" aria-label="Recuerdos compartidos">
            <div class="polaroid drop-in wiggle" style="--r:-6deg;animation-delay:.1s,1s">
                <span class="washi" aria-hidden="true"></span>
                <div class="ph">🖐️</div>
                <p class="handw text-center text-xl mt-2 text-[#1F2937]">High five</p>
            </div>
            <div class="polaroid drop-in wiggle mt-6" style="--r:4deg;animation-delay:.25s,1.5s">
                <span class="washi" aria-hidden="true" style="background:repeating-linear-gradient(45deg,#2DD4BF 0 6px,#5EEAD4 6px 12px);"></span>
                <div class="ph" style="background:linear-gradient(135deg,#FB923C,#EA580C);">🎮</div>
                <p class="handw text-center text-xl mt-2 text-[#1F2937]">Risas</p>
            </div>
            <div class="polaroid drop-in wiggle" style="--r:-3deg;animation-delay:.4s,1.2s">
                <span class="washi" aria-hidden="true"></span>
                <div class="ph" style="background:linear-gradient(135deg,#1F2937,#374151);">⭐</div>
                <p class="handw text-center text-xl mt-2 text-[#1F2937]">Aventuras</p>
            </div>
            <div class="polaroid drop-in wiggle mt-6" style="--r:7deg;animation-delay:.55s,1.8s">
                <span class="washi" aria-hidden="true" style="background:repeating-linear-gradient(45deg,#FB923C 0 6px,#FDBA74 6px 12px);"></span>
                <div class="ph" style="background:linear-gradient(135deg,#2DD4BF,#0F766E);">💪</div>
                <p class="handw text-center text-xl mt-2 text-[#1F2937]">Familia</p>
            </div>
        </section>

        {{-- Hoja con clip y mensaje --}}
        <article class="reveal-mask" x-show="revealed" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-12" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="relative max-w-2xl w-full mx-auto sheet rounded-sm p-8 sm:p-12 pt-14">
                <span class="clip" aria-hidden="true"></span>
                <span class="stamp absolute top-6 right-6 px-3 py-1 text-sm">DE CORAZÓN</span>

                @if($mensaje->imagen_path)
                    <figure class="flex justify-center mb-6">
                        <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                             alt="Imagen para {{ $mensaje->destinatario }}"
                             class="w-40 h-40 sm:w-48 sm:h-48 object-contain bg-white img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'clasico' }}">
                    </figure>
                @endif

                <p class="handw text-3xl text-center text-[#1F2937] mb-2">Para mi hermano,</p>
                <h2 class="marker text-4xl text-center text-[#FB923C] mb-6">{{ $mensaje->destinatario }}</h2>

                <div class="handw text-2xl sm:text-[1.7rem] leading-relaxed text-[#1F2937] text-center">
                    {!! $mensaje->mensaje !!}
                </div>

                <div class="mt-8 text-right">
                    <p class="handw text-2xl text-[#2DD4BF]">— {{ $mensaje->remitente }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $mensaje->created_at->format('d M, Y') }}</p>
                </div>

                <span class="pin absolute -top-2 left-8" aria-hidden="true"></span>
                <span class="pin absolute -top-2 right-8" aria-hidden="true"></span>
            </div>
        </article>

        {{-- Código + compartir --}}
        <section class="max-w-md mx-auto mt-16 bg-white border-2 border-dashed border-[#2DD4BF] p-6 rounded-lg text-center" x-data="{copied:false}">
            <p class="marker text-[#1F2937] text-sm tracking-wider mb-2">CÓDIGO ÚNICO</p>
            <p class="text-2xl font-mono font-bold text-[#FB923C] mb-4 tracking-widest">{{ $mensaje->code }}</p>
            <button @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,2200)"
                    class="bg-[#2DD4BF] hover:bg-[#0F766E] text-white font-bold marker tracking-wider px-6 py-3 rounded-full transition-all hover:scale-105 active:scale-95">
                <span x-show="!copied">📋 COPIAR ENLACE</span>
                <span x-show="copied" x-cloak>✓ ¡COPIADO!</span>
            </button>
        </section>

        <footer class="mt-12 text-center text-sm text-gray-500">
            <p class="handw text-lg">{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#2DD4BF'])
</body>
</html>
