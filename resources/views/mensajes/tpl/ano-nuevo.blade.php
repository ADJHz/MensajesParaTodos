<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje de Año Nuevo para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Año Nuevo' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#0A0A1F">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @php
        $formas = [
            'ninguna'=>'','cuadrado'=>'border-radius:8px;','circulo'=>'border-radius:50%;',
            'corazon'=>'clip-path:url(#cp-heart);','estrella'=>'clip-path:url(#cp-star);',
            'hexagono'=>'clip-path:url(#cp-hexagon);','diamante'=>'clip-path:url(#cp-diamond);',
        ];
        $marcos = [
            'ninguno'=>'','dorado'=>'filter:drop-shadow(0 0 14px #FFD700) drop-shadow(0 0 28px rgba(255,215,0,.6));',
            'rosa'=>'filter:drop-shadow(0 0 12px #E91E8C);','sombra'=>'filter:drop-shadow(4px 8px 18px rgba(0,0,0,.7));',
            'morado'=>'filter:drop-shadow(0 0 12px #C0C0C0);','verde'=>'filter:drop-shadow(0 0 12px #FFD700);',
            'blanco'=>'filter:drop-shadow(0 0 14px #fff);',
        ];
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';
    @endphp
    <style>
        :root { --noche:#0A0A1F; --dorado:#FFD700; --plata:#C0C0C0; --magenta:#E91E8C; }
        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(ellipse at top, #1a1a3a 0%, #0A0A1F 50%, #050510 100%);
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: .05em; }

        /* Fuegos artificiales */
        @keyframes firework {
            0%   { transform: scale(0); opacity: 1; box-shadow: 0 0 0 0 currentColor; }
            70%  { opacity: 1; }
            100% { transform: scale(1); opacity: 0;
                box-shadow:
                    60px -60px 0 -3px currentColor, -60px -60px 0 -3px currentColor,
                    60px 60px 0 -3px currentColor, -60px 60px 0 -3px currentColor,
                    80px 0 0 -3px currentColor, -80px 0 0 -3px currentColor,
                    0 80px 0 -3px currentColor, 0 -80px 0 -3px currentColor,
                    50px -30px 0 -3px currentColor, -50px 30px 0 -3px currentColor,
                    -50px -30px 0 -3px currentColor, 50px 30px 0 -3px currentColor; }
        }
        .firework {
            position:absolute; width:6px; height:6px; border-radius:50%;
            background: currentColor;
            animation: firework 2.5s ease-out infinite;
            pointer-events:none;
        }

        /* Confeti dorado/plateado */
        @keyframes confeti-fall { 0%{transform:translateY(-50px) rotate(0);opacity:0;} 10%{opacity:1;} 100%{transform:translateY(110vh) rotate(720deg);opacity:.7;} }
        .confeti { position:fixed; top:-50px; width:8px; height:14px; pointer-events:none; z-index:1; animation: confeti-fall linear infinite; }

        /* Brillos */
        @keyframes sparkle { 0%,100%{opacity:0;transform:scale(.5);} 50%{opacity:1;transform:scale(1.2);} }
        .sparkle { animation: sparkle 1.8s ease-in-out infinite; }

        /* "12345" countdown background */
        .bg-numbers {
            position: absolute; inset:0; display:flex; align-items:center; justify-content:center;
            font-family: 'Bebas Neue', sans-serif; font-size: 30vw; color: rgba(255,215,0,.04);
            pointer-events:none; user-select:none; overflow:hidden;
            letter-spacing: .15em;
        }

        /* Reloj/medallón */
        .reloj {
            width: 280px; height: 280px; border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #2a2a4a, #0A0A1F);
            border: 8px solid;
            border-image: linear-gradient(135deg, #FFD700, #C0C0C0, #FFD700) 1;
            border-image-slice: 1;
            box-shadow: 0 0 60px rgba(255,215,0,.3), inset 0 0 30px rgba(0,0,0,.6);
            position: relative;
            margin: 0 auto;
            cursor: pointer;
        }
        .reloj-marca {
            position:absolute; left:50%; top:8px;
            width:3px; height:14px; background:#FFD700;
            transform-origin: 50% 132px;
        }
        .manecilla {
            position:absolute; left:50%; top:50%; transform-origin: 0 0;
            background: #FFD700; border-radius: 4px;
        }

        /* Tarjeta */
        .tarjeta-glass {
            background: linear-gradient(135deg, rgba(255,215,0,.08), rgba(233,30,140,.06));
            backdrop-filter: blur(20px);
            border: 2px solid;
            border-image: linear-gradient(135deg, #FFD700, #E91E8C) 1;
            box-shadow: 0 30px 80px rgba(0,0,0,.6), 0 0 60px rgba(255,215,0,.15);
        }

        @keyframes count-pop {
            0% { opacity:0; transform: scale(.3); }
            30% { opacity:1; transform: scale(1.4); }
            70% { opacity:1; transform: scale(1); }
            100% { opacity:0; transform: scale(.6); }
        }
        .count-pop { animation: count-pop 1s ease-out both; }

        @keyframes reveal-card { from{opacity:0; transform:scale(.5) translateY(50px);} to{opacity:1; transform:scale(1) translateY(0);} }
        .reveal { animation: reveal-card 1s cubic-bezier(.34,1.56,.64,1) both; }

        @keyframes glow-pulse { 0%,100%{filter:drop-shadow(0 0 8px #FFD700);} 50%{filter:drop-shadow(0 0 24px #FFD700);} }
        .glow { animation: glow-pulse 2s ease-in-out infinite; }

        .img-shape { width: 180px; height: 180px; object-fit: contain; background:#fff; }

        @keyframes clink {
            0%,100% { transform: rotate(0); }
            25% { transform: rotate(-15deg); }
            75% { transform: rotate(15deg); }
        }
        .clink-l { animation: clink 2s ease-in-out infinite; transform-origin: bottom right; }
        .clink-r { animation: clink 2s ease-in-out infinite reverse; transform-origin: bottom left; }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'ano-nuevo'])

    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>
        </defs>
    </svg>

    {{-- Background "12345" --}}
    <div class="bg-numbers" aria-hidden="true">12345</div>

    {{-- Fuegos artificiales --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        <span class="firework" style="left:15%;top:20%;color:#FFD700;animation-delay:0s;"></span>
        <span class="firework" style="left:80%;top:15%;color:#E91E8C;animation-delay:.7s;"></span>
        <span class="firework" style="left:25%;top:60%;color:#C0C0C0;animation-delay:1.4s;"></span>
        <span class="firework" style="left:70%;top:55%;color:#FFD700;animation-delay:2.1s;"></span>
        <span class="firework" style="left:50%;top:30%;color:#E91E8C;animation-delay:1.0s;"></span>
        <span class="firework" style="left:10%;top:75%;color:#FFD700;animation-delay:1.8s;"></span>
        <span class="firework" style="left:90%;top:80%;color:#C0C0C0;animation-delay:.4s;"></span>

        {{-- Sparkles --}}
        <span class="sparkle absolute" style="top:10%;left:30%;color:#FFD700;font-size:18px;">✦</span>
        <span class="sparkle absolute" style="top:25%;left:65%;color:#fff;font-size:14px;animation-delay:.6s;">✧</span>
        <span class="sparkle absolute" style="top:50%;left:15%;color:#E91E8C;font-size:16px;animation-delay:1.2s;">✦</span>
        <span class="sparkle absolute" style="top:70%;left:80%;color:#FFD700;font-size:20px;animation-delay:.3s;">✧</span>
        <span class="sparkle absolute" style="top:40%;left:50%;color:#fff;font-size:12px;animation-delay:.9s;">✦</span>
    </div>

    {{-- Confeti --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        @php $cConf=['#FFD700','#C0C0C0','#FFD700','#E91E8C','#FFD700','#C0C0C0']; @endphp
        @foreach(range(0,16) as $i)
        <span class="confeti" style="left:{{ ($i*6+2) % 100 }}%;background:{{ $cConf[$i % count($cConf)] }};animation-duration:{{ 5 + ($i % 4) }}s;animation-delay:{{ $i * .35 }}s;border-radius:{{ $i%3==0 ? '50%' : '1px' }};"></span>
        @endforeach
    </div>

    <div x-data="{
            etapa: 'reloj', count: null,
            iniciarCountdown() {
                this.etapa = 'count';
                const seq = [3,2,1,'¡FELIZ AÑO!'];
                let i = 0;
                const tick = () => {
                    if (i >= seq.length) {
                        this.etapa = 'mensaje';
                        window.fxCelebrar?.('fuegos');
                        window.dispatchEvent(new CustomEvent('tpl-carta-abierta'));
                        return;
                    }
                    this.count = seq[i++];
                    setTimeout(tick, 1000);
                };
                tick();
            },
            copiado: false,
            copiarLink() { navigator.clipboard.writeText(window.location.href).then(()=>{ this.copiado=true; setTimeout(()=>this.copiado=false,2000); }); }
         }"
         class="relative z-10 max-w-3xl mx-auto px-4 py-12">

        {{-- Header --}}
        <header class="text-center mb-8">
            <p class="font-bebas text-base tracking-[.4em]" style="color:#C0C0C0;">— BIENVENID@ {{ date('Y') }} —</p>
            <h1 class="font-bebas text-5xl sm:text-7xl mt-2" style="background: linear-gradient(135deg,#FFD700 0%,#E91E8C 50%,#C0C0C0 100%); -webkit-background-clip:text; background-clip:text; color:transparent;">
                {{ $mensaje->ocasion->nombre ?? 'AÑO NUEVO' }}
            </h1>
            <p class="text-sm mt-2 text-gray-400">{{ $mensaje->ocasion->emoji ?? '🎆' }} Una nueva historia comienza</p>
        </header>

        {{-- Reloj inicial --}}
        <section x-show="etapa === 'reloj'" class="my-12">
            <button @click="iniciarCountdown()" class="block mx-auto reloj glow" aria-label="Iniciar countdown de Año Nuevo">
                {{-- 12 marcas --}}
                @for($k=0;$k<12;$k++)
                <div class="reloj-marca" style="transform: translateX(-50%) rotate({{ $k * 30 }}deg);"></div>
                @endfor
                {{-- Manecillas marcando 12:00 --}}
                <div class="manecilla" style="width:4px; height:90px; transform: translate(-50%, -100%) rotate(0deg);"></div>
                <div class="manecilla" style="width:4px; height:70px; transform: translate(-50%, -100%) rotate(0deg); background:#C0C0C0;"></div>
                <div style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:14px;height:14px;border-radius:50%;background:#FFD700;box-shadow:0 0 8px #FFD700;"></div>
                {{-- "12:00" --}}
                <div style="position:absolute;left:50%;top:65%;transform:translateX(-50%);">
                    <span class="font-bebas text-3xl" style="color:#FFD700; text-shadow: 0 0 12px rgba(255,215,0,.8);">12:00</span>
                </div>
            </button>
            <p class="text-center mt-8 font-bebas text-2xl tracking-[.2em]" style="color:#FFD700;">
                ◆ TOCA EL RELOJ ◆
            </p>
            <p class="text-center text-sm text-gray-400 mt-2">Comienza la cuenta regresiva</p>
        </section>

        {{-- Countdown --}}
        <section x-show="etapa === 'count'" class="my-20 text-center" x-cloak>
            <div :key="count" class="count-pop font-bebas text-[180px] sm:text-[240px] leading-none" style="color:#FFD700; text-shadow: 0 0 40px rgba(255,215,0,.8), 0 0 80px rgba(233,30,140,.4);">
                <span x-text="count"></span>
            </div>
        </section>

        {{-- Tarjeta mensaje --}}
        <article x-show="etapa === 'mensaje'" class="tarjeta-glass rounded-3xl p-8 sm:p-12 reveal" x-cloak>

            {{-- Copas brindando --}}
            <div class="flex justify-center gap-2 mb-6" aria-hidden="true">
                <svg class="clink-l" width="50" height="70" viewBox="0 0 50 70">
                    <path d="M10 5 L40 5 L35 30 Q35 40 25 40 Q15 40 15 30 Z" fill="rgba(255,215,0,.3)" stroke="#FFD700" stroke-width="1.5"/>
                    <line x1="25" y1="40" x2="25" y2="60" stroke="#FFD700" stroke-width="1.5"/>
                    <ellipse cx="25" cy="62" rx="12" ry="3" fill="#FFD700"/>
                    <circle cx="22" cy="20" r="2" fill="#FFD700" opacity=".7"/>
                    <circle cx="30" cy="25" r="1.5" fill="#FFD700" opacity=".7"/>
                </svg>
                <svg class="clink-r" width="50" height="70" viewBox="0 0 50 70">
                    <path d="M10 5 L40 5 L35 30 Q35 40 25 40 Q15 40 15 30 Z" fill="rgba(192,192,192,.3)" stroke="#C0C0C0" stroke-width="1.5"/>
                    <line x1="25" y1="40" x2="25" y2="60" stroke="#C0C0C0" stroke-width="1.5"/>
                    <ellipse cx="25" cy="62" rx="12" ry="3" fill="#C0C0C0"/>
                    <circle cx="22" cy="20" r="2" fill="#C0C0C0" opacity=".7"/>
                    <circle cx="30" cy="25" r="1.5" fill="#C0C0C0" opacity=".7"/>
                </svg>
            </div>

            <h2 class="font-bebas text-4xl sm:text-6xl text-center" style="background: linear-gradient(135deg,#FFD700,#E91E8C); -webkit-background-clip:text; background-clip:text; color:transparent;">
                ¡FELIZ AÑO NUEVO,
            </h2>
            <h2 class="font-bebas text-5xl sm:text-7xl text-center mt-1 mb-6" style="color:#FFD700; text-shadow: 0 0 20px rgba(255,215,0,.5);">
                {{ strtoupper($mensaje->destinatario) }}!
            </h2>

            {{-- Imagen --}}
            @if($mensaje->imagen_path)
            <div class="flex justify-center my-6">
                <div style="background: linear-gradient(135deg,#FFD700,#E91E8C); padding:5px; border-radius:14px;">
                    <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                         alt="Foto de {{ $mensaje->destinatario }}"
                         class="img-shape" style="{{ $eForma }} {{ $eMarco }}">
                </div>
            </div>
            @endif

            <div class="prose prose-invert max-w-none my-8 text-gray-100 leading-relaxed text-lg" style="font-family:'Poppins',sans-serif;">
                {!! $mensaje->mensaje !!}
            </div>

            <div class="text-right mt-8 border-t pt-4" style="border-color: rgba(255,215,0,.3);">
                <p class="text-sm" style="color:#C0C0C0;">Brindemos por más momentos juntos,</p>
                <p class="font-bebas text-3xl mt-1" style="color:#FFD700;">{{ $mensaje->remitente }}</p>
            </div>
        </article>

        {{-- Code + compartir --}}
        <section x-show="etapa === 'mensaje'" class="tarjeta-glass rounded-2xl p-6 mt-8 text-center" x-cloak>
            <p class="font-bebas text-sm tracking-[.3em] mb-2" style="color:#C0C0C0;">CÓDIGO DE TU MENSAJE</p>
            <p class="font-bebas text-4xl mb-4" style="color:#FFD700; letter-spacing:.2em; text-shadow: 0 0 12px rgba(255,215,0,.5);">{{ $mensaje->code }}</p>
            <button @click="copiarLink()"
                    class="font-bebas text-lg tracking-[.2em] px-8 py-3 rounded-full transition-all hover:scale-105 active:scale-95"
                    style="background: linear-gradient(135deg,#FFD700,#E91E8C); color:#0A0A1F; box-shadow: 0 0 25px rgba(255,215,0,.5);">
                <span x-show="!copiado">✦ COPIAR ENLACE ✦</span>
                <span x-show="copiado">✓ COPIADO</span>
            </button>
        </section>

        <footer class="text-center mt-12 font-bebas tracking-[.3em] text-sm" style="color:#C0C0C0;">
            <p>★ {{ strtoupper(config('app.name')) }} &copy; {{ date('Y') }} ★</p>
        </footer>
    </div>

    @include('mensajes.partials.music-player', ['accent' => '#FFD700'])
</body>
</html>
