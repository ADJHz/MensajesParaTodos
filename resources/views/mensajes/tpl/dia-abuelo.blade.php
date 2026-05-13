<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mensaje vintage para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Día del Abuelo' }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre ?? 'Día del Abuelo' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#8B7355">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,400;0,600;1,400&family=Crimson+Text:ital,wght@0,400;0,700;1,400&family=Dancing+Script:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @php
        $formas = [
            'ninguna'=>'','cuadrado'=>'border-radius:6px;','circulo'=>'border-radius:50%;',
            'corazon'=>'clip-path:url(#cp-heart);','estrella'=>'clip-path:url(#cp-star);',
            'hexagono'=>'clip-path:url(#cp-hexagon);','diamante'=>'clip-path:url(#cp-diamond);',
        ];
        $marcos = [
            'ninguno'=>'','dorado'=>'filter:drop-shadow(0 0 8px #B8860B) sepia(.4);',
            'sombra'=>'filter:drop-shadow(4px 8px 18px rgba(92,64,51,.5)) sepia(.4);',
            'morado'=>'filter:drop-shadow(0 0 8px #5C4033) sepia(.4);','rosa'=>'filter:sepia(.4);',
            'verde'=>'filter:sepia(.4);','blanco'=>'filter:drop-shadow(0 0 6px #fff) sepia(.4);',
        ];
        $eForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
        $eMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? 'filter:sepia(.4);';
    @endphp
    <style>
        :root { --sepia:#8B7355; --crema:#F4ECD8; --dorado:#B8860B; --marron:#5C4033; }
        body {
            font-family: 'Spectral', serif;
            background: #EFE3CB;
            background-image:
                radial-gradient(ellipse at top left, rgba(184,134,11,.12), transparent 60%),
                radial-gradient(ellipse at bottom right, rgba(92,64,51,.15), transparent 60%);
            color: #3A2C1F;
        }
        .font-elegant { font-family: 'Crimson Text', serif; }
        .font-hand { font-family: 'Dancing Script', cursive; }

        /* Papel envejecido */
        .papel-vintage {
            background: #F4ECD8;
            background-image:
                radial-gradient(ellipse at 20% 30%, rgba(184,134,11,.18), transparent 50%),
                radial-gradient(ellipse at 80% 70%, rgba(92,64,51,.15), transparent 60%),
                repeating-linear-gradient(0deg, transparent, transparent 28px, rgba(139,115,85,.06) 28px, rgba(139,115,85,.06) 29px);
            box-shadow:
                inset 0 0 80px rgba(92,64,51,.18),
                0 25px 70px rgba(74,45,15,.35),
                0 8px 25px rgba(74,45,15,.2);
            position: relative;
            border: 1px solid rgba(139,115,85,.3);
        }
        /* Esquinas dobladas */
        .papel-vintage::before {
            content:''; position:absolute; top:0; right:0; width:60px; height:60px;
            background: linear-gradient(225deg, transparent 50%, #D4C5A0 50%, #C4B080 100%);
            box-shadow: -2px 2px 6px rgba(0,0,0,.18);
        }
        .papel-vintage::after {
            content:''; position:absolute; bottom:0; left:0; width:50px; height:50px;
            background: linear-gradient(45deg, transparent 50%, #D4C5A0 50%, #C4B080 100%);
            box-shadow: 2px -2px 5px rgba(0,0,0,.18);
        }

        /* Marco oval dorado */
        .marco-oval {
            border: 8px solid #B8860B;
            border-radius: 50%;
            padding: 8px;
            background: linear-gradient(135deg, #DAA520, #B8860B, #8B6914);
            box-shadow: 0 0 0 3px #5C4033, 0 8px 25px rgba(74,45,15,.4), inset 0 0 20px rgba(0,0,0,.3);
            position: relative;
        }
        .marco-oval::before {
            content:''; position:absolute; inset:-4px; border-radius:50%;
            border: 1px dashed rgba(255,215,0,.6); pointer-events:none;
        }

        /* Hojas otoño cayendo */
        @keyframes leaf-fall {
            0%   { transform: translateY(-50px) translateX(0) rotate(0); opacity:0; }
            10%  { opacity:.9; }
            100% { transform: translateY(110vh) translateX(80px) rotate(720deg); opacity:.3; }
        }
        .leaf { position:fixed; top:-50px; pointer-events:none; z-index:1; animation: leaf-fall linear infinite; will-change: transform; }

        @keyframes fade-up { from{opacity:0;transform:translateY(30px);} to{opacity:1;transform:translateY(0);} }
        .fade-up { animation: fade-up 1s ease-out both; }

        .img-vintage { width: 200px; height: 200px; object-fit: cover; border-radius: 50%; }

        /* Línea decorativa */
        .ornament-line {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 20'%3E%3Cpath d='M0 10 H80 M120 10 H200' stroke='%23B8860B' stroke-width='1'/%3E%3Ccircle cx='100' cy='10' r='4' fill='none' stroke='%23B8860B' stroke-width='1'/%3E%3Ccircle cx='100' cy='10' r='1.5' fill='%23B8860B'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            height: 20px;
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">
    @include('mensajes.partials.efectos', ['tema' => 'abuelo'])

    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <clipPath id="cp-heart" clipPathUnits="objectBoundingBox"><path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/></clipPath>
            <clipPath id="cp-star" clipPathUnits="objectBoundingBox"><polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/></clipPath>
            <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/></clipPath>
            <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox"><polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/></clipPath>
        </defs>
    </svg>

    {{-- Hojas de otoño cayendo --}}
    <div class="fixed inset-0 pointer-events-none z-0" aria-hidden="true">
        @php $hojas = [['#B8860B',6,'8%'],['#8B5A2B',9,'22%'],['#A0522D',7,'40%'],['#CD853F',10,'58%'],['#8B4513',8,'74%'],['#D2691E',11,'90%']]; @endphp
        @foreach($hojas as $i => $h)
        <svg class="leaf" width="28" height="28" viewBox="0 0 24 24"
             style="left:{{ $h[2] }};animation-duration:{{ $h[1] }}s;animation-delay:{{ $i*1.4 }}s;fill:{{ $h[0] }};">
            <path d="M12 2 C7 6, 4 12, 6 18 C8 22, 12 22, 12 22 C12 22, 16 22, 18 18 C20 12, 17 6, 12 2 Z M12 5 L12 21" stroke="#5C4033" stroke-width="0.5"/>
        </svg>
        @endforeach
    </div>

    <div x-data="{ copiado:false, copiarLink(){ navigator.clipboard.writeText(window.location.href).then(()=>{ this.copiado=true; setTimeout(()=>this.copiado=false,2200); }); } }"
         x-init="setTimeout(()=>{ window.fxCelebrar?.('confeti'); window.dispatchEvent(new CustomEvent('tpl-carta-abierta')); }, 800);"
         class="relative z-10 max-w-3xl mx-auto px-4 py-6 sm:py-10">

        {{-- Header --}}
        <header class="text-center mb-8 fade-up">
            <div class="inline-flex items-center gap-3 mb-3" aria-hidden="true">
                {{-- Pluma estilográfica --}}
                <svg width="40" height="40" viewBox="0 0 40 40">
                    <path d="M5 35 L25 15 L30 20 L10 40 Z" fill="#5C4033" stroke="#B8860B" stroke-width="1"/>
                    <path d="M25 15 L33 7 L37 11 L30 20 Z" fill="#B8860B" stroke="#5C4033" stroke-width="1"/>
                    <line x1="25" y1="15" x2="30" y2="20" stroke="#3A2C1F" stroke-width="1"/>
                </svg>
                <span class="text-4xl">{{ $mensaje->ocasion->emoji ?? '👴' }}</span>
                {{-- Lente de aumento --}}
                <svg width="40" height="40" viewBox="0 0 40 40">
                    <circle cx="16" cy="16" r="11" fill="rgba(184,134,11,.15)" stroke="#5C4033" stroke-width="2.5"/>
                    <line x1="24" y1="24" x2="36" y2="36" stroke="#5C4033" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
            <h1 class="font-elegant text-3xl sm:text-4xl italic" style="color:#5C4033;">
                {{ $mensaje->ocasion->nombre ?? 'Día del Abuelo' }}
            </h1>
            <div class="ornament-line mt-4 max-w-xs mx-auto"></div>
            <p class="font-hand text-2xl mt-2" style="color:#B8860B;">~ Recuerdos de toda una vida ~</p>
        </header>

        {{-- Página de álbum --}}
        <article class="papel-vintage rounded-sm p-8 sm:p-14 fade-up" style="animation-delay:.3s;">

            <p class="text-center font-elegant italic text-lg mb-2" style="color:#8B7355;">
                Querid@ Abuel@,
            </p>

            <h2 class="text-center font-hand text-5xl sm:text-6xl mb-6" style="color:#5C4033;">
                {{ $mensaje->destinatario }}
            </h2>

            {{-- Foto en marco oval --}}
            @if($mensaje->imagen_path)
            <div class="flex justify-center mb-8">
                <div class="marco-oval">
                    <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                         alt="Recuerdo de {{ $mensaje->destinatario }}"
                         class="img-vintage" style="{{ $eForma }} {{ $eMarco }}">
                </div>
            </div>
            @else
            {{-- Si no hay imagen, fotografía decorativa antigua --}}
            <div class="flex justify-center mb-8" aria-hidden="true">
                <div class="marco-oval">
                    <div class="img-vintage flex items-center justify-center text-7xl bg-gradient-to-br from-amber-100 to-amber-300" style="filter:sepia(.5);">
                        👴👵
                    </div>
                </div>
            </div>
            @endif

            <div class="ornament-line my-6"></div>

            {{-- Mensaje a mano --}}
            <div class="prose max-w-none font-elegant italic text-lg leading-loose mx-auto" style="color:#3A2C1F; max-width: 56ch;">
                {!! $mensaje->mensaje !!}
            </div>

            <div class="ornament-line my-6"></div>

            {{-- Firma --}}
            <div class="text-right mt-8">
                <p class="font-elegant italic text-base" style="color:#8B7355;">Con eterno cariño,</p>
                <p class="font-hand text-4xl mt-1" style="color:#B8860B;">{{ $mensaje->remitente }}</p>
                <p class="font-elegant text-xs mt-2" style="color:#8B7355;">{{ $mensaje->created_at?->format('d \d\e F, Y') }}</p>
            </div>

            {{-- Si no hay youtube_url, mostrar gramófono --}}
            @if(empty($mensaje->youtube_url))
            <div class="flex justify-center mt-10 opacity-70" aria-hidden="true" title="Gramófono — recuerdos sonoros">
                <svg width="100" height="120" viewBox="0 0 100 120">
                    <ellipse cx="50" cy="105" rx="40" ry="6" fill="#5C4033"/>
                    <rect x="30" y="80" width="40" height="20" fill="#8B5A2B" stroke="#5C4033" stroke-width="1.5" rx="2"/>
                    <circle cx="50" cy="80" r="3" fill="#B8860B"/>
                    <line x1="50" y1="80" x2="50" y2="50" stroke="#5C4033" stroke-width="2"/>
                    <path d="M50 50 Q70 30 88 18 L92 28 Q70 38 55 55 Z" fill="#B8860B" stroke="#5C4033" stroke-width="1.5"/>
                    <ellipse cx="90" cy="22" rx="6" ry="9" fill="none" stroke="#5C4033" stroke-width="1.5"/>
                </svg>
            </div>
            @endif
        </article>

        {{-- Code + compartir --}}
        <section class="papel-vintage rounded-sm p-6 mt-8 text-center fade-up" style="animation-delay:.6s;">
            <p class="font-elegant italic text-sm mb-2" style="color:#8B7355;">— Código de este recuerdo —</p>
            <p class="font-hand text-3xl mb-4" style="color:#B8860B; letter-spacing:.15em;">{{ $mensaje->code }}</p>
            <button @click="copiarLink()"
                    class="font-elegant italic text-base px-6 py-2.5 rounded-sm border-2 transition-all hover:scale-105"
                    style="border-color:#5C4033; color:#5C4033; background:rgba(184,134,11,.1);">
                <span x-show="!copiado">✒ Copiar enlace</span>
                <span x-show="copiado">✓ Enlace copiado</span>
            </button>
        </section>

        <footer class="text-center mt-10 font-elegant italic text-sm" style="color:#8B7355;">
            <div class="ornament-line mb-2 max-w-xs mx-auto"></div>
            <p>{{ config('app.name') }} &copy; {{ date('Y') }} — Atesorando memorias</p>
        </footer>
    </div>

    @include('mensajes.partials.music-player', ['accent' => '#B8860B'])
</body>
</html>
