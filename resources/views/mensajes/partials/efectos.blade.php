{{--
    Efectos temáticos animados (overlay decorativo).
    Uso:
        @include('mensajes.partials.efectos', ['tema' => 'princesa'])

    Temas soportados:
        princesa, superheroe, autos, cuento, mama, papa, abuelo, amistad,
        hermano, amor, cumpleanos, graduacion, navidad, ano-nuevo,
        quinceanera, dia-nino, hearts
--}}
@php
    $tema = $tema ?? 'hearts';
    $celebra = in_array($tema, ['cumpleanos','ano-nuevo','quinceanera','graduacion']);

    // Resolver origen del personaje desde la variable global $mensaje (si existe)
    $mensajeActual = $mensaje ?? ($mensajePlat ?? null);
    $personajeOrigen = $mensajeActual->personaje_origen ?? 'tema';
    $personajeUrl    = ($personajeOrigen === 'custom' && !empty($mensajeActual?->personaje_path))
        ? \Illuminate\Support\Facades\Storage::url($mensajeActual->personaje_path)
        : null;
    $personajeEstilo = $mensajeActual->personaje_estilo ?? 'adventurer';
    $personajeSeed   = $mensajeActual->personaje_seed   ?? ($mensajeActual->destinatario ?? '{{ config('app.name') }}');
@endphp

{{-- Canvas tsParticles (motor JS rico) --}}
<div class="fx-particles" data-fx-tema="{{ $tema }}" @if($celebra) data-fx-celebrate @endif aria-hidden="true"></div>

{{-- Halo radial decorativo según tema --}}
<div class="fx-halo fx-halo-{{ $tema }}" aria-hidden="true"></div>

{{-- Sticker decorativo (personaje SVG / DiceBear / custom) en esquina --}}
@if($personajeOrigen !== 'ninguno' && !in_array($tema, ['hearts']))
    <div class="fx-sticker fx-sticker-{{ $tema }}" aria-hidden="true">
        @if($personajeOrigen === 'custom' && $personajeUrl)
            <img src="{{ $personajeUrl }}" alt="" loading="lazy" class="fx-sticker-img">
        @elseif($personajeOrigen === 'dicebear')
            @include('mensajes.partials.dicebear', [
                'seed'   => $personajeSeed,
                'estilo' => $personajeEstilo,
                'tamano' => 200,
                'flotante' => true,
            ])
        @else
            @include('mensajes.partials.personaje', ['tema' => $tema, 'tamano' => 'xl'])
        @endif
    </div>
@endif

{{-- Editor de intensidad de efectos (botón flotante) --}}
@include('mensajes.partials.intensidad')

<div class="fx-overlay" aria-hidden="true">

    {{-- ═════════════ SVG SHARED DEFS (princesa, sparkles, etc.) ═════════════ --}}
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            {{-- Corona --}}
            <symbol id="fx-crown" viewBox="0 0 64 64">
                <path d="M6 22 L18 36 L32 14 L46 36 L58 22 L54 50 L10 50 Z"
                      fill="url(#fx-crown-grad)" stroke="#b45309" stroke-width="1.5"/>
                <circle cx="6" cy="22" r="3" fill="#fde68a"/>
                <circle cx="32" cy="14" r="3" fill="#f472b6"/>
                <circle cx="58" cy="22" r="3" fill="#fde68a"/>
                <rect x="14" y="50" width="36" height="6" rx="2" fill="#b45309"/>
                <linearGradient id="fx-crown-grad" x1="0" x2="0" y1="0" y2="1">
                    <stop offset="0" stop-color="#fde68a"/>
                    <stop offset="1" stop-color="#f59e0b"/>
                </linearGradient>
            </symbol>

            {{-- Pétalo / rosa --}}
            <symbol id="fx-petalo" viewBox="0 0 32 32">
                <path d="M16 2 C24 8, 28 16, 16 30 C4 16, 8 8, 16 2 Z" fill="url(#fx-petalo-grad)"/>
                <linearGradient id="fx-petalo-grad" x1="0" x2="1" y1="0" y2="1">
                    <stop offset="0" stop-color="#fda4af"/>
                    <stop offset="1" stop-color="#e11d48"/>
                </linearGradient>
            </symbol>

            <symbol id="fx-rosa" viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="10" fill="#e11d48"/>
                <circle cx="24" cy="24" r="6" fill="#fb7185"/>
                <circle cx="24" cy="24" r="3" fill="#fecaca"/>
                <path d="M14 30 q-6 4 -10 0 q4 -6 10 0" fill="#16a34a"/>
                <path d="M34 30 q6 4 10 0 q-4 -6 -10 0" fill="#16a34a"/>
            </symbol>

            {{-- Estrella --}}
            <symbol id="fx-star" viewBox="0 0 24 24">
                <path d="M12 1 L15 9 L23 9 L17 14 L19 22 L12 17 L5 22 L7 14 L1 9 L9 9 Z"
                      fill="#fde68a" stroke="#f59e0b" stroke-width="0.5"/>
            </symbol>

            {{-- Rayo --}}
            <symbol id="fx-bolt" viewBox="0 0 24 24">
                <path d="M13 2 L4 14 L10 14 L8 22 L20 9 L13 9 Z"
                      fill="#fbbf24" stroke="#d97706" stroke-width="0.7"/>
            </symbol>

            {{-- Corazón --}}
            <symbol id="fx-heart" viewBox="0 0 24 24">
                <path d="M12 21 C7 17 2 13 2 8 C2 5 4 3 7 3 C9 3 11 4 12 6 C13 4 15 3 17 3 C20 3 22 5 22 8 C22 13 17 17 12 21 Z"
                      fill="url(#fx-heart-grad)"/>
                <linearGradient id="fx-heart-grad" x1="0" x2="0" y1="0" y2="1">
                    <stop offset="0" stop-color="#fb7185"/>
                    <stop offset="1" stop-color="#be123c"/>
                </linearGradient>
            </symbol>

            {{-- Globo --}}
            <symbol id="fx-balloon" viewBox="0 0 32 48">
                <ellipse cx="16" cy="16" rx="13" ry="15" fill="url(#fx-balloon-grad)"/>
                <path d="M16 31 L14 35 L18 35 Z" fill="#475569"/>
                <path d="M16 35 Q12 40 16 44 Q20 40 16 47" stroke="#475569" stroke-width="0.8" fill="none"/>
                <ellipse cx="11" cy="11" rx="3" ry="4" fill="rgba(255,255,255,.55)"/>
                <linearGradient id="fx-balloon-grad" x1="0" x2="1" y1="0" y2="1">
                    <stop offset="0" stop-color="var(--bal1, #f472b6)"/>
                    <stop offset="1" stop-color="var(--bal2, #db2777)"/>
                </linearGradient>
            </symbol>

            {{-- Copo de nieve --}}
            <symbol id="fx-copo" viewBox="0 0 24 24">
                <g stroke="#e0f2fe" stroke-width="1.4" stroke-linecap="round" fill="none">
                    <line x1="12" y1="2" x2="12" y2="22"/>
                    <line x1="2"  y1="12" x2="22" y2="12"/>
                    <line x1="5"  y1="5"  x2="19" y2="19"/>
                    <line x1="19" y1="5"  x2="5"  y2="19"/>
                </g>
            </symbol>

            {{-- Birrete --}}
            <symbol id="fx-birrete" viewBox="0 0 48 32">
                <polygon points="24,2 46,12 24,22 2,12" fill="#1e293b"/>
                <path d="M10 14 v8 q14 8 28 0 v-8" fill="#0f172a"/>
                <line x1="32" y1="13" x2="38" y2="26" stroke="#fbbf24" stroke-width="2"/>
                <circle cx="38" cy="27" r="3" fill="#fbbf24"/>
            </symbol>

            {{-- Corbata --}}
            <symbol id="fx-tie" viewBox="0 0 32 48">
                <polygon points="10,2 22,2 24,8 16,46 8,8" fill="#1d4ed8"/>
                <polygon points="13,8 19,8 16,16" fill="#1e3a8a"/>
            </symbol>

            {{-- Sombrero --}}
            <symbol id="fx-hat" viewBox="0 0 48 32">
                <ellipse cx="24" cy="26" rx="22" ry="4" fill="#0f172a"/>
                <rect x="14" y="6" width="20" height="20" rx="2" fill="#0f172a"/>
                <rect x="13" y="20" width="22" height="3" fill="#fbbf24"/>
            </symbol>
        </defs>
    </svg>

    {{-- ═════════════════════════ TEMA: PRINCESA ════════════════════════════ --}}
    @if($tema === 'princesa')
        <div class="fx-castle">
            <svg viewBox="0 0 200 110" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="cg" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#fbcfe8"/>
                        <stop offset="1" stop-color="#f9a8d4" stop-opacity=".5"/>
                    </linearGradient>
                </defs>
                <path d="M0 110 V70 H20 V40 L30 30 L40 40 V70 H60 V20 L72 8 L84 20 V70 H120 V20 L132 8 L144 20 V70 H170 V40 L180 30 L190 40 V70 H200 V110 Z"
                      fill="url(#cg)"/>
                <polygon points="30,30 30,18 35,18 35,28" fill="#ec4899"/>
                <polygon points="72,8 72,-2 77,-2 77,6" fill="#ec4899"/>
                <polygon points="132,8 132,-2 137,-2 137,6" fill="#ec4899"/>
                <polygon points="180,30 180,18 185,18 185,28" fill="#ec4899"/>
            </svg>
        </div>

        @for($i = 0; $i < 14; $i++)
            <svg class="fx-petal" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(11,22) }}s;--sz:{{ rand(14,28) }}px;--rot:{{ rand(-180,180) }}deg;">
                <use href="#fx-petalo"/>
            </svg>
        @endfor

        @for($i = 0; $i < 6; $i++)
            <svg class="fx-crown-fly" style="--l:{{ rand(5,95) }}%;--d:{{ rand(0,10) }}s;--dur:{{ rand(14,22) }}s;--sz:{{ rand(20,38) }}px;">
                <use href="#fx-crown"/>
            </svg>
        @endfor

        @for($i = 0; $i < 18; $i++)
            <span class="fx-sparkle" style="left:{{ rand(0,100) }}%;top:{{ rand(0,100) }}%;animation-delay:{{ rand(0,30)/10 }}s;font-size:{{ rand(10,22) }}px;">✨</span>
        @endfor

        @for($i = 0; $i < 5; $i++)
            <svg class="fx-rosa-flot" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,12) }}s;--dur:{{ rand(16,26) }}s;--sz:{{ rand(28,46) }}px;">
                <use href="#fx-rosa"/>
            </svg>
        @endfor

    {{-- ═════════════════════════ TEMA: SUPERHEROE / NIÑO ════════════════════ --}}
    @elseif(in_array($tema, ['superheroe','nino']))
        @for($i = 0; $i < 12; $i++)
            <svg class="fx-bolt-fly" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,8) }}s;--dur:{{ rand(7,14) }}s;--sz:{{ rand(20,42) }}px;">
                <use href="#fx-bolt"/>
            </svg>
        @endfor
        @for($i = 0; $i < 16; $i++)
            <svg class="fx-star-fly" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,10) }}s;--dur:{{ rand(9,18) }}s;--sz:{{ rand(12,28) }}px;">
                <use href="#fx-star"/>
            </svg>
        @endfor
        <div class="fx-comic-pow">¡POW!</div>
        <div class="fx-comic-zap">¡ZAP!</div>

    {{-- ═════════════════════════ TEMA: AUTOS ════════════════════════════════ --}}
    @elseif($tema === 'autos')
        <div class="fx-road-bg"></div>
        @for($i = 0; $i < 5; $i++)
            <span class="fx-auto" style="--top:{{ rand(20,80) }}%;--d:{{ rand(0,10) }}s;--dur:{{ rand(6,12) }}s;font-size:{{ rand(28,52) }}px;">🏎️</span>
        @endfor
        @for($i = 0; $i < 4; $i++)
            <span class="fx-auto fx-auto-rev" style="--top:{{ rand(20,80) }}%;--d:{{ rand(0,8) }}s;--dur:{{ rand(7,14) }}s;font-size:{{ rand(26,46) }}px;">🚗</span>
        @endfor
        @for($i = 0; $i < 8; $i++)
            <span class="fx-flag" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,30)/10 }}s;font-size:{{ rand(18,30) }}px;">🏁</span>
        @endfor

    {{-- ═════════════════════════ TEMA: CUENTO ═══════════════════════════════ --}}
    @elseif($tema === 'cuento')
        @for($i = 0; $i < 6; $i++)
            <span class="fx-cloud" style="--top:{{ rand(5,40) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(28,55) }}s;font-size:{{ rand(40,80) }}px;opacity:{{ rand(40,90)/100 }};">☁️</span>
        @endfor
        @for($i = 0; $i < 10; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(12,22) }}s;font-size:{{ rand(20,36) }}px;">{{ ['🦋','📖','🌟','🌸'][$i % 4] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: MAMÁ ═════════════════════════════════ --}}
    @elseif($tema === 'mama')
        @for($i = 0; $i < 18; $i++)
            <svg class="fx-heart-rise" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,18) }}s;--dur:{{ rand(10,18) }}s;--sz:{{ rand(14,30) }}px;color:#ec4899;">
                <use href="#fx-heart"/>
            </svg>
        @endfor
        @for($i = 0; $i < 10; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(14,24) }}s;font-size:{{ rand(20,34) }}px;">{{ ['🌹','🌸','💐','🌷'][$i % 4] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: PAPÁ ═════════════════════════════════ --}}
    @elseif($tema === 'papa')
        @for($i = 0; $i < 6; $i++)
            <svg class="fx-flota-suave-svg" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,12) }}s;--dur:{{ rand(14,22) }}s;--sz:{{ rand(28,48) }}px;">
                <use href="#fx-tie"/>
            </svg>
        @endfor
        @for($i = 0; $i < 5; $i++)
            <svg class="fx-flota-suave-svg" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(16,26) }}s;--sz:{{ rand(30,50) }}px;">
                <use href="#fx-hat"/>
            </svg>
        @endfor
        @for($i = 0; $i < 8; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(16,26) }}s;font-size:{{ rand(22,36) }}px;">{{ ['👨‍🦱','🛠️','⚽','🎩'][$i % 4] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: ABUELO ═══════════════════════════════ --}}
    @elseif($tema === 'abuelo')
        @for($i = 0; $i < 12; $i++)
            <span class="fx-leaf" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(12,22) }}s;font-size:{{ rand(18,32) }}px;">{{ ['🍂','🍁','🍃'][$i % 3] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: AMISTAD ══════════════════════════════ --}}
    @elseif($tema === 'amistad')
        @for($i = 0; $i < 15; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(12,22) }}s;font-size:{{ rand(22,38) }}px;">{{ ['🤝','🙌','💫','😄','🌈'][$i % 5] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: HERMANO ══════════════════════════════ --}}
    @elseif($tema === 'hermano')
        @for($i = 0; $i < 14; $i++)
            <svg class="fx-star-fly" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,10) }}s;--dur:{{ rand(10,18) }}s;--sz:{{ rand(14,28) }}px;">
                <use href="#fx-star"/>
            </svg>
        @endfor
        @for($i = 0; $i < 8; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(14,22) }}s;font-size:{{ rand(22,36) }}px;">{{ ['🎮','🤜','🤛','⚡'][$i % 4] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: AMOR / PAREJA ════════════════════════ --}}
    @elseif($tema === 'amor')
        @for($i = 0; $i < 24; $i++)
            <svg class="fx-heart-rise" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,18) }}s;--dur:{{ rand(8,16) }}s;--sz:{{ rand(14,32) }}px;">
                <use href="#fx-heart"/>
            </svg>
        @endfor
        @for($i = 0; $i < 6; $i++)
            <svg class="fx-rosa-flot" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(18,28) }}s;--sz:{{ rand(28,46) }}px;">
                <use href="#fx-rosa"/>
            </svg>
        @endfor

    {{-- ═════════════════════════ TEMA: CUMPLEAÑOS ═══════════════════════════ --}}
    @elseif($tema === 'cumpleanos')
        @php
            $balloonColors = [
                ['#fb7185','#e11d48'], ['#60a5fa','#1d4ed8'], ['#34d399','#047857'],
                ['#fbbf24','#d97706'], ['#a78bfa','#6d28d9'], ['#f472b6','#db2777'],
            ];
        @endphp
        @for($i = 0; $i < 12; $i++)
            @php $c = $balloonColors[$i % count($balloonColors)]; @endphp
            <svg class="fx-balloon-rise" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(12,22) }}s;--sz:{{ rand(28,52) }}px;--bal1:{{ $c[0] }};--bal2:{{ $c[1] }};">
                <use href="#fx-balloon"/>
            </svg>
        @endfor
        @for($i = 0; $i < 30; $i++)
            <span class="fx-confetti" style="left:{{ rand(0,100) }}%;background:{{ ['#f472b6','#60a5fa','#fbbf24','#34d399','#a78bfa'][$i % 5] }};animation-delay:{{ rand(0,40)/10 }}s;animation-duration:{{ rand(5,10) }}s;"></span>
        @endfor
        @for($i = 0; $i < 4; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(14,22) }}s;font-size:{{ rand(28,44) }}px;">🎂</span>
        @endfor

    {{-- ═════════════════════════ TEMA: GRADUACIÓN ═══════════════════════════ --}}
    @elseif($tema === 'graduacion')
        @for($i = 0; $i < 10; $i++)
            <svg class="fx-flota-suave-svg" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,12) }}s;--dur:{{ rand(10,18) }}s;--sz:{{ rand(28,52) }}px;">
                <use href="#fx-birrete"/>
            </svg>
        @endfor
        @for($i = 0; $i < 12; $i++)
            <svg class="fx-star-fly" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,10) }}s;--dur:{{ rand(10,18) }}s;--sz:{{ rand(14,26) }}px;">
                <use href="#fx-star"/>
            </svg>
        @endfor
        @for($i = 0; $i < 5; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(14,22) }}s;font-size:{{ rand(26,40) }}px;">🎓</span>
        @endfor

    {{-- ═════════════════════════ TEMA: NAVIDAD ══════════════════════════════ --}}
    @elseif($tema === 'navidad')
        @for($i = 0; $i < 30; $i++)
            <svg class="fx-snow" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(8,16) }}s;--sz:{{ rand(10,24) }}px;">
                <use href="#fx-copo"/>
            </svg>
        @endfor
        @for($i = 0; $i < 6; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(16,26) }}s;font-size:{{ rand(22,38) }}px;">{{ ['🎁','🎄','⭐','🦌'][$i % 4] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: AÑO NUEVO ════════════════════════════ --}}
    @elseif($tema === 'ano-nuevo')
        @for($i = 0; $i < 8; $i++)
            <span class="fx-firework" style="left:{{ rand(10,90) }}%;top:{{ rand(15,70) }}%;animation-delay:{{ rand(0,40)/10 }}s;color:{{ ['#fbbf24','#f472b6','#60a5fa','#34d399'][$i % 4] }};">✦</span>
        @endfor
        @for($i = 0; $i < 30; $i++)
            <span class="fx-confetti" style="left:{{ rand(0,100) }}%;background:{{ ['#fbbf24','#f472b6','#60a5fa','#a78bfa'][$i % 4] }};animation-delay:{{ rand(0,40)/10 }}s;animation-duration:{{ rand(5,10) }}s;"></span>
        @endfor
        @for($i = 0; $i < 6; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(14,22) }}s;font-size:{{ rand(26,42) }}px;">{{ ['🎆','🎇','🥂'][$i % 3] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: QUINCEAÑERA ══════════════════════════ --}}
    @elseif($tema === 'quinceanera')
        @for($i = 0; $i < 5; $i++)
            <svg class="fx-crown-fly" style="--l:{{ rand(5,95) }}%;--d:{{ rand(0,10) }}s;--dur:{{ rand(14,22) }}s;--sz:{{ rand(28,48) }}px;">
                <use href="#fx-crown"/>
            </svg>
        @endfor
        @for($i = 0; $i < 18; $i++)
            <span class="fx-sparkle" style="left:{{ rand(0,100) }}%;top:{{ rand(0,100) }}%;animation-delay:{{ rand(0,30)/10 }}s;font-size:{{ rand(10,22) }}px;">✨</span>
        @endfor
        @for($i = 0; $i < 10; $i++)
            <svg class="fx-petal" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(11,22) }}s;--sz:{{ rand(14,26) }}px;--rot:{{ rand(-180,180) }}deg;">
                <use href="#fx-petalo"/>
            </svg>
        @endfor

    {{-- ═════════════════════════ TEMA: DIA NIÑO ═════════════════════════════ --}}
    @elseif($tema === 'dia-nino')
        @for($i = 0; $i < 10; $i++)
            @php $c = [['#60a5fa','#1d4ed8'],['#fb7185','#e11d48'],['#34d399','#047857'],['#fbbf24','#d97706']][$i % 4]; @endphp
            <svg class="fx-balloon-rise" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,15) }}s;--dur:{{ rand(12,22) }}s;--sz:{{ rand(28,52) }}px;--bal1:{{ $c[0] }};--bal2:{{ $c[1] }};">
                <use href="#fx-balloon"/>
            </svg>
        @endfor
        @for($i = 0; $i < 8; $i++)
            <span class="fx-flota-suave" style="left:{{ rand(0,100) }}%;animation-delay:{{ rand(0,15) }}s;animation-duration:{{ rand(14,22) }}s;font-size:{{ rand(22,38) }}px;">{{ ['🧸','🎈','🎮','🪁'][$i % 4] }}</span>
        @endfor

    {{-- ═════════════════════════ TEMA: HEARTS (default) ═════════════════════ --}}
    @else
        @for($i = 0; $i < 18; $i++)
            <svg class="fx-heart-rise" style="--l:{{ rand(0,100) }}%;--d:{{ rand(0,18) }}s;--dur:{{ rand(10,18) }}s;--sz:{{ rand(14,28) }}px;">
                <use href="#fx-heart"/>
            </svg>
        @endfor
    @endif

</div>

@once
<style>
    /* ───── canvas tsParticles ───── */
    .fx-particles {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }
    .fx-particles canvas { pointer-events: none !important; }

    /* ───── halo radial por tema (capa de luz / atmósfera) ───── */
    .fx-halo {
        position: fixed;
        inset: -10vh;
        z-index: 0;
        pointer-events: none;
        opacity: .85;
        mix-blend-mode: screen;
    }
    .fx-halo-princesa     { background: radial-gradient(ellipse at 20% 25%, rgba(244,114,182,.55), transparent 55%),
                                        radial-gradient(ellipse at 80% 80%, rgba(253,224,71,.4),  transparent 50%); }
    .fx-halo-superheroe   { background: radial-gradient(ellipse at 30% 20%, rgba(251,191,36,.5), transparent 55%),
                                        radial-gradient(ellipse at 75% 80%, rgba(59,130,246,.45), transparent 55%); }
    .fx-halo-autos        { background: radial-gradient(ellipse at 50% 90%, rgba(251,191,36,.45), transparent 60%); }
    .fx-halo-cuento       { background: radial-gradient(ellipse at 20% 20%, rgba(191,219,254,.5), transparent 55%),
                                        radial-gradient(ellipse at 80% 80%, rgba(254,243,199,.45), transparent 55%); }
    .fx-halo-mama         { background: radial-gradient(ellipse at 50% 0%, rgba(244,114,182,.55), transparent 60%),
                                        radial-gradient(ellipse at 50% 100%, rgba(251,207,232,.45), transparent 50%); }
    .fx-halo-papa         { background: radial-gradient(ellipse at 30% 20%, rgba(59,130,246,.45), transparent 55%); }
    .fx-halo-abuelo       { background: radial-gradient(ellipse at 50% 30%, rgba(217,119,6,.4),  transparent 55%); }
    .fx-halo-amistad      { background: radial-gradient(ellipse at 30% 30%, rgba(251,191,36,.45), transparent 55%),
                                        radial-gradient(ellipse at 70% 70%, rgba(96,165,250,.45), transparent 55%); }
    .fx-halo-hermano      { background: radial-gradient(ellipse at 50% 50%, rgba(239,68,68,.4), transparent 55%); }
    .fx-halo-amor         { background: radial-gradient(ellipse at 50% 50%, rgba(225,29,72,.5),  transparent 55%); }
    .fx-halo-cumpleanos   { background: radial-gradient(ellipse at 30% 30%, rgba(244,114,182,.5), transparent 55%),
                                        radial-gradient(ellipse at 70% 70%, rgba(96,165,250,.5),  transparent 55%); }
    .fx-halo-graduacion   { background: radial-gradient(ellipse at 50% 30%, rgba(251,191,36,.55), transparent 55%); }
    .fx-halo-navidad      { background: radial-gradient(ellipse at 50% 30%, rgba(220,38,38,.45), transparent 55%),
                                        radial-gradient(ellipse at 50% 100%, rgba(22,163,74,.4), transparent 60%); }
    .fx-halo-ano-nuevo    { background: radial-gradient(ellipse at 50% 100%, rgba(251,191,36,.55), transparent 60%); }
    .fx-halo-quinceanera  { background: radial-gradient(ellipse at 50% 30%, rgba(244,114,182,.55), transparent 55%),
                                        radial-gradient(ellipse at 50% 80%, rgba(253,224,71,.45), transparent 55%); }
    .fx-halo-dia-nino     { background: radial-gradient(ellipse at 30% 20%, rgba(96,165,250,.5), transparent 55%),
                                        radial-gradient(ellipse at 70% 80%, rgba(252,165,165,.45), transparent 55%); }
    .fx-halo-hearts       { background: radial-gradient(ellipse at 50% 50%, rgba(244,114,182,.45), transparent 55%); }

    @keyframes fx-halo-breath {
        0%,100% { opacity: .65; transform: scale(1); }
        50%     { opacity: 1;   transform: scale(1.04); }
    }
    .fx-halo { animation: fx-halo-breath 9s ease-in-out infinite; }

    /* ───── sticker decorativo (personaje SVG) ───── */
    .fx-sticker {
        position: fixed;
        z-index: 1;
        pointer-events: none;
        opacity: .9;
    }
    .fx-sticker .personaje { width: clamp(120px, 16vw, 200px) !important; height: auto !important; }
    .fx-sticker-img {
        width: clamp(120px, 16vw, 200px); height: auto;
        border-radius: 18px;
        background: rgba(255,255,255,.6);
        box-shadow: 0 8px 22px rgba(0,0,0,.18);
        animation: fx-sticker-bob 3.4s ease-in-out infinite;
    }
    @keyframes fx-sticker-bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
    /* Ocultar en pantallas pequeñas para no estorbar */
    @media (max-width: 760px) {
        .fx-sticker { display: none; }
    }
    .fx-sticker-princesa     { bottom: 4vh; right: 2vw; }
    .fx-sticker-superheroe   { top: 8vh;    right: 2vw; transform: rotate(-6deg); }
    .fx-sticker-autos        { bottom: 2vh; left: 2vw; }
    .fx-sticker-cuento       { top: 8vh;    left: 2vw; transform: rotate(-4deg); }
    .fx-sticker-mama         { bottom: 4vh; right: 2vw; }
    .fx-sticker-papa         { bottom: 4vh; right: 2vw; }
    .fx-sticker-abuelo       { bottom: 4vh; right: 2vw; }
    .fx-sticker-amistad      { top: 8vh;    right: 2vw; transform: rotate(6deg); }
    .fx-sticker-hermano      { top: 8vh;    right: 2vw; }
    .fx-sticker-amor         { bottom: 4vh; right: 2vw; }
    .fx-sticker-cumpleanos   { bottom: 2vh; right: 2vw; }
    .fx-sticker-graduacion   { bottom: 4vh; right: 2vw; }
    .fx-sticker-navidad      { bottom: 2vh; right: 2vw; }
    .fx-sticker-ano-nuevo    { top: 8vh;    right: 2vw; }
    .fx-sticker-quinceanera  { bottom: 2vh; right: 2vw; }
    .fx-sticker-dia-nino     { bottom: 2vh; right: 2vw; }

    .fx-overlay {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }
    .fx-overlay svg, .fx-overlay span { position: absolute; }

    /* ───── helpers comunes ───── */
    @keyframes fx-fall {
        0%   { transform: translate3d(0, -10vh, 0) rotate(var(--rot,0deg)); opacity: 0; }
        10%  { opacity: 1; }
        100% { transform: translate3d(40px, 110vh, 0) rotate(calc(var(--rot,0deg) + 360deg)); opacity: 0; }
    }
    @keyframes fx-rise {
        0%   { transform: translate3d(0, 110vh, 0) scale(.7); opacity: 0; }
        15%  { opacity: 1; }
        100% { transform: translate3d(20px, -15vh, 0) scale(1); opacity: 0; }
    }
    @keyframes fx-soft-float {
        0%,100% { transform: translateY(0) rotate(-4deg); }
        50%     { transform: translateY(-22px) rotate(4deg); }
    }
    @keyframes fx-sparkle {
        0%,100% { opacity: .25; transform: scale(.7); }
        50%     { opacity: 1;   transform: scale(1.3); }
    }
    @keyframes fx-cross {
        0%   { transform: translateX(-20vw); }
        100% { transform: translateX(120vw); }
    }
    @keyframes fx-cross-rev {
        0%   { transform: translateX(120vw) scaleX(-1); }
        100% { transform: translateX(-20vw) scaleX(-1); }
    }

    /* ───── princesa ───── */
    .fx-castle {
        position: fixed; left: 0; right: 0; bottom: 0; height: 28vh;
        opacity: .55; pointer-events: none;
    }
    .fx-castle svg { position: absolute; inset: 0; width: 100%; height: 100%; }
    .fx-petal {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: -10vh;
        animation: fx-fall var(--dur) linear var(--d) infinite;
    }
    .fx-crown-fly {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: 110vh;
        animation: fx-rise var(--dur) linear var(--d) infinite;
        filter: drop-shadow(0 4px 8px rgba(245,158,11,.4));
    }
    .fx-sparkle { animation: fx-sparkle 1.8s ease-in-out infinite; }
    .fx-rosa-flot {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: 110vh;
        animation: fx-rise var(--dur) ease-in-out var(--d) infinite;
        filter: drop-shadow(0 4px 6px rgba(225,29,72,.35));
    }

    /* ───── superhéroe ───── */
    .fx-bolt-fly {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: 110vh;
        animation: fx-rise var(--dur) ease-in var(--d) infinite;
        filter: drop-shadow(0 0 8px #fbbf24);
    }
    .fx-star-fly {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: 110vh;
        animation: fx-rise var(--dur) linear var(--d) infinite;
        filter: drop-shadow(0 0 6px rgba(251,191,36,.6));
    }
    @keyframes fx-comic {
        0%,100% { transform: scale(.8) rotate(-8deg); opacity: 0; }
        20%,80% { opacity: 1; }
        50%     { transform: scale(1.15) rotate(8deg); }
    }
    .fx-comic-pow, .fx-comic-zap {
        position: fixed;
        font-family: 'Bangers','Baloo 2',cursive;
        font-weight: 900;
        font-size: clamp(40px, 7vw, 78px);
        color: #fbbf24;
        -webkit-text-stroke: 3px #1e293b;
        text-shadow: 4px 4px 0 #1e293b;
        animation: fx-comic 4s ease-in-out infinite;
    }
    .fx-comic-pow { top: 12%; left: 6%; }
    .fx-comic-zap { bottom: 20%; right: 6%; color: #f472b6; animation-delay: 2s; }

    /* ───── autos ───── */
    .fx-road-bg {
        position: fixed; left: 0; right: 0; bottom: 0; height: 14vh;
        background:
            repeating-linear-gradient(90deg, transparent 0 60px, #fbbf24 60px 100px),
            linear-gradient(180deg, transparent 0%, rgba(15,23,42,.15) 100%);
        background-size: 100% 6px, 100% 100%;
        background-position: 0 50%, 0 0;
        background-repeat: repeat-x, no-repeat;
        opacity: .5;
    }
    .fx-auto {
        top: var(--top);
        left: 0;
        animation: fx-cross var(--dur) linear var(--d) infinite;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,.25));
    }
    .fx-auto-rev { animation-name: fx-cross-rev; }
    .fx-flag { animation: fx-sparkle 1.2s ease-in-out infinite; }

    /* ───── flotación suave ───── */
    .fx-flota-suave, .fx-flota-suave-svg {
        top: -10vh;
        animation: fx-fall 18s linear infinite;
    }
    .fx-flota-suave-svg {
        width: var(--sz); height: var(--sz);
        left: var(--l);
        animation: fx-fall var(--dur) linear var(--d) infinite;
    }

    /* ───── corazones ───── */
    .fx-heart-rise {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: 110vh;
        animation: fx-rise var(--dur) ease-in var(--d) infinite;
        filter: drop-shadow(0 4px 6px rgba(225,29,72,.35));
    }

    /* ───── globos ───── */
    .fx-balloon-rise {
        width: var(--sz); height: calc(var(--sz) * 1.5);
        left: var(--l); top: 110vh;
        animation: fx-rise var(--dur) ease-in var(--d) infinite;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,.2));
    }

    /* ───── confeti ───── */
    @keyframes fx-confetti-fall {
        0%   { transform: translateY(-10vh) rotate(0); opacity: 1; }
        100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
    }
    .fx-confetti {
        top: -10vh;
        width: 8px; height: 14px;
        border-radius: 2px;
        animation: fx-confetti-fall linear infinite;
    }

    /* ───── nieve / hojas ───── */
    .fx-snow {
        width: var(--sz); height: var(--sz);
        left: var(--l); top: -10vh;
        animation: fx-fall var(--dur) linear var(--d) infinite;
    }
    .fx-leaf {
        left: var(--l); top: -10vh;
        animation: fx-fall var(--dur) linear var(--d) infinite;
        filter: drop-shadow(0 3px 4px rgba(0,0,0,.15));
    }

    /* ───── año nuevo ───── */
    @keyframes fx-fw {
        0%   { transform: scale(.2); opacity: 0; }
        30%  { opacity: 1; }
        100% { transform: scale(2.4); opacity: 0; }
    }
    .fx-firework {
        font-size: 90px;
        animation: fx-fw 3s ease-out infinite;
        text-shadow: 0 0 30px currentColor, 0 0 60px currentColor;
    }

    /* ───── respeta motion preference ───── */
    @media (prefers-reduced-motion: reduce) {
        .fx-overlay * { animation: none !important; }
    }
</style>
@endonce
