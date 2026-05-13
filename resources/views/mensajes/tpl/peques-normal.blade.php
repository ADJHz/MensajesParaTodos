<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje especial para {{ $mensaje->destinatario }}">
    <title>{{ $mensaje->destinatario }} - {{ $mensaje->ocasion->nombre ?? 'Mensaje normal peques' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#475569">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
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

        $template = $mensaje->template ?? 'peques-cuento-clasico';
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';

        $tema = [
            'peques-arcoiris' => ['bg' => 'from-violet-100 via-pink-100 to-yellow-100', 'badge' => 'bg-violet-200 text-violet-700', 'accent' => '#7C3AED'],
            'peques-cuento-clasico' => ['bg' => 'from-slate-100 via-zinc-100 to-stone-100', 'badge' => 'bg-slate-200 text-slate-700', 'accent' => '#475569'],
        ][$template] ?? ['bg' => 'from-slate-100 via-zinc-100 to-stone-100', 'badge' => 'bg-slate-200 text-slate-700', 'accent' => '#475569'];
    @endphp
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 45%, #fdf4ff 100%);
            min-height: 100vh;
        }
        .font-soft { font-family: 'Quicksand', sans-serif; }
    </style>
</head>
<body>
    @include('mensajes.partials.efectos', ['tema' => 'cuento'])
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>
        </defs>
    </svg>

    <main x-data="{ copiado: false, copiar(){ navigator.clipboard.writeText(window.location.href).then(() => { this.copiado = true; setTimeout(() => this.copiado = false, 1800); }); } }"
          class="max-w-3xl mx-auto px-4 py-6 sm:py-10">

        <header class="text-center mb-8">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-bold {{ $tema['badge'] }}">
                <span>{{ $mensaje->ocasion->emoji ?? '💌' }}</span>
                <span>{{ $mensaje->ocasion->nombre ?? 'Mensaje normal peques' }}</span>
            </span>
            <h1 class="font-soft text-4xl sm:text-5xl font-bold text-slate-800 mt-4">Para {{ $mensaje->destinatario }}</h1>
            <p class="text-slate-500 mt-2">Un mensaje limpio y bonito para compartir.</p>
        </header>

        <section class="bg-linear-to-br {{ $tema['bg'] }} rounded-3xl p-4 sm:p-6 shadow-xl border border-white/60">
            <article class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100">
                @if($mensaje->imagen_path)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $mensaje->imagen_path) }}"
                             alt="Foto de {{ $mensaje->destinatario }}"
                             class="w-44 h-44 object-contain bg-white border-4 border-slate-200"
                             style="{{ $eForma }} {{ $eMarco }}">
                    </div>
                @endif

                <div class="prose prose-sm sm:prose-base max-w-none text-slate-700 leading-relaxed">
                    {!! $mensaje->mensaje !!}
                </div>

                <p class="text-right mt-8 text-xl sm:text-2xl font-soft font-bold text-slate-700">{{ $mensaje->remitente }}</p>
            </article>
        </section>

        <section class="bg-white rounded-2xl p-5 text-center shadow-md border border-slate-100 mt-6">
            <p class="text-sm text-slate-500">Codigo del mensaje</p>
            <p class="font-soft text-3xl font-bold text-slate-700 tracking-wider mt-1">{{ $mensaje->code }}</p>
            <button @click="copiar()" class="mt-4 px-5 py-2.5 rounded-full bg-slate-600 text-white font-bold hover:bg-slate-700 transition">
                <span x-show="!copiado">Copiar enlace</span>
                <span x-show="copiado" x-cloak>Copiado!</span>
            </button>
        </section>

        <footer class="text-center text-xs text-slate-500 mt-8">
            Mensaje creado con carino en {{ config('app.name') }} - {{ date('Y') }}
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => $tema['accent']])
</body>
</html>
