<?php

namespace App\Helpers\Templates;

class OcasionGroupD
{
    public static function templates(): array
    {
        return [
            'cumpleanos-especial' => [
                ['id'=>'ce-confeti','nombre'=>'Lluvia de Confeti','emoji'=>'🎊','desc'=>'Explosión de colores vibrantes','bg'=>'from-fuchsia-50 via-yellow-50 to-cyan-50','bar'=>'bg-gradient-to-r from-fuchsia-500 via-yellow-400 to-cyan-500'],
                ['id'=>'ce-pastel','nombre'=>'Pastel de Tres Pisos','emoji'=>'🎂','desc'=>'Dulce celebración con velitas','bg'=>'from-pink-50 via-rose-50 to-amber-50','bar'=>'bg-gradient-to-r from-pink-400 to-amber-400'],
                ['id'=>'ce-globos','nombre'=>'Globos al Cielo','emoji'=>'🎈','desc'=>'Globos de colores volando','bg'=>'from-sky-50 via-fuchsia-50 to-yellow-50','bar'=>'bg-gradient-to-r from-sky-400 via-fuchsia-400 to-yellow-400'],
            ],
            'quinceanera' => [
                ['id'=>'q-tiara','nombre'=>'Tiara de Princesa','emoji'=>'👑','desc'=>'Corona dorada con joyas brillantes','bg'=>'from-pink-50 via-rose-50 to-amber-50','bar'=>'bg-gradient-to-r from-rose-300 to-amber-400'],
                ['id'=>'q-mariposas','nombre'=>'Mariposas y Flores','emoji'=>'🦋','desc'=>'Delicado vuelo de mariposas','bg'=>'from-rose-50 via-pink-50 to-purple-50','bar'=>'bg-gradient-to-r from-rose-300 via-pink-300 to-purple-300'],
                ['id'=>'q-tul','nombre'=>'Velo de Tul','emoji'=>'🌸','desc'=>'Ondas suaves como un vestido','bg'=>'from-pink-50 via-rose-50 to-pink-50','bar'=>'bg-gradient-to-r from-pink-200 to-rose-300'],
            ],
            'graduacion' => [
                ['id'=>'gra-birrete','nombre'=>'Birrete Volador','emoji'=>'🎓','desc'=>'Celebra el gran logro académico','bg'=>'from-blue-50 via-yellow-50 to-blue-50','bar'=>'bg-gradient-to-r from-blue-700 to-yellow-500'],
                ['id'=>'gra-diploma','nombre'=>'Diploma Sellado','emoji'=>'📜','desc'=>'Pergamino con cinta y sello dorado','bg'=>'from-amber-50 via-stone-50 to-red-50','bar'=>'bg-gradient-to-r from-amber-600 to-red-900'],
                ['id'=>'gra-laureles','nombre'=>'Corona de Laurel','emoji'=>'🌿','desc'=>'Honor académico clásico','bg'=>'from-yellow-50 via-amber-50 to-emerald-50','bar'=>'bg-gradient-to-r from-yellow-500 via-amber-500 to-emerald-600'],
            ],
        ];
    }

    public static function configs(): array
    {
        return [
            'ce-confeti' => [
                'wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fefce8,#ecfeff,#f0fdf4);',
                'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px dashed #f9a8d4;box-shadow:0 25px 60px rgba(236,72,153,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#ec4899,#f59e0b,#facc15,#84cc16,#06b6d4,#ec4899);background-size:200%;height:6px;',
                'bc'=>'','tc'=>'#1f2937','ac'=>'#db2777','bg'=>'#fdf2f8','tx'=>'#374151','fc'=>'#9d174d','deco'=>'🎊🎉🎈',
            ],
            'ce-pastel' => [
                'wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fff1f2,#fffbeb);',
                'card'=>'background:#fffaf5;border-radius:2rem;border:2px solid #fbcfe8;box-shadow:0 22px 55px rgba(244,114,182,0.2);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#f472b6,#fb923c,#fbbf24);height:5px;',
                'bc'=>'','tc'=>'#831843','ac'=>'#db2777','bg'=>'#fdf2f8','tx'=>'#9d174d','fc'=>'#be185d','deco'=>'🎂🍰🕯️',
            ],
            'ce-globos' => [
                'wrap'=>'background:linear-gradient(160deg,#f0f9ff,#fdf4ff,#fefce8);',
                'card'=>'background:rgba(255,255,255,0.93);border-radius:2rem;border:2px solid #bae6fd;box-shadow:0 25px 55px rgba(14,165,233,0.15);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#38bdf8,#e879f9,#facc15,#fb7185);height:5px;',
                'bc'=>'','tc'=>'#0c4a6e','ac'=>'#0284c7','bg'=>'#f0f9ff','tx'=>'#075985','fc'=>'#0369a1','deco'=>'🎈🎀🎁',
            ],
            'q-tiara' => [
                'wrap'=>'background:linear-gradient(135deg,#fff1f2,#fdf2f8,#fffbeb);',
                'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px solid #fbcfe8;box-shadow:0 30px 70px rgba(244,194,194,0.35);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fbcfe8,#fcd34d,#fbcfe8);height:5px;',
                'bc'=>'','tc'=>'#831843','ac'=>'#d97706','bg'=>'#fff1f2','tx'=>'#9f1239','fc'=>'#be185d','deco'=>'👑💎✨',
            ],
            'q-mariposas' => [
                'wrap'=>'background:linear-gradient(135deg,#fff1f2,#fdf2f8,#faf5ff);',
                'card'=>'background:rgba(255,255,255,0.93);border-radius:2rem;border:1px solid #f5d0fe;box-shadow:0 25px 55px rgba(232,121,249,0.18);overflow:hidden;backdrop-filter:blur(8px);',
                'bar'=>'background:linear-gradient(90deg,#fda4af,#f9a8d4,#d8b4fe);height:4px;',
                'bc'=>'','tc'=>'#86198f','ac'=>'#c026d3','bg'=>'#fdf4ff','tx'=>'#a21caf','fc'=>'#a21caf','deco'=>'🦋🌸💐',
            ],
            'q-tul' => [
                'wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fff1f2,#fdf2f8);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:2.5rem;border:1px solid #fbcfe8;box-shadow:0 30px 60px rgba(251,207,232,0.5);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fbcfe8,#fda4af,#fbcfe8);height:4px;',
                'bc'=>'','tc'=>'#9d174d','ac'=>'#db2777','bg'=>'#fdf2f8','tx'=>'#9f1239','fc'=>'#be185d','deco'=>'🌸🎀🪞',
            ],
            'gra-birrete' => [
                'wrap'=>'background:linear-gradient(135deg,#eff6ff,#fffbeb,#eff6ff);',
                'card'=>'background:rgba(255,255,255,0.96);border-radius:1.25rem;border:2px solid #1e3a8a33;box-shadow:0 25px 55px rgba(30,58,138,0.2);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#1e3a8a,#fcd34d,#1e3a8a);height:6px;',
                'bc'=>'','tc'=>'#1e3a8a','ac'=>'#1d4ed8','bg'=>'#eff6ff','tx'=>'#1e40af','fc'=>'#1e3a8a','deco'=>'🎓🏅📚',
            ],
            'gra-diploma' => [
                'wrap'=>'background:linear-gradient(135deg,#fffbeb,#fafaf9,#fef2f2);',
                'card'=>'background:#fffbf0;border-radius:0.75rem;border:2px solid #d6cdb8;box-shadow:6px 10px 30px rgba(127,29,29,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#7f1d1d,#fcd34d,#7f1d1d);height:5px;',
                'bc'=>'','tc'=>'#78350f','ac'=>'#7f1d1d','bg'=>'#fffbeb','tx'=>'#92400e','fc'=>'#7f1d1d','deco'=>'📜🎗️🏆',
            ],
            'gra-laureles' => [
                'wrap'=>'background:linear-gradient(135deg,#fefce8,#fffbeb,#ecfdf5);',
                'card'=>'background:rgba(255,255,255,0.95);border-radius:1.5rem;border:2px solid #fcd34d;box-shadow:0 22px 55px rgba(217,119,6,0.18);overflow:hidden;',
                'bar'=>'background:linear-gradient(90deg,#fcd34d,#84cc16,#fcd34d);height:5px;',
                'bc'=>'','tc'=>'#365314','ac'=>'#ca8a04','bg'=>'#fefce8','tx'=>'#3f6212','fc'=>'#854d0e','deco'=>'🌿🏆🎓',
            ],
        ];
    }

    public static function svg(): array
    {
        return [
            'ce-confeti' => '
                <svg style="position:absolute;top:-10px;left:-10px;width:160px;height:160px;opacity:0.55;pointer-events:none;" viewBox="0 0 160 160">
                    <rect x="20" y="15" width="8" height="14" fill="#ec4899" transform="rotate(20 24 22)"/>
                    <rect x="50" y="35" width="6" height="12" fill="#facc15" transform="rotate(-30 53 41)"/>
                    <rect x="85" y="20" width="9" height="9" fill="#06b6d4" transform="rotate(45 89 24)"/>
                    <rect x="115" y="55" width="7" height="13" fill="#84cc16" transform="rotate(-15 118 61)"/>
                    <rect x="35" y="80" width="8" height="8" fill="#fb923c" transform="rotate(60 39 84)"/>
                    <rect x="70" y="105" width="6" height="14" fill="#a855f7" transform="rotate(25 73 112)"/>
                    <circle cx="100" cy="90" r="4" fill="#ec4899"/>
                    <circle cx="130" cy="120" r="3" fill="#facc15"/>
                    <circle cx="25" cy="55" r="4" fill="#06b6d4"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;right:-10px;width:140px;height:140px;opacity:0.5;pointer-events:none;" viewBox="0 0 140 140">
                    <rect x="20" y="20" width="8" height="14" fill="#84cc16" transform="rotate(45 24 27)"/>
                    <rect x="55" y="50" width="9" height="9" fill="#ec4899" transform="rotate(-20 59 54)"/>
                    <rect x="90" y="30" width="6" height="13" fill="#facc15" transform="rotate(35 93 36)"/>
                    <rect x="105" y="80" width="8" height="8" fill="#06b6d4" transform="rotate(-45 109 84)"/>
                    <rect x="40" y="100" width="7" height="12" fill="#fb923c" transform="rotate(15 43 106)"/>
                    <circle cx="75" cy="85" r="4" fill="#a855f7"/>
                    <circle cx="115" cy="55" r="3" fill="#ec4899"/>
                </svg>',

            'ce-pastel' => '
                <svg style="position:absolute;top:50%;right:-20px;transform:translateY(-50%);width:170px;height:170px;opacity:0.45;pointer-events:none;" viewBox="0 0 170 170">
                    <rect x="55" y="20" width="3" height="20" fill="#fbbf24"/>
                    <rect x="80" y="14" width="3" height="26" fill="#fbbf24"/>
                    <rect x="105" y="20" width="3" height="20" fill="#fbbf24"/>
                    <ellipse cx="56" cy="18" rx="3" ry="5" fill="#fb923c"/>
                    <ellipse cx="81" cy="12" rx="3" ry="5" fill="#fb923c"/>
                    <ellipse cx="106" cy="18" rx="3" ry="5" fill="#fb923c"/>
                    <rect x="40" y="40" width="80" height="22" rx="3" fill="#f9a8d4"/>
                    <rect x="40" y="40" width="80" height="6" fill="#fbcfe8"/>
                    <rect x="30" y="62" width="100" height="28" rx="3" fill="#f472b6"/>
                    <rect x="30" y="62" width="100" height="7" fill="#fbcfe8"/>
                    <rect x="20" y="90" width="120" height="36" rx="3" fill="#ec4899"/>
                    <rect x="20" y="90" width="120" height="9" fill="#fbcfe8"/>
                    <circle cx="35" cy="105" r="3" fill="#fff"/>
                    <circle cx="80" cy="115" r="3" fill="#fff"/>
                    <circle cx="125" cy="105" r="3" fill="#fff"/>
                </svg>',

            'ce-globos' => '
                <svg style="position:absolute;top:-15px;left:50%;transform:translateX(-50%);width:200px;height:200px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200">
                    <ellipse cx="50" cy="50" rx="22" ry="28" fill="#fb7185"/>
                    <ellipse cx="44" cy="42" rx="5" ry="8" fill="#fda4af" opacity="0.6"/>
                    <polygon points="50,78 47,82 53,82" fill="#fb7185"/>
                    <path d="M 50 82 Q 55 110 48 140 Q 42 170 50 195" stroke="#94a3b8" stroke-width="1.2" fill="none"/>
                    <ellipse cx="100" cy="35" rx="24" ry="30" fill="#facc15"/>
                    <ellipse cx="94" cy="26" rx="6" ry="9" fill="#fde68a" opacity="0.6"/>
                    <polygon points="100,65 97,69 103,69" fill="#facc15"/>
                    <path d="M 100 69 Q 95 100 102 130 Q 108 165 100 195" stroke="#94a3b8" stroke-width="1.2" fill="none"/>
                    <ellipse cx="150" cy="55" rx="22" ry="28" fill="#38bdf8"/>
                    <ellipse cx="144" cy="47" rx="5" ry="8" fill="#7dd3fc" opacity="0.6"/>
                    <polygon points="150,83 147,87 153,87" fill="#38bdf8"/>
                    <path d="M 150 87 Q 145 115 152 145 Q 158 175 150 195" stroke="#94a3b8" stroke-width="1.2" fill="none"/>
                </svg>',

            'q-tiara' => '
                <svg style="position:absolute;top:10px;left:50%;transform:translateX(-50%);width:180px;height:120px;opacity:0.55;pointer-events:none;" viewBox="0 0 180 120">
                    <path d="M 20 80 L 40 30 L 60 65 L 90 15 L 120 65 L 140 30 L 160 80 Z" fill="#fcd34d" stroke="#d97706" stroke-width="1.5"/>
                    <rect x="20" y="78" width="140" height="8" rx="2" fill="#d97706"/>
                    <circle cx="40" cy="30" r="4" fill="#f9a8d4"/>
                    <circle cx="90" cy="15" r="5" fill="#ec4899"/>
                    <circle cx="140" cy="30" r="4" fill="#f9a8d4"/>
                    <circle cx="60" cy="65" r="3" fill="#a855f7"/>
                    <circle cx="120" cy="65" r="3" fill="#a855f7"/>
                    <circle cx="90" cy="60" r="3" fill="#fff" opacity="0.8"/>
                </svg>
                <svg style="position:absolute;bottom:10px;left:10px;width:80px;height:80px;opacity:0.4;pointer-events:none;" viewBox="0 0 80 80">
                    <path d="M 40 10 L 44 36 L 40 40 L 36 36 Z" fill="#fcd34d"/>
                    <path d="M 40 70 L 44 44 L 40 40 L 36 44 Z" fill="#fcd34d"/>
                    <path d="M 10 40 L 36 36 L 40 40 L 36 44 Z" fill="#fcd34d"/>
                    <path d="M 70 40 L 44 36 L 40 40 L 44 44 Z" fill="#fcd34d"/>
                    <circle cx="40" cy="40" r="4" fill="#fff"/>
                </svg>
                <svg style="position:absolute;bottom:20px;right:10px;width:70px;height:70px;opacity:0.4;pointer-events:none;" viewBox="0 0 70 70">
                    <path d="M 35 8 L 39 32 L 35 36 L 31 32 Z" fill="#fcd34d"/>
                    <path d="M 35 62 L 39 38 L 35 36 L 31 38 Z" fill="#fcd34d"/>
                    <path d="M 8 35 L 32 31 L 36 35 L 32 39 Z" fill="#fcd34d"/>
                    <path d="M 62 35 L 38 31 L 36 35 L 38 39 Z" fill="#fcd34d"/>
                </svg>',

            'q-mariposas' => '
                <svg style="position:absolute;top:15px;left:15px;width:120px;height:100px;opacity:0.55;pointer-events:none;" viewBox="0 0 120 100">
                    <ellipse cx="35" cy="35" rx="22" ry="18" fill="#f9a8d4" transform="rotate(-20 35 35)"/>
                    <ellipse cx="35" cy="65" rx="18" ry="14" fill="#f9a8d4" transform="rotate(20 35 65)"/>
                    <ellipse cx="85" cy="35" rx="22" ry="18" fill="#d8b4fe" transform="rotate(20 85 35)"/>
                    <ellipse cx="85" cy="65" rx="18" ry="14" fill="#d8b4fe" transform="rotate(-20 85 65)"/>
                    <ellipse cx="60" cy="50" rx="3" ry="22" fill="#86198f"/>
                    <circle cx="60" cy="30" r="4" fill="#86198f"/>
                </svg>
                <svg style="position:absolute;bottom:20px;right:20px;width:90px;height:80px;opacity:0.5;pointer-events:none;" viewBox="0 0 90 80">
                    <ellipse cx="25" cy="28" rx="17" ry="14" fill="#fda4af" transform="rotate(-25 25 28)"/>
                    <ellipse cx="25" cy="52" rx="13" ry="10" fill="#fda4af" transform="rotate(25 25 52)"/>
                    <ellipse cx="65" cy="28" rx="17" ry="14" fill="#fda4af" transform="rotate(25 65 28)"/>
                    <ellipse cx="65" cy="52" rx="13" ry="10" fill="#fda4af" transform="rotate(-25 65 52)"/>
                    <ellipse cx="45" cy="40" rx="2.5" ry="18" fill="#9d174d"/>
                </svg>
                <svg style="position:absolute;top:50%;right:10px;transform:translateY(-50%);width:70px;height:70px;opacity:0.45;pointer-events:none;" viewBox="0 0 70 70">
                    <circle cx="35" cy="35" r="6" fill="#fbbf24"/>
                    <ellipse cx="35" cy="18" rx="6" ry="10" fill="#f9a8d4"/>
                    <ellipse cx="35" cy="52" rx="6" ry="10" fill="#f9a8d4"/>
                    <ellipse cx="18" cy="35" rx="10" ry="6" fill="#f9a8d4"/>
                    <ellipse cx="52" cy="35" rx="10" ry="6" fill="#f9a8d4"/>
                </svg>',

            'q-tul' => '
                <svg style="position:absolute;top:0;left:0;width:100%;height:140px;opacity:0.4;pointer-events:none;" viewBox="0 0 400 140" preserveAspectRatio="none">
                    <path d="M 0 60 Q 100 20 200 60 T 400 60 L 400 0 L 0 0 Z" fill="#fbcfe8"/>
                    <path d="M 0 90 Q 100 50 200 90 T 400 90 L 400 0 L 0 0 Z" fill="#fda4af" opacity="0.5"/>
                </svg>
                <svg style="position:absolute;bottom:0;left:0;width:100%;height:140px;opacity:0.4;pointer-events:none;" viewBox="0 0 400 140" preserveAspectRatio="none">
                    <path d="M 0 80 Q 100 120 200 80 T 400 80 L 400 140 L 0 140 Z" fill="#fbcfe8"/>
                    <path d="M 0 50 Q 100 90 200 50 T 400 50 L 400 140 L 0 140 Z" fill="#fda4af" opacity="0.5"/>
                </svg>
                <svg style="position:absolute;top:30%;right:15px;width:60px;height:120px;opacity:0.5;pointer-events:none;" viewBox="0 0 60 120">
                    <path d="M 30 5 Q 15 25 20 50 Q 25 75 30 115 Q 35 75 40 50 Q 45 25 30 5 Z" fill="#fdf2f8" stroke="#fbcfe8" stroke-width="1"/>
                    <path d="M 30 15 L 30 110" stroke="#f9a8d4" stroke-width="0.8"/>
                </svg>',

            'gra-birrete' => '
                <svg style="position:absolute;top:10px;right:15px;width:160px;height:140px;opacity:0.55;pointer-events:none;" viewBox="0 0 160 140">
                    <ellipse cx="80" cy="65" rx="20" ry="10" fill="#1e3a8a"/>
                    <path d="M 80 55 L 80 70" stroke="#1e3a8a" stroke-width="2"/>
                    <polygon points="20,55 80,30 140,55 80,80" fill="#0f172a"/>
                    <polygon points="20,55 80,80 80,85 20,60" fill="#1e3a8a"/>
                    <polygon points="140,55 80,80 80,85 140,60" fill="#1e40af"/>
                    <circle cx="80" cy="55" r="4" fill="#fcd34d"/>
                    <path d="M 80 55 Q 110 60 120 90 Q 122 105 115 115" stroke="#fcd34d" stroke-width="2.5" fill="none"/>
                    <path d="M 110 110 L 120 130 M 115 110 L 115 132 M 120 110 L 110 130" stroke="#fcd34d" stroke-width="2"/>
                    <circle cx="115" cy="132" r="4" fill="#facc15"/>
                </svg>
                <svg style="position:absolute;bottom:15px;left:15px;width:90px;height:90px;opacity:0.4;pointer-events:none;" viewBox="0 0 90 90">
                    <rect x="20" y="35" width="50" height="40" rx="2" fill="#1e3a8a"/>
                    <rect x="22" y="37" width="46" height="36" fill="#fffbeb"/>
                    <rect x="28" y="44" width="32" height="2" fill="#1e3a8a"/>
                    <rect x="28" y="50" width="32" height="2" fill="#1e3a8a"/>
                    <rect x="28" y="56" width="32" height="2" fill="#1e3a8a"/>
                    <rect x="28" y="62" width="20" height="2" fill="#1e3a8a"/>
                    <polygon points="15,30 75,30 70,38 20,38" fill="#1e3a8a"/>
                </svg>',

            'gra-diploma' => '
                <svg style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:220px;height:140px;opacity:0.45;pointer-events:none;" viewBox="0 0 220 140">
                    <path d="M 20 30 Q 15 30 15 35 L 15 105 Q 15 110 20 110 L 200 110 Q 205 110 205 105 L 205 35 Q 205 30 200 30 Z" fill="#fffbeb" stroke="#92400e" stroke-width="1.5"/>
                    <path d="M 15 35 Q 10 35 10 40 L 10 100 Q 10 105 15 105" fill="none" stroke="#92400e" stroke-width="1.5"/>
                    <path d="M 205 35 Q 210 35 210 40 L 210 100 Q 210 105 205 105" fill="none" stroke="#92400e" stroke-width="1.5"/>
                    <line x1="40" y1="55" x2="180" y2="55" stroke="#92400e" stroke-width="1"/>
                    <line x1="40" y1="68" x2="180" y2="68" stroke="#92400e" stroke-width="1"/>
                    <line x1="40" y1="81" x2="180" y2="81" stroke="#92400e" stroke-width="1"/>
                    <line x1="40" y1="94" x2="140" y2="94" stroke="#92400e" stroke-width="1"/>
                    <circle cx="180" cy="100" r="14" fill="#fcd34d" stroke="#7f1d1d" stroke-width="2"/>
                    <path d="M 180 95 L 182 99 L 187 99 L 183 102 L 185 107 L 180 104 L 175 107 L 177 102 L 173 99 L 178 99 Z" fill="#7f1d1d"/>
                    <polygon points="170,112 180,114 190,112 188,135 180,128 172,135" fill="#7f1d1d"/>
                </svg>',

            'gra-laureles' => '
                <svg style="position:absolute;top:50%;left:10px;transform:translateY(-50%);width:90px;height:180px;opacity:0.55;pointer-events:none;" viewBox="0 0 90 180">
                    <path d="M 60 10 Q 60 60 60 170" stroke="#854d0e" stroke-width="2" fill="none"/>
                    <ellipse cx="50" cy="25" rx="10" ry="5" fill="#84cc16" transform="rotate(-30 50 25)"/>
                    <ellipse cx="48" cy="45" rx="11" ry="5" fill="#65a30d" transform="rotate(-25 48 45)"/>
                    <ellipse cx="46" cy="65" rx="11" ry="5" fill="#84cc16" transform="rotate(-30 46 65)"/>
                    <ellipse cx="46" cy="85" rx="12" ry="6" fill="#65a30d" transform="rotate(-25 46 85)"/>
                    <ellipse cx="46" cy="105" rx="12" ry="6" fill="#84cc16" transform="rotate(-30 46 105)"/>
                    <ellipse cx="48" cy="125" rx="11" ry="5" fill="#65a30d" transform="rotate(-25 48 125)"/>
                    <ellipse cx="50" cy="145" rx="10" ry="5" fill="#84cc16" transform="rotate(-30 50 145)"/>
                    <ellipse cx="55" cy="162" rx="9" ry="4" fill="#65a30d" transform="rotate(-25 55 162)"/>
                </svg>
                <svg style="position:absolute;top:50%;right:10px;transform:translateY(-50%);width:90px;height:180px;opacity:0.55;pointer-events:none;" viewBox="0 0 90 180">
                    <path d="M 30 10 Q 30 60 30 170" stroke="#854d0e" stroke-width="2" fill="none"/>
                    <ellipse cx="40" cy="25" rx="10" ry="5" fill="#84cc16" transform="rotate(30 40 25)"/>
                    <ellipse cx="42" cy="45" rx="11" ry="5" fill="#65a30d" transform="rotate(25 42 45)"/>
                    <ellipse cx="44" cy="65" rx="11" ry="5" fill="#84cc16" transform="rotate(30 44 65)"/>
                    <ellipse cx="44" cy="85" rx="12" ry="6" fill="#65a30d" transform="rotate(25 44 85)"/>
                    <ellipse cx="44" cy="105" rx="12" ry="6" fill="#84cc16" transform="rotate(30 44 105)"/>
                    <ellipse cx="42" cy="125" rx="11" ry="5" fill="#65a30d" transform="rotate(25 42 125)"/>
                    <ellipse cx="40" cy="145" rx="10" ry="5" fill="#84cc16" transform="rotate(30 40 145)"/>
                    <ellipse cx="35" cy="162" rx="9" ry="4" fill="#65a30d" transform="rotate(25 35 162)"/>
                </svg>
                <svg style="position:absolute;top:15px;left:50%;transform:translateX(-50%);width:80px;height:60px;opacity:0.5;pointer-events:none;" viewBox="0 0 80 60">
                    <polygon points="40,5 47,22 65,22 51,33 56,52 40,42 24,52 29,33 15,22 33,22" fill="#fcd34d" stroke="#d97706" stroke-width="1"/>
                </svg>',
        ];
    }
}
