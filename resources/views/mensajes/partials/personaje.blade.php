{{--
    Personaje SVG animado por tema. Ideal como avatar del narrador.
    Uso:
        @include('mensajes.partials.personaje', ['tema' => 'princesa', 'tamano' => 'lg'])
    Tamaños: 'sm' (64), 'md' (96), 'lg' (160), 'xl' (220)
--}}
@php
    $tema   = $tema ?? 'princesa';
    $tamano = $tamano ?? 'md';
    $sizes  = ['sm' => 64, 'md' => 96, 'lg' => 160, 'xl' => 220];
    $size   = $sizes[$tamano] ?? 96;
@endphp

<div class="personaje personaje-{{ $tema }}" style="width:{{ $size }}px;height:{{ $size }}px" aria-hidden="true">

    @switch($tema)

        @case('princesa')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                <defs>
                    <linearGradient id="pr-vestido" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#fda4af"/>
                        <stop offset="1" stop-color="#e11d48"/>
                    </linearGradient>
                    <radialGradient id="pr-cara" cx=".5" cy=".4" r=".6">
                        <stop offset="0" stop-color="#fef3c7"/>
                        <stop offset="1" stop-color="#fde68a"/>
                    </radialGradient>
                </defs>
                {{-- corona --}}
                <g class="pr-corona">
                    <path d="M65 50 L80 70 L100 35 L120 70 L135 50 L130 80 L70 80 Z" fill="url(#pr-corona-grad)"/>
                    <defs>
                        <linearGradient id="pr-corona-grad" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0" stop-color="#fde68a"/>
                            <stop offset="1" stop-color="#f59e0b"/>
                        </linearGradient>
                    </defs>
                    <circle cx="65" cy="50" r="4" fill="#f9a8d4"/>
                    <circle cx="100" cy="35" r="4" fill="#fb7185"/>
                    <circle cx="135" cy="50" r="4" fill="#f9a8d4"/>
                    <rect x="68" y="80" width="64" height="6" rx="2" fill="#b45309"/>
                </g>
                {{-- cabello --}}
                <path d="M55 95 Q50 130 60 165 L80 175 Q70 140 80 105 Z" fill="#92400e"/>
                <path d="M145 95 Q150 130 140 165 L120 175 Q130 140 120 105 Z" fill="#92400e"/>
                {{-- cara --}}
                <ellipse cx="100" cy="115" rx="32" ry="38" fill="url(#pr-cara)"/>
                {{-- ojos --}}
                <g class="pr-ojos">
                    <ellipse cx="88" cy="115" rx="3.5" ry="5" fill="#1e3a8a"/>
                    <ellipse cx="112" cy="115" rx="3.5" ry="5" fill="#1e3a8a"/>
                    <circle cx="89" cy="113" r="1.2" fill="#fff"/>
                    <circle cx="113" cy="113" r="1.2" fill="#fff"/>
                </g>
                {{-- mejillas --}}
                <circle cx="80" cy="128" r="5" fill="#fb7185" opacity=".6"/>
                <circle cx="120" cy="128" r="5" fill="#fb7185" opacity=".6"/>
                {{-- boca --}}
                <path d="M92 135 Q100 142 108 135" stroke="#be123c" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- vestido --}}
                <path d="M70 165 Q60 200 40 235 L160 235 Q140 200 130 165 Q115 175 100 175 Q85 175 70 165 Z" fill="url(#pr-vestido)"/>
                <path d="M70 165 Q100 175 130 165 L125 178 Q100 188 75 178 Z" fill="#fbcfe8" opacity=".7"/>
                {{-- estrellitas --}}
                <g class="pr-twinkle">
                    <circle cx="55" cy="200" r="2" fill="#fde68a"/>
                    <circle cx="150" cy="210" r="2.5" fill="#fde68a"/>
                    <circle cx="100" cy="220" r="2" fill="#fff"/>
                </g>
            </svg>
            @break

        @case('superheroe')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- capa --}}
                <path class="sh-capa" d="M50 90 Q30 160 35 230 L100 200 L165 230 Q170 160 150 90 Z" fill="#dc2626"/>
                {{-- cuerpo --}}
                <rect x="70" y="120" width="60" height="90" rx="14" fill="#1d4ed8"/>
                {{-- cinturón --}}
                <rect x="70" y="170" width="60" height="10" fill="#fbbf24"/>
                <circle cx="100" cy="175" r="6" fill="#f59e0b"/>
                {{-- emblema --}}
                <path d="M85 135 L100 160 L115 135 L107 135 L100 148 L93 135 Z" fill="#fbbf24"/>
                {{-- cabeza --}}
                <circle cx="100" cy="95" r="32" fill="#fde68a"/>
                {{-- antifaz --}}
                <path class="sh-mascara" d="M68 88 Q100 75 132 88 L132 102 Q100 110 68 102 Z" fill="#0f172a"/>
                <ellipse cx="88" cy="95" rx="5" ry="3" fill="#fff"/>
                <ellipse cx="112" cy="95" rx="5" ry="3" fill="#fff"/>
                {{-- pelo --}}
                <path d="M70 75 Q100 55 130 75 Q120 65 100 62 Q80 65 70 75 Z" fill="#1e293b"/>
                {{-- sonrisa --}}
                <path d="M90 115 Q100 122 110 115" stroke="#92400e" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- brazos --}}
                <rect x="48" y="130" width="20" height="55" rx="10" fill="#1d4ed8"/>
                <rect x="132" y="130" width="20" height="55" rx="10" fill="#1d4ed8"/>
                <circle cx="58" cy="190" r="10" fill="#fde68a"/>
                <circle cx="142" cy="190" r="10" fill="#fde68a"/>
                {{-- destellos --}}
                <g class="sh-spark">
                    <path d="M30 80 L34 90 L44 92 L34 94 L30 104 L26 94 L16 92 L26 90 Z" fill="#fbbf24"/>
                    <path d="M170 110 L172 116 L178 118 L172 120 L170 126 L168 120 L162 118 L168 116 Z" fill="#fbbf24"/>
                </g>
            </svg>
            @break

        @case('autos')
            <svg viewBox="0 0 240 160" width="100%" height="100%">
                {{-- carretera --}}
                <rect y="120" width="240" height="40" fill="#1e293b"/>
                <g class="ca-rayas">
                    <rect x="0"  y="138" width="20" height="4" fill="#fbbf24"/>
                    <rect x="40" y="138" width="20" height="4" fill="#fbbf24"/>
                    <rect x="80" y="138" width="20" height="4" fill="#fbbf24"/>
                    <rect x="120" y="138" width="20" height="4" fill="#fbbf24"/>
                    <rect x="160" y="138" width="20" height="4" fill="#fbbf24"/>
                    <rect x="200" y="138" width="20" height="4" fill="#fbbf24"/>
                </g>
                {{-- carro --}}
                <g class="ca-coche">
                    <path d="M40 110 L60 70 L160 70 L185 110 Z" fill="#dc2626"/>
                    <rect x="50" y="100" width="140" height="25" rx="6" fill="#b91c1c"/>
                    <rect x="70" y="78" width="40" height="22" rx="3" fill="#bfdbfe" opacity=".8"/>
                    <rect x="115" y="78" width="40" height="22" rx="3" fill="#bfdbfe" opacity=".8"/>
                    <circle cx="75" cy="125" r="13" fill="#0f172a"/>
                    <circle cx="75" cy="125" r="6"  fill="#94a3b8"/>
                    <circle cx="170" cy="125" r="13" fill="#0f172a"/>
                    <circle cx="170" cy="125" r="6"  fill="#94a3b8"/>
                    <rect x="175" y="92" width="12" height="6" rx="2" fill="#fde68a"/>
                </g>
                {{-- humo --}}
                <g class="ca-humo">
                    <circle cx="30" cy="105" r="6" fill="#cbd5e1" opacity=".7"/>
                    <circle cx="20" cy="100" r="5" fill="#cbd5e1" opacity=".5"/>
                    <circle cx="14" cy="108" r="4" fill="#cbd5e1" opacity=".4"/>
                </g>
            </svg>
            @break

        @case('mama')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- pelo --}}
                <path d="M55 95 Q50 145 70 175 L130 175 Q150 145 145 95 Q140 60 100 60 Q60 60 55 95 Z" fill="#92400e"/>
                {{-- cara --}}
                <ellipse cx="100" cy="120" rx="35" ry="42" fill="#fde68a"/>
                {{-- ojos cerrados sonriendo --}}
                <path class="ma-ojo" d="M82 118 Q88 113 94 118" stroke="#1e293b" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                <path class="ma-ojo" d="M106 118 Q112 113 118 118" stroke="#1e293b" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- mejillas --}}
                <circle cx="78" cy="135" r="5" fill="#fb7185" opacity=".6"/>
                <circle cx="122" cy="135" r="5" fill="#fb7185" opacity=".6"/>
                {{-- boca --}}
                <path d="M88 142 Q100 152 112 142" stroke="#be123c" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- aretes --}}
                <circle cx="62" cy="138" r="3" fill="#ec4899"/>
                <circle cx="138" cy="138" r="3" fill="#ec4899"/>
                {{-- cuerpo --}}
                <path d="M55 175 Q40 210 30 235 L170 235 Q160 210 145 175 Z" fill="#ec4899"/>
                {{-- corazón flotando --}}
                <g class="ma-heart">
                    <path d="M170 50 C167 47 162 47 160 50 C158 47 153 47 150 50 C146 55 152 62 160 70 C168 62 174 55 170 50 Z" fill="#dc2626"/>
                </g>
            </svg>
            @break

        @case('papa')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- sombrero --}}
                <ellipse cx="100" cy="65" rx="48" ry="6" fill="#0f172a"/>
                <rect x="72" y="42" width="56" height="22" rx="3" fill="#0f172a"/>
                <rect x="70" y="58" width="60" height="6" fill="#fbbf24"/>
                {{-- cara --}}
                <ellipse cx="100" cy="115" rx="34" ry="40" fill="#fde68a"/>
                {{-- ojos --}}
                <ellipse cx="88" cy="113" rx="3" ry="4" fill="#1e293b"/>
                <ellipse cx="112" cy="113" rx="3" ry="4" fill="#1e293b"/>
                {{-- bigote --}}
                <path d="M82 130 Q90 138 100 132 Q110 138 118 130 Q110 142 100 138 Q90 142 82 130 Z" fill="#1e293b"/>
                {{-- sonrisa --}}
                <path d="M90 145 Q100 152 110 145" stroke="#92400e" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- cuerpo + camisa --}}
                <path d="M55 165 Q45 220 50 235 L150 235 Q155 220 145 165 Z" fill="#1e3a8a"/>
                {{-- corbata --}}
                <polygon points="92,165 108,165 110,175 100,225 90,175" fill="#dc2626"/>
                <polygon points="95,175 105,175 100,182" fill="#991b1b"/>
                {{-- destello --}}
                <g class="pa-spark">
                    <path d="M170 90 L173 99 L182 102 L173 105 L170 114 L167 105 L158 102 L167 99 Z" fill="#fbbf24"/>
                </g>
            </svg>
            @break

        @case('amor')
            <svg viewBox="0 0 200 200" width="100%" height="100%">
                <defs>
                    <linearGradient id="am-grad" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#fb7185"/>
                        <stop offset="1" stop-color="#be123c"/>
                    </linearGradient>
                </defs>
                <g class="am-heart">
                    <path d="M100 175 C60 145 20 110 20 70 C20 45 40 30 60 30 C80 30 95 42 100 60 C105 42 120 30 140 30 C160 30 180 45 180 70 C180 110 140 145 100 175 Z" fill="url(#am-grad)"/>
                    <ellipse cx="65" cy="60" rx="12" ry="8" fill="#fff" opacity=".4"/>
                </g>
                <g class="am-spark">
                    <circle cx="40" cy="40" r="3" fill="#fbbf24"/>
                    <circle cx="160" cy="50" r="3" fill="#fbbf24"/>
                    <circle cx="170" cy="120" r="2" fill="#fff"/>
                </g>
            </svg>
            @break

        @case('cumpleanos')
        @case('dia-nino')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- pastel base --}}
                <rect x="40" y="160" width="120" height="50" rx="6" fill="#fbcfe8"/>
                <rect x="40" y="160" width="120" height="10" fill="#f472b6"/>
                <rect x="55" y="120" width="90" height="45" rx="6" fill="#fde68a"/>
                <rect x="55" y="120" width="90" height="8" fill="#f59e0b"/>
                {{-- crema goteando --}}
                <path d="M40 170 q10 14 20 0 q10 14 20 0 q10 14 20 0 q10 14 20 0 q10 14 20 0 q10 14 20 0" fill="none" stroke="#f472b6" stroke-width="6"/>
                {{-- velas --}}
                <rect x="78" y="100" width="6" height="20" fill="#60a5fa"/>
                <rect x="97" y="95"  width="6" height="25" fill="#fb7185"/>
                <rect x="116" y="100" width="6" height="20" fill="#34d399"/>
                <g class="cu-llama">
                    <ellipse cx="81"  cy="95" rx="4" ry="7" fill="#fbbf24"/>
                    <ellipse cx="100" cy="89" rx="4" ry="8" fill="#fbbf24"/>
                    <ellipse cx="119" cy="95" rx="4" ry="7" fill="#fbbf24"/>
                </g>
                {{-- chispas --}}
                <g class="cu-chispas">
                    <circle cx="40" cy="60" r="3" fill="#f472b6"/>
                    <circle cx="160" cy="70" r="3" fill="#60a5fa"/>
                    <circle cx="30" cy="40" r="2" fill="#34d399"/>
                    <circle cx="170" cy="50" r="2" fill="#fbbf24"/>
                </g>
            </svg>
            @break

        @case('navidad')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- árbol --}}
                <polygon points="100,20 60,90 80,90 50,150 80,150 35,210 165,210 120,150 150,150 120,90 140,90" fill="#16a34a"/>
                <rect x="85" y="210" width="30" height="20" fill="#92400e"/>
                {{-- estrella --}}
                <g class="na-star">
                    <path d="M100 8 L105 22 L120 22 L108 31 L113 45 L100 36 L87 45 L92 31 L80 22 L95 22 Z" fill="#fde68a"/>
                </g>
                {{-- esferas --}}
                <circle cx="80" cy="100" r="6" fill="#dc2626"/>
                <circle cx="120" cy="120" r="6" fill="#3b82f6"/>
                <circle cx="70" cy="160" r="6" fill="#fbbf24"/>
                <circle cx="130" cy="170" r="6" fill="#ec4899"/>
                {{-- nieve --}}
                <g class="na-nieve">
                    <circle cx="30" cy="50" r="2.5" fill="#fff"/>
                    <circle cx="170" cy="80" r="2" fill="#fff"/>
                    <circle cx="20" cy="180" r="2.5" fill="#fff"/>
                    <circle cx="180" cy="200" r="2" fill="#fff"/>
                </g>
            </svg>
            @break

        @case('graduacion')
            <svg viewBox="0 0 200 200" width="100%" height="100%">
                <ellipse cx="100" cy="180" rx="55" ry="6" fill="#0f172a" opacity=".3"/>
                {{-- birrete --}}
                <polygon points="100,30 180,70 100,110 20,70" fill="#1e293b"/>
                <path d="M40 80 v22 q60 35 120 0 v-22" fill="#0f172a"/>
                <line x1="140" y1="78" x2="155" y2="135" stroke="#fbbf24" stroke-width="3"/>
                <circle cx="155" cy="138" r="6" fill="#fbbf24" class="gr-borla"/>
                {{-- diploma --}}
                <g class="gr-diploma">
                    <rect x="55" y="130" width="90" height="50" rx="3" fill="#fef3c7" stroke="#fbbf24" stroke-width="2"/>
                    <line x1="65" y1="145" x2="135" y2="145" stroke="#92400e" stroke-width="1.5"/>
                    <line x1="65" y1="155" x2="135" y2="155" stroke="#92400e" stroke-width="1.5"/>
                    <line x1="65" y1="165" x2="115" y2="165" stroke="#92400e" stroke-width="1.5"/>
                </g>
            </svg>
            @break

        @case('quinceanera')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- vestido grande --}}
                <path d="M55 130 Q40 200 25 235 L175 235 Q160 200 145 130 Q120 145 100 145 Q80 145 55 130 Z" fill="#f9a8d4"/>
                <path d="M55 130 Q100 145 145 130 L140 145 Q100 158 60 145 Z" fill="#fbcfe8"/>
                {{-- corona --}}
                <g class="qu-corona">
                    <path d="M65 50 L82 70 L100 35 L118 70 L135 50 L130 80 L70 80 Z" fill="#fde68a" stroke="#f59e0b"/>
                    <circle cx="100" cy="35" r="5" fill="#ec4899"/>
                </g>
                {{-- cabeza --}}
                <ellipse cx="100" cy="115" rx="30" ry="36" fill="#fde68a"/>
                <ellipse cx="88" cy="115" rx="3" ry="4" fill="#1e3a8a"/>
                <ellipse cx="112" cy="115" rx="3" ry="4" fill="#1e3a8a"/>
                <path d="M90 132 Q100 140 110 132" stroke="#be123c" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- pelo --}}
                <path d="M68 95 Q72 130 80 145 L70 145 Q60 125 65 95 Z" fill="#92400e"/>
                <path d="M132 95 Q128 130 120 145 L130 145 Q140 125 135 95 Z" fill="#92400e"/>
                {{-- destellos --}}
                <g class="qu-spark">
                    <path d="M30 110 L33 117 L40 120 L33 123 L30 130 L27 123 L20 120 L27 117 Z" fill="#fde68a"/>
                    <path d="M170 130 L172 137 L179 140 L172 143 L170 150 L168 143 L161 140 L168 137 Z" fill="#fde68a"/>
                </g>
            </svg>
            @break

        @case('abuelo')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- pelo blanco --}}
                <ellipse cx="100" cy="85" rx="46" ry="22" fill="#e5e7eb"/>
                {{-- cara --}}
                <ellipse cx="100" cy="115" rx="36" ry="42" fill="#fde68a"/>
                {{-- gafas --}}
                <circle cx="86" cy="115" r="9" fill="none" stroke="#1e293b" stroke-width="2"/>
                <circle cx="114" cy="115" r="9" fill="none" stroke="#1e293b" stroke-width="2"/>
                <line x1="95" y1="115" x2="105" y2="115" stroke="#1e293b" stroke-width="2"/>
                {{-- bigote blanco --}}
                <path d="M82 138 Q90 144 100 140 Q110 144 118 138 Q110 148 100 145 Q90 148 82 138 Z" fill="#e5e7eb"/>
                {{-- sonrisa --}}
                <path d="M90 152 Q100 158 110 152" stroke="#92400e" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- camisa --}}
                <path d="M55 175 Q50 220 55 235 L145 235 Q150 220 145 175 Z" fill="#a16207"/>
                {{-- pipa --}}
                <g class="ab-humo">
                    <circle cx="142" cy="148" r="3" fill="#cbd5e1" opacity=".7"/>
                    <circle cx="148" cy="140" r="3" fill="#cbd5e1" opacity=".5"/>
                    <circle cx="155" cy="130" r="3" fill="#cbd5e1" opacity=".4"/>
                </g>
            </svg>
            @break

        {{-- ═══════════ PERSONAJES ORIGINALES PARA PEQUES ═══════════ --}}
        {{-- Inspirados en arquetipos clásicos pero diseño 100% original (sin IP) --}}

        @case('princesa-hielo')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                <defs>
                    <linearGradient id="ph-vestido" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#bae6fd"/>
                        <stop offset="1" stop-color="#0284c7"/>
                    </linearGradient>
                </defs>
                {{-- copos alrededor --}}
                <g class="ph-nieve">
                    <text x="30"  y="50"  font-size="14" fill="#e0f2fe">❄</text>
                    <text x="160" y="60"  font-size="12" fill="#bae6fd">❄</text>
                    <text x="20"  y="180" font-size="10" fill="#e0f2fe">❄</text>
                    <text x="170" y="190" font-size="14" fill="#bae6fd">❄</text>
                </g>
                {{-- pelo trenza lateral plateado --}}
                <path d="M55 90 Q50 140 70 175 L78 200 L72 230 L60 220 Q40 170 50 90 Z" fill="#e2e8f0"/>
                <circle cx="68" cy="180" r="6" fill="#cbd5e1"/>
                <circle cx="71" cy="195" r="6" fill="#cbd5e1"/>
                <circle cx="74" cy="210" r="6" fill="#cbd5e1"/>
                {{-- corona de hielo --}}
                <g class="ph-corona">
                    <path d="M70 75 L82 55 L92 70 L100 45 L108 70 L118 55 L130 75 Z" fill="#bfdbfe" stroke="#3b82f6" stroke-width="1.5"/>
                    <circle cx="100" cy="48" r="3" fill="#dbeafe"/>
                </g>
                {{-- cara --}}
                <ellipse cx="100" cy="115" rx="32" ry="38" fill="#fef3c7"/>
                {{-- ojos azules --}}
                <ellipse class="ph-ojos" cx="88" cy="115" rx="3.5" ry="5" fill="#1e40af"/>
                <ellipse class="ph-ojos" cx="112" cy="115" rx="3.5" ry="5" fill="#1e40af"/>
                <circle cx="89" cy="113" r="1.2" fill="#fff"/>
                <circle cx="113" cy="113" r="1.2" fill="#fff"/>
                <circle cx="80" cy="128" r="5" fill="#7dd3fc" opacity=".5"/>
                <circle cx="120" cy="128" r="5" fill="#7dd3fc" opacity=".5"/>
                <path d="M92 138 Q100 144 108 138" stroke="#1e3a8a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- vestido brillante --}}
                <path d="M70 165 Q60 200 40 235 L160 235 Q140 200 130 165 Q115 175 100 175 Q85 175 70 165 Z" fill="url(#ph-vestido)"/>
                <path d="M70 165 Q100 175 130 165 L125 178 Q100 188 75 178 Z" fill="#e0f2fe" opacity=".8"/>
                {{-- escarchas brillantes --}}
                <g class="ph-spark">
                    <circle cx="60" cy="200" r="2" fill="#fff"/>
                    <circle cx="150" cy="210" r="2.5" fill="#fff"/>
                    <circle cx="100" cy="220" r="2" fill="#bae6fd"/>
                </g>
            </svg>
            @break

        @case('princesa-mar')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                <defs>
                    <linearGradient id="pm-cola" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#5eead4"/>
                        <stop offset="1" stop-color="#0e7490"/>
                    </linearGradient>
                </defs>
                {{-- ondas de fondo --}}
                <g class="pm-burbujas">
                    <circle cx="40" cy="80" r="4" fill="#a5f3fc" opacity=".7"/>
                    <circle cx="160" cy="100" r="6" fill="#67e8f9" opacity=".6"/>
                    <circle cx="30" cy="170" r="3" fill="#a5f3fc" opacity=".7"/>
                    <circle cx="170" cy="180" r="5" fill="#67e8f9" opacity=".5"/>
                </g>
                {{-- cabello rojo flotante --}}
                <path d="M55 95 Q40 140 55 180 L80 175 Q70 140 80 105 Z" fill="#dc2626"/>
                <path d="M145 95 Q160 140 145 180 L120 175 Q130 140 120 105 Z" fill="#dc2626"/>
                <path d="M70 80 Q100 60 130 80 Q120 70 100 70 Q80 70 70 80 Z" fill="#b91c1c"/>
                {{-- cara --}}
                <ellipse cx="100" cy="115" rx="32" ry="38" fill="#fde68a"/>
                <ellipse cx="88" cy="115" rx="3.5" ry="5" fill="#0f766e"/>
                <ellipse cx="112" cy="115" rx="3.5" ry="5" fill="#0f766e"/>
                <circle cx="89" cy="113" r="1.2" fill="#fff"/>
                <circle cx="113" cy="113" r="1.2" fill="#fff"/>
                <circle cx="80" cy="128" r="5" fill="#fb7185" opacity=".6"/>
                <circle cx="120" cy="128" r="5" fill="#fb7185" opacity=".6"/>
                <path d="M92 138 Q100 145 108 138" stroke="#9f1239" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                {{-- top de conchas --}}
                <ellipse cx="88" cy="160" rx="10" ry="8" fill="#a78bfa"/>
                <ellipse cx="112" cy="160" rx="10" ry="8" fill="#a78bfa"/>
                <path d="M83 158 L88 152 L93 158 M107 158 L112 152 L117 158" stroke="#7c3aed" stroke-width="1" fill="none"/>
                {{-- cola de sirena --}}
                <g class="pm-cola">
                    <path d="M80 170 Q70 220 100 230 Q130 220 120 170 Z" fill="url(#pm-cola)"/>
                    <path d="M70 230 Q60 245 50 235 Q70 240 80 220 Z" fill="#0e7490"/>
                    <path d="M130 230 Q140 245 150 235 Q130 240 120 220 Z" fill="#0e7490"/>
                    {{-- escamas --}}
                    <circle cx="90" cy="185" r="3" fill="#22d3ee" opacity=".6"/>
                    <circle cx="110" cy="190" r="3" fill="#22d3ee" opacity=".6"/>
                    <circle cx="100" cy="205" r="3" fill="#22d3ee" opacity=".6"/>
                </g>
            </svg>
            @break

        @case('heroe-aracnido')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- traje rojo y azul (silueta heroica original) --}}
                {{-- piernas azul --}}
                <path d="M75 200 L70 235 L92 235 L96 205 Z" fill="#1d4ed8"/>
                <path d="M125 200 L130 235 L108 235 L104 205 Z" fill="#1d4ed8"/>
                {{-- torso rojo --}}
                <path d="M65 130 Q60 180 75 210 L125 210 Q140 180 135 130 Z" fill="#dc2626"/>
                {{-- patrón de telaraña --}}
                <g stroke="#7f1d1d" stroke-width=".8" fill="none" opacity=".7">
                    <path d="M100 130 v80 M70 145 q30 25 60 0 M65 170 q35 30 70 0 M68 195 q32 20 64 0"/>
                </g>
                {{-- emblema araña --}}
                <ellipse cx="100" cy="160" rx="6" ry="8" fill="#0f172a"/>
                <line x1="94" y1="158" x2="86" y2="152" stroke="#0f172a" stroke-width="1.5"/>
                <line x1="94" y1="162" x2="86" y2="166" stroke="#0f172a" stroke-width="1.5"/>
                <line x1="106" y1="158" x2="114" y2="152" stroke="#0f172a" stroke-width="1.5"/>
                <line x1="106" y1="162" x2="114" y2="166" stroke="#0f172a" stroke-width="1.5"/>
                {{-- brazos --}}
                <path class="ar-brazo-izq" d="M65 135 L40 180 L48 188 L72 145 Z" fill="#dc2626"/>
                <path class="ar-brazo-der" d="M135 135 L160 180 L152 188 L128 145 Z" fill="#dc2626"/>
                {{-- cabeza --}}
                <ellipse cx="100" cy="100" rx="32" ry="36" fill="#dc2626"/>
                {{-- ojos blancos icónicos pero estilizados --}}
                <path class="ar-ojo" d="M75 95 Q82 80 95 90 Q92 102 80 102 Z" fill="#fff" stroke="#0f172a" stroke-width="1"/>
                <path class="ar-ojo" d="M125 95 Q118 80 105 90 Q108 102 120 102 Z" fill="#fff" stroke="#0f172a" stroke-width="1"/>
                {{-- telaraña en cabeza --}}
                <g stroke="#7f1d1d" stroke-width=".7" fill="none" opacity=".6">
                    <path d="M100 70 v60 M75 95 q25 -10 50 0 M75 110 q25 10 50 0"/>
                </g>
                {{-- telaraña lanzada --}}
                <g class="ar-tela" stroke="#fff" stroke-width="1.5" fill="none">
                    <line x1="160" y1="50" x2="135" y2="135"/>
                    <circle cx="160" cy="50" r="3" fill="#fff"/>
                </g>
            </svg>
            @break

        @case('heroe-murcielago')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- luna detrás --}}
                <circle cx="170" cy="50" r="22" fill="#fde68a" opacity=".4"/>
                <circle cx="160" cy="48" r="20" fill="#0f172a"/>
                {{-- capa con picos --}}
                <path class="mu-capa" d="M40 110 L25 230 L60 200 L75 230 L90 200 L100 230 L110 200 L125 230 L140 200 L175 230 L160 110 Z" fill="#0f172a"/>
                {{-- cuerpo --}}
                <rect x="70" y="120" width="60" height="90" rx="12" fill="#1e293b"/>
                {{-- cinturón amarillo --}}
                <rect x="70" y="170" width="60" height="10" fill="#fbbf24"/>
                <rect x="95" y="172" width="10" height="6" fill="#f59e0b"/>
                {{-- emblema murciélago original --}}
                <path d="M75 140 Q90 145 100 140 Q110 145 125 140 Q120 155 110 152 L105 162 L100 155 L95 162 L90 152 Q80 155 75 140 Z" fill="#fbbf24"/>
                {{-- cabeza con orejas largas --}}
                <path d="M68 95 L72 50 L92 80 L108 80 L128 50 L132 95 Q120 110 100 110 Q80 110 68 95 Z" fill="#1e293b"/>
                {{-- mascara con ojos blancos --}}
                <ellipse cx="88" cy="92" rx="6" ry="3" fill="#fff" class="mu-ojo"/>
                <ellipse cx="112" cy="92" rx="6" ry="3" fill="#fff" class="mu-ojo"/>
                {{-- mandíbula --}}
                <path d="M82 105 Q100 120 118 105 Q110 118 100 118 Q90 118 82 105 Z" fill="#fde68a"/>
                <path d="M92 115 Q100 120 108 115" stroke="#0f172a" stroke-width="1.5" fill="none"/>
                {{-- destellos noche --}}
                <g class="mu-spark">
                    <text x="20" y="40" fill="#fff" font-size="10">★</text>
                    <text x="180" y="100" fill="#fff" font-size="8">★</text>
                </g>
            </svg>
            @break

        @case('heroe-verde')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- piernas pantalon roto morado --}}
                <path d="M75 195 L65 235 L92 235 L97 200 Z" fill="#6d28d9"/>
                <path d="M125 195 L135 235 L108 235 L103 200 Z" fill="#6d28d9"/>
                <path d="M65 230 L70 235 L62 238 Z" fill="#6d28d9"/>
                <path d="M135 230 L130 235 L138 238 Z" fill="#6d28d9"/>
                {{-- torso musculoso verde --}}
                <path d="M55 130 Q50 180 75 200 L125 200 Q150 180 145 130 Q120 110 100 110 Q80 110 55 130 Z" fill="#16a34a"/>
                {{-- pectorales --}}
                <path d="M75 140 Q90 155 100 145" stroke="#15803d" stroke-width="2" fill="none"/>
                <path d="M125 140 Q110 155 100 145" stroke="#15803d" stroke-width="2" fill="none"/>
                <path d="M85 165 Q100 175 115 165" stroke="#15803d" stroke-width="2" fill="none"/>
                {{-- brazos enormes --}}
                <ellipse class="vd-brazo" cx="40" cy="160" rx="20" ry="32" fill="#16a34a"/>
                <ellipse class="vd-brazo" cx="160" cy="160" rx="20" ry="32" fill="#16a34a"/>
                <circle cx="35" cy="195" r="14" fill="#16a34a"/>
                <circle cx="165" cy="195" r="14" fill="#16a34a"/>
                {{-- cabeza --}}
                <ellipse cx="100" cy="85" rx="34" ry="32" fill="#16a34a"/>
                {{-- pelo negro alborotado --}}
                <path d="M68 75 Q80 50 100 55 Q120 50 132 75 Q120 65 100 65 Q80 65 68 75 Z" fill="#0f172a"/>
                {{-- ceño fruncido --}}
                <path d="M78 80 L92 78" stroke="#0f172a" stroke-width="3" stroke-linecap="round"/>
                <path d="M122 80 L108 78" stroke="#0f172a" stroke-width="3" stroke-linecap="round"/>
                {{-- ojos --}}
                <ellipse cx="88" cy="88" rx="3" ry="4" fill="#fff"/>
                <ellipse cx="112" cy="88" rx="3" ry="4" fill="#fff"/>
                <circle cx="88" cy="88" r="1.5" fill="#0f172a"/>
                <circle cx="112" cy="88" r="1.5" fill="#0f172a"/>
                {{-- boca/dientes --}}
                <path d="M85 100 L115 100 L113 106 L100 110 L87 106 Z" fill="#0f172a"/>
                <path d="M88 102 L112 102 L110 104 L90 104 Z" fill="#fff"/>
                {{-- impacto --}}
                <g class="vd-impacto">
                    <path d="M20 120 L30 125 L25 130 L35 135 L25 140" stroke="#fbbf24" stroke-width="2" fill="none"/>
                    <path d="M180 120 L170 125 L175 130 L165 135 L175 140" stroke="#fbbf24" stroke-width="2" fill="none"/>
                </g>
            </svg>
            @break

        @case('heroe-velocista')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- estela de velocidad --}}
                <g class="vl-estela">
                    <path d="M10 130 L60 130" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" opacity=".7"/>
                    <path d="M5 150 L55 150" stroke="#facc15" stroke-width="2" stroke-linecap="round" opacity=".5"/>
                    <path d="M15 170 L55 170" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" opacity=".4"/>
                </g>
                {{-- cuerpo rojo --}}
                <path d="M70 130 Q65 180 80 210 L120 210 Q135 180 130 130 Z" fill="#dc2626"/>
                {{-- piernas en movimiento --}}
                <path class="vl-pierna" d="M80 200 L75 230 L92 232 L96 205 Z" fill="#dc2626"/>
                <path d="M120 200 L125 230 L108 232 L104 205 Z" fill="#dc2626"/>
                {{-- emblema rayo --}}
                <path d="M95 145 L88 165 L98 165 L92 185 L112 158 L100 158 L106 145 Z" fill="#fbbf24" stroke="#0f172a" stroke-width="1"/>
                {{-- brazos atrás (correr) --}}
                <path d="M65 140 L40 165 L48 175 L72 150 Z" fill="#dc2626"/>
                <path d="M135 140 L155 175 L148 182 L128 152 Z" fill="#dc2626"/>
                {{-- cabeza con casco --}}
                <ellipse cx="100" cy="100" rx="32" ry="34" fill="#fde68a"/>
                <path d="M68 100 Q70 70 100 65 Q130 70 132 100 Q120 88 100 88 Q80 88 68 100 Z" fill="#dc2626"/>
                {{-- alas en el casco --}}
                <path d="M68 92 L55 80 L70 88 Z" fill="#fbbf24"/>
                <path d="M132 92 L145 80 L130 88 Z" fill="#fbbf24"/>
                {{-- ojos --}}
                <ellipse cx="88" cy="105" rx="3" ry="4" fill="#0f172a"/>
                <ellipse cx="112" cy="105" rx="3" ry="4" fill="#0f172a"/>
                <path d="M90 118 Q100 124 110 118" stroke="#92400e" stroke-width="2" fill="none" stroke-linecap="round"/>
                {{-- chispas de electricidad --}}
                <g class="vl-chispas">
                    <path d="M170 90 L173 96 L180 98 L173 100 L170 106 L167 100 L160 98 L167 96 Z" fill="#fbbf24"/>
                    <path d="M30 200 L33 206 L40 208 L33 210 L30 216 L27 210 L20 208 L27 206 Z" fill="#fbbf24"/>
                </g>
            </svg>
            @break

        @case('dino')
            <svg viewBox="0 0 240 200" width="100%" height="100%">
                {{-- cuerpo --}}
                <ellipse cx="130" cy="130" rx="70" ry="40" fill="#22c55e"/>
                {{-- cuello largo --}}
                <path d="M70 130 Q40 80 65 50 Q90 45 90 80 L80 130 Z" fill="#22c55e"/>
                {{-- cabeza --}}
                <ellipse cx="65" cy="55" rx="22" ry="18" fill="#16a34a"/>
                <circle cx="60" cy="50" r="3" fill="#0f172a"/>
                <circle cx="61" cy="49" r="1" fill="#fff"/>
                <path d="M55 60 Q50 65 48 62" stroke="#0f172a" stroke-width="1.5" fill="none"/>
                {{-- cola --}}
                <path d="M195 130 Q230 110 235 95 Q225 130 200 145 Z" fill="#16a34a"/>
                {{-- patas --}}
                <rect x="100" y="155" width="14" height="35" rx="4" fill="#16a34a"/>
                <rect x="135" y="155" width="14" height="35" rx="4" fill="#16a34a"/>
                <rect x="170" y="155" width="14" height="35" rx="4" fill="#16a34a"/>
                {{-- placas en la espalda --}}
                <g class="dn-placas">
                    <path d="M85 105 L92 92 L99 105 Z" fill="#15803d"/>
                    <path d="M105 95 L114 80 L123 95 Z" fill="#15803d"/>
                    <path d="M130 92 L140 78 L150 92 Z" fill="#15803d"/>
                    <path d="M155 95 L165 82 L175 95 Z" fill="#15803d"/>
                    <path d="M180 105 L188 92 L196 105 Z" fill="#15803d"/>
                </g>
                {{-- vientre --}}
                <ellipse cx="130" cy="145" rx="50" ry="20" fill="#bbf7d0"/>
            </svg>
            @break

        @case('robot')
            <svg viewBox="0 0 200 240" width="100%" height="100%">
                {{-- antena --}}
                <line x1="100" y1="40" x2="100" y2="20" stroke="#94a3b8" stroke-width="3"/>
                <circle class="rb-antena" cx="100" cy="18" r="6" fill="#ef4444"/>
                {{-- cabeza --}}
                <rect x="65" y="40" width="70" height="65" rx="10" fill="#94a3b8"/>
                <rect x="60" y="55" width="80" height="40" rx="6" fill="#cbd5e1"/>
                {{-- ojos LED --}}
                <circle class="rb-ojo" cx="82" cy="75" r="8" fill="#06b6d4"/>
                <circle class="rb-ojo" cx="118" cy="75" r="8" fill="#06b6d4"/>
                <circle cx="82" cy="75" r="3" fill="#fff"/>
                <circle cx="118" cy="75" r="3" fill="#fff"/>
                {{-- boca con LEDs --}}
                <rect x="78" y="92" width="44" height="8" rx="2" fill="#0f172a"/>
                <rect x="82" y="94" width="4" height="4" fill="#fbbf24"/>
                <rect x="90" y="94" width="4" height="4" fill="#22c55e"/>
                <rect x="98" y="94" width="4" height="4" fill="#fbbf24"/>
                <rect x="106" y="94" width="4" height="4" fill="#22c55e"/>
                <rect x="114" y="94" width="4" height="4" fill="#fbbf24"/>
                {{-- cuello --}}
                <rect x="90" y="105" width="20" height="10" fill="#64748b"/>
                {{-- cuerpo --}}
                <rect x="55" y="115" width="90" height="85" rx="8" fill="#94a3b8"/>
                {{-- panel central --}}
                <rect x="80" y="135" width="40" height="50" rx="4" fill="#0f172a"/>
                <circle class="rb-panel" cx="92" cy="150" r="4" fill="#ef4444"/>
                <circle class="rb-panel" cx="108" cy="150" r="4" fill="#22c55e"/>
                <rect x="86" y="165" width="28" height="6" fill="#06b6d4"/>
                <rect x="86" y="175" width="20" height="4" fill="#fbbf24"/>
                {{-- brazos --}}
                <rect x="35" y="125" width="20" height="55" rx="4" fill="#64748b"/>
                <rect x="145" y="125" width="20" height="55" rx="4" fill="#64748b"/>
                <circle cx="45" cy="185" r="10" fill="#cbd5e1"/>
                <circle cx="155" cy="185" r="10" fill="#cbd5e1"/>
                {{-- piernas --}}
                <rect x="70" y="200" width="20" height="35" rx="4" fill="#64748b"/>
                <rect x="110" y="200" width="20" height="35" rx="4" fill="#64748b"/>
                <rect x="65" y="230" width="30" height="8" rx="2" fill="#475569"/>
                <rect x="105" y="230" width="30" height="8" rx="2" fill="#475569"/>
            </svg>
            @break

        @case('cuento')
        @default
            <svg viewBox="0 0 200 200" width="100%" height="100%">
                <defs>
                    <linearGradient id="cu-grad" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#fde68a"/>
                        <stop offset="1" stop-color="#f59e0b"/>
                    </linearGradient>
                </defs>
                {{-- libro --}}
                <g class="cu-libro">
                    <path d="M30 60 Q100 50 100 60 L100 170 Q100 160 30 170 Z" fill="#7c2d12"/>
                    <path d="M170 60 Q100 50 100 60 L100 170 Q100 160 170 170 Z" fill="#7c2d12"/>
                    <path d="M30 60 Q100 50 100 60 L100 170 Q100 160 30 170 Z" fill="#fef3c7"/>
                    <path d="M170 60 Q100 50 100 60 L100 170 Q100 160 170 170 Z" fill="#fef3c7"/>
                    <line x1="100" y1="60" x2="100" y2="170" stroke="#92400e" stroke-width="2"/>
                </g>
                <g class="cu-spark">
                    <path d="M40 30 L43 38 L51 41 L43 44 L40 52 L37 44 L29 41 L37 38 Z" fill="url(#cu-grad)"/>
                    <path d="M160 35 L162 42 L170 45 L162 48 L160 56 L158 48 L150 45 L158 42 Z" fill="url(#cu-grad)"/>
                </g>
            </svg>
            @break

    @endswitch
</div>

@once
<style>
    .personaje { display:inline-block; position:relative; filter: drop-shadow(0 8px 14px rgba(0,0,0,.18)); }

    /* ───── animaciones por tema ───── */
    @keyframes pj-bob   { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
    @keyframes pj-sway  { 0%,100% { transform: rotate(-2deg); } 50% { transform: rotate(2deg); } }
    @keyframes pj-spin  { 0% { transform: rotate(0); } 100% { transform: rotate(360deg); } }
    @keyframes pj-pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.08); } }
    @keyframes pj-blink { 0%,92%,100% { transform: scaleY(1); } 95% { transform: scaleY(.1); } }
    @keyframes pj-floatY { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    @keyframes pj-twinkle { 0%,100% { opacity:.3; transform:scale(.8); } 50% { opacity:1; transform:scale(1.2); } }
    @keyframes pj-flame { 0%,100% { transform: scaleY(1) translateY(0); } 50% { transform: scaleY(1.18) translateY(-2px); } }
    @keyframes pj-drive { 0%,100% { transform: translateX(0); } 25% { transform: translateX(2px) translateY(-1px); } 75% { transform: translateX(-2px) translateY(1px); } }
    @keyframes pj-road  { 0% { transform: translateX(0); } 100% { transform: translateX(-40px); } }
    @keyframes pj-smoke { 0% { opacity:.7; transform: translate(0,0) scale(.5); } 100% { opacity:0; transform: translate(-12px,-12px) scale(1.4); } }

    .personaje { animation: pj-bob 3.4s ease-in-out infinite; }

    .personaje-princesa .pr-corona  { transform-origin: 100px 80px; animation: pj-sway 3.6s ease-in-out infinite; }
    .personaje-princesa .pr-twinkle { animation: pj-twinkle 1.6s ease-in-out infinite; }
    .personaje-princesa .pr-ojos    { transform-origin: 100px 115px; animation: pj-blink 5s infinite; }

    .personaje-superheroe .sh-capa  { transform-origin: 100px 90px; animation: pj-sway 2.6s ease-in-out infinite; }
    .personaje-superheroe .sh-spark { animation: pj-twinkle 1.4s ease-in-out infinite; }

    .personaje-autos { animation: none; }
    .personaje-autos .ca-coche { transform-origin: 100px 100px; animation: pj-drive .35s ease-in-out infinite; }
    .personaje-autos .ca-rayas { animation: pj-road .6s linear infinite; }
    .personaje-autos .ca-humo circle { animation: pj-smoke 1.2s ease-out infinite; }
    .personaje-autos .ca-humo circle:nth-child(2) { animation-delay: .25s; }
    .personaje-autos .ca-humo circle:nth-child(3) { animation-delay: .5s; }

    .personaje-mama .ma-heart { transform-origin: 160px 60px; animation: pj-floatY 2.6s ease-in-out infinite, pj-pulse 1.8s ease-in-out infinite; }

    .personaje-papa .pa-spark { animation: pj-twinkle 1.5s ease-in-out infinite; }

    .personaje-amor { animation: pj-pulse 1.4s ease-in-out infinite; }
    .personaje-amor .am-spark { animation: pj-twinkle 1.6s ease-in-out infinite; }

    .personaje-cumpleanos .cu-llama ellipse,
    .personaje-dia-nino   .cu-llama ellipse { transform-origin: center bottom; animation: pj-flame .6s ease-in-out infinite; }
    .personaje-cumpleanos .cu-llama ellipse:nth-child(2),
    .personaje-dia-nino   .cu-llama ellipse:nth-child(2) { animation-delay: .15s; }
    .personaje-cumpleanos .cu-llama ellipse:nth-child(3),
    .personaje-dia-nino   .cu-llama ellipse:nth-child(3) { animation-delay: .3s; }
    .personaje-cumpleanos .cu-chispas circle { animation: pj-twinkle 1.5s ease-in-out infinite; }

    .personaje-navidad .na-star  { transform-origin: 100px 25px; animation: pj-twinkle 1.6s ease-in-out infinite; }
    .personaje-navidad .na-nieve circle { animation: pj-twinkle 2s ease-in-out infinite; }

    .personaje-graduacion .gr-borla   { transform-origin: 155px 138px; animation: pj-sway 1.6s ease-in-out infinite; }
    .personaje-graduacion .gr-diploma { transform-origin: 100px 155px; animation: pj-bob 2.4s ease-in-out infinite; }

    .personaje-quinceanera .qu-corona { transform-origin: 100px 80px; animation: pj-sway 3.4s ease-in-out infinite; }
    .personaje-quinceanera .qu-spark  { animation: pj-twinkle 1.6s ease-in-out infinite; }

    .personaje-abuelo .ab-humo circle { animation: pj-smoke 1.6s ease-out infinite; }
    .personaje-abuelo .ab-humo circle:nth-child(2) { animation-delay: .3s; }
    .personaje-abuelo .ab-humo circle:nth-child(3) { animation-delay: .6s; }

    .personaje-cuento .cu-libro { transform-origin: 100px 110px; animation: pj-bob 3.6s ease-in-out infinite; }
    .personaje-cuento .cu-spark { animation: pj-twinkle 1.6s ease-in-out infinite; }

    /* ───── personajes originales para peques ───── */
    .personaje-princesa-hielo .ph-corona { transform-origin: 100px 75px; animation: pj-sway 3.6s ease-in-out infinite; }
    .personaje-princesa-hielo .ph-spark  { animation: pj-twinkle 1.4s ease-in-out infinite; }
    .personaje-princesa-hielo .ph-nieve text { animation: pj-twinkle 2s ease-in-out infinite; }
    .personaje-princesa-hielo .ph-ojos   { transform-origin: 100px 115px; animation: pj-blink 5s infinite; }

    .personaje-princesa-mar .pm-cola { transform-origin: 100px 175px; animation: pj-sway 2.4s ease-in-out infinite; }
    .personaje-princesa-mar .pm-burbujas circle { animation: pj-floatY 2.6s ease-in-out infinite; }
    .personaje-princesa-mar .pm-burbujas circle:nth-child(2) { animation-delay: .4s; }
    .personaje-princesa-mar .pm-burbujas circle:nth-child(3) { animation-delay: .8s; }

    .personaje-heroe-aracnido { animation: pj-bob 2.4s ease-in-out infinite; }
    .personaje-heroe-aracnido .ar-brazo-izq { transform-origin: 65px 135px; animation: pj-sway 1.8s ease-in-out infinite; }
    .personaje-heroe-aracnido .ar-brazo-der { transform-origin: 135px 135px; animation: pj-sway 1.8s ease-in-out infinite reverse; }
    .personaje-heroe-aracnido .ar-tela      { animation: pj-twinkle 1.2s ease-in-out infinite; }

    .personaje-heroe-murcielago .mu-capa  { transform-origin: 100px 130px; animation: pj-sway 3s ease-in-out infinite; }
    .personaje-heroe-murcielago .mu-ojo   { animation: pj-twinkle 2.5s ease-in-out infinite; }
    .personaje-heroe-murcielago .mu-spark { animation: pj-twinkle 1.4s ease-in-out infinite; }

    .personaje-heroe-verde { animation: pj-pulse 1.6s ease-in-out infinite; }
    .personaje-heroe-verde .vd-brazo    { transform-origin: center; animation: pj-pulse 1.4s ease-in-out infinite; }
    .personaje-heroe-verde .vd-impacto  { animation: pj-twinkle .8s ease-in-out infinite; }

    .personaje-heroe-velocista .vl-estela { animation: pj-twinkle .4s ease-in-out infinite; }
    .personaje-heroe-velocista .vl-pierna { transform-origin: 88px 200px; animation: pj-sway .35s ease-in-out infinite; }
    .personaje-heroe-velocista .vl-chispas { animation: pj-twinkle .8s ease-in-out infinite; }

    .personaje-dino .dn-placas { transform-origin: 130px 100px; animation: pj-bob 2.6s ease-in-out infinite; }

    .personaje-robot .rb-antena { transform-origin: 100px 24px; animation: pj-pulse 1.2s ease-in-out infinite; }
    .personaje-robot .rb-ojo    { animation: pj-twinkle 1.6s ease-in-out infinite; }
    .personaje-robot .rb-panel  { animation: pj-twinkle .9s ease-in-out infinite; }

    @media (prefers-reduced-motion: reduce) {
        .personaje, .personaje * { animation: none !important; }
    }
</style>
@endonce
