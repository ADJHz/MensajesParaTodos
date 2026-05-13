<?php

namespace App\Helpers\Templates;

class OcasionGroupA
{
    public static function templates(): array
    {
        return [
            'dia-de-las-madres' => [
                ['id'=>'mad-petalos',  'nombre'=>'Pétalos de Rosa',  'emoji'=>'🌸', 'desc'=>'Romántico y delicado',     'bg'=>'from-rose-50 via-pink-50 to-fuchsia-50',   'bar'=>'bg-gradient-to-r from-rose-400 to-pink-500'],
                ['id'=>'mad-jardin',   'nombre'=>'Jardín Florido',   'emoji'=>'💐', 'desc'=>'Como su jardín favorito',  'bg'=>'from-pink-50 via-rose-50 to-amber-50',     'bar'=>'bg-gradient-to-r from-pink-400 to-amber-400'],
                ['id'=>'mad-corazon',  'nombre'=>'Corazón de Mamá',  'emoji'=>'💗', 'desc'=>'El amor más puro',         'bg'=>'from-fuchsia-50 via-pink-50 to-rose-100',  'bar'=>'bg-gradient-to-r from-fuchsia-400 to-rose-500'],
            ],
            'cumple-mama' => [
                ['id'=>'cmama-globos', 'nombre'=>'Globos de Fiesta', 'emoji'=>'🎈', 'desc'=>'Colores y celebración',    'bg'=>'from-sky-50 via-pink-50 to-yellow-50',     'bar'=>'bg-gradient-to-r from-sky-400 to-pink-400'],
                ['id'=>'cmama-pastel', 'nombre'=>'Pastel de Cumple', 'emoji'=>'🎂', 'desc'=>'Tres pisos y muchas velas','bg'=>'from-pink-50 via-amber-50 to-rose-100',    'bar'=>'bg-gradient-to-r from-amber-400 to-rose-400'],
                ['id'=>'cmama-corona', 'nombre'=>'Reina del Día',    'emoji'=>'👑', 'desc'=>'Brillo y elegancia dorada','bg'=>'from-amber-50 via-yellow-50 to-orange-50', 'bar'=>'bg-gradient-to-r from-amber-400 to-yellow-500'],
            ],
            'amor-sin-fecha-mama' => [
                ['id'=>'amama-mariposas',     'nombre'=>'Mariposas',       'emoji'=>'🦋', 'desc'=>'Libertad y ternura',     'bg'=>'from-violet-50 via-pink-50 to-rose-50',    'bar'=>'bg-gradient-to-r from-violet-400 to-pink-400'],
                ['id'=>'amama-jardin-eterno', 'nombre'=>'Jardín Eterno',   'emoji'=>'🌿', 'desc'=>'Naturaleza y calidez',   'bg'=>'from-emerald-50 via-lime-50 to-yellow-50', 'bar'=>'bg-gradient-to-r from-emerald-400 to-lime-400'],
                ['id'=>'amama-acuarela',      'nombre'=>'Acuarela Suave',  'emoji'=>'🎨', 'desc'=>'Arte hecho con amor',    'bg'=>'from-rose-50 via-violet-50 to-sky-50',     'bar'=>'bg-gradient-to-r from-rose-300 to-violet-400'],
            ],
            'dia-del-padre' => [
                ['id'=>'pad-corbata', 'nombre'=>'Caballero Clásico','emoji'=>'👔', 'desc'=>'Elegancia atemporal',      'bg'=>'from-slate-50 via-blue-50 to-slate-100',   'bar'=>'bg-gradient-to-r from-slate-600 to-blue-700'],
                ['id'=>'pad-brujula', 'nombre'=>'Aventurero',       'emoji'=>'🧭', 'desc'=>'Quien marca el rumbo',     'bg'=>'from-stone-50 via-amber-50 to-orange-50',  'bar'=>'bg-gradient-to-r from-amber-600 to-orange-700'],
                ['id'=>'pad-madera',  'nombre'=>'Roble Fuerte',     'emoji'=>'🪵', 'desc'=>'Madera, vintage y temple', 'bg'=>'from-amber-100 via-orange-100 to-yellow-100','bar'=>'bg-gradient-to-r from-amber-700 to-yellow-800'],
            ],
            'cumple-papa' => [
                ['id'=>'cpapa-parrilla',     'nombre'=>'Maestro Parrillero','emoji'=>'🔥', 'desc'=>'Brasas y buen sabor',     'bg'=>'from-orange-50 via-red-50 to-amber-100',   'bar'=>'bg-gradient-to-r from-orange-500 to-red-600'],
                ['id'=>'cpapa-cerveza',      'nombre'=>'Brindis con Papá',  'emoji'=>'🍺', 'desc'=>'Una bien fría a su salud','bg'=>'from-yellow-50 via-amber-50 to-orange-50', 'bar'=>'bg-gradient-to-r from-yellow-500 to-amber-600'],
                ['id'=>'cpapa-herramientas', 'nombre'=>'Manos de Oro',      'emoji'=>'🔧', 'desc'=>'El que arregla todo',     'bg'=>'from-zinc-50 via-blue-50 to-slate-100',    'bar'=>'bg-gradient-to-r from-zinc-600 to-blue-700'],
            ],
        ];
    }

    public static function configs(): array
    {
        return [
            'mad-petalos' => [
                'wrap'=>'background:linear-gradient(135deg,#fff1f2,#fdf2f8,#fae8ff);',
                'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px solid #fecdd3;box-shadow:0 20px 50px rgba(244,63,94,0.15);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fb7185,#e879f9);height:5px;',
                'bc'=>'',
                'tc'=>'#831843','ac'=>'#e11d48','bg'=>'#fff1f2','tx'=>'#9f1239','fc'=>'#be185d',
                'deco'=>'🌸🌹💗',
            ],
            'mad-jardin' => [
                'wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fff1f2,#fffbeb);',
                'card'=>'background:rgba(255,255,255,0.97);border-radius:1.75rem;border:2px solid #fbcfe8;box-shadow:0 18px 45px rgba(236,72,153,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#f472b6,#fbbf24);height:6px;',
                'bc'=>'💐',
                'tc'=>'#9d174d','ac'=>'#db2777','bg'=>'#fdf2f8','tx'=>'#831843','fc'=>'#a16207',
                'deco'=>'🌷🌻🌼',
            ],
            'mad-corazon' => [
                'wrap'=>'background:linear-gradient(135deg,#fae8ff,#fdf2f8,#ffe4e6);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:2.25rem;border:2px solid #f5d0fe;box-shadow:0 22px 55px rgba(217,70,239,0.2);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#e879f9,#f43f5e);height:5px;',
                'bc'=>'💗',
                'tc'=>'#86198f','ac'=>'#c026d3','bg'=>'#fdf4ff','tx'=>'#701a75','fc'=>'#be185d',
                'deco'=>'💗💖💝',
            ],
            'cmama-globos' => [
                'wrap'=>'background:linear-gradient(135deg,#f0f9ff,#fdf2f8,#fefce8);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:1.5rem;border:2px dashed #f9a8d4;box-shadow:0 18px 45px rgba(56,189,248,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#38bdf8,#f472b6,#facc15);height:6px;',
                'bc'=>'🎈',
                'tc'=>'#0c4a6e','ac'=>'#db2777','bg'=>'#f0f9ff','tx'=>'#0369a1','fc'=>'#be185d',
                'deco'=>'🎈🎉🎊',
            ],
            'cmama-pastel' => [
                'wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fffbeb,#ffe4e6);',
                'card'=>'background:rgba(255,255,255,0.97);border-radius:2rem;border:2px solid #fde68a;box-shadow:0 20px 50px rgba(245,158,11,0.2);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fbbf24,#fb7185);height:6px;',
                'bc'=>'🎂',
                'tc'=>'#9a3412','ac'=>'#d97706','bg'=>'#fffbeb','tx'=>'#92400e','fc'=>'#be123c',
                'deco'=>'🎂🕯️🍰',
            ],
            'cmama-corona' => [
                'wrap'=>'background:linear-gradient(135deg,#fffbeb,#fefce8,#fff7ed);',
                'card'=>'background:rgba(255,255,255,0.98);border-radius:2rem;border:3px solid #fbbf24;box-shadow:0 22px 55px rgba(217,119,6,0.25);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fbbf24,#eab308,#fbbf24);height:7px;',
                'bc'=>'👑',
                'tc'=>'#78350f','ac'=>'#b45309','bg'=>'#fffbeb','tx'=>'#92400e','fc'=>'#a16207',
                'deco'=>'👑✨💎',
            ],
            'amama-mariposas' => [
                'wrap'=>'background:linear-gradient(135deg,#f5f3ff,#fdf2f8,#fff1f2);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:2rem;border:2px solid #ddd6fe;box-shadow:0 18px 45px rgba(139,92,246,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#a78bfa,#f472b6);height:5px;',
                'bc'=>'🦋',
                'tc'=>'#5b21b6','ac'=>'#7c3aed','bg'=>'#faf5ff','tx'=>'#6d28d9','fc'=>'#be185d',
                'deco'=>'🦋🌸🌷',
            ],
            'amama-jardin-eterno' => [
                'wrap'=>'background:linear-gradient(135deg,#ecfdf5,#f7fee7,#fefce8);',
                'card'=>'background:rgba(255,255,255,0.97);border-radius:1.75rem;border:2px solid #bbf7d0;box-shadow:0 18px 45px rgba(16,185,129,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#34d399,#a3e635);height:6px;',
                'bc'=>'🌿',
                'tc'=>'#064e3b','ac'=>'#059669','bg'=>'#ecfdf5','tx'=>'#065f46','fc'=>'#854d0e',
                'deco'=>'🌿🌻🍃',
            ],
            'amama-acuarela' => [
                'wrap'=>'background:linear-gradient(135deg,#fff1f2,#f5f3ff,#f0f9ff);',
                'card'=>'background:rgba(255,255,255,0.94);border-radius:2.5rem;border:2px solid #fbcfe8;box-shadow:0 20px 50px rgba(236,72,153,0.15);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fda4af,#c4b5fd,#7dd3fc);height:5px;',
                'bc'=>'',
                'tc'=>'#9f1239','ac'=>'#a855f7','bg'=>'rgba(253,242,248,0.6)','tx'=>'#831843','fc'=>'#7c3aed',
                'deco'=>'🎨🌸💧',
            ],
            'pad-corbata' => [
                'wrap'=>'background:linear-gradient(135deg,#f8fafc,#eff6ff,#f1f5f9);',
                'card'=>'background:rgba(255,255,255,0.98);border-radius:0.75rem;border:2px solid #cbd5e1;box-shadow:0 18px 45px rgba(15,23,42,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#475569,#1d4ed8);height:6px;',
                'bc'=>'👔',
                'tc'=>'#0f172a','ac'=>'#1e3a8a','bg'=>'#f8fafc','tx'=>'#1e293b','fc'=>'#1e40af',
                'deco'=>'👔🎩⌚',
            ],
            'pad-brujula' => [
                'wrap'=>'background:linear-gradient(135deg,#fafaf9,#fffbeb,#fff7ed);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:1rem;border:2px solid #fed7aa;box-shadow:0 18px 45px rgba(180,83,9,0.2);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#d97706,#c2410c);height:6px;',
                'bc'=>'🧭',
                'tc'=>'#78350f','ac'=>'#c2410c','bg'=>'#fffbeb','tx'=>'#7c2d12','fc'=>'#9a3412',
                'deco'=>'🧭🗺️⛰️',
            ],
            'pad-madera' => [
                'wrap'=>'background:linear-gradient(135deg,#fef3c7,#fed7aa,#fde68a);',
                'card'=>'background:linear-gradient(180deg,#fef3c7,#fde68a) , repeating-linear-gradient(90deg,rgba(146,64,14,0.08) 0px,rgba(146,64,14,0.08) 2px,transparent 2px,transparent 14px);background-blend-mode:multiply;border-radius:1rem;border:3px solid #b45309;box-shadow:0 20px 50px rgba(120,53,15,0.3);overflow:hidden;',
                'bar'=>'background:repeating-linear-gradient(90deg,#92400e 0px,#78350f 4px,#92400e 8px);height:8px;',
                'bc'=>'🪵',
                'tc'=>'#451a03','ac'=>'#92400e','bg'=>'rgba(255,251,235,0.85)','tx'=>'#78350f','fc'=>'#a16207',
                'deco'=>'🪵🗝️🔨',
            ],
            'cpapa-parrilla' => [
                'wrap'=>'background:linear-gradient(135deg,#fff7ed,#fef2f2,#fffbeb);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:1.25rem;border:2px solid #fdba74;box-shadow:0 20px 50px rgba(234,88,12,0.22);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#f97316,#dc2626,#f59e0b);height:7px;',
                'bc'=>'🔥',
                'tc'=>'#7c2d12','ac'=>'#dc2626','bg'=>'#fff7ed','tx'=>'#9a3412','fc'=>'#b91c1c',
                'deco'=>'🔥🥩🌭',
            ],
            'cpapa-cerveza' => [
                'wrap'=>'background:linear-gradient(135deg,#fefce8,#fffbeb,#fff7ed);',
                'card'=>'background:rgba(255,255,255,0.97);border-radius:1.5rem;border:2px solid #fde68a;box-shadow:0 18px 45px rgba(202,138,4,0.22);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#eab308,#d97706);height:6px;',
                'bc'=>'🍺',
                'tc'=>'#713f12','ac'=>'#a16207','bg'=>'#fefce8','tx'=>'#854d0e','fc'=>'#92400e',
                'deco'=>'🍺🌾🥨',
            ],
            'cpapa-herramientas' => [
                'wrap'=>'background:linear-gradient(135deg,#f4f4f5,#eff6ff,#f1f5f9);',
                'card'=>'background:rgba(255,255,255,0.97);border-radius:0.75rem;border:2px solid #d4d4d8;box-shadow:0 18px 45px rgba(63,63,70,0.2);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#52525b,#1d4ed8);height:6px;',
                'bc'=>'🔧',
                'tc'=>'#18181b','ac'=>'#1e40af','bg'=>'#fafafa','tx'=>'#27272a','fc'=>'#1e3a8a',
                'deco'=>'🔧🔨⚙️',
            ],
        ];
    }

    public static function svg(): array
    {
        return [
            'mad-petalos' =>
                '<svg style="position:absolute;top:-20px;right:-20px;width:170px;height:170px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M100 40 C120 60 130 80 110 100 C90 80 80 60 100 40 Z" fill="#fb7185"/>'
                .'<path d="M140 70 C150 90 145 115 120 115 C115 95 120 75 140 70 Z" fill="#f472b6"/>'
                .'<path d="M70 80 C55 100 60 125 85 125 C90 105 85 85 70 80 Z" fill="#fbcfe8"/>'
                .'<circle cx="105" cy="105" r="6" fill="#fde68a"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-15px;width:130px;height:130px;opacity:0.45;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M50 150 C60 130 80 130 80 150 C80 165 65 170 50 150 Z" fill="#f9a8d4"/>'
                .'<path d="M90 160 C100 145 115 150 110 165 C105 175 92 175 90 160 Z" fill="#fb7185"/>'
                .'<circle cx="40" cy="170" r="4" fill="#fde68a"/>'
                .'<circle cx="120" cy="155" r="3" fill="#fbbf24"/>'
                .'</svg>',

            'mad-jardin' =>
                '<svg style="position:absolute;top:-10px;right:-10px;width:160px;height:160px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<circle cx="140" cy="60" r="14" fill="#fbbf24"/>'
                .'<ellipse cx="120" cy="50" rx="12" ry="6" fill="#f9a8d4" transform="rotate(-30 120 50)"/>'
                .'<ellipse cx="160" cy="50" rx="12" ry="6" fill="#f9a8d4" transform="rotate(30 160 50)"/>'
                .'<ellipse cx="120" cy="80" rx="12" ry="6" fill="#f9a8d4" transform="rotate(30 120 80)"/>'
                .'<ellipse cx="160" cy="80" rx="12" ry="6" fill="#f9a8d4" transform="rotate(-30 160 80)"/>'
                .'<path d="M140 75 Q140 130 130 170" stroke="#65a30d" stroke-width="3" fill="none"/>'
                .'<path d="M132 110 Q120 105 115 95" stroke="#65a30d" stroke-width="2.5" fill="none"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-10px;width:140px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M50 170 Q40 130 50 100 Q60 130 50 170 Z" fill="#fda4af"/>'
                .'<path d="M70 170 Q60 140 70 115 Q80 140 70 170 Z" fill="#f472b6"/>'
                .'<circle cx="50" cy="100" r="6" fill="#fde047"/>'
                .'<circle cx="70" cy="115" r="6" fill="#fde047"/>'
                .'<path d="M30 175 Q90 175 100 175" stroke="#65a30d" stroke-width="2" fill="none"/>'
                .'</svg>',

            'mad-corazon' =>
                '<svg style="position:absolute;top:-15px;right:-15px;width:170px;height:170px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M120 50 C130 35 155 35 160 55 C165 75 130 95 120 105 C110 95 75 75 80 55 C85 35 110 35 120 50 Z" fill="#e879f9"/>'
                .'<path d="M60 110 C65 100 80 100 82 112 C84 124 65 135 60 140 C55 135 36 124 38 112 C40 100 55 100 60 110 Z" fill="#f472b6"/>'
                .'<path d="M155 130 C158 124 167 124 168 131 C169 138 158 144 155 147 C152 144 141 138 142 131 C143 124 152 124 155 130 Z" fill="#fb7185"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-10px;left:-10px;width:120px;height:120px;opacity:0.4;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M30 60 Q60 30 90 60 T150 60" stroke="#c026d3" stroke-width="2" fill="none"/>'
                .'<path d="M30 90 Q60 60 90 90 T150 90" stroke="#db2777" stroke-width="2" fill="none"/>'
                .'<circle cx="30" cy="60" r="3" fill="#e879f9"/>'
                .'<circle cx="90" cy="60" r="3" fill="#f472b6"/>'
                .'<circle cx="150" cy="60" r="3" fill="#fb7185"/>'
                .'</svg>',

            'cmama-globos' =>
                '<svg style="position:absolute;top:-10px;right:-15px;width:160px;height:180px;opacity:0.6;pointer-events:none;" viewBox="0 0 200 220" fill="none">'
                .'<ellipse cx="60" cy="50" rx="22" ry="28" fill="#fb7185"/>'
                .'<ellipse cx="105" cy="35" rx="22" ry="28" fill="#38bdf8"/>'
                .'<ellipse cx="150" cy="55" rx="22" ry="28" fill="#facc15"/>'
                .'<polygon points="60,78 56,84 64,84" fill="#fb7185"/>'
                .'<polygon points="105,63 101,69 109,69" fill="#38bdf8"/>'
                .'<polygon points="150,83 146,89 154,89" fill="#facc15"/>'
                .'<path d="M60 84 Q65 130 100 200" stroke="#94a3b8" stroke-width="1.5" fill="none"/>'
                .'<path d="M105 69 Q100 130 100 200" stroke="#94a3b8" stroke-width="1.5" fill="none"/>'
                .'<path d="M150 89 Q140 130 100 200" stroke="#94a3b8" stroke-width="1.5" fill="none"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-10px;left:-10px;width:130px;height:130px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<rect x="30" y="40" width="6" height="14" fill="#f472b6" transform="rotate(20 33 47)"/>'
                .'<rect x="60" y="80" width="6" height="14" fill="#facc15" transform="rotate(-30 63 87)"/>'
                .'<rect x="100" y="50" width="6" height="14" fill="#38bdf8" transform="rotate(45 103 57)"/>'
                .'<rect x="140" y="100" width="6" height="14" fill="#a3e635" transform="rotate(-15 143 107)"/>'
                .'<rect x="40" y="130" width="6" height="14" fill="#fb7185" transform="rotate(60 43 137)"/>'
                .'<rect x="120" y="150" width="6" height="14" fill="#c084fc" transform="rotate(-45 123 157)"/>'
                .'<circle cx="80" cy="160" r="4" fill="#fde047"/>'
                .'<circle cx="160" cy="60" r="4" fill="#fb7185"/>'
                .'</svg>',

            'cmama-pastel' =>
                '<svg style="position:absolute;top:-15px;right:-10px;width:170px;height:180px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 220" fill="none">'
                .'<rect x="55" y="120" width="90" height="40" rx="4" fill="#fbbf24"/>'
                .'<rect x="65" y="85" width="70" height="35" rx="4" fill="#fb7185"/>'
                .'<rect x="78" y="55" width="44" height="30" rx="4" fill="#fda4af"/>'
                .'<path d="M55 130 Q70 122 85 130 T115 130 T145 130" stroke="#fff" stroke-width="2" fill="none"/>'
                .'<path d="M65 95 Q78 88 90 95 T115 95 T135 95" stroke="#fff" stroke-width="2" fill="none"/>'
                .'<rect x="98" y="35" width="3" height="20" fill="#f8fafc"/>'
                .'<path d="M99.5 30 Q97 33 99.5 36 Q102 33 99.5 30" fill="#f97316"/>'
                .'<rect x="78" y="42" width="3" height="13" fill="#f8fafc"/>'
                .'<path d="M79.5 38 Q77 40 79.5 43 Q82 40 79.5 38" fill="#f97316"/>'
                .'<rect x="118" y="42" width="3" height="13" fill="#f8fafc"/>'
                .'<path d="M119.5 38 Q117 40 119.5 43 Q122 40 119.5 38" fill="#f97316"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-10px;left:-10px;width:120px;height:120px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<circle cx="40" cy="50" r="5" fill="#fb7185"/>'
                .'<circle cx="80" cy="90" r="5" fill="#fbbf24"/>'
                .'<circle cx="120" cy="60" r="5" fill="#a3e635"/>'
                .'<circle cx="60" cy="140" r="5" fill="#38bdf8"/>'
                .'<circle cx="150" cy="130" r="5" fill="#c084fc"/>'
                .'<circle cx="100" cy="170" r="5" fill="#fb7185"/>'
                .'<circle cx="30" cy="170" r="4" fill="#fde047"/>'
                .'</svg>',

            'cmama-corona' =>
                '<svg style="position:absolute;top:-20px;right:-15px;width:180px;height:160px;opacity:0.6;pointer-events:none;" viewBox="0 0 220 200" fill="none">'
                .'<path d="M40 100 L60 50 L90 90 L110 40 L130 90 L160 50 L180 100 Z" fill="#fbbf24" stroke="#b45309" stroke-width="2"/>'
                .'<rect x="40" y="100" width="140" height="22" fill="#eab308" stroke="#b45309" stroke-width="2"/>'
                .'<circle cx="60" cy="50" r="6" fill="#fb7185"/>'
                .'<circle cx="110" cy="40" r="7" fill="#38bdf8"/>'
                .'<circle cx="160" cy="50" r="6" fill="#a3e635"/>'
                .'<circle cx="80" cy="111" r="5" fill="#f9a8d4"/>'
                .'<circle cx="110" cy="111" r="5" fill="#fef3c7"/>'
                .'<circle cx="140" cy="111" r="5" fill="#f9a8d4"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-15px;width:140px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M40 60 L44 70 L54 70 L46 76 L50 86 L40 80 L30 86 L34 76 L26 70 L36 70 Z" fill="#fbbf24"/>'
                .'<path d="M120 100 L122 105 L127 105 L123 108 L125 113 L120 110 L115 113 L117 108 L113 105 L118 105 Z" fill="#fde047"/>'
                .'<path d="M70 150 L73 156 L80 156 L74 160 L77 167 L70 163 L63 167 L66 160 L60 156 L67 156 Z" fill="#fbbf24"/>'
                .'<circle cx="160" cy="40" r="3" fill="#fde047"/>'
                .'<circle cx="150" cy="160" r="3" fill="#fbbf24"/>'
                .'</svg>',

            'amama-mariposas' =>
                '<svg style="position:absolute;top:-15px;right:-15px;width:170px;height:160px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M100 70 C75 50 55 60 60 80 C65 95 85 95 100 85 Z" fill="#a78bfa"/>'
                .'<path d="M100 70 C125 50 145 60 140 80 C135 95 115 95 100 85 Z" fill="#c4b5fd"/>'
                .'<path d="M100 90 C80 100 65 115 75 130 C85 135 95 120 100 105 Z" fill="#f472b6"/>'
                .'<path d="M100 90 C120 100 135 115 125 130 C115 135 105 120 100 105 Z" fill="#fda4af"/>'
                .'<rect x="98" y="65" width="4" height="65" rx="2" fill="#7c3aed"/>'
                .'<circle cx="100" cy="62" r="4" fill="#7c3aed"/>'
                .'<path d="M97 60 Q92 50 88 50" stroke="#7c3aed" stroke-width="1.5" fill="none"/>'
                .'<path d="M103 60 Q108 50 112 50" stroke="#7c3aed" stroke-width="1.5" fill="none"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-10px;left:-15px;width:140px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M50 120 C40 110 30 115 35 125 C40 132 50 128 55 122 Z" fill="#f9a8d4"/>'
                .'<path d="M50 120 C60 110 70 115 65 125 C60 132 50 128 45 122 Z" fill="#fbcfe8"/>'
                .'<rect x="48" y="118" width="2" height="20" fill="#be185d"/>'
                .'<circle cx="120" cy="60" r="8" fill="#fda4af"/>'
                .'<circle cx="120" cy="60" r="3" fill="#fde047"/>'
                .'<path d="M120 68 Q118 90 120 110" stroke="#65a30d" stroke-width="2" fill="none"/>'
                .'<ellipse cx="115" cy="80" rx="6" ry="3" fill="#86efac" transform="rotate(-30 115 80)"/>'
                .'</svg>',

            'amama-jardin-eterno' =>
                '<svg style="position:absolute;top:-10px;right:-10px;width:160px;height:160px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<circle cx="150" cy="50" r="20" fill="#fde047"/>'
                .'<g stroke="#fbbf24" stroke-width="2">'
                .'<line x1="150" y1="20" x2="150" y2="30"/>'
                .'<line x1="150" y1="70" x2="150" y2="80"/>'
                .'<line x1="120" y1="50" x2="130" y2="50"/>'
                .'<line x1="170" y1="50" x2="180" y2="50"/>'
                .'<line x1="128" y1="28" x2="135" y2="35"/>'
                .'<line x1="165" y1="65" x2="172" y2="72"/>'
                .'<line x1="172" y1="28" x2="165" y2="35"/>'
                .'<line x1="135" y1="65" x2="128" y2="72"/>'
                .'</g>'
                .'<path d="M30 180 Q40 120 70 90 Q90 110 80 150 Q70 175 40 180" stroke="#059669" stroke-width="3" fill="none"/>'
                .'<ellipse cx="60" cy="100" rx="10" ry="5" fill="#34d399" transform="rotate(-30 60 100)"/>'
                .'<ellipse cx="80" cy="130" rx="10" ry="5" fill="#86efac" transform="rotate(40 80 130)"/>'
                .'<ellipse cx="50" cy="150" rx="10" ry="5" fill="#34d399" transform="rotate(-20 50 150)"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-15px;width:160px;height:160px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<path d="M20 180 Q30 130 50 100 Q70 130 60 180" stroke="#059669" stroke-width="3" fill="none"/>'
                .'<path d="M120 180 Q130 140 145 110 Q160 140 150 180" stroke="#65a30d" stroke-width="3" fill="none"/>'
                .'<ellipse cx="40" cy="120" rx="9" ry="4" fill="#34d399" transform="rotate(30 40 120)"/>'
                .'<ellipse cx="55" cy="140" rx="9" ry="4" fill="#86efac" transform="rotate(-30 55 140)"/>'
                .'<ellipse cx="135" cy="130" rx="9" ry="4" fill="#a3e635" transform="rotate(45 135 130)"/>'
                .'<ellipse cx="150" cy="150" rx="9" ry="4" fill="#86efac" transform="rotate(-30 150 150)"/>'
                .'<circle cx="90" cy="80" r="6" fill="#fbbf24"/>'
                .'</svg>',

            'amama-acuarela' =>
                '<svg style="position:absolute;top:-25px;right:-25px;width:200px;height:200px;opacity:0.45;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<defs>'
                .'<radialGradient id="aw1" cx="0.5" cy="0.5" r="0.5"><stop offset="0%" stop-color="#fda4af" stop-opacity="0.9"/><stop offset="100%" stop-color="#fda4af" stop-opacity="0"/></radialGradient>'
                .'<radialGradient id="aw2" cx="0.5" cy="0.5" r="0.5"><stop offset="0%" stop-color="#c4b5fd" stop-opacity="0.85"/><stop offset="100%" stop-color="#c4b5fd" stop-opacity="0"/></radialGradient>'
                .'<radialGradient id="aw3" cx="0.5" cy="0.5" r="0.5"><stop offset="0%" stop-color="#7dd3fc" stop-opacity="0.8"/><stop offset="100%" stop-color="#7dd3fc" stop-opacity="0"/></radialGradient>'
                .'</defs>'
                .'<circle cx="80" cy="70" r="60" fill="url(#aw1)"/>'
                .'<circle cx="140" cy="100" r="55" fill="url(#aw2)"/>'
                .'<circle cx="100" cy="150" r="45" fill="url(#aw3)"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-25px;left:-25px;width:180px;height:180px;opacity:0.4;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<defs>'
                .'<radialGradient id="aw4" cx="0.5" cy="0.5" r="0.5"><stop offset="0%" stop-color="#f9a8d4" stop-opacity="0.85"/><stop offset="100%" stop-color="#f9a8d4" stop-opacity="0"/></radialGradient>'
                .'<radialGradient id="aw5" cx="0.5" cy="0.5" r="0.5"><stop offset="0%" stop-color="#a5b4fc" stop-opacity="0.8"/><stop offset="100%" stop-color="#a5b4fc" stop-opacity="0"/></radialGradient>'
                .'</defs>'
                .'<circle cx="60" cy="130" r="55" fill="url(#aw4)"/>'
                .'<circle cx="130" cy="80" r="50" fill="url(#aw5)"/>'
                .'<circle cx="150" cy="160" r="3" fill="#be185d" opacity="0.6"/>'
                .'<circle cx="40" cy="60" r="2.5" fill="#7c3aed" opacity="0.6"/>'
                .'</svg>',

            'pad-corbata' =>
                '<svg style="position:absolute;top:-10px;right:-10px;width:140px;height:160px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 220" fill="none">'
                .'<polygon points="100,40 90,55 110,55" fill="#1e3a8a"/>'
                .'<polygon points="90,55 110,55 115,75 95,90 85,75" fill="#1d4ed8"/>'
                .'<polygon points="95,90 105,90 115,170 100,180 85,170" fill="#1e40af"/>'
                .'<line x1="92" y1="100" x2="108" y2="100" stroke="#0f172a" stroke-width="0.8"/>'
                .'<line x1="91" y1="115" x2="109" y2="115" stroke="#0f172a" stroke-width="0.8"/>'
                .'<line x1="90" y1="130" x2="110" y2="130" stroke="#0f172a" stroke-width="0.8"/>'
                .'<line x1="89" y1="145" x2="111" y2="145" stroke="#0f172a" stroke-width="0.8"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-10px;left:-15px;width:160px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<ellipse cx="100" cy="120" rx="70" ry="14" fill="#0f172a"/>'
                .'<path d="M60 120 Q60 70 100 70 Q140 70 140 120 Z" fill="#1e293b"/>'
                .'<rect x="60" y="115" width="80" height="8" fill="#1e3a8a"/>'
                .'<rect x="40" y="160" width="60" height="3" fill="#475569" rx="1"/>'
                .'<circle cx="120" cy="170" r="6" fill="none" stroke="#475569" stroke-width="2"/>'
                .'<line x1="120" y1="167" x2="120" y2="161" stroke="#475569" stroke-width="1.5"/>'
                .'<line x1="120" y1="170" x2="125" y2="170" stroke="#475569" stroke-width="1.5"/>'
                .'</svg>',

            'pad-brujula' =>
                '<svg style="position:absolute;top:-15px;right:-15px;width:160px;height:160px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<circle cx="100" cy="100" r="60" fill="#fef3c7" stroke="#92400e" stroke-width="3"/>'
                .'<circle cx="100" cy="100" r="50" fill="none" stroke="#b45309" stroke-width="1"/>'
                .'<text x="100" y="55" text-anchor="middle" font-size="14" font-weight="bold" fill="#7c2d12">N</text>'
                .'<text x="100" y="155" text-anchor="middle" font-size="11" fill="#7c2d12">S</text>'
                .'<text x="55" y="105" text-anchor="middle" font-size="11" fill="#7c2d12">O</text>'
                .'<text x="145" y="105" text-anchor="middle" font-size="11" fill="#7c2d12">E</text>'
                .'<polygon points="100,65 95,100 100,108 105,100" fill="#dc2626"/>'
                .'<polygon points="100,135 95,100 100,92 105,100" fill="#1e293b"/>'
                .'<circle cx="100" cy="100" r="4" fill="#92400e"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-15px;width:160px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 180" fill="none">'
                .'<polygon points="20,160 60,90 90,140 130,70 170,160" fill="#a16207" stroke="#78350f" stroke-width="2"/>'
                .'<polygon points="60,90 75,108 60,108" fill="#fef3c7"/>'
                .'<polygon points="130,70 148,95 130,95" fill="#fef3c7"/>'
                .'<rect x="20" y="20" width="80" height="55" rx="3" fill="#fef3c7" stroke="#92400e" stroke-width="2" transform="rotate(-8 60 47)"/>'
                .'<path d="M28 35 Q50 28 75 38 Q90 50 70 65 Q40 70 28 55 Z" stroke="#92400e" stroke-width="1" fill="none" transform="rotate(-8 60 47)"/>'
                .'<circle cx="50" cy="45" r="2" fill="#dc2626" transform="rotate(-8 60 47)"/>'
                .'</svg>',

            'pad-madera' =>
                '<svg style="position:absolute;top:-10px;right:-10px;width:160px;height:160px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<g stroke="#78350f" stroke-width="1.5" fill="none" opacity="0.7">'
                .'<path d="M0 30 Q60 25 110 35 T200 30"/>'
                .'<path d="M0 60 Q60 55 110 65 T200 60"/>'
                .'<path d="M0 90 Q60 85 110 95 T200 90"/>'
                .'<path d="M0 120 Q60 115 110 125 T200 120"/>'
                .'<path d="M0 150 Q60 145 110 155 T200 150"/>'
                .'</g>'
                .'<ellipse cx="60" cy="80" rx="10" ry="5" fill="none" stroke="#451a03" stroke-width="1.5"/>'
                .'<ellipse cx="140" cy="130" rx="12" ry="6" fill="none" stroke="#451a03" stroke-width="1.5"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-15px;width:140px;height:140px;opacity:0.6;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<circle cx="60" cy="80" r="22" fill="none" stroke="#78350f" stroke-width="4"/>'
                .'<circle cx="60" cy="80" r="6" fill="#fef3c7" stroke="#78350f" stroke-width="2"/>'
                .'<rect x="80" y="76" width="70" height="8" fill="#92400e" stroke="#78350f" stroke-width="2"/>'
                .'<rect x="140" y="68" width="6" height="6" fill="#92400e" stroke="#78350f" stroke-width="2"/>'
                .'<rect x="140" y="86" width="6" height="6" fill="#92400e" stroke="#78350f" stroke-width="2"/>'
                .'<rect x="150" y="76" width="6" height="6" fill="#92400e" stroke="#78350f" stroke-width="2"/>'
                .'<circle cx="120" cy="150" r="14" fill="none" stroke="#78350f" stroke-width="3"/>'
                .'<rect x="116" y="160" width="8" height="20" fill="#92400e"/>'
                .'<rect x="120" y="172" width="8" height="3" fill="#92400e"/>'
                .'<rect x="120" y="178" width="6" height="3" fill="#92400e"/>'
                .'</svg>',

            'cpapa-parrilla' =>
                '<svg style="position:absolute;top:-15px;right:-10px;width:170px;height:180px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 220" fill="none">'
                .'<ellipse cx="100" cy="160" rx="70" ry="18" fill="#1f2937"/>'
                .'<path d="M30 160 Q30 100 100 100 Q170 100 170 160 Z" fill="#374151"/>'
                .'<g stroke="#9ca3af" stroke-width="2">'
                .'<line x1="40" y1="130" x2="160" y2="130"/>'
                .'<line x1="40" y1="140" x2="160" y2="140"/>'
                .'<line x1="40" y1="150" x2="160" y2="150"/>'
                .'</g>'
                .'<circle cx="65" cy="120" r="5" fill="#dc2626"/>'
                .'<circle cx="100" cy="115" r="6" fill="#f97316"/>'
                .'<circle cx="135" cy="120" r="5" fill="#dc2626"/>'
                .'<circle cx="80" cy="125" r="3" fill="#fbbf24"/>'
                .'<circle cx="120" cy="125" r="3" fill="#fbbf24"/>'
                .'<path d="M60 95 Q55 75 65 60 Q70 75 60 95" fill="#9ca3af" opacity="0.7"/>'
                .'<path d="M100 90 Q92 65 102 45 Q108 65 100 90" fill="#cbd5e1" opacity="0.7"/>'
                .'<path d="M140 95 Q135 75 145 60 Q150 75 140 95" fill="#9ca3af" opacity="0.7"/>'
                .'<rect x="50" y="160" width="6" height="40" fill="#1f2937"/>'
                .'<rect x="144" y="160" width="6" height="40" fill="#1f2937"/>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-10px;left:-15px;width:140px;height:140px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<ellipse cx="60" cy="120" rx="40" ry="22" fill="#7c2d12"/>'
                .'<circle cx="50" cy="115" r="6" fill="#dc2626"/>'
                .'<circle cx="65" cy="120" r="7" fill="#f97316"/>'
                .'<circle cx="80" cy="115" r="5" fill="#fbbf24"/>'
                .'<circle cx="55" cy="125" r="4" fill="#facc15"/>'
                .'<circle cx="75" cy="128" r="4" fill="#dc2626"/>'
                .'<path d="M140 60 Q160 50 150 80 Q145 95 130 100 Q120 90 130 80 Q140 75 140 60 Z" fill="#f97316"/>'
                .'<path d="M138 65 Q150 60 145 80 Q140 90 132 92 Q128 85 134 80 Q140 75 138 65 Z" fill="#fbbf24"/>'
                .'</svg>',

            'cpapa-cerveza' =>
                '<svg style="position:absolute;top:-15px;right:-15px;width:160px;height:180px;opacity:0.6;pointer-events:none;" viewBox="0 0 200 220" fill="none">'
                .'<path d="M70 200 L60 70 L140 70 L130 200 Z" fill="#fbbf24" stroke="#a16207" stroke-width="2"/>'
                .'<rect x="60" y="60" width="80" height="20" rx="6" fill="#fef3c7" stroke="#a16207" stroke-width="2"/>'
                .'<circle cx="68" cy="55" r="8" fill="#fef3c7"/>'
                .'<circle cx="82" cy="48" r="10" fill="#fff"/>'
                .'<circle cx="100" cy="44" r="12" fill="#fef3c7"/>'
                .'<circle cx="118" cy="48" r="10" fill="#fff"/>'
                .'<circle cx="132" cy="55" r="8" fill="#fef3c7"/>'
                .'<path d="M140 90 Q170 95 170 130 Q170 165 140 170" stroke="#a16207" stroke-width="6" fill="none"/>'
                .'<g fill="#fcd34d" opacity="0.6">'
                .'<circle cx="85" cy="110" r="2"/>'
                .'<circle cx="110" cy="130" r="2"/>'
                .'<circle cx="95" cy="150" r="2"/>'
                .'<circle cx="115" cy="170" r="2"/>'
                .'</g>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-15px;width:140px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<g stroke="#65a30d" stroke-width="2" fill="none">'
                .'<path d="M50 180 Q50 120 60 80"/>'
                .'</g>'
                .'<ellipse cx="55" cy="75" rx="6" ry="10" fill="#a3e635"/>'
                .'<ellipse cx="48" cy="90" rx="5" ry="8" fill="#84cc16"/>'
                .'<ellipse cx="62" cy="100" rx="5" ry="8" fill="#a3e635"/>'
                .'<ellipse cx="50" cy="115" rx="5" ry="8" fill="#84cc16"/>'
                .'<ellipse cx="60" cy="130" rx="5" ry="8" fill="#a3e635"/>'
                .'<ellipse cx="50" cy="145" rx="5" ry="8" fill="#84cc16"/>'
                .'<circle cx="140" cy="80" r="14" fill="#d97706"/>'
                .'<path d="M140 80 L140 75 M133 80 L130 78 M147 80 L150 78 M140 87 L140 92" stroke="#fef3c7" stroke-width="1.5"/>'
                .'</svg>',

            'cpapa-herramientas' =>
                '<svg style="position:absolute;top:-10px;right:-10px;width:170px;height:160px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<rect x="30" y="60" width="90" height="22" rx="3" fill="#71717a" stroke="#27272a" stroke-width="2" transform="rotate(20 75 71)"/>'
                .'<rect x="115" y="50" width="40" height="35" rx="4" fill="#52525b" stroke="#18181b" stroke-width="2" transform="rotate(20 135 67)"/>'
                .'<rect x="105" y="62" width="14" height="14" fill="#27272a" transform="rotate(20 112 69)"/>'
                .'<g transform="rotate(-25 130 140)">'
                .'<rect x="125" y="100" width="14" height="80" rx="3" fill="#a1a1aa" stroke="#3f3f46" stroke-width="2"/>'
                .'<circle cx="132" cy="100" r="14" fill="#71717a" stroke="#27272a" stroke-width="2"/>'
                .'<circle cx="132" cy="180" r="14" fill="#71717a" stroke="#27272a" stroke-width="2"/>'
                .'<rect x="128" y="92" width="8" height="8" fill="#3f3f46"/>'
                .'<rect x="128" y="180" width="8" height="8" fill="#3f3f46"/>'
                .'</g>'
                .'</svg>'
                .'<svg style="position:absolute;bottom:-15px;left:-10px;width:140px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">'
                .'<g transform="rotate(45 60 100)">'
                .'<rect x="55" y="50" width="10" height="80" rx="2" fill="#92400e" stroke="#451a03" stroke-width="1.5"/>'
                .'<rect x="40" y="30" width="40" height="25" rx="3" fill="#52525b" stroke="#18181b" stroke-width="2"/>'
                .'</g>'
                .'<circle cx="140" cy="60" r="8" fill="#a1a1aa" stroke="#3f3f46" stroke-width="2"/>'
                .'<circle cx="140" cy="60" r="3" fill="#3f3f46"/>'
                .'<circle cx="160" cy="100" r="6" fill="#a1a1aa" stroke="#3f3f46" stroke-width="2"/>'
                .'<circle cx="160" cy="100" r="2" fill="#3f3f46"/>'
                .'<circle cx="130" cy="140" r="7" fill="#a1a1aa" stroke="#3f3f46" stroke-width="2"/>'
                .'<circle cx="130" cy="140" r="2.5" fill="#3f3f46"/>'
                .'<circle cx="170" cy="160" r="5" fill="#a1a1aa" stroke="#3f3f46" stroke-width="2"/>'
                .'</svg>',
        ];
    }
}
