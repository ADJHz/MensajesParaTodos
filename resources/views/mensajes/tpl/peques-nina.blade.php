<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje especial para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} - {{ $mensaje->ocasion->nombre ?? 'Mensaje para Nina' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#DB2777">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
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

        $template = $mensaje->template ?? 'peques-princesa-sueno';
        $narradores = [
            'peques-princesa-sueno' => ['nombre' => 'Princesa Estelar', 'icono' => '👑', 'frase' => 'Habia una vez un mensaje precioso para ti.'],
            'peques-stitch-tierno' => ['nombre' => 'Amiguito Galactico', 'icono' => '🛸', 'frase' => 'Hola, vine a leerte este mensaje con mucho amor.'],
        ];

        $narrador = $narradores[$template] ?? null;
        $textoPlano = trim(strip_tags($mensaje->mensaje ?? ''));
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';
    @endphp
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: radial-gradient(circle at 20% 20%, #fbcfe8 0, transparent 35%),
                        radial-gradient(circle at 80% 80%, #bfdbfe 0, transparent 30%),
                        linear-gradient(180deg, #fdf2f8 0%, #fae8ff 55%, #eff6ff 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        .font-peques { font-family: 'Baloo 2', cursive; }
        .glass-card {
            background: rgba(255,255,255,0.78);
            border: 1px solid rgba(255,255,255,0.9);
            box-shadow: 0 20px 45px rgba(219,39,119,.18);
            backdrop-filter: blur(8px);
            border-radius: 26px;
        }
        .speech {
            position: relative;
            background: #ffffff;
            border: 2px solid #db2777;
            border-radius: 18px;
            padding: .9rem 1rem;
            box-shadow: 0 8px 25px rgba(219,39,119,.14);
        }
        .speech:after {
            content: '';
            position: absolute;
            left: 22px;
            bottom: -12px;
            border-width: 12px 10px 0 10px;
            border-style: solid;
            border-color: #db2777 transparent transparent transparent;
        }
        .speech:before {
            content: '';
            position: absolute;
            left: 24px;
            bottom: -9px;
            border-width: 10px 8px 0 8px;
            border-style: solid;
            border-color: #ffffff transparent transparent transparent;
            z-index: 1;
        }
        @keyframes sparkle { 0%,100%{opacity:.35;transform:scale(.9);} 50%{opacity:1;transform:scale(1.15);} }
        .sparkle { animation: sparkle 1.8s ease-in-out infinite; }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'princesa'])
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
            copiar(){
                navigator.clipboard.writeText(window.location.href).then(() => {
                    this.copiado = true;
                    setTimeout(() => this.copiado = false, 1800);
                });
            }
        }"
          class="max-w-3xl mx-auto px-4 py-6 sm:py-10 relative z-10">

        <header class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-100 text-pink-700 font-bold text-sm border border-pink-200">
                <span>{{ $mensaje->ocasion->emoji ?? '👑' }}</span>
                <span>{{ $mensaje->ocasion->nombre ?? 'Mensaje para Nina' }}</span>
            </div>
            <h1 class="font-peques text-5xl sm:text-6xl font-extrabold text-pink-700 mt-4">{{ $mensaje->destinatario }}</h1>
            <p class="text-gray-600 mt-1">Un mensaje bonito para alegrar tu dia.</p>
            <div class="text-2xl mt-2" aria-hidden="true">
                <span class="sparkle">✨</span>
                <span class="sparkle" style="animation-delay:.3s">🌸</span>
                <span class="sparkle" style="animation-delay:.6s">✨</span>
            </div>
        </header>

        <section class="glass-card p-5 sm:p-8 mb-6">
            @if($narrador)
                <div class="grid sm:grid-cols-[auto_1fr] gap-4 items-start mb-6">
                    <div class="flex justify-center">
                        @include('mensajes.partials.personaje', ['tema' => 'princesa', 'tamano' => 'lg'])
                    </div>
                    <div class="speech">
                        <p class="font-peques text-2xl font-bold text-pink-700 leading-none mb-2">{{ $narrador['nombre'] }}</p>
                        <p class="text-slate-700 font-semibold">{{ $narrador['frase'] }}</p>
                    </div>
                </div>
                <div class="text-center mb-6">
                    @include('mensajes.partials.narrador-voz', [
                        'textoVoz'      => ($narrador['frase'] ?? '') . ' ' . $textoPlano,
                        'vozPrimaria'   => 'Mia',
                        'vozSecundaria' => 'Lupe',
                        'colorBoton'    => 'bg-pink-600 hover:bg-pink-700',
                        'genero'        => 'femenino',
                    ])
                </div>
            @endif

            @if($mensaje->imagen_path)
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('storage/' . $mensaje->imagen_path) }}"
                         alt="Foto de {{ $mensaje->destinatario }}"
                         class="w-44 h-44 object-cover border-4 border-pink-200"
                         style="{{ $eForma }} {{ $eMarco }}">
                </div>
            @endif

            <div class="speech mb-6">
                <div class="prose prose-sm max-w-none text-slate-800 leading-relaxed">
                    {!! $mensaje->mensaje !!}
                </div>
            </div>

            <p class="text-right font-peques text-3xl font-bold text-pink-700">{{ $mensaje->remitente }}</p>
        </section>

        <section class="glass-card p-5 text-center">
            <p class="text-sm text-gray-500">Codigo del mensaje</p>
            <p class="font-peques text-4xl font-bold text-pink-700 tracking-wider mt-1">{{ $mensaje->code }}</p>
            <button @click="copiar()" class="mt-4 px-5 py-2.5 rounded-full bg-pink-600 text-white font-extrabold hover:bg-pink-700 transition">
                <span x-show="!copiado">Copiar enlace</span>
                <span x-show="copiado" x-cloak>Copiado!</span>
            </button>
        </section>

        <footer class="text-center text-xs text-slate-500 mt-8">
            Mensaje creado con carino en {{ config('app.name') }} - {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#DB2777'])
</body>
</html>
