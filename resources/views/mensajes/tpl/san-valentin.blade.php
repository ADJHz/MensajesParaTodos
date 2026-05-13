<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Para {{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}">
    <title>{{ $mensaje->destinatario }} — {{ $mensaje->ocasion->nombre }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta name="theme-color" content="#DC143C">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,500;1,500&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body{font-family:'Cormorant Garamond',serif;background:#722F37;color:#F7E7CE;min-height:100vh;overflow-x:hidden;}
        .romance-bg{
            background:
                radial-gradient(ellipse at top, rgba(220,20,60,.55), transparent 60%),
                radial-gradient(ellipse at bottom, rgba(114,47,55,.95), #4A1820 70%);
        }
        .vibes{font-family:'Great Vibes',cursive;}
        .serif{font-family:'Cormorant Garamond',serif;}
        @keyframes heart-fall{0%{transform:translateY(-10vh) rotate(0);opacity:0;}10%{opacity:1;}90%{opacity:1;}100%{transform:translateY(110vh) rotate(360deg);opacity:0;}}
        @keyframes heart-beat{0%,100%{transform:scale(1);}25%{transform:scale(1.18);}50%{transform:scale(1);}75%{transform:scale(1.12);}}
        .heart{position:fixed;top:-10vh;pointer-events:none;z-index:1;animation:heart-fall linear infinite;will-change:transform;}
        .heart > svg{animation:heart-beat 1s ease-in-out infinite;}
        @keyframes petal-fall-r{0%{transform:translateY(-10vh) rotate(0);opacity:0;}10%{opacity:.9;}100%{transform:translateY(110vh) rotate(540deg);opacity:0;}}
        .petal-r{position:fixed;top:-10vh;pointer-events:none;z-index:1;animation:petal-fall-r linear infinite;}
        .gift-box{
            background:linear-gradient(135deg,#DC143C 0%,#A50E2C 100%);
            box-shadow:0 25px 60px rgba(0,0,0,.5),inset 0 -8px 24px rgba(0,0,0,.25),inset 0 8px 24px rgba(255,255,255,.15);
            position:relative;
        }
        .gift-lid{
            background:linear-gradient(135deg,#E91E63 0%,#B91747 100%);
            box-shadow:0 -8px 30px rgba(0,0,0,.3),inset 0 -4px 16px rgba(0,0,0,.2),inset 0 4px 16px rgba(255,255,255,.2);
            position:absolute;top:0;left:-3%;right:-3%;height:60px;
            transform-origin:top center;transition:transform 1.2s cubic-bezier(.34,1.4,.64,1);
            z-index:5;
        }
        .lid-open{transform:rotateX(-160deg) translateY(-30px);}
        .ribbon-v{position:absolute;top:-30px;bottom:0;left:50%;transform:translateX(-50%);width:40px;background:linear-gradient(180deg,#F7E7CE,#E0CFAE);box-shadow:0 0 16px rgba(247,231,206,.5);z-index:6;}
        .ribbon-h{position:absolute;left:-3%;right:-3%;top:30px;height:40px;background:linear-gradient(180deg,#F7E7CE,#E0CFAE);box-shadow:0 0 16px rgba(247,231,206,.5);z-index:4;}
        .bow{position:absolute;top:-50px;left:50%;transform:translateX(-50%);z-index:7;filter:drop-shadow(0 4px 10px rgba(0,0,0,.4));}
        .chocolate{
            aspect-ratio:1/1;border-radius:8px;
            background:radial-gradient(circle at 30% 30%, #8B4513 0%, #5D2E0A 70%, #3E1F06 100%);
            box-shadow:inset -3px -4px 8px rgba(0,0,0,.5),inset 3px 4px 8px rgba(255,255,255,.15),0 4px 8px rgba(0,0,0,.3);
            display:flex;align-items:center;justify-content:center;font-size:24px;
        }
        .romantic-card{
            background:linear-gradient(180deg,#FFF8F0 0%,#F7E7CE 100%);
            color:#722F37;
            box-shadow:0 16px 40px rgba(0,0,0,.4),inset 0 0 0 1px rgba(220,20,60,.2);
            position:relative;
        }
        .romantic-card::before,.romantic-card::after{
            content:'';position:absolute;width:60px;height:60px;
            background:linear-gradient(45deg,transparent 45%,#DC143C 45%,#DC143C 55%,transparent 55%);
            opacity:.4;
        }
        .romantic-card::before{top:0;left:0;border-radius:0 0 60px 0;}
        .romantic-card::after{bottom:0;right:0;border-radius:60px 0 0 0;transform:rotate(180deg);}
        @keyframes cupid-cross{
            0%{transform:translateX(-15vw) translateY(0) rotate(0);opacity:0;}
            10%{opacity:1;}
            90%{opacity:1;}
            100%{transform:translateX(115vw) translateY(-30px) rotate(0);opacity:0;}
        }
        .cupid{position:fixed;top:18%;left:0;z-index:2;pointer-events:none;animation:cupid-cross 8s linear infinite;}
        @keyframes main-beat{0%,100%{transform:scale(1);filter:drop-shadow(0 0 20px rgba(220,20,60,.6));}50%{transform:scale(1.08);filter:drop-shadow(0 0 40px rgba(220,20,60,.9));}}
        .main-heart{animation:main-beat 1.1s ease-in-out infinite;}
        .img-circulo{clip-path:circle(50% at 50% 50%);}
        .img-cuadrado{clip-path:inset(0 round 8px);}
        .img-corazon{clip-path:path('M50,88 C20,66 4,46 4,28 C4,12 16,2 30,2 C40,2 47,8 50,18 C53,8 60,2 70,2 C84,2 96,12 96,28 C96,46 80,66 50,88 Z');}
        .img-hexagono{clip-path:polygon(25% 5%,75% 5%,98% 50%,75% 95%,25% 95%,2% 50%);}
        .marco-clasico{border:6px solid #F7E7CE;box-shadow:0 0 0 2px #DC143C,0 8px 22px rgba(0,0,0,.4);}
        .marco-vintage{filter:sepia(.3) saturate(1.2);border:8px double #722F37;}
        .marco-moderno{box-shadow:0 0 0 4px #DC143C,0 10px 30px rgba(220,20,60,.5);}
        .marco-ninguno{box-shadow:0 6px 20px rgba(0,0,0,.4);}
        [x-cloak]{display:none!important;}
    </style>
</head>
<body class="romance-bg" x-data="{opened:false,open(){this.opened=true;window.fxCelebrar?.('amor');setTimeout(()=>window.dispatchEvent(new CustomEvent('tpl-carta-abierta')),900);}}">
    @include('mensajes.partials.efectos', ['tema' => 'amor'])

    {{-- Corazones cayendo --}}
    @for($i=0;$i<15;$i++)
        <span class="heart" style="left:{{ random_int(0,100) }}%;animation-duration:{{ random_int(8,16) }}s;animation-delay:{{ random_int(0,12) }}s;" aria-hidden="true">
            <svg width="{{ random_int(14,28) }}" height="{{ random_int(14,28) }}" viewBox="0 0 24 24" fill="{{ ['#DC143C','#E91E63','#F7E7CE'][random_int(0,2)] }}"><path d="M12 21s-7-4.5-9.5-9C.8 8.5 3 4 7 4c2 0 3.5 1 5 3 1.5-2 3-3 5-3 4 0 6.2 4.5 4.5 8-2.5 4.5-9.5 9-9.5 9z"/></svg>
        </span>
    @endfor

    {{-- Pétalos rojos --}}
    @for($i=0;$i<10;$i++)
        <span class="petal-r" style="left:{{ random_int(0,100) }}%;animation-duration:{{ random_int(10,18) }}s;animation-delay:{{ random_int(0,10) }}s;" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 22 22"><ellipse cx="11" cy="11" rx="6" ry="10" fill="#DC143C" opacity=".75"/></svg>
        </span>
    @endfor

    {{-- Cupido cruzando --}}
    <div class="cupid" aria-hidden="true">
        <svg width="80" height="40" viewBox="0 0 80 40">
            <circle cx="20" cy="20" r="10" fill="#F7E7CE"/>
            <path d="M5,15 Q15,5 25,15" stroke="#F7E7CE" stroke-width="2" fill="none"/>
            <line x1="30" y1="20" x2="78" y2="20" stroke="#722F37" stroke-width="2"/>
            <polygon points="78,20 70,16 70,24" fill="#DC143C"/>
            <polygon points="30,20 36,14 36,26" fill="#DC143C"/>
        </svg>
    </div>

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-8 sm:py-12">
        <header class="text-center mb-6">
            <div class="main-heart inline-block" aria-hidden="true">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="#DC143C"><path d="M12 21s-7-4.5-9.5-9C.8 8.5 3 4 7 4c2 0 3.5 1 5 3 1.5-2 3-3 5-3 4 0 6.2 4.5 4.5 8-2.5 4.5-9.5 9-9.5 9z"/></svg>
            </div>
            <h1 class="vibes text-6xl sm:text-8xl text-[#F7E7CE] mt-2 leading-none drop-shadow-lg">Para Ti</h1>
            <p class="serif italic text-xl sm:text-2xl text-[#F7E7CE]/80 mt-3 tracking-[.3em] uppercase">{{ $mensaje->ocasion->nombre }}</p>
        </header>

        {{-- Caja de regalo --}}
        <section class="relative max-w-xl mx-auto" x-show="!opened">
            <div class="gift-box rounded-md p-10 pt-20 pb-16">
                <div class="ribbon-h" aria-hidden="true"></div>
                <div class="ribbon-v" aria-hidden="true"></div>
                <div class="gift-lid rounded-t-md" :class="opened && 'lid-open'" aria-hidden="true"></div>
                <div class="bow" aria-hidden="true">
                    <svg width="100" height="50" viewBox="0 0 100 50">
                        <ellipse cx="30" cy="25" rx="22" ry="14" fill="#F7E7CE"/>
                        <ellipse cx="70" cy="25" rx="22" ry="14" fill="#F7E7CE"/>
                        <rect x="44" y="18" width="12" height="14" fill="#E0CFAE"/>
                    </svg>
                </div>
                <div class="text-center pt-12">
                    <p class="vibes text-4xl text-[#F7E7CE]">¿Lista para abrir tu regalo?</p>
                    <button @click="open()" class="mt-6 bg-[#F7E7CE] hover:bg-white text-[#722F37] serif italic text-xl px-10 py-4 rounded-full shadow-2xl transition-all hover:scale-105 active:scale-95 tracking-wider">
                        ❤ Abrir el regalo ❤
                    </button>
                </div>
            </div>
        </section>

        {{-- Contenido revelado --}}
        <section x-show="opened" x-cloak
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 scale-75"
                 x-transition:enter-end="opacity-100 scale-100">
            {{-- Bombones grid --}}
            <div class="grid grid-cols-4 gap-3 sm:gap-4 max-w-md mx-auto mb-10">
                @foreach(['🍫','💋','🌹','💝','💋','🍫','💝','🌹'] as $emo)
                    <div class="chocolate">{{ $emo }}</div>
                @endforeach
            </div>

            {{-- Tarjeta romántica --}}
            <article class="romantic-card rounded-md p-8 sm:p-12 max-w-2xl mx-auto">
                @if($mensaje->imagen_path)
                    <figure class="flex justify-center mb-6">
                        <img src="{{ asset('storage/'.$mensaje->imagen_path) }}"
                             alt="Imagen para {{ $mensaje->destinatario }}"
                             class="w-44 h-44 sm:w-52 sm:h-52 object-cover img-{{ $mensaje->imagen_forma ?? 'corazon' }} marco-{{ $mensaje->imagen_marco ?? 'clasico' }}">
                    </figure>
                @endif

                <p class="vibes text-4xl text-center text-[#DC143C]">Mi amor,</p>
                <h2 class="serif italic text-3xl sm:text-4xl text-center text-[#722F37] mt-1 mb-6">{{ $mensaje->destinatario }}</h2>

                <div class="serif text-xl sm:text-2xl leading-relaxed text-center text-[#722F37] italic">
                    {!! $mensaje->mensaje !!}
                </div>

                <div class="mt-8 text-center">
                    <p class="vibes text-3xl text-[#DC143C]">Por siempre tuyo,</p>
                    <p class="serif italic text-2xl text-[#722F37] mt-1">{{ $mensaje->remitente }}</p>
                    <p class="text-xs text-[#722F37]/60 mt-3 tracking-widest uppercase">{{ $mensaje->created_at->format('d · M · Y') }}</p>
                </div>
            </article>
        </section>

        {{-- Código + compartir --}}
        <section class="mt-14 max-w-md mx-auto bg-[#722F37]/60 backdrop-blur border border-[#F7E7CE]/40 rounded-lg p-6 text-center" x-data="{copied:false}">
            <p class="serif italic text-[#F7E7CE]/70 tracking-widest uppercase text-xs mb-2">Código de tu carta</p>
            <p class="vibes text-3xl text-[#F7E7CE] mb-4">{{ $mensaje->code }}</p>
            <button @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,2200)"
                    class="bg-[#DC143C] hover:bg-[#E91E63] text-white serif italic text-lg px-6 py-2.5 rounded-full shadow-lg transition hover:scale-105">
                <span x-show="!copied">❤ Copiar enlace</span>
                <span x-show="copied" x-cloak>✓ ¡Copiado!</span>
            </button>
        </section>

        <footer class="mt-12 text-center text-[#F7E7CE]/60 serif italic text-sm">
            <p>{{ config('app.name') }} &copy; {{ date('Y') }} — hecho con ❤</p>
        </footer>
    </main>

    @include('mensajes.partials.music-player', ['accent' => '#DC143C'])
</body>
</html>
