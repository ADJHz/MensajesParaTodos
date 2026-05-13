{{--
    Avatar generado vía DiceBear (https://www.dicebear.com).
    Licencia: CC0 / MIT — uso comercial libre.
    No requiere instalación: se usa la API HTTP oficial.

    Uso:
        @include('mensajes.partials.dicebear', [
            'seed'   => 'lorena',          // cualquier string (nombre, código...)
            'estilo' => 'adventurer',      // ver lista abajo
            'tamano' => 160,                // px
            'flotante' => true,             // animación de flotación
        ])

    Estilos recomendados para niñas:
        adventurer, big-smile, lorelei, micah, notionists
    Estilos recomendados para niños:
        adventurer, big-smile, fun-emoji, miniavs, pixel-art, croodles
    Estilos genéricos:
        avataaars, bottts (robots), shapes, identicon, thumbs
--}}
@php
    $seed     = $seed ?? '{{ config('app.name') }}';
    $estilo   = $estilo ?? 'adventurer';
    $tamano   = (int) ($tamano ?? 128);
    $flotante = $flotante ?? true;

    // Whitelist de estilos válidos
    $estilosOk = [
        'adventurer','big-smile','fun-emoji','lorelei','micah','miniavs',
        'notionists','open-peeps','pixel-art','croodles','avataaars',
        'bottts','shapes','identicon','thumbs','personas','adventurer-neutral',
    ];
    if (!in_array($estilo, $estilosOk, true)) $estilo = 'adventurer';

    $url = 'https://api.dicebear.com/9.x/' . urlencode($estilo) . '/svg?seed=' . urlencode($seed) . '&size=240&radius=50';
@endphp

<img src="{{ $url }}"
     alt=""
     loading="lazy"
     width="{{ $tamano }}"
     height="{{ $tamano }}"
     class="dicebear-avatar @if($flotante) dicebear-floaty @endif"
     style="width:{{ $tamano }}px;height:{{ $tamano }}px"
     aria-hidden="true">

@once
    <style>
        .dicebear-avatar {
            display: inline-block;
            border-radius: 50%;
            background: rgba(255,255,255,.6);
            box-shadow: 0 8px 22px rgba(0,0,0,.18);
            object-fit: cover;
        }
        @keyframes db-float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        .dicebear-floaty { animation: db-float 3.4s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) { .dicebear-floaty { animation: none; } }
    </style>
@endonce
