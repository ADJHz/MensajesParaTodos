<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#1A1A1A">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body{font-family:'Cormorant Garamond',serif;background:#0F0F0F;color:#FAF7F2;min-height:100vh;overflow-x:hidden;}
        .gala-bg{
            background:
                radial-gradient(ellipse at top, rgba(212,175,55,.18), transparent 55%),
                radial-gradient(ellipse at bottom, rgba(123,31,45,.25), transparent 60%),
                #1A1A1A;
        }
        .playfair{font-family:'Playfair Display',serif;}
        .corm{font-family:'Cormorant Garamond',serif;}
        .gold{color:#D4AF37;}
        .gold-grad{background:linear-gradient(135deg,#F5D67A 0%,#D4AF37 50%,#A8841A 100%);-webkit-background-clip:text;background-clip:text;color:transparent;}

        @keyframes ring-spin{from{transform:rotate(0);}to{transform:rotate(360deg);}}
        .ring-rot{animation:ring-spin 22s linear infinite;transform-origin:center;}
        .ring-rot-rev{animation:ring-spin 30s linear infinite reverse;transform-origin:center;}

        @keyframes sparkle-fall{0%{transform:translateY(-10vh) rotate(0);opacity:0;}10%{opacity:1;}100%{transform:translateY(110vh) rotate(360deg);opacity:0;}}
        .sparkle{position:fixed;top:-10vh;pointer-events:none;z-index:1;animation:sparkle-fall linear infinite;}

        .deco-frame{
            position:relative;background:linear-gradient(180deg,#FAF7F2 0%,#F0E9DC 100%);
            color:#1A1A1A;
            box-shadow:0 30px 80px rgba(0,0,0,.7),0 0 0 1px rgba(212,175,55,.4);
        }
        .deco-frame::before{
            content:'';position:absolute;inset:14px;border:1px solid #D4AF37;pointer-events:none;
        }
        .deco-frame::after{
            content:'';position:absolute;inset:22px;border:1px solid #D4AF37;opacity:.4;pointer-events:none;
        }
        .corner{position:absolute;width:60px;height:60px;pointer-events:none;}
        .corner.tl{top:6px;left:6px;}
        .corner.tr{top:6px;right:6px;transform:scaleX(-1);}
        .corner.bl{bottom:6px;left:6px;transform:scaleY(-1);}
        .corner.br{bottom:6px;right:6px;transform:scale(-1,-1);}

        .curtain-l,.curtain-r{
            position:absolute;top:0;bottom:0;width:50%;
            background:linear-gradient(90deg,#7B1F2D 0%,#5A1622 50%,#3E0F18 100%);
            box-shadow:inset 0 0 60px rgba(0,0,0,.6);
            transition:transform 1.6s cubic-bezier(.7,0,.3,1);
            z-index:5;
        }
        .curtain-l{left:0;background:linear-gradient(90deg,#3E0F18 0%,#5A1622 50%,#7B1F2D 100%);}
        .curtain-r{right:0;}
        .curtain-l::after,.curtain-r::after{
            content:'';position:absolute;inset:0;
            background:repeating-linear-gradient(90deg,rgba(0,0,0,.3) 0 4px,transparent 4px 18px);
        }
        .open-l{transform:translateX(-105%);}
        .open-r{transform:translateX(105%);}

        @keyframes champagne-pop{0%,100%{transform:rotate(-8deg) translateY(0);}50%{transform:rotate(-2deg) translateY(-4px);}}
        .glasses{animation:champagne-pop 4s ease-in-out infinite;}

        .img-circulo{clip-path:circle(50% at 50% 50%);}
        .img-cuadrado{clip-path:inset(0);}
        .img-corazon{clip-path:path('M50,88 C20,66 4,46 4,28 C4,12 16,2 30,2 C40,2 47,8 50,18 C53,8 60,2 70,2 C84,2 96,12 96,28 C96,46 80,66 50,88 Z');}
        .img-hexagono{clip-path:polygon(25% 5%,75% 5%,98% 50%,75% 95%,25% 95%,2% 50%);}
        .marco-clasico{border:8px solid #FAF7F2;box-shadow:0 0 0 2px #D4AF37,0 12px 30px rgba(0,0,0,.4);}
        .marco-vintage{filter:sepia(.4);border:10px double #7B1F2D;}
        .marco-moderno{box-shadow:0 0 0 4px #D4AF37,0 14px 36px rgba(212,175,55,.4);}
        .marco-ninguno{box-shadow:0 8px 24px rgba(0,0,0,.5);}
        [x-cloak]{display:none!important;}
    </style>
</head>
<body class="gala-bg" x-data="{opened:false,open(){this.opened=true;window.fxCelebrar?.('amor');setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')),1200);}}">
    @include('mensajes.partials.efectos', ['tema' => 'amor'])

    {{-- Sparkles dorados --}}
    @for($i=0;$i<18;$i++)
        <span class="sparkle" style="left:{{ random_int(0,100) }}%;animation-duration:{{ random_int(10,18) }}s;animation-delay:{{ random_int(0,14) }}s;" aria-hidden="true">
            <svg width="{{ random_int(8,18) }}" height="{{ random_int(8,18) }}" viewBox="0 0 16 16" fill="#D4AF37">
                <path d="M8 0 L9.5 6.5 L16 8 L9.5 9.5 L8 16 L6.5 9.5 L0 8 L6.5 6.5 Z"/>
            </svg>
        </span>
    @endfor

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-8 sm:py-12">
        {{-- Anillos entrelazados --}}
        <header class="text-center mb-6">
            <div class="relative w-32 h-20 mx-auto mb-4" aria-hidden="true">
                <svg width="128" height="80" viewBox="0 0 128 80" class="absolute inset-0">
                    <g class="ring-rot" style="transform-origin:42px 40px">
                        <circle cx="42" cy="40" r="28" fill="none" stroke="#D4AF37" stroke-width="4"/>
                        <circle cx="42" cy="12" r="3" fill="#FAF7F2"/>
                    </g>
                </svg>
                <svg width="128" height="80" viewBox="0 0 128 80" class="absolute inset-0">
                    <g class="ring-rot-rev" style="transform-origin:86px 40px">
                        <circle cx="86" cy="40" r="28" fill="none" stroke="#F5D67A" stroke-width="4"/>
                        <circle cx="86" cy="12" r="3" fill="#FAF7F2"/>
                    </g>
                </svg>
            </div>
            <p class="corm italic gold tracking-[.4em] uppercase text-xs">{{ $mensaje->ocasion->nombre }} {{ $mensaje->ocasion->emoji ?? '💍' }}</p>
            <h1 class="playfair font-black text-5xl sm:text-7xl gold-grad mt-3 leading-none">Aniversario</h1>
            <div class="flex items-center justify-center gap-3 mt-4 text-[#D4AF37]" aria-hidden="true">
                <span class="h-px w-16 bg-[#D4AF37]/60"></span>
                <span class="glasses inline-block">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#D4AF37" stroke-width="1.5">
                        <path d="M8 6 L14 6 L13 14 Q11 17 11 22 L11 32 M8 32 L14 32"/>
                        <path d="M26 6 L32 6 L31 14 Q29 17 29 22 L29 32 M26 32 L32 32"/>
                    </svg>
                </span>
                <span class="h-px w-16 bg-[#D4AF37]/60"></span>
            </div>
        </header>

        {{-- Invitación con cortinas --}}
        <article class="relative deco-frame rounded-sm p-10 sm:p-14 overflow-hidden">
            <span class="corner tl" aria-hidden="true"><svg viewBox="0 0 60 60"><path d="M2,2 L58,2 M2,2 L2,58 M2,30 Q14,18 30,30 M30,2 Q18,14 30,30" stroke="#D4AF37" stroke-width="1" fill="none"/><circle cx="2" cy="2" r="3" fill="#D4AF37"/></svg></span>
            <span class="corner tr" aria-hidden="true"><svg viewBox="0 0 60 60"><path d="M2,2 L58,2 M2,2 L2,58 M2,30 Q14,18 30,30 M30,2 Q18,14 30,30" stroke="#D4AF37" stroke-width="1" fill="none"/><circle cx="2" cy="2" r="3" fill="#D4AF37"/></svg></span>
            <span class="corner bl" aria-hidden="true"><svg viewBox="0 0 60 60"><path d="M2,2 L58,2 M2,2 L2,58 M2,30 Q14,18 30,30 M30,2 Q18,14 30,30" stroke="#D4AF37" stroke-width="1" fill="none"/><circle cx="2" cy="2" r="3" fill="#D4AF37"/></svg></span>
            <span class="corner br" aria-hidden="true"><svg viewBox="0 0 60 60"><path d="M2,2 L58,2 M2,2 L2,58 M2,30 Q14,18 30,30 M30,2 Q18,14 30,30" stroke="#D4AF37" stroke-width="1" fill="none"/><circle cx="2" cy="2" r="3" fill="#D4AF37"/></svg></span>

            {{-- Cortinas (sólo visibles antes de abrir) --}}
            <div class="curtain-l" :class="opened && 'open-l'" aria-hidden="true"></div>
            <div class="curtain-r" :class="opened && 'open-r'" aria-hidden="true"></div>

            <div class="text-center min-h-[300px] flex flex-col items-center justify-center" x-show="!opened">
                <p class="corm italic text-[#D4AF37] tracking-[.3em] uppercase text-sm">Invitación</p>
                <p class="playfair italic text-3xl text-[#1A1A1A] mt-4 mb-8">Una velada inolvidable<br>te aguarda...</p>
                <button @click="open()" class="bg-[#1A1A1A] hover:bg-[#7B1F2D] text-[#D4AF37] border-2 border-[#D4AF37] playfair italic text-lg px-10 py-3 rounded-sm tracking-[.2em] uppercase transition-all hover:scale-105">
                    Abrir invitación
                </button>
            </div>

            <div x-show="opened" x-cloak
                 x-transition:enter="transition ease-out duration-1500 delay-700"
                 x-transition:enter-start="opacity-0 translate-y-6"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="text-center">
                @if($mensaje->imagen_path)
                    <figure class="flex justify-center mb-8">
                        <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                             alt="Imagen de aniversario para {{ $mensaje->destinatario }}"
                             class="w-44 h-44 sm:w-52 sm:h-52 object-contain bg-white img-{{ $mensaje->imagen_forma ?? 'circulo' }} marco-{{ $mensaje->imagen_marco ?? 'clasico' }}">
                    </figure>
                @endif

                <p class="corm italic text-[#7B1F2D] tracking-[.3em] uppercase text-sm">Para</p>
                <h2 class="playfair font-black text-4xl sm:text-5xl text-[#1A1A1A] mt-2 mb-2">{{ $mensaje->destinatario }}</h2>
                <div class="flex items-center justify-center gap-3 mb-6 text-[#D4AF37]" aria-hidden="true">
                    <span class="h-px w-12 bg-[#D4AF37]"></span>
                    <span>✦</span>
                    <span class="h-px w-12 bg-[#D4AF37]"></span>
                </div>

                <div class="playfair italic text-xl sm:text-2xl leading-relaxed text-[#1A1A1A] max-w-xl mx-auto">
                    {!! $mensaje->mensaje !!}
                </div>

                <div class="mt-10 pt-6 border-t border-[#D4AF37]/30">
                    <p class="corm italic text-[#7B1F2D] tracking-widest uppercase text-xs">Con todo mi amor</p>
                    <p class="playfair text-3xl italic text-[#1A1A1A] mt-2">{{ $mensaje->remitente }}</p>
                    <p class="corm italic text-[#1A1A1A]/60 mt-3 tracking-[.3em] uppercase text-xs">{{ $mensaje->created_at->format('d · F · Y') }}</p>
                </div>
            </div>
        </article>

        {{-- Código --}}
        <section class="mt-12 max-w-md mx-auto bg-black/50 backdrop-blur border border-[#D4AF37]/40 rounded-sm p-6 text-center" x-data="{copied:false}">
            <p class="corm italic text-[#D4AF37] tracking-[.4em] uppercase text-xs mb-2">Código privado</p>
            <p class="playfair text-2xl gold-grad mb-4 tracking-[.3em]">{{ $mensaje->code }}</p>
            <button @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,2200)"
                    class="bg-[#D4AF37] hover:bg-[#F5D67A] text-[#1A1A1A] playfair italic px-6 py-2.5 rounded-sm tracking-widest uppercase text-sm transition hover:scale-105">
                <span x-show="!copied">Copiar enlace</span>
                <span x-show="copied" x-cloak>✓ Copiado</span>
            </button>
        </section>

        <footer class="mt-12 text-center text-[#FAF7F2]/40 corm italic text-sm tracking-widest">
            <p>{{ strtoupper(config('app.name')) }} &copy; {{ date('Y') }}</p>
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#D4AF37'])
</body>
</html>
