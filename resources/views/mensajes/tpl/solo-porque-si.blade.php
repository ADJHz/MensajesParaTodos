<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#FFE066">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&family=Patrick+Hand&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body{font-family:'Nunito',sans-serif;color:#1F2937;min-height:100vh;overflow-x:hidden;}
        .cork-bg{
            background-color:#C19A6B;
            background-image:
                radial-gradient(circle at 12% 18%, rgba(101,67,33,.45) 0 1.5px, transparent 2px),
                radial-gradient(circle at 38% 72%, rgba(101,67,33,.4) 0 1.2px, transparent 2px),
                radial-gradient(circle at 65% 25%, rgba(101,67,33,.5) 0 1.6px, transparent 2px),
                radial-gradient(circle at 82% 55%, rgba(101,67,33,.45) 0 1.4px, transparent 2px),
                radial-gradient(circle at 22% 88%, rgba(101,67,33,.4) 0 1.3px, transparent 2px),
                radial-gradient(circle at 50% 50%, rgba(101,67,33,.4) 0 1.5px, transparent 2px),
                radial-gradient(circle at 92% 12%, rgba(101,67,33,.5) 0 1.5px, transparent 2px),
                radial-gradient(circle at 8% 60%, rgba(101,67,33,.4) 0 1.2px, transparent 2px),
                radial-gradient(circle at 70% 90%, rgba(101,67,33,.45) 0 1.5px, transparent 2px),
                linear-gradient(135deg, #C19A6B 0%, #B08A5A 100%);
            background-size: 80px 80px, 90px 90px, 70px 70px, 100px 100px, 85px 85px, 75px 75px, 95px 95px, 110px 110px, 88px 88px, 100% 100%;
        }
        .caveat{font-family:'Caveat',cursive;}
        .patrick{font-family:'Patrick Hand',cursive;}

        .post-it{
            position:relative;display:inline-block;padding:18px 16px;
            background:#FFE066;
            box-shadow:0 6px 14px rgba(0,0,0,.18),0 1px 2px rgba(0,0,0,.12);
            transform-origin:center top;
        }
        .post-it::before{
            content:'';position:absolute;top:-8px;left:50%;transform:translateX(-50%);
            width:30px;height:14px;background:rgba(255,255,255,.45);
            box-shadow:0 1px 2px rgba(0,0,0,.1);
        }
        .post-it.green{background:#A7E063;}
        .post-it.blue{background:#7DD3FC;}
        .post-it.pink{background:#FBB6CE;}
        .post-it.peach{background:#FDBA74;}

        @keyframes paper-drop{
            0%{transform:translateY(-120vh) rotate(var(--r,-6deg)) scale(.8);opacity:0;}
            60%{opacity:1;}
            85%{transform:translateY(8px) rotate(var(--r,-6deg)) scale(1.02);}
            100%{transform:translateY(0) rotate(var(--r,-6deg)) scale(1);opacity:1;}
        }
        .drop{animation:paper-drop 1.4s cubic-bezier(.34,1.4,.64,1) both;}
        @keyframes flutter{0%,100%{transform:rotate(var(--r,-3deg)) translateY(0);}50%{transform:rotate(calc(var(--r,-3deg) + 1deg)) translateY(-3px);}}
        .flutter{animation:flutter 5s ease-in-out infinite;}

        .pin-red{
            position:absolute;top:-10px;left:50%;transform:translateX(-50%);
            width:22px;height:22px;border-radius:50%;
            background:radial-gradient(circle at 35% 30%,#FCA5A5,#DC2626 65%,#7F1D1D 100%);
            box-shadow:0 4px 8px rgba(0,0,0,.35),inset -3px -3px 5px rgba(0,0,0,.3);
            z-index:3;
        }

        .scribble{position:absolute;pointer-events:none;opacity:.65;}

        .img-circulo{clip-path:circle(50% at 50% 50%);}
        .img-cuadrado{clip-path:inset(0 round 4px);}
        .img-corazon{clip-path:path('M50,88 C20,66 4,46 4,28 C4,12 16,2 30,2 C40,2 47,8 50,18 C53,8 60,2 70,2 C84,2 96,12 96,28 C96,46 80,66 50,88 Z');}
        .img-hexagono{clip-path:polygon(25% 5%,75% 5%,98% 50%,75% 95%,25% 95%,2% 50%);}
        .marco-clasico{border:6px solid #fff;box-shadow:0 0 0 2px #1F2937,0 6px 14px rgba(0,0,0,.25);}
        .marco-vintage{filter:sepia(.3);border:6px solid #92400E;}
        .marco-moderno{border:4px solid #7DD3FC;box-shadow:0 6px 16px rgba(0,0,0,.2);}
        .marco-ninguno{box-shadow:0 4px 12px rgba(0,0,0,.2);}
    </style>
</head>
<body class="cork-bg" x-data="{loaded:false}" x-init="setTimeout(()=>{loaded=true;window.dispatchEvent(new CustomEvent('tpl-carta-abierta'))},1200)">
    @include('mensajes.partials.efectos', ['tema' => 'hearts'])

    <main class="relative max-w-5xl mx-auto px-4 py-6 sm:py-10 min-h-screen">
        {{-- Garabatos SVG decorativos --}}
        <svg class="scribble" style="top:6%;right:8%;width:120px;height:60px;" viewBox="0 0 120 60" aria-hidden="true">
            <path d="M5,30 Q20,5 40,30 T80,30 T115,30" stroke="#DC2626" stroke-width="3" fill="none" stroke-linecap="round"/>
        </svg>
        <svg class="scribble" style="bottom:14%;left:5%;width:110px;height:80px;" viewBox="0 0 110 80" aria-hidden="true">
            <path d="M55,72 C55,55 35,40 35,25 C35,15 45,8 55,18 C65,8 75,15 75,25 C75,40 55,55 55,72 Z" stroke="#DC2626" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg class="scribble" style="top:38%;left:3%;width:60px;height:60px;" viewBox="0 0 60 60" aria-hidden="true">
            <path d="M10,30 L50,30 M30,10 L30,50" stroke="#1F2937" stroke-width="3" stroke-linecap="round"/>
            <circle cx="30" cy="30" r="22" stroke="#1F2937" stroke-width="2" fill="none" stroke-dasharray="4 4"/>
        </svg>
        <svg class="scribble" style="top:50%;right:4%;width:70px;height:70px;" viewBox="0 0 70 70" aria-hidden="true">
            <path d="M10,35 Q35,5 60,35 Q35,65 10,35 Z" stroke="#7DD3FC" stroke-width="3" fill="none"/>
            <circle cx="35" cy="35" r="6" fill="#7DD3FC"/>
        </svg>

        {{-- Post-its decorativos --}}
        <div class="absolute top-[5%] left-[6%] post-it caveat text-2xl text-[#1F2937] flutter drop" style="--r:-8deg;animation-delay:.2s,1.5s;width:120px;text-align:center;">te pienso 💭</div>
        <div class="absolute top-[10%] right-[18%] post-it green caveat text-3xl text-[#1F2937] flutter drop" style="--r:5deg;animation-delay:.35s,2s;width:90px;text-align:center;">💕</div>
        <div class="absolute top-[40%] right-[6%] post-it blue caveat text-2xl text-[#1F2937] flutter drop hidden sm:block" style="--r:-4deg;animation-delay:.5s,1.7s;width:110px;text-align:center;">eres lo<br>mejor</div>
        <div class="absolute bottom-[18%] left-[8%] post-it peach caveat text-3xl text-[#1F2937] flutter drop hidden sm:block" style="--r:6deg;animation-delay:.65s,1.9s;width:80px;text-align:center;">♡</div>
        <div class="absolute bottom-[8%] right-[10%] post-it pink caveat text-2xl text-[#1F2937] flutter drop" style="--r:-3deg;animation-delay:.8s,2.2s;width:130px;text-align:center;">solo<br>porque sí ✨</div>
        <div class="absolute top-[28%] left-[12%] post-it green caveat text-2xl text-[#1F2937] flutter drop hidden md:block" style="--r:4deg;animation-delay:.95s,1.6s;width:100px;text-align:center;">smile :)</div>
        <div class="absolute top-[60%] left-[18%] post-it blue caveat text-2xl text-[#1F2937] flutter drop hidden md:block" style="--r:-5deg;animation-delay:1.1s,1.8s;width:95px;text-align:center;">📌 read me</div>

        <header class="text-center mb-6 relative z-10 drop" style="--r:0deg;animation-delay:.05s;">
            <p class="patrick text-lg text-white/90 tracking-wider uppercase">Tablero · {{ $mensaje->ocasion->emoji ?? '💌' }} {{ $mensaje->ocasion->nombre }}</p>
            <h1 class="caveat text-5xl sm:text-7xl text-white drop-shadow-md mt-1">¡Hola, {{ $mensaje->destinatario }}!</h1>
        </header>

        {{-- Post-it principal con el mensaje --}}
        <article class="relative max-w-xl mx-auto mt-12 drop flutter" style="--r:-2deg;animation-delay:.4s,2.5s;">
            <span class="pin-red" aria-hidden="true"></span>
            <div class="post-it w-full p-8 sm:p-12" style="display:block;">
                @if($mensaje->imagen_path)
                    <figure class="flex justify-center mb-5">
                        <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                             alt="Imagen para {{ $mensaje->destinatario }}"
                             class="w-36 h-36 sm:w-44 sm:h-44 object-contain bg-white img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'clasico' }}">
                    </figure>
                @endif

                <p class="patrick text-xl text-[#1F2937] mb-2 text-center">Pequeña nota:</p>
                <div class="caveat text-3xl sm:text-4xl text-[#1F2937] leading-snug text-center">
                    {!! $mensaje->mensaje !!}
                </div>

                <div class="mt-6 text-right">
                    <p class="caveat text-3xl text-[#DC2626]">— {{ $mensaje->remitente }}</p>
                    <p class="patrick text-sm text-[#1F2937]/60 mt-1">{{ $mensaje->created_at->format('d/m/Y') }}</p>
                </div>

                {{-- subraya con marker --}}
                <svg class="absolute -bottom-2 left-8 right-8" height="10" viewBox="0 0 400 10" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M2,5 Q100,1 200,5 T398,5" stroke="#DC2626" stroke-width="3" fill="none" stroke-linecap="round" opacity=".4"/>
                </svg>
            </div>
        </article>

        {{-- Código y compartir --}}
        <section class="relative max-w-sm mx-auto mt-16 post-it blue p-6 drop flutter" style="--r:1deg;animation-delay:1.3s,2s;display:block;text-align:center;" x-data="{copied:false}">
            <span class="pin-red" aria-hidden="true"></span>
            <p class="patrick text-base text-[#1F2937] tracking-wide uppercase mb-1">Tu código</p>
            <p class="caveat text-3xl font-bold text-[#1F2937] mb-3 tracking-widest">{{ $mensaje->code }}</p>
            <button @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,2200)"
                    class="bg-[#1F2937] hover:bg-[#DC2626] text-white patrick text-lg px-5 py-2 rounded-sm transition-all hover:scale-105 active:scale-95">
                <span x-show="!copied">📋 Copiar enlace</span>
                <span x-show="copied" x-cloak>✓ ¡Copiado!</span>
            </button>
        </section>

        <footer class="mt-12 text-center caveat text-2xl text-white/90 drop-shadow">
            <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#DC2626'])
</body>
</html>
