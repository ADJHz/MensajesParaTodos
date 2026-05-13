<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje especial para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} - {{ $mensaje->ocasion->nombre ?? 'Mensaje para Nino' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#2563EB">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        $formas = [
            'ninguna'=>'','cuadrado'=>'border-radius:18px;','circulo'=>'border-radius:50%;',
            'corazon'=>'clip-path:url(#cp-heart);','estrella'=>'clip-path:url(#cp-star);',
            'hexagono'=>'clip-path:url(#cp-hexagon);','diamante'=>'clip-path:url(#cp-diamond);',
        ];
        $marcos = [
            'ninguno'=>'','dorado'=>'filter:drop-shadow(0 0 10px #FCD34D);','rosa'=>'filter:drop-shadow(0 0 10px #F472B6);',
            'sombra'=>'filter:drop-shadow(4px 8px 18px rgba(0,0,0,.35));','morado'=>'filter:drop-shadow(0 0 10px #A78BFA);',
            'verde'=>'filter:drop-shadow(0 0 10px #4ADE80);','blanco'=>'filter:drop-shadow(0 0 10px #fff);',
        ];

        $template = $mensaje->template ?? 'peques-heroe-amigo';
        $narradores = [
            'peques-heroe-amigo' => ['nombre' => 'Arana Heroica', 'icono' => '🕷️', 'frase' => 'Hola, yo entrego este mensaje super especial para ti.'],
            'peques-capitan-valiente' => ['nombre' => 'Capitan Valiente', 'icono' => '🛡️', 'frase' => 'Atencion equipo: este mensaje viene con mucho amor.'],
            'peques-tecno-armadura' => ['nombre' => 'Tecno Armadura', 'icono' => '🤖', 'frase' => 'Sistema listo: activando lectura de mensaje emocionante.'],
        ];

        $narrador = $narradores[$template] ?? null;
        $esAutos = $template === 'peques-pista-veloz';
        $textoPlano = trim(strip_tags($mensaje->mensaje ?? ''));
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';
    @endphp
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: radial-gradient(circle at 15% 10%, #bfdbfe 0, transparent 35%),
                        radial-gradient(circle at 85% 90%, #fde68a 0, transparent 35%),
                        linear-gradient(180deg, #eff6ff 0%, #dbeafe 55%, #fee2e2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        .font-hero { font-family: 'Bangers', cursive; letter-spacing: 1px; }
        .comic-box { border: 4px solid #0f172a; border-radius: 22px; box-shadow: 8px 8px 0 #0f172a; background: #fff; }
        .hero-burst { background: conic-gradient(from 0deg, #fef08a, #fca5a5, #93c5fd, #fef08a); }
        .dot-road {
            background-image: repeating-linear-gradient(90deg, #111827 0 24px, transparent 24px 42px);
            height: 10px;
            border-radius: 999px;
            opacity: .35;
        }
        .speech {
            position: relative;
            background: #ffffff;
            border: 3px solid #0f172a;
            border-radius: 20px;
            box-shadow: 6px 6px 0 #0f172a;
            padding: 1rem 1.1rem;
        }
        .speech:after {
            content: '';
            position: absolute;
            left: 22px;
            bottom: -15px;
            border-width: 14px 12px 0 12px;
            border-style: solid;
            border-color: #0f172a transparent transparent transparent;
        }
        .speech:before {
            content: '';
            position: absolute;
            left: 24px;
            bottom: -10px;
            border-width: 11px 10px 0 10px;
            border-style: solid;
            border-color: #ffffff transparent transparent transparent;
            z-index: 1;
        }
        @keyframes floaty { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
        .floaty { animation: floaty 3.2s ease-in-out infinite; }
    </style>
</head>
<body>
    @php $temaFx = ($template ?? '') === 'peques-pista-veloz' ? 'autos' : 'superheroe'; @endphp
    @include('mensajes.partials.efectos', ['tema' => $temaFx])
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>
        </defs>
    </svg>

    <main x-data="{
            abierto: false,
            copiado: false,
            copiando:false,
            copiar(){
                navigator.clipboard.writeText(window.location.href).then(() => {
                    this.copiado = true;
                    setTimeout(() => this.copiado = false, 1800);
                });
            }
        }"
          class="max-w-3xl mx-auto px-4 py-6 sm:py-10 relative z-10">

        <header class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-bold text-sm border border-blue-200">
                <span>{{ $mensaje->ocasion->emoji ?? '🕷️' }}</span>
                <span>{{ $mensaje->ocasion->nombre ?? 'Mensaje para Nino' }}</span>
            </div>
            <h1 class="font-hero text-5xl sm:text-6xl text-blue-700 mt-4 drop-shadow">{{ $mensaje->destinatario }}</h1>
            <p class="text-gray-600 mt-1">Hoy recibes un mensaje epico.</p>
        </header>

        <section class="comic-box p-5 sm:p-8 hero-burst mb-6">
            <div class="comic-box bg-white p-5 sm:p-7">
                @if($narrador)
                    <div class="grid sm:grid-cols-[auto_1fr] gap-4 items-start mb-6">
                        <div class="flex justify-center">
                            @include('mensajes.partials.personaje', ['tema' => $temaFx === 'autos' ? 'autos' : 'superheroe', 'tamano' => 'lg'])
                        </div>
                        <div class="speech">
                            <p class="font-hero text-2xl text-blue-700 leading-none mb-2">{{ $narrador['nombre'] }}</p>
                            <p class="text-slate-700 font-semibold">{{ $narrador['frase'] }}</p>
                        </div>
                    </div>
                    <div class="text-center mb-6">
                        @include('mensajes.partials.narrador-voz', [
                            'textoVoz'      => ($narrador['frase'] ?? '') . ' ' . $textoPlano,
                            'vozPrimaria'   => 'Miguel',
                            'vozSecundaria' => 'Enrique',
                            'colorBoton'    => 'bg-blue-600 hover:bg-blue-700',
                            'genero'        => 'masculino',
                            'voz'           => 'es-MX-JorgeNeural',
                            'rate'          => 8,    // un poco más rápido = energía de superhéroe
                            'pitch'         => -6,   // un poco más grave = voz heroica
                        ])
                    </div>
                @elseif($esAutos)
                    <div class="mb-6">
                        <div class="dot-road mb-2"></div>
                        <div class="text-center text-4xl">🏎️ 💨 🏁</div>
                        <div class="dot-road mt-2"></div>
                    </div>
                @endif

                @if($mensaje->imagen_path)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $mensaje->imagen_path) }}"
                             alt="Foto de {{ $mensaje->destinatario }}"
                             class="w-44 h-44 object-cover border-4 border-slate-900"
                             style="{{ $eForma }} {{ $eMarco }}">
                    </div>
                @endif

                <div class="speech mb-6">
                    <div class="prose prose-sm max-w-none text-slate-800 leading-relaxed">
                        {!! $mensaje->mensaje !!}
                    </div>
                </div>

                <p class="text-right font-hero text-3xl text-blue-700">{{ $mensaje->remitente }}</p>
            </div>
        </section>

        <section class="comic-box bg-white p-5 text-center">
            <p class="text-sm text-gray-500">Codigo del mensaje</p>
            <p class="font-hero text-4xl text-blue-700 tracking-wider mt-1">{{ $mensaje->code }}</p>
            <button @click="copiar()" class="mt-4 px-5 py-2.5 rounded-full bg-blue-600 text-white font-extrabold hover:bg-blue-700 transition">
                <span x-show="!copiado">Copiar enlace</span>
                <span x-show="copiado" x-cloak>Copiado!</span>
            </button>
        </section>

        <footer class="text-center text-xs text-slate-500 mt-8">
            Mensaje creado con carino en {{ config('app.name') }} - {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#2563EB'])
</body>
</html>
