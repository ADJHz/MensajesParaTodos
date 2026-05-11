<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Un mensaje especial para {{ $dedicatoria->mama_name }} — Feliz Día de las Mamás 💐">
    <title>Para {{ $dedicatoria->mama_name }} 💐 — Gracias Mamá</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400;1,700&family=Dancing+Script:wght@500;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Pétalos cayendo ── */
        @keyframes petals-fall {
            0%   { transform: translateY(-80px) rotate(0deg); opacity: 0; }
            8%   { opacity: 0.85; }
            85%  { opacity: 0.7; }
            100% { transform: translateY(110vh) rotate(600deg); opacity: 0; }
        }
        .petal {
            position: fixed;
            top: -80px;
            pointer-events: none;
            z-index: 1;
            animation: petals-fall linear infinite;
            will-change: transform;
        }

        /* ── Carta de papel ── */
        .paper-card {
            background: #FFFCF5;
            box-shadow:
                0 2px 0 #e8ddc8,
                0 4px 0 #e0d4bc,
                0 1px 40px rgba(74,55,40,0.12),
                0 20px 60px rgba(74,55,40,0.10);
            border-radius: 4px;
            position: relative;
        }
        .paper-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                to bottom,
                transparent,
                transparent 31px,
                rgba(212,70,122,0.08) 31px,
                rgba(212,70,122,0.08) 32px
            );
            border-radius: 4px;
            pointer-events: none;
        }
        .paper-card::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 52px;
            width: 1px;
            background: rgba(212,70,122,0.18);
            pointer-events: none;
        }

        /* ── Texto manuscrito ── */
        .handwriting {
            font-family: 'Dancing Script', cursive;
        }

        /* ── Ecualizador de música ── */
        .music-bar {
            width: 3px;
            border-radius: 2px;
            background: #D4467A;
            animation: music-eq 0.8s ease-in-out infinite alternate;
        }
        .music-bar:nth-child(2) { animation-delay: 0.15s; }
        .music-bar:nth-child(3) { animation-delay: 0.30s; }
        .music-bar:nth-child(4) { animation-delay: 0.45s; }
        .music-bar:nth-child(5) { animation-delay: 0.60s; }
        @keyframes music-eq {
            from { height: 4px;  }
            to   { height: 20px; }
        }
        .music-bar-paused { animation-play-state: paused; }

        /* ── Animaciones de entrada ── */
        @keyframes slide-up {
            from { transform: translateY(40px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .slide-up { animation: slide-up 0.7s cubic-bezier(0.22,1,0.36,1) forwards; }

        @keyframes flip-envelope {
            0%   { transform: perspective(800px) rotateX(0deg); }
            40%  { transform: perspective(800px) rotateX(-15deg); }
            100% { transform: perspective(800px) rotateX(0deg); }
        }
        .envelope-hover:hover { animation: flip-envelope 0.4s ease-out; }

        /* ── Sello de cera ── */
        @keyframes seal-pulse {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 4px rgba(212,70,122,0.4)); }
            50%       { transform: scale(1.06); filter: drop-shadow(0 0 10px rgba(212,70,122,0.7)); }
        }
        .wax-seal { animation: seal-pulse 2.5s ease-in-out infinite; }
    </style>
</head>
<body class="font-body overflow-x-hidden"
      style="background: linear-gradient(145deg, #FFD6E0 0%, #FFF5F8 35%, #F5EDFF 70%, #FFF0E8 100%); color: #4A3728; min-height: 100vh;">

    {{-- ═══════════════════════════════════════════
         PÉTALOS CAYENDO — distribuidos uniformemente
    ═══════════════════════════════════════════ --}}
    @php
        $petals = [
            ['left'=>'4vw',  'size'=>18, 'dur'=>9,  'delay'=>0,   'color'=>'#FFB8D0'],
            ['left'=>'11vw', 'size'=>14, 'dur'=>12, 'delay'=>2.5, 'color'=>'#F4A0BF'],
            ['left'=>'19vw', 'size'=>22, 'dur'=>8,  'delay'=>5,   'color'=>'#E8D5F5'],
            ['left'=>'27vw', 'size'=>16, 'dur'=>11, 'delay'=>1,   'color'=>'#FFD6E0'],
            ['left'=>'35vw', 'size'=>12, 'dur'=>14, 'delay'=>7,   'color'=>'#FFB8D0'],
            ['left'=>'43vw', 'size'=>20, 'dur'=>10, 'delay'=>3.5, 'color'=>'#F4A0BF'],
            ['left'=>'51vw', 'size'=>15, 'dur'=>9,  'delay'=>0.8, 'color'=>'#E8D5F5'],
            ['left'=>'59vw', 'size'=>24, 'dur'=>13, 'delay'=>4.5, 'color'=>'#FFD6E0'],
            ['left'=>'67vw', 'size'=>13, 'dur'=>8,  'delay'=>6,   'color'=>'#FFB8D0'],
            ['left'=>'75vw', 'size'=>19, 'dur'=>11, 'delay'=>1.8, 'color'=>'#F4A0BF'],
            ['left'=>'83vw', 'size'=>16, 'dur'=>10, 'delay'=>9,   'color'=>'#E8D5F5'],
            ['left'=>'91vw', 'size'=>21, 'dur'=>12, 'delay'=>3,   'color'=>'#FFD6E0'],
            ['left'=>'8vw',  'size'=>13, 'dur'=>15, 'delay'=>11,  'color'=>'#F4A0BF'],
            ['left'=>'48vw', 'size'=>17, 'dur'=>9,  'delay'=>8,   'color'=>'#FFB8D0'],
            ['left'=>'88vw', 'size'=>12, 'dur'=>13, 'delay'=>5.5, 'color'=>'#E8D5F5'],
        ];
    @endphp
    @foreach ($petals as $p)
        <div class="petal" aria-hidden="true"
             style="left:{{ $p['left'] }}; width:{{ $p['size'] }}px; height:{{ $p['size'] }}px; animation-duration:{{ $p['dur'] }}s; animation-delay:{{ $p['delay'] }}s;">
            <svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                <ellipse cx="15" cy="15" rx="7" ry="13" fill="{{ $p['color'] }}" opacity="0.9" transform="rotate({{ rand(0,360) }},15,15)"/>
            </svg>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════
         PLAYER DE MÚSICA — fijo, esquina inferior
    ═══════════════════════════════════════════ --}}
    <div x-data="musicPlayer()"
         class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50"
         role="region"
         aria-label="Reproductor de música">

        <iframe id="yt-player"
                src="about:blank"
                allow="autoplay"
                style="width:0;height:0;border:0;position:absolute;pointer-events:none;"
                aria-hidden="true"
                title="Reproductor de música de fondo"></iframe>

        <button @click="toggle()"
                :aria-label="playing ? 'Pausar música' : 'Reproducir música de fondo'"
                class="flex items-center gap-2 sm:gap-3 pl-3 pr-4 sm:pl-4 sm:pr-5 py-2 sm:py-3 rounded-full shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95 select-none"
                style="background: rgba(255,255,255,0.82); backdrop-filter: blur(16px); border: 1.5px solid #FFB8D0;">
            <div class="flex items-end gap-[3px] h-5 sm:h-6" aria-hidden="true">
                <div class="music-bar" :class="!playing && 'music-bar-paused'" style="height:8px;"></div>
                <div class="music-bar" :class="!playing && 'music-bar-paused'" style="height:14px;"></div>
                <div class="music-bar" :class="!playing && 'music-bar-paused'" style="height:6px;"></div>
                <div class="music-bar" :class="!playing && 'music-bar-paused'" style="height:18px;"></div>
                <div class="music-bar" :class="!playing && 'music-bar-paused'" style="height:10px;"></div>
            </div>
            <span class="text-xs sm:text-sm font-semibold text-mama-cta" style="font-family:'Nunito',sans-serif;"
                  x-text="playing ? 'Pausar' : 'Música ♪'"></span>
        </button>
    </div>

    {{-- ═══════════════════════════════════════════
         CONTENIDO PRINCIPAL
    ═══════════════════════════════════════════ --}}
    <main class="relative z-10 flex flex-col items-center justify-start min-h-screen px-4 sm:px-6 py-8 sm:py-12">

        {{-- Marca --}}
        <a href="/"
           aria-label="Volver a GraciasMadre"
           class="mb-8 sm:mb-10 text-xs sm:text-sm font-semibold tracking-widest uppercase opacity-60 hover:opacity-100 transition-opacity"
           style="font-family:'Nunito',sans-serif; color:#D4467A;">
            Gracias Mamá <span aria-hidden="true">💐</span>
        </a>

        {{-- ─── Componente sobre + carta ─── --}}
        <div x-data="envelope()" class="w-full max-w-xs sm:max-w-sm md:max-w-lg lg:max-w-2xl">

            {{-- ── Sobre cerrado ── --}}
            <div x-show="!opened"
                 x-transition:leave="transition ease-in duration-400"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90"
                 class="envelope-hover cursor-pointer select-none"
                 @click="open()"
                 role="button"
                 tabindex="0"
                 @keydown.enter="open()"
                 @keydown.space.prevent="open()"
                 :aria-label="'Abrir carta para ' + mamaName">

                <div class="relative mx-auto">
                    {{-- Sombra del sobre --}}
                    <div class="absolute inset-0 rounded-2xl translate-y-3 blur-xl opacity-30"
                         style="background: #D4467A;"></div>

                    {{-- SVG sobre: más detallado y bonito --}}
                    <svg viewBox="0 0 420 290" xmlns="http://www.w3.org/2000/svg"
                         class="w-full drop-shadow-2xl relative z-10"
                         style="filter: drop-shadow(0 20px 40px rgba(212,70,122,0.25));">
                        {{-- Cuerpo base del sobre --}}
                        <rect x="2" y="2" width="416" height="286" rx="20" fill="white" opacity="0.97"/>
                        {{-- Borde sutil --}}
                        <rect x="2" y="2" width="416" height="286" rx="20" fill="none"
                              stroke="#FFB8D0" stroke-width="2"/>
                        {{-- Solapa superior triangular --}}
                        <path d="M2,2 Q210,0 418,2 L210,168 Z" fill="#FFD6E0" opacity="0.75"/>
                        {{-- Línea del doblez superior --}}
                        <path d="M2,2 L210,168 L418,2" fill="none" stroke="#F4A0BF" stroke-width="1.5" opacity="0.6"/>
                        {{-- Solapa izquierda --}}
                        <path d="M2,2 L2,288 L164,160 Z" fill="#F4A0BF" opacity="0.3"/>
                        {{-- Solapa derecha --}}
                        <path d="M418,2 L418,288 L256,160 Z" fill="#F4A0BF" opacity="0.3"/>
                        {{-- Solapa inferior --}}
                        <path d="M2,288 L210,168 L418,288 Z" fill="#FFB8D0" opacity="0.55"/>
                        {{-- Línea inferior --}}
                        <path d="M2,288 L210,168 L418,288" fill="none" stroke="#F4A0BF" stroke-width="1" opacity="0.5"/>

                        {{-- Sello circular con degradado --}}
                        <defs>
                            <radialGradient id="seal-g" cx="50%" cy="40%" r="60%">
                                <stop offset="0%" stop-color="#FFE4BA"/>
                                <stop offset="100%" stop-color="#FFB8D0"/>
                            </radialGradient>
                        </defs>
                        <circle cx="356" cy="50" r="30" fill="url(#seal-g)" opacity="0.95"/>
                        <circle cx="356" cy="50" r="28" fill="none" stroke="#D4467A" stroke-width="1.5" opacity="0.5" stroke-dasharray="4 3"/>
                        <text x="356" y="60" text-anchor="middle" font-size="26" fill="#D4467A">💐</text>

                        {{-- Líneas decorativas de carta --}}
                        <line x1="100" y1="195" x2="320" y2="195" stroke="#FFB8D0" stroke-width="1" opacity="0.5"/>
                        <line x1="120" y1="215" x2="300" y2="215" stroke="#FFB8D0" stroke-width="1" opacity="0.4"/>
                        <line x1="130" y1="235" x2="290" y2="235" stroke="#FFB8D0" stroke-width="1" opacity="0.3"/>

                        {{-- Texto "Para: nombre" --}}
                        <text x="210" y="178" text-anchor="middle" font-size="16"
                              fill="#4A3728" font-family="'Dancing Script',Georgia,cursive" font-style="italic" opacity="0.85">
                            Para: {{ $dedicatoria->mama_name }}
                        </text>
                    </svg>

                    {{-- Indicador animado --}}
                    <div class="relative z-10 mt-5 sm:mt-6 text-center">
                        <span class="inline-flex items-center gap-2 text-mama-cta font-semibold text-sm sm:text-base animate-bounce"
                              style="font-family:'Nunito',sans-serif;">
                            <span aria-hidden="true">💌</span>
                            Toca para abrir tu carta
                            <span aria-hidden="true">💌</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- ── Carta abierta ── --}}
            <div x-show="opened"
                 x-transition:enter="transition ease-out duration-600"
                 x-transition:enter-start="opacity-0 translate-y-6 scale-98"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 class="slide-up pb-10">

                {{-- Encabezado de la carta --}}
                <div class="text-center mb-6 sm:mb-8">
                    <div class="animate-heartbeat inline-block mb-3 sm:mb-4" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                             class="w-12 h-12 sm:w-16 sm:h-16 mx-auto">
                            <path d="M24 42s-18-11.5-18-24a12 12 0 0 1 18-10.4A12 12 0 0 1 42 18c0 12.5-18 24-18 24z"
                                  fill="#F4A0BF"/>
                            <path d="M18 15a6 6 0 0 0-6 6" stroke="white" stroke-width="2.5"
                                  stroke-linecap="round" fill="none" opacity="0.5"/>
                        </svg>
                    </div>
                    <h1 class="font-bold text-3xl sm:text-4xl md:text-5xl text-mama-text leading-tight"
                        style="font-family:'Playfair Display',Georgia,serif;">
                        Para ti,
                        <span class="block sm:inline" style="color:#D4467A;">{{ $dedicatoria->mama_name }}</span>
                    </h1>
                    <p class="mt-2 text-xs sm:text-sm opacity-60 uppercase tracking-widest"
                       style="font-family:'Nunito',sans-serif;">
                        10 de Mayo — Día de las Mamás
                    </p>
                </div>

                {{-- ═══ CARTA DE PAPEL ═══ --}}
                <div class="paper-card mx-auto w-full overflow-hidden">

                    {{-- Pestaña superior de color rosa --}}
                    <div class="h-3 w-full" style="background: linear-gradient(90deg, #FFB8D0, #D4467A, #F4A0BF);"></div>

                    <div class="px-6 sm:px-10 md:px-14 py-8 sm:py-10 md:py-12">

                        {{-- Fecha y sello interior --}}
                        <div class="flex items-start justify-between mb-6 sm:mb-8">
                            <div aria-hidden="true">
                                {{-- Florecita esquina --}}
                                <svg viewBox="0 0 50 50" class="w-8 h-8 sm:w-10 sm:h-10 opacity-50">
                                    <g transform="translate(25,25)">
                                        <ellipse rx="4" ry="12" fill="#FFB8D0" transform="rotate(0)"/>
                                        <ellipse rx="4" ry="12" fill="#F4A0BF" transform="rotate(60)"/>
                                        <ellipse rx="4" ry="12" fill="#FFB8D0" transform="rotate(120)"/>
                                        <ellipse rx="4" ry="12" fill="#F4A0BF" transform="rotate(180)"/>
                                        <ellipse rx="4" ry="12" fill="#FFB8D0" transform="rotate(240)"/>
                                        <ellipse rx="4" ry="12" fill="#F4A0BF" transform="rotate(300)"/>
                                        <circle r="6" fill="#FFE4BA"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="text-right">
                                <p class="text-xs sm:text-sm opacity-60 handwriting" style="color:#4A3728;">
                                    10 de Mayo, {{ date('Y') }}
                                </p>
                                <p class="text-xs opacity-40 mt-0.5" style="font-family:'Nunito',sans-serif;">
                                    Día de las Mamás
                                </p>
                            </div>
                        </div>

                        {{-- Saludo --}}
                        <p class="handwriting text-xl sm:text-2xl md:text-3xl mb-5 sm:mb-6"
                           style="color:#D4467A; line-height:1.5;">
                            Querida {{ $dedicatoria->mama_name }}:
                        </p>

                        {{-- Cuerpo del mensaje --}}
                        <div class="mb-6 sm:mb-8 pl-0 sm:pl-2 md:pl-4">
                            <p class="text-base sm:text-lg md:text-xl leading-loose whitespace-pre-line text-mama-text"
                               style="font-family:'Playfair Display',Georgia,serif; font-style:italic; line-height:2;">{{ $dedicatoria->message }}</p>
                        </div>

                        {{-- Cierre y firma --}}
                        <div class="border-t pt-6 sm:pt-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4"
                             style="border-color: rgba(244,160,191,0.4);">

                            <div>
                                <p class="handwriting text-lg sm:text-xl" style="color:#4A3728; opacity:0.8;">
                                    Con todo mi amor,
                                </p>
                                @if ($dedicatoria->remitente)
                                    <p class="handwriting text-2xl sm:text-3xl mt-1 font-bold" style="color:#D4467A;">
                                        {{ $dedicatoria->remitente }}
                                    </p>
                                @else
                                    <p class="handwriting text-2xl sm:text-3xl mt-1" style="color:#D4467A; opacity:0.6;">
                                        ✦ ✦ ✦
                                    </p>
                                @endif
                            </div>

                            {{-- Sello de cera decorativo --}}
                            <div class="wax-seal self-center sm:self-end" aria-hidden="true">
                                <svg viewBox="0 0 70 70" class="w-14 h-14 sm:w-16 sm:h-16">
                                    <defs>
                                        <radialGradient id="wax" cx="40%" cy="35%" r="65%">
                                            <stop offset="0%" stop-color="#F4A0BF"/>
                                            <stop offset="100%" stop-color="#D4467A"/>
                                        </radialGradient>
                                    </defs>
                                    <polygon points="35,2 43,28 70,28 48,44 56,70 35,54 14,70 22,44 0,28 27,28"
                                             fill="url(#wax)" opacity="0.9"/>
                                    <text x="35" y="41" text-anchor="middle" font-size="18" fill="white"
                                          font-family="serif">♥</text>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Pie de la carta con color --}}
                    <div class="h-2 w-full" style="background: linear-gradient(90deg, #F4A0BF, #FFD6E0, #F4A0BF);"></div>
                </div>

                {{-- Flores decorativas debajo de la carta --}}
                <div class="flex justify-center items-center gap-3 sm:gap-5 mt-6 sm:mt-8" aria-hidden="true">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="animate-float-slow {{ ['w-8 h-8','w-6 h-6','w-10 h-10','w-7 h-7','w-8 h-8'][$i] }}"
                             style="animation-delay: {{ $i * 0.8 }}s;">
                            <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(40,40)">
                                    <ellipse rx="8" ry="20" fill="{{ ['#FFB8D0','#F4A0BF','#E8D5F5'][$i % 3] }}" transform="rotate(0)"/>
                                    <ellipse rx="8" ry="20" fill="{{ ['#FFB8D0','#F4A0BF','#E8D5F5'][$i % 3] }}" transform="rotate(72)"/>
                                    <ellipse rx="8" ry="20" fill="{{ ['#F4A0BF','#FFB8D0','#FFD6E0'][$i % 3] }}" transform="rotate(144)"/>
                                    <ellipse rx="8" ry="20" fill="{{ ['#F4A0BF','#FFB8D0','#FFD6E0'][$i % 3] }}" transform="rotate(216)"/>
                                    <ellipse rx="8" ry="20" fill="{{ ['#FFB8D0','#F4A0BF','#E8D5F5'][$i % 3] }}" transform="rotate(288)"/>
                                    <circle r="10" fill="#FFE4BA"/>
                                </g>
                            </svg>
                        </div>
                    @endfor
                </div>

                {{-- Código y compartir --}}
                <div class="mt-6 sm:mt-8 glass-card rounded-2xl p-5 sm:p-6 shadow-xl text-center"
                     style="border: 1px solid rgba(244,160,191,0.35);">
                    <p class="text-xs uppercase tracking-widest opacity-60 mb-2"
                       style="font-family:'Nunito',sans-serif;">Código de esta carta</p>
                    <p class="font-bold text-2xl sm:text-3xl tracking-[0.25em] sm:tracking-[0.3em] text-mama-cta mb-4"
                       style="font-family:'Playfair Display',serif;">{{ $dedicatoria->code }}</p>

                    <button onclick="navigator.clipboard.writeText(window.location.href).then(() => { this.textContent='¡Copiado! ✓'; setTimeout(() => { this.innerHTML='Copiar enlace <span aria-hidden=\'true\'>🔗</span>'; }, 2200); })"
                            class="px-5 sm:px-7 py-2.5 sm:py-3 rounded-full text-white font-semibold text-sm shadow-lg transition-all duration-300 hover:scale-105 active:scale-95"
                            style="background: linear-gradient(135deg, #D4467A 0%, #F4A0BF 100%); font-family:'Nunito',sans-serif;">
                        Copiar enlace <span aria-hidden="true">🔗</span>
                    </button>
                </div>

                <p class="text-center mt-6 text-xs opacity-40" style="font-family:'Nunito',sans-serif;">
                    Gracias Mamá &copy; {{ date('Y') }} — Con amor para las mamás del mundo
                </p>
            </div>
        </div>
    </main>

    <script>
        function envelope() {
            return {
                opened: false,
                mamaName: '{{ addslashes($dedicatoria->mama_name) }}',
                open() {
                    this.opened = true;
                    this.$nextTick(() => {
                        window.dispatchEvent(new CustomEvent('carta-abierta'));
                    });
                }
            };
        }

        function musicPlayer() {
            return {
                playing: false,
                videoId: 'Lwrrsp-sDk8',
                iframe: null,
                init() {
                    this.iframe = document.getElementById('yt-player');
                    window.addEventListener('carta-abierta', () => {
                        if (!this.playing) this.play();
                    });
                },
                play() {
                    this.iframe.src =
                        'https://www.youtube.com/embed/' + this.videoId +
                        '?autoplay=1&loop=1&playlist=' + this.videoId +
                        '&controls=0&enablejsapi=1&rel=0';
                    this.playing = true;
                },
                pause() {
                    this.iframe.src = 'about:blank';
                    this.playing = false;
                },
                toggle() {
                    this.playing ? this.pause() : this.play();
                }
            };
        }
    </script>
</body>
</html>
