<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#0F0F1A">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body{font-family:'VT323',monospace;background:#0F0F1A;color:#22D3EE;min-height:100vh;overflow-x:hidden;}
        .arcade-bg{
            background:
                radial-gradient(ellipse at top, rgba(168,85,247,.18), transparent 60%),
                radial-gradient(ellipse at bottom, rgba(34,211,238,.12), transparent 55%),
                #0F0F1A;
            position:relative;
        }
        .arcade-bg::before{
            content:'';position:fixed;inset:0;
            background-image:
                linear-gradient(rgba(168,85,247,.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168,85,247,.08) 1px, transparent 1px);
            background-size:32px 32px;
            pointer-events:none;
            z-index:0;
        }
        .scanlines::after{
            content:'';position:fixed;inset:0;pointer-events:none;z-index:9999;
            background:repeating-linear-gradient(to bottom, rgba(0,0,0,.18) 0 1px, transparent 1px 3px);
            mix-blend-mode:overlay;
        }
        .pixel-font{font-family:'Press Start 2P',monospace;}
        .term-font{font-family:'VT323',monospace;}
        .neon-purple{color:#A855F7;text-shadow:0 0 8px rgba(168,85,247,.8),0 0 22px rgba(168,85,247,.5);}
        .neon-cyan{color:#22D3EE;text-shadow:0 0 8px rgba(34,211,238,.8),0 0 22px rgba(34,211,238,.5);}
        .neon-lime{color:#84CC16;text-shadow:0 0 8px rgba(132,204,22,.8);}
        .panel{
            background:rgba(15,15,26,.85);
            border:3px solid #A855F7;
            box-shadow:0 0 0 2px #0F0F1A,0 0 30px rgba(168,85,247,.5),inset 0 0 30px rgba(168,85,247,.15);
            backdrop-filter:blur(6px);
        }
        .pixel-btn{
            background:#84CC16;color:#0F0F1A;
            font-family:'Press Start 2P',monospace;
            padding:18px 28px;border:none;cursor:pointer;
            box-shadow:0 6px 0 #4D7C0F,0 8px 20px rgba(132,204,22,.5);
            transition:all .15s;
            image-rendering:pixelated;
        }
        .pixel-btn:hover{transform:translateY(2px);box-shadow:0 4px 0 #4D7C0F,0 6px 14px rgba(132,204,22,.6);}
        .pixel-btn:active{transform:translateY(6px);box-shadow:0 0 0 #4D7C0F;}
        @keyframes blink{50%{opacity:.3;}}
        .blink{animation:blink 1.1s steps(2) infinite;}
        @keyframes float-pixel{0%{transform:translateY(100vh) rotate(0);opacity:0;}10%{opacity:1;}90%{opacity:1;}100%{transform:translateY(-10vh) rotate(360deg);opacity:0;}}
        .pix{position:fixed;width:10px;height:10px;pointer-events:none;z-index:1;animation:float-pixel linear infinite;image-rendering:pixelated;}
        @keyframes scan-line{0%{transform:translateX(-100%);}100%{transform:translateX(100%);}}
        .energy-bar{height:18px;background:#1F1F2E;border:2px solid #22D3EE;position:relative;overflow:hidden;}
        .energy-bar > span{display:block;height:100%;background:linear-gradient(90deg,#84CC16,#22D3EE);box-shadow:0 0 12px #22D3EE;}
        .energy-bar::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,.5),transparent);animation:scan-line 2.4s linear infinite;}
        @keyframes mission-glow{0%,100%{box-shadow:0 0 0 2px #0F0F1A,0 0 30px rgba(132,204,22,.7),inset 0 0 30px rgba(132,204,22,.2);}50%{box-shadow:0 0 0 2px #0F0F1A,0 0 60px rgba(132,204,22,.9),inset 0 0 50px rgba(132,204,22,.3);}}
        .mission-panel{border-color:#84CC16;animation:mission-glow 2.2s ease-in-out infinite;}
        .img-circulo{clip-path:circle(50% at 50% 50%);}
        .img-cuadrado{clip-path:inset(0);}
        .img-corazon{clip-path:path('M50,88 C20,66 4,46 4,28 C4,12 16,2 30,2 C40,2 47,8 50,18 C53,8 60,2 70,2 C84,2 96,12 96,28 C96,46 80,66 50,88 Z');}
        .img-hexagono{clip-path:polygon(25% 5%,75% 5%,98% 50%,75% 95%,25% 95%,2% 50%);}
        .marco-clasico{border:4px solid #A855F7;box-shadow:0 0 20px rgba(168,85,247,.6);}
        .marco-vintage{filter:saturate(.7) hue-rotate(-15deg);border:4px solid #84CC16;}
        .marco-moderno{border:4px solid #22D3EE;box-shadow:0 0 24px rgba(34,211,238,.7);}
        .marco-ninguno{}
        [x-cloak]{display:none!important;}
    </style>
</head>
<body class="arcade-bg scanlines" x-data="{started:false,energy:0,start(){this.started=true;let t=setInterval(()=>{this.energy+=4;if(this.energy>=100){this.energy=100;clearInterval(t);window.fxCelebrar?.('cumple');window.dispatchEvent(new CustomEvent('tpl-carta-abierta'));}},22);}}">
    @include('mensajes.partials.efectos', ['tema' => 'hermano'])

    {{-- pixels flotantes --}}
    @for($i=0;$i<14;$i++)
        <span class="pix" style="left:{{ random_int(2,98) }}%;background:{{ ['#A855F7','#22D3EE','#84CC16'][random_int(0,2)] }};animation-delay:{{ random_int(0,8) }}s;animation-duration:{{ random_int(8,16) }}s;" aria-hidden="true"></span>
    @endfor

    <main class="relative z-10 max-w-4xl mx-auto px-4 py-6 sm:py-10">
        {{-- HUD top --}}
        <header class="flex justify-between items-center mb-10 pixel-font text-[10px] sm:text-xs">
            <div>
                <p class="neon-cyan">PLAYER 1</p>
                <p class="neon-lime mt-2">{{ strtoupper($mensaje->remitente) }}</p>
            </div>
            <div class="text-right">
                <p class="neon-purple">LVL {{ now()->diffInYears($mensaje->created_at) + 1 }}</p>
                <p class="neon-cyan mt-2">{{ $mensaje->ocasion->emoji ?? '🎮' }} {{ strtoupper($mensaje->ocasion->nombre) }}</p>
            </div>
        </header>

        {{-- Pantalla principal --}}
        <section class="panel p-6 sm:p-10 rounded-sm">
            <div class="text-center mb-8">
                <p class="pixel-font text-[10px] sm:text-xs neon-cyan mb-4 blink">★ INCOMING TRANSMISSION ★</p>
                <h1 class="pixel-font text-2xl sm:text-4xl neon-purple leading-tight">HAPPY<br><span class="neon-lime">BIRTHDAY</span></h1>
                <p class="text-4xl sm:text-6xl mt-4 term-font neon-cyan">&gt; {{ strtoupper($mensaje->destinatario) }}_<span class="blink">|</span></p>
            </div>

            {{-- Stats --}}
            <div class="space-y-3 mb-8 max-w-md mx-auto">
                <div>
                    <div class="flex justify-between text-xs pixel-font mb-1"><span class="neon-cyan">EPICNESS</span><span class="neon-lime">100%</span></div>
                    <div class="energy-bar"><span style="width:100%"></span></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs pixel-font mb-1"><span class="neon-cyan">COOLNESS</span><span class="neon-lime">99%</span></div>
                    <div class="energy-bar"><span style="width:99%"></span></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs pixel-font mb-1"><span class="neon-cyan">BRO STATS</span><span class="neon-lime">MAX</span></div>
                    <div class="energy-bar"><span style="width:100%"></span></div>
                </div>
            </div>

            {{-- Botón --}}
            <div class="text-center" x-show="!started">
                <button @click="start()" class="pixel-btn text-xs sm:text-sm">▶ PRESS START</button>
                <p class="pixel-font text-[10px] neon-cyan mt-4 blink">INSERT COIN TO CONTINUE</p>
            </div>

            {{-- Loading --}}
            <div class="text-center" x-show="started && energy < 100" x-cloak>
                <p class="pixel-font text-xs neon-lime mb-3">LOADING MISSION...</p>
                <div class="energy-bar max-w-sm mx-auto"><span :style="`width:${energy}%`"></span></div>
                <p class="pixel-font text-[10px] neon-cyan mt-2" x-text="energy + '%'"></p>
            </div>
        </section>

        {{-- Misión completa --}}
        <article class="panel mission-panel mt-10 p-6 sm:p-10 rounded-sm" x-show="energy >= 100" x-cloak
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100">
            <p class="pixel-font text-xs sm:text-sm text-center neon-lime mb-6 blink">★ MISSION COMPLETE ★</p>

            @if($mensaje->imagen_path)
                <figure class="flex justify-center mb-6">
                    <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                         alt="Imagen para {{ $mensaje->destinatario }}"
                             class="w-44 h-44 sm:w-52 sm:h-52 object-contain bg-white img-{{ $mensaje->imagen_forma ?? 'cuadrado' }} marco-{{ $mensaje->imagen_marco ?? 'moderno' }}"
                         style="image-rendering:pixelated;">
                </figure>
            @endif

            <div class="term-font text-xl sm:text-2xl text-[#E0E0FF] leading-relaxed text-center max-w-2xl mx-auto">
                <span class="neon-cyan">&gt; </span>{!! $mensaje->mensaje !!}
            </div>

            <div class="mt-8 pt-6 border-t-2 border-dashed border-[#A855F7]/40 text-center">
                <p class="pixel-font text-[10px] neon-purple">SIGNED BY</p>
                <p class="term-font text-3xl neon-lime mt-2">{{ $mensaje->remitente }}</p>
                <p class="pixel-font text-[8px] text-[#22D3EE]/70 mt-3">{{ $mensaje->created_at->format('Y.m.d') }}</p>
            </div>
        </article>

        {{-- Código --}}
        <section class="panel mt-10 p-6 rounded-sm text-center max-w-md mx-auto" x-data="{copied:false}">
            <p class="pixel-font text-[10px] neon-cyan mb-3">★ ACCESS CODE ★</p>
            <p class="pixel-font text-lg neon-lime mb-5 tracking-widest">{{ $mensaje->code }}</p>
            <button @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,2200)"
                    class="pixel-btn text-[10px]">
                <span x-show="!copied">[ COPY LINK ]</span>
                <span x-show="copied" x-cloak>[ COPIED! ]</span>
            </button>
        </section>

        <footer class="mt-12 text-center pixel-font text-[8px] neon-purple">
            <p>{{ strtoupper(config('app.name')) }} &copy; {{ date('Y') }}</p>
            <p class="mt-2 neon-cyan blink">&lt;/GAME OVER&gt;</p>
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#A855F7'])
</body>
</html>
