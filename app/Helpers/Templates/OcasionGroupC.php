<?php

namespace App\Helpers\Templates;

class OcasionGroupC
{
    public static function templates(): array
    {
        return [
            'dia-del-nino' => [
                ['id'=>'nin-circo',    'nombre'=>'Circo Mágico',     'emoji'=>'🎪', 'desc'=>'Carpa, payasos y diversión',     'bg'=>'from-red-50 via-yellow-50 to-sky-50',    'bar'=>'bg-gradient-to-r from-red-500 via-yellow-400 to-sky-500'],
                ['id'=>'nin-globos',   'nombre'=>'Globos al Cielo',  'emoji'=>'🎈', 'desc'=>'Globos, confeti y alegría',      'bg'=>'from-pink-50 via-yellow-50 to-emerald-50','bar'=>'bg-gradient-to-r from-pink-500 via-yellow-400 to-emerald-500'],
                ['id'=>'nin-juguetes', 'nombre'=>'Caja de Juguetes', 'emoji'=>'🧸', 'desc'=>'Bloques, dados y peluches',      'bg'=>'from-amber-50 via-rose-50 to-sky-50',    'bar'=>'bg-gradient-to-r from-amber-500 via-rose-400 to-sky-500'],
            ],
            'dia-del-abuelo' => [
                ['id'=>'abu-sepia', 'nombre'=>'Foto Sepia',       'emoji'=>'📸', 'desc'=>'Marco vintage y recuerdos',     'bg'=>'from-amber-50 via-yellow-50 to-stone-100', 'bar'=>'bg-gradient-to-r from-amber-700 to-yellow-700'],
                ['id'=>'abu-album', 'nombre'=>'Álbum de Recuerdos','emoji'=>'📔', 'desc'=>'Polaroids amarillentas',         'bg'=>'from-stone-100 via-amber-50 to-orange-50', 'bar'=>'bg-gradient-to-r from-stone-600 to-amber-700'],
                ['id'=>'abu-pluma', 'nombre'=>'Pluma y Pergamino','emoji'=>'🖋️', 'desc'=>'Caligrafía clásica',             'bg'=>'from-amber-50 via-stone-100 to-yellow-50', 'bar'=>'bg-gradient-to-r from-stone-700 to-amber-800'],
            ],
            'dia-de-la-amistad' => [
                ['id'=>'ami-arcoiris','nombre'=>'Arcoíris',       'emoji'=>'🌈', 'desc'=>'Colores y nubes alegres',        'bg'=>'from-fuchsia-50 via-yellow-50 to-cyan-50','bar'=>'bg-gradient-to-r from-fuchsia-500 via-yellow-400 via-lime-400 to-cyan-500'],
                ['id'=>'ami-pulseras','nombre'=>'Pulseras de Hilo','emoji'=>'💝', 'desc'=>'Trenzas de amistad',             'bg'=>'from-pink-50 via-orange-50 to-violet-50','bar'=>'bg-gradient-to-r from-pink-500 via-orange-400 to-violet-500'],
                ['id'=>'ami-manos',   'nombre'=>'Manos Unidas',   'emoji'=>'🤝', 'desc'=>'Fist bump entre amigos',         'bg'=>'from-yellow-50 via-lime-50 to-cyan-50',  'bar'=>'bg-gradient-to-r from-yellow-400 via-lime-400 to-cyan-500'],
            ],
            'navidad' => [
                ['id'=>'nav-pino',    'nombre'=>'Pino Navideño',  'emoji'=>'🎄', 'desc'=>'Árbol con bolas y luces',        'bg'=>'from-red-50 via-green-50 to-red-50',     'bar'=>'bg-gradient-to-r from-red-600 via-yellow-400 to-green-700'],
                ['id'=>'nav-copos',   'nombre'=>'Copos de Nieve', 'emoji'=>'❄️', 'desc'=>'Nevada suave y blanca',          'bg'=>'from-sky-50 via-slate-50 to-blue-50',    'bar'=>'bg-gradient-to-r from-sky-400 to-indigo-500'],
                ['id'=>'nav-regalos', 'nombre'=>'Regalos Bajo el Árbol','emoji'=>'🎁','desc'=>'Cajas con moños y cintas',  'bg'=>'from-rose-50 via-emerald-50 to-amber-50','bar'=>'bg-gradient-to-r from-rose-600 via-amber-400 to-emerald-700'],
            ],
            'año-nuevo' => [
                ['id'=>'anu-fuegos',    'nombre'=>'Fuegos Artificiales','emoji'=>'🎆','desc'=>'Destellos en el cielo nocturno','bg'=>'from-slate-900 via-indigo-950 to-fuchsia-950','bar'=>'bg-gradient-to-r from-yellow-400 via-fuchsia-500 to-cyan-400','dark'=>true],
                ['id'=>'anu-champagne', 'nombre'=>'Brindis Dorado',    'emoji'=>'🥂','desc'=>'Copas y burbujas doradas',     'bg'=>'from-stone-900 via-yellow-950 to-stone-900','bar'=>'bg-gradient-to-r from-yellow-500 via-amber-400 to-yellow-600','dark'=>true],
                ['id'=>'anu-reloj',     'nombre'=>'Cuenta Regresiva',  'emoji'=>'🕛','desc'=>'Reloj marcando las 12:00',     'bg'=>'from-zinc-900 via-slate-900 to-indigo-950','bar'=>'bg-gradient-to-r from-yellow-400 to-fuchsia-500','dark'=>true],
            ],
        ];
    }

    public static function configs(): array
    {
        return [
            // ════ DÍA DEL NIÑO ════
            'nin-circo' => ['wrap'=>'background:linear-gradient(135deg,#fef2f2,#fefce8,#f0f9ff);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.75rem;border:3px dashed #ef4444;box-shadow:0 20px 50px rgba(239,68,68,0.18);overflow:hidden;', 'bar'=>'background:repeating-linear-gradient(45deg,#ef4444 0 14px,#fff 14px 28px);height:6px;', 'bc'=>'', 'tc'=>'#7f1d1d', 'ac'=>'#dc2626', 'bg'=>'#fef2f2', 'tx'=>'#991b1b', 'fc'=>'#b91c1c', 'deco'=>'🎪🤡⭐'],
            'nin-globos' => ['wrap'=>'background:linear-gradient(160deg,#fdf2f8,#fefce8,#ecfdf5);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px solid #fbcfe8;box-shadow:0 20px 50px rgba(236,72,153,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#ec4899,#facc15,#10b981,#3b82f6);height:5px;', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#db2777', 'bg'=>'#fdf2f8', 'tx'=>'#374151', 'fc'=>'#be185d', 'deco'=>'🎈🎉✨'],
            'nin-juguetes' => ['wrap'=>'background:linear-gradient(135deg,#fffbeb,#fff1f2,#f0f9ff);', 'card'=>'background:#fffef5;border-radius:1.5rem;border:3px solid #fcd34d;box-shadow:0 18px 40px rgba(245,158,11,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f59e0b,#fb7185,#38bdf8);height:5px;', 'bc'=>'', 'tc'=>'#78350f', 'ac'=>'#ea580c', 'bg'=>'#fffbeb', 'tx'=>'#7c2d12', 'fc'=>'#9a3412', 'deco'=>'🧸🪀🎲'],

            // ════ DÍA DEL ABUELO ════
            'abu-sepia' => ['wrap'=>'background:linear-gradient(135deg,#f5efe1,#ede1c8,#f5efe1);', 'card'=>'background:#fbf3df;border-radius:0.5rem;border:6px solid #c19a5b;box-shadow:8px 12px 30px rgba(92,64,33,0.35),inset 0 0 30px rgba(154,108,52,0.12);overflow:hidden;', 'bar'=>'background:#7a5230;height:5px;', 'bc'=>'', 'tc'=>'#3d2914', 'ac'=>'#7a5230', 'bg'=>'transparent', 'tx'=>'#5c3d1f', 'fc'=>'#6b4423', 'deco'=>'📸🖼️🤎'],
            'abu-album' => ['wrap'=>'background:linear-gradient(135deg,#f1e4c8,#e8d5a8,#f1e4c8);', 'card'=>'background:#fdf6e3;border-radius:0.75rem;border:2px solid #b8956a;box-shadow:6px 10px 28px rgba(0,0,0,0.18),inset 0 0 40px rgba(184,149,106,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#a8814e,#d4a574);height:4px;', 'bc'=>'', 'tc'=>'#4a2f17', 'ac'=>'#8b5e34', 'bg'=>'#fdf6e3', 'tx'=>'#5c3d1f', 'fc'=>'#7a5230', 'deco'=>'📔📷🕰️'],
            'abu-pluma' => ['wrap'=>'background:#f3e7c8;', 'card'=>'background:#fbf5e0;border-radius:0.25rem;border:1px solid #b8956a;box-shadow:0 12px 30px rgba(92,64,33,0.18);overflow:hidden;background-image:repeating-linear-gradient(0deg,transparent 0 22px,rgba(122,82,48,0.12) 22px 23px);', 'bar'=>'background:#3d2914;height:3px;', 'bc'=>'', 'tc'=>'#2c1810', 'ac'=>'#5c3d1f', 'bg'=>'transparent', 'tx'=>'#3d2914', 'fc'=>'#5c3d1f', 'deco'=>'🖋️📜✒️'],

            // ════ DÍA DE LA AMISTAD ════
            'ami-arcoiris' => ['wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fff7ed,#fefce8,#ecfdf5,#ecfeff,#f5f3ff);', 'card'=>'background:rgba(255,255,255,0.94);border-radius:2rem;border:2px solid #f9a8d4;box-shadow:0 20px 50px rgba(217,70,239,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#ef4444,#f97316,#facc15,#84cc16,#06b6d4,#8b5cf6);height:5px;', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#d946ef', 'bg'=>'#fdf2f8', 'tx'=>'#374151', 'fc'=>'#a21caf', 'deco'=>'🌈☁️✨'],
            'ami-pulseras' => ['wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fff7ed,#f5f3ff);', 'card'=>'background:rgba(255,255,255,0.93);border-radius:1.75rem;border:2px solid #fda4af;box-shadow:0 18px 40px rgba(244,63,94,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#fb7185,#fb923c,#a78bfa);height:5px;', 'bc'=>'', 'tc'=>'#831843', 'ac'=>'#e11d48', 'bg'=>'#fdf2f8', 'tx'=>'#9f1239', 'fc'=>'#be185d', 'deco'=>'💝🧶💖'],
            'ami-manos' => ['wrap'=>'background:linear-gradient(135deg,#fefce8,#f7fee7,#ecfeff);', 'card'=>'background:rgba(255,255,255,0.94);border-radius:1.5rem;border:2px solid #fde68a;box-shadow:0 18px 40px rgba(234,179,8,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#facc15,#84cc16,#06b6d4);height:5px;', 'bc'=>'', 'tc'=>'#365314', 'ac'=>'#65a30d', 'bg'=>'#fefce8', 'tx'=>'#3f6212', 'fc'=>'#4d7c0f', 'deco'=>'🤝✊👋'],

            // ════ NAVIDAD ════
            'nav-pino' => ['wrap'=>'background:linear-gradient(135deg,#fef2f2,#f0fdf4,#fef2f2);', 'card'=>'background:rgba(255,255,255,0.96);border-radius:1.5rem;border:3px solid #16a34a;box-shadow:0 22px 50px rgba(196,30,58,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#c41e3a,#facc15,#2d5a3d);height:6px;', 'bc'=>'', 'tc'=>'#7f1d1d', 'ac'=>'#c41e3a', 'bg'=>'#fef2f2', 'tx'=>'#991b1b', 'fc'=>'#b91c1c', 'deco'=>'🎄✨🎁'],
            'nav-copos' => ['wrap'=>'background:linear-gradient(160deg,#f0f9ff,#eff6ff,#f8fafc);', 'card'=>'background:rgba(255,255,255,0.92);border-radius:1.75rem;border:1px solid #bae6fd;box-shadow:0 22px 50px rgba(56,189,248,0.18);overflow:hidden;backdrop-filter:blur(10px);', 'bar'=>'background:linear-gradient(90deg,#7dd3fc,#a5b4fc,#fff);height:4px;', 'bc'=>'', 'tc'=>'#0c4a6e', 'ac'=>'#0284c7', 'bg'=>'#f0f9ff', 'tx'=>'#075985', 'fc'=>'#0369a1', 'deco'=>'❄️☃️🌨️'],
            'nav-regalos' => ['wrap'=>'background:linear-gradient(135deg,#fff1f2,#ecfdf5,#fffbeb);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.5rem;border:2px solid #fcd34d;box-shadow:0 22px 50px rgba(196,30,58,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#c41e3a,#fbbf24,#2d5a3d);height:5px;', 'bc'=>'', 'tc'=>'#7c2d12', 'ac'=>'#c41e3a', 'bg'=>'#fff1f2', 'tx'=>'#9f1239', 'fc'=>'#be123c', 'deco'=>'🎁🎀🌟'],

            // ════ AÑO NUEVO ════
            'anu-fuegos' => ['wrap'=>'background:radial-gradient(ellipse at top,#1e1b4b,#0a0a1f);', 'card'=>'background:rgba(255,255,255,0.05);border-radius:1.75rem;border:1px solid rgba(255,215,0,0.3);box-shadow:0 0 60px rgba(217,70,239,0.25),0 30px 70px rgba(0,0,0,0.6);overflow:hidden;backdrop-filter:blur(16px);', 'bar'=>'background:linear-gradient(90deg,#fde047,#d946ef,#22d3ee,#fde047);background-size:200%;height:4px;', 'bc'=>'', 'tc'=>'#fffbeb', 'ac'=>'#fde047', 'bg'=>'rgba(253,224,71,0.08)', 'tx'=>'rgba(255,251,235,0.85)', 'fc'=>'#fcd34d', 'deco'=>'🎆🎇✨'],
            'anu-champagne' => ['wrap'=>'background:linear-gradient(160deg,#1c1917,#3f2e10,#1c1917);', 'card'=>'background:rgba(255,255,255,0.06);border-radius:1.5rem;border:1px solid rgba(255,215,0,0.4);box-shadow:0 0 50px rgba(255,215,0,0.2),0 28px 60px rgba(0,0,0,0.55);overflow:hidden;backdrop-filter:blur(14px);', 'bar'=>'background:linear-gradient(90deg,#facc15,#fde047,#eab308);height:4px;', 'bc'=>'', 'tc'=>'#fef3c7', 'ac'=>'#facc15', 'bg'=>'rgba(250,204,21,0.08)', 'tx'=>'rgba(254,243,199,0.85)', 'fc'=>'#fcd34d', 'deco'=>'🥂🍾✨'],
            'anu-reloj' => ['wrap'=>'background:radial-gradient(ellipse at center,#1e293b,#0a0a1f);', 'card'=>'background:rgba(255,255,255,0.05);border-radius:1.5rem;border:2px solid rgba(255,215,0,0.35);box-shadow:0 0 70px rgba(255,215,0,0.18),0 30px 60px rgba(0,0,0,0.6);overflow:hidden;backdrop-filter:blur(16px);', 'bar'=>'background:linear-gradient(90deg,#fde047,#d946ef);height:4px;', 'bc'=>'', 'tc'=>'#fffbeb', 'ac'=>'#fde047', 'bg'=>'rgba(253,224,71,0.08)', 'tx'=>'rgba(255,251,235,0.85)', 'fc'=>'#fcd34d', 'deco'=>'🕛🌟🎊'],
        ];
    }

    public static function svg(): array
    {
        return [
            // ════ DÍA DEL NIÑO ════
            'nin-circo' => '
                <svg style="position:absolute;top:-15px;right:-10px;width:170px;height:170px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">
                    <path d="M100 30 L40 130 L160 130 Z" fill="#ef4444"/>
                    <path d="M100 30 L70 130 L130 130 Z" fill="#fff"/>
                    <path d="M100 30 L100 130" stroke="#dc2626" stroke-width="2"/>
                    <circle cx="100" cy="30" r="6" fill="#facc15"/>
                    <path d="M85 130 L85 160 L115 160 L115 130" fill="#fef3c7" stroke="#dc2626" stroke-width="1.5"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;left:-10px;width:120px;height:120px;opacity:0.55;pointer-events:none;" viewBox="0 0 120 120" fill="none">
                    <circle cx="60" cy="60" r="28" fill="#fef3c7"/>
                    <circle cx="50" cy="55" r="3" fill="#1f2937"/>
                    <circle cx="70" cy="55" r="3" fill="#1f2937"/>
                    <circle cx="60" cy="68" r="6" fill="#ef4444"/>
                    <path d="M45 75 Q60 85 75 75" stroke="#1f2937" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M30 50 L20 45 M30 70 L20 75 M90 50 L100 45 M90 70 L100 75" stroke="#facc15" stroke-width="2"/>
                </svg>
                <svg style="position:absolute;top:30%;left:55%;width:60px;height:60px;opacity:0.4;pointer-events:none;" viewBox="0 0 60 60">
                    <path d="M30 5 L36 22 L54 22 L40 32 L46 50 L30 40 L14 50 L20 32 L6 22 L24 22 Z" fill="#facc15"/>
                </svg>',

            'nin-globos' => '
                <svg style="position:absolute;top:-20px;right:-5px;width:160px;height:200px;opacity:0.6;pointer-events:none;" viewBox="0 0 160 200" fill="none">
                    <ellipse cx="40" cy="40" rx="22" ry="28" fill="#ec4899"/>
                    <path d="M40 68 L40 140" stroke="#9ca3af" stroke-width="1"/>
                    <ellipse cx="85" cy="25" rx="20" ry="26" fill="#facc15"/>
                    <path d="M85 51 L85 140" stroke="#9ca3af" stroke-width="1"/>
                    <ellipse cx="125" cy="50" rx="22" ry="28" fill="#10b981"/>
                    <path d="M125 78 L125 140" stroke="#9ca3af" stroke-width="1"/>
                    <ellipse cx="60" cy="75" rx="18" ry="23" fill="#3b82f6"/>
                    <path d="M60 98 L60 140" stroke="#9ca3af" stroke-width="1"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;left:-10px;width:200px;height:80px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 80">
                    <rect x="20" y="20" width="6" height="6" fill="#ec4899" transform="rotate(20 23 23)"/>
                    <rect x="50" y="40" width="5" height="5" fill="#facc15" transform="rotate(45 52 42)"/>
                    <rect x="80" y="15" width="6" height="6" fill="#10b981" transform="rotate(-20 83 18)"/>
                    <rect x="110" y="45" width="5" height="5" fill="#3b82f6" transform="rotate(30 112 47)"/>
                    <rect x="140" y="25" width="6" height="6" fill="#a855f7" transform="rotate(-40 143 28)"/>
                    <rect x="170" y="50" width="5" height="5" fill="#ef4444" transform="rotate(15 172 52)"/>
                    <rect x="35" y="55" width="5" height="5" fill="#06b6d4" transform="rotate(60 37 57)"/>
                    <rect x="95" y="60" width="6" height="6" fill="#fb923c" transform="rotate(-25 98 63)"/>
                </svg>',

            'nin-juguetes' => '
                <svg style="position:absolute;top:10px;right:10px;width:130px;height:130px;opacity:0.55;pointer-events:none;" viewBox="0 0 130 130" fill="none">
                    <rect x="20" y="60" width="40" height="40" fill="#ef4444" stroke="#7f1d1d" stroke-width="1.5"/>
                    <text x="40" y="86" text-anchor="middle" font-size="22" fill="#fff" font-weight="bold">A</text>
                    <rect x="65" y="50" width="35" height="35" fill="#3b82f6" stroke="#1e3a8a" stroke-width="1.5"/>
                    <text x="82" y="74" text-anchor="middle" font-size="20" fill="#fff" font-weight="bold">B</text>
                    <rect x="40" y="20" width="32" height="32" fill="#facc15" stroke="#78350f" stroke-width="1.5" transform="rotate(15 56 36)"/>
                    <circle cx="50" cy="32" r="2.5" fill="#1f2937"/>
                    <circle cx="62" cy="32" r="2.5" fill="#1f2937"/>
                    <circle cx="56" cy="44" r="2.5" fill="#1f2937"/>
                </svg>
                <svg style="position:absolute;bottom:-5px;left:-5px;width:130px;height:130px;opacity:0.55;pointer-events:none;" viewBox="0 0 130 130" fill="none">
                    <ellipse cx="65" cy="100" rx="30" ry="22" fill="#92400e"/>
                    <circle cx="65" cy="65" r="26" fill="#a16207"/>
                    <circle cx="55" cy="62" r="3.5" fill="#1f2937"/>
                    <circle cx="75" cy="62" r="3.5" fill="#1f2937"/>
                    <ellipse cx="65" cy="73" rx="5" ry="3" fill="#1f2937"/>
                    <circle cx="42" cy="50" r="9" fill="#a16207"/>
                    <circle cx="88" cy="50" r="9" fill="#a16207"/>
                    <circle cx="42" cy="50" r="4" fill="#78350f"/>
                    <circle cx="88" cy="50" r="4" fill="#78350f"/>
                </svg>',

            // ════ DÍA DEL ABUELO ════
            'abu-sepia' => '
                <svg style="position:absolute;top:14px;right:14px;width:120px;height:140px;opacity:0.55;pointer-events:none;" viewBox="0 0 120 140" fill="none">
                    <rect x="10" y="10" width="100" height="120" fill="#f5e7c8" stroke="#7a5230" stroke-width="3"/>
                    <rect x="18" y="18" width="84" height="104" fill="#d4b489"/>
                    <circle cx="60" cy="60" r="20" fill="#a8814e"/>
                    <rect x="40" y="80" width="40" height="35" fill="#8b6539"/>
                    <path d="M10 10 L18 18 M110 10 L102 18 M10 130 L18 122 M110 130 L102 122" stroke="#5c3d1f" stroke-width="1"/>
                </svg>
                <svg style="position:absolute;bottom:-5px;left:-5px;width:90px;height:90px;opacity:0.45;pointer-events:none;" viewBox="0 0 90 90">
                    <path d="M10 10 L25 10 L25 25 Z" fill="#7a5230"/>
                    <path d="M80 80 L65 80 L65 65 Z" fill="#7a5230"/>
                </svg>',

            'abu-album' => '
                <svg style="position:absolute;top:10px;right:-10px;width:170px;height:170px;opacity:0.5;pointer-events:none;" viewBox="0 0 170 170" fill="none">
                    <rect x="20" y="20" width="80" height="100" fill="#fdf6e3" stroke="#8b5e34" stroke-width="2" transform="rotate(-8 60 70)"/>
                    <rect x="32" y="32" width="56" height="56" fill="#d4b489" transform="rotate(-8 60 60)"/>
                    <text x="60" y="115" text-anchor="middle" font-size="9" fill="#5c3d1f" font-family="serif" transform="rotate(-8 60 115)">1965</text>
                    <rect x="70" y="50" width="80" height="100" fill="#fdf6e3" stroke="#8b5e34" stroke-width="2" transform="rotate(6 110 100)"/>
                    <rect x="82" y="62" width="56" height="56" fill="#c19a5b" transform="rotate(6 110 90)"/>
                </svg>
                <svg style="position:absolute;bottom:-5px;left:10px;width:120px;height:80px;opacity:0.5;pointer-events:none;" viewBox="0 0 120 80">
                    <rect x="10" y="20" width="55" height="55" fill="#fdf6e3" stroke="#8b5e34" stroke-width="2" transform="rotate(-12 37 47)"/>
                    <rect x="18" y="28" width="39" height="39" fill="#a8814e" transform="rotate(-12 37 47)"/>
                </svg>',

            'abu-pluma' => '
                <svg style="position:absolute;top:18px;right:18px;width:130px;height:130px;opacity:0.55;pointer-events:none;" viewBox="0 0 130 130" fill="none">
                    <path d="M30 100 Q60 60 100 25 L110 30 Q90 70 50 105 Z" fill="#5c3d1f" stroke="#3d2914" stroke-width="1"/>
                    <path d="M40 95 L100 35" stroke="#a8814e" stroke-width="0.8"/>
                    <path d="M45 100 L105 40" stroke="#a8814e" stroke-width="0.8"/>
                    <circle cx="30" cy="100" r="3" fill="#1f2937"/>
                    <path d="M30 103 L25 115" stroke="#1f2937" stroke-width="1.2"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;left:-10px;width:170px;height:120px;opacity:0.4;pointer-events:none;" viewBox="0 0 170 120" fill="none">
                    <path d="M10 20 Q20 10 40 18 L150 18 Q165 10 160 30 L160 95 Q165 115 145 105 L25 105 Q10 115 15 90 Z" fill="#fbf3df" stroke="#8b5e34" stroke-width="1.5"/>
                    <path d="M30 40 L130 40 M30 55 L120 55 M30 70 L135 70 M30 85 L100 85" stroke="#b8956a" stroke-width="0.7"/>
                </svg>',

            // ════ DÍA DE LA AMISTAD ════
            'ami-arcoiris' => '
                <svg style="position:absolute;top:-10px;right:-15px;width:200px;height:140px;opacity:0.6;pointer-events:none;" viewBox="0 0 200 140" fill="none">
                    <path d="M20 130 A80 80 0 0 1 180 130" stroke="#ef4444" stroke-width="9" fill="none"/>
                    <path d="M30 130 A70 70 0 0 1 170 130" stroke="#f97316" stroke-width="9" fill="none"/>
                    <path d="M40 130 A60 60 0 0 1 160 130" stroke="#facc15" stroke-width="9" fill="none"/>
                    <path d="M50 130 A50 50 0 0 1 150 130" stroke="#84cc16" stroke-width="9" fill="none"/>
                    <path d="M60 130 A40 40 0 0 1 140 130" stroke="#06b6d4" stroke-width="9" fill="none"/>
                    <path d="M70 130 A30 30 0 0 1 130 130" stroke="#8b5cf6" stroke-width="9" fill="none"/>
                    <ellipse cx="35" cy="130" rx="22" ry="9" fill="#fff"/>
                    <ellipse cx="165" cy="130" rx="22" ry="9" fill="#fff"/>
                </svg>
                <svg style="position:absolute;bottom:10px;left:10px;width:90px;height:60px;opacity:0.5;pointer-events:none;" viewBox="0 0 90 60">
                    <ellipse cx="30" cy="35" rx="22" ry="11" fill="#fff"/>
                    <ellipse cx="45" cy="28" rx="14" ry="8" fill="#fff"/>
                    <ellipse cx="20" cy="30" rx="11" ry="7" fill="#fff"/>
                </svg>',

            'ami-pulseras' => '
                <svg style="position:absolute;top:10px;right:10px;width:160px;height:80px;opacity:0.55;pointer-events:none;" viewBox="0 0 160 80" fill="none">
                    <path d="M5 40 Q15 25 25 40 T45 40 T65 40 T85 40 T105 40 T125 40 T145 40 T155 40" stroke="#fb7185" stroke-width="4" fill="none"/>
                    <path d="M5 40 Q15 55 25 40 T45 40 T65 40 T85 40 T105 40 T125 40 T145 40 T155 40" stroke="#fb923c" stroke-width="4" fill="none"/>
                    <circle cx="15" cy="40" r="3" fill="#facc15"/>
                    <circle cx="55" cy="40" r="3" fill="#a78bfa"/>
                    <circle cx="95" cy="40" r="3" fill="#34d399"/>
                    <circle cx="135" cy="40" r="3" fill="#f472b6"/>
                </svg>
                <svg style="position:absolute;bottom:5px;left:5px;width:160px;height:80px;opacity:0.55;pointer-events:none;" viewBox="0 0 160 80" fill="none">
                    <path d="M5 40 Q15 25 25 40 T45 40 T65 40 T85 40 T105 40 T125 40 T145 40 T155 40" stroke="#a78bfa" stroke-width="4" fill="none"/>
                    <path d="M5 40 Q15 55 25 40 T45 40 T65 40 T85 40 T105 40 T125 40 T145 40 T155 40" stroke="#38bdf8" stroke-width="4" fill="none"/>
                    <circle cx="35" cy="40" r="3" fill="#fb7185"/>
                    <circle cx="75" cy="40" r="3" fill="#facc15"/>
                    <circle cx="115" cy="40" r="3" fill="#34d399"/>
                </svg>',

            'ami-manos' => '
                <svg style="position:absolute;top:50%;left:50%;width:180px;height:140px;opacity:0.55;pointer-events:none;transform:translate(-50%,-50%);" viewBox="0 0 180 140" fill="none">
                    <g transform="translate(20 50)">
                        <ellipse cx="30" cy="30" rx="28" ry="22" fill="#fb923c"/>
                        <circle cx="20" cy="20" r="9" fill="#fb923c"/>
                        <circle cx="35" cy="15" r="9" fill="#fb923c"/>
                        <circle cx="50" cy="20" r="9" fill="#fb923c"/>
                    </g>
                    <g transform="translate(100 50)">
                        <ellipse cx="30" cy="30" rx="28" ry="22" fill="#a16207"/>
                        <circle cx="10" cy="20" r="9" fill="#a16207"/>
                        <circle cx="25" cy="15" r="9" fill="#a16207"/>
                        <circle cx="40" cy="20" r="9" fill="#a16207"/>
                    </g>
                    <g transform="translate(85 70)">
                        <circle cx="0" cy="0" r="4" fill="#facc15"/>
                        <circle cx="-8" cy="-6" r="3" fill="#facc15"/>
                        <circle cx="9" cy="-7" r="3" fill="#facc15"/>
                        <circle cx="-6" cy="8" r="3" fill="#facc15"/>
                        <circle cx="8" cy="7" r="3" fill="#facc15"/>
                    </g>
                </svg>
                <svg style="position:absolute;top:15px;right:15px;width:55px;height:55px;opacity:0.45;pointer-events:none;" viewBox="0 0 50 50">
                    <path d="M25 5 L29 18 L43 18 L32 27 L36 40 L25 32 L14 40 L18 27 L7 18 L21 18 Z" fill="#facc15"/>
                </svg>',

            // ════ NAVIDAD ════
            'nav-pino' => '
                <svg style="position:absolute;top:-10px;right:-5px;width:170px;height:200px;opacity:0.6;pointer-events:none;" viewBox="0 0 170 200" fill="none">
                    <path d="M85 15 L60 60 L70 60 L45 105 L60 105 L30 155 L140 155 L110 105 L125 105 L100 60 L110 60 Z" fill="#2d5a3d" stroke="#14532d" stroke-width="1.5"/>
                    <rect x="75" y="155" width="20" height="20" fill="#7c2d12"/>
                    <circle cx="85" cy="40" r="4" fill="#c41e3a"/>
                    <circle cx="65" cy="80" r="4" fill="#facc15"/>
                    <circle cx="105" cy="85" r="4" fill="#c41e3a"/>
                    <circle cx="55" cy="120" r="4" fill="#facc15"/>
                    <circle cx="115" cy="125" r="4" fill="#c41e3a"/>
                    <circle cx="85" cy="135" r="4" fill="#facc15"/>
                    <path d="M85 10 L88 18 L96 18 L90 23 L92 31 L85 26 L78 31 L80 23 L74 18 L82 18 Z" fill="#facc15"/>
                </svg>
                <svg style="position:absolute;bottom:10px;left:10px;width:80px;height:80px;opacity:0.5;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <rect x="20" y="35" width="40" height="35" fill="#c41e3a" stroke="#7f1d1d" stroke-width="1"/>
                    <rect x="36" y="35" width="8" height="35" fill="#facc15"/>
                    <path d="M28 35 Q34 25 40 35 Q46 25 52 35" stroke="#facc15" stroke-width="3" fill="none"/>
                </svg>',

            'nav-copos' => '
                <svg style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0.55;pointer-events:none;" viewBox="0 0 300 300" fill="none" preserveAspectRatio="none">
                    <g fill="none" stroke="#7dd3fc" stroke-width="1.5" stroke-linecap="round">
                        <g transform="translate(50 40)"><path d="M0 -14 L0 14 M-14 0 L14 0 M-10 -10 L10 10 M-10 10 L10 -10"/><path d="M-3 -12 L0 -14 L3 -12 M-3 12 L0 14 L3 12 M-12 -3 L-14 0 L-12 3 M12 -3 L14 0 L12 3"/></g>
                        <g transform="translate(220 70) scale(1.4)"><path d="M0 -14 L0 14 M-14 0 L14 0 M-10 -10 L10 10 M-10 10 L10 -10"/></g>
                        <g transform="translate(120 130) scale(0.7)"><path d="M0 -14 L0 14 M-14 0 L14 0 M-10 -10 L10 10 M-10 10 L10 -10"/></g>
                        <g transform="translate(260 200)"><path d="M0 -14 L0 14 M-14 0 L14 0 M-10 -10 L10 10 M-10 10 L10 -10"/></g>
                        <g transform="translate(40 230) scale(1.2)"><path d="M0 -14 L0 14 M-14 0 L14 0 M-10 -10 L10 10 M-10 10 L10 -10"/></g>
                        <g transform="translate(170 260) scale(0.8)"><path d="M0 -14 L0 14 M-14 0 L14 0 M-10 -10 L10 10 M-10 10 L10 -10"/></g>
                        <g transform="translate(80 90) scale(0.5)"><path d="M0 -14 L0 14 M-14 0 L14 0"/></g>
                        <g transform="translate(200 180) scale(0.6)"><path d="M0 -14 L0 14 M-14 0 L14 0"/></g>
                    </g>
                </svg>
                <svg style="position:absolute;bottom:-20px;left:-10px;width:200px;height:80px;opacity:0.4;pointer-events:none;" viewBox="0 0 200 80" fill="none">
                    <path d="M0 60 Q30 40 60 55 T120 50 T180 55 L200 60 L200 80 L0 80 Z" fill="#fff"/>
                </svg>',

            'nav-regalos' => '
                <svg style="position:absolute;bottom:-5px;right:-5px;width:170px;height:170px;opacity:0.6;pointer-events:none;" viewBox="0 0 170 170" fill="none">
                    <rect x="20" y="100" width="60" height="55" fill="#c41e3a" stroke="#7f1d1d" stroke-width="1.5"/>
                    <rect x="46" y="100" width="8" height="55" fill="#facc15"/>
                    <rect x="20" y="123" width="60" height="8" fill="#facc15"/>
                    <path d="M40 100 Q50 85 50 100 Q50 85 60 100" stroke="#facc15" stroke-width="4" fill="none"/>
                    <rect x="85" y="80" width="50" height="50" fill="#2d5a3d" stroke="#14532d" stroke-width="1.5"/>
                    <rect x="107" y="80" width="6" height="50" fill="#fff"/>
                    <rect x="85" y="100" width="50" height="6" fill="#fff"/>
                    <path d="M100 80 Q110 65 110 80 Q110 65 120 80" stroke="#fff" stroke-width="3" fill="none"/>
                    <rect x="50" y="40" width="45" height="45" fill="#facc15" stroke="#92400e" stroke-width="1.5"/>
                    <rect x="70" y="40" width="6" height="45" fill="#c41e3a"/>
                    <rect x="50" y="60" width="45" height="6" fill="#c41e3a"/>
                </svg>
                <svg style="position:absolute;top:14px;left:14px;width:80px;height:80px;opacity:0.45;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <circle cx="20" cy="20" r="4" fill="#c41e3a"/>
                    <circle cx="35" cy="14" r="4" fill="#c41e3a"/>
                    <circle cx="50" cy="20" r="4" fill="#c41e3a"/>
                    <path d="M20 24 Q35 35 50 24" stroke="#2d5a3d" stroke-width="2" fill="none"/>
                    <path d="M14 25 L26 25 M30 17 L42 17 M44 25 L56 25" stroke="#2d5a3d" stroke-width="1.5"/>
                </svg>',

            // ════ AÑO NUEVO ════
            'anu-fuegos' => '
                <svg style="position:absolute;top:-10px;right:-10px;width:200px;height:200px;opacity:0.7;pointer-events:none;" viewBox="0 0 200 200" fill="none">
                    <g transform="translate(80 70)" stroke="#fde047" stroke-width="1.5" stroke-linecap="round">
                        <line x1="0" y1="0" x2="0" y2="-40"/>
                        <line x1="0" y1="0" x2="28" y2="-28"/>
                        <line x1="0" y1="0" x2="40" y2="0"/>
                        <line x1="0" y1="0" x2="28" y2="28"/>
                        <line x1="0" y1="0" x2="0" y2="40"/>
                        <line x1="0" y1="0" x2="-28" y2="28"/>
                        <line x1="0" y1="0" x2="-40" y2="0"/>
                        <line x1="0" y1="0" x2="-28" y2="-28"/>
                    </g>
                    <g transform="translate(80 70)" fill="#fde047">
                        <circle cx="0" cy="-40" r="2.5"/><circle cx="28" cy="-28" r="2.5"/><circle cx="40" cy="0" r="2.5"/><circle cx="28" cy="28" r="2.5"/><circle cx="0" cy="40" r="2.5"/><circle cx="-28" cy="28" r="2.5"/><circle cx="-40" cy="0" r="2.5"/><circle cx="-28" cy="-28" r="2.5"/>
                    </g>
                    <g transform="translate(150 130)" stroke="#d946ef" stroke-width="1.2" stroke-linecap="round">
                        <line x1="0" y1="0" x2="0" y2="-25"/>
                        <line x1="0" y1="0" x2="18" y2="-18"/>
                        <line x1="0" y1="0" x2="25" y2="0"/>
                        <line x1="0" y1="0" x2="18" y2="18"/>
                        <line x1="0" y1="0" x2="0" y2="25"/>
                        <line x1="0" y1="0" x2="-18" y2="18"/>
                        <line x1="0" y1="0" x2="-25" y2="0"/>
                        <line x1="0" y1="0" x2="-18" y2="-18"/>
                    </g>
                </svg>
                <svg style="position:absolute;bottom:-15px;left:-10px;width:180px;height:180px;opacity:0.65;pointer-events:none;" viewBox="0 0 180 180" fill="none">
                    <g transform="translate(60 110)" stroke="#22d3ee" stroke-width="1.4" stroke-linecap="round">
                        <line x1="0" y1="0" x2="0" y2="-32"/>
                        <line x1="0" y1="0" x2="22" y2="-22"/>
                        <line x1="0" y1="0" x2="32" y2="0"/>
                        <line x1="0" y1="0" x2="22" y2="22"/>
                        <line x1="0" y1="0" x2="0" y2="32"/>
                        <line x1="0" y1="0" x2="-22" y2="22"/>
                        <line x1="0" y1="0" x2="-32" y2="0"/>
                        <line x1="0" y1="0" x2="-22" y2="-22"/>
                    </g>
                    <g fill="#fde047">
                        <circle cx="120" cy="40" r="1.5"/><circle cx="140" cy="80" r="1.5"/><circle cx="100" cy="160" r="1.5"/><circle cx="30" cy="50" r="1.5"/>
                    </g>
                </svg>',

            'anu-champagne' => '
                <svg style="position:absolute;top:50%;left:50%;width:200px;height:170px;opacity:0.6;pointer-events:none;transform:translate(-50%,-50%);" viewBox="0 0 200 170" fill="none">
                    <g stroke="#fde047" stroke-width="1.8" fill="rgba(253,224,71,0.18)">
                        <path d="M50 30 L70 30 L75 60 Q75 75 60 78 Q45 75 45 60 Z"/>
                        <line x1="60" y1="78" x2="60" y2="125"/>
                        <ellipse cx="60" cy="130" rx="18" ry="3"/>
                    </g>
                    <g stroke="#fde047" stroke-width="1.8" fill="rgba(253,224,71,0.18)">
                        <path d="M130 30 L150 30 L155 60 Q155 75 140 78 Q125 75 125 60 Z" transform="rotate(15 140 55)"/>
                        <line x1="140" y1="78" x2="140" y2="125" transform="rotate(15 140 100)"/>
                        <ellipse cx="148" cy="130" rx="18" ry="3"/>
                    </g>
                    <g fill="#facc15">
                        <circle cx="55" cy="50" r="1.5"/><circle cx="62" cy="55" r="1"/><circle cx="58" cy="62" r="1.2"/><circle cx="65" cy="48" r="1"/>
                        <circle cx="138" cy="48" r="1.5"/><circle cx="145" cy="55" r="1"/><circle cx="142" cy="62" r="1.2"/>
                        <circle cx="100" cy="40" r="1.5"/><circle cx="95" cy="55" r="1"/><circle cx="105" cy="50" r="1"/>
                    </g>
                </svg>
                <svg style="position:absolute;top:14px;right:14px;width:80px;height:80px;opacity:0.55;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <g fill="#fde047">
                        <path d="M40 10 L43 22 L55 22 L46 30 L49 42 L40 35 L31 42 L34 30 L25 22 L37 22 Z"/>
                    </g>
                </svg>',

            'anu-reloj' => '
                <svg style="position:absolute;top:50%;left:50%;width:180px;height:180px;opacity:0.65;pointer-events:none;transform:translate(-50%,-50%);" viewBox="0 0 180 180" fill="none">
                    <circle cx="90" cy="90" r="78" fill="rgba(10,10,31,0.6)" stroke="#fde047" stroke-width="2.5"/>
                    <circle cx="90" cy="90" r="68" fill="none" stroke="#fde047" stroke-width="0.5" opacity="0.5"/>
                    <g stroke="#fde047" stroke-width="2" stroke-linecap="round">
                        <line x1="90" y1="20" x2="90" y2="30"/>
                        <line x1="90" y1="150" x2="90" y2="160"/>
                        <line x1="20" y1="90" x2="30" y2="90"/>
                        <line x1="150" y1="90" x2="160" y2="90"/>
                        <line x1="40" y1="40" x2="46" y2="46"/>
                        <line x1="134" y1="46" x2="140" y2="40"/>
                        <line x1="40" y1="140" x2="46" y2="134"/>
                        <line x1="134" y1="134" x2="140" y2="140"/>
                    </g>
                    <text x="90" y="40" text-anchor="middle" font-size="16" fill="#fde047" font-weight="bold" font-family="serif">12</text>
                    <text x="148" y="96" text-anchor="middle" font-size="14" fill="#fde047" font-family="serif">3</text>
                    <text x="90" y="152" text-anchor="middle" font-size="14" fill="#fde047" font-family="serif">6</text>
                    <text x="34" y="96" text-anchor="middle" font-size="14" fill="#fde047" font-family="serif">9</text>
                    <line x1="90" y1="90" x2="90" y2="42" stroke="#fde047" stroke-width="3" stroke-linecap="round"/>
                    <line x1="90" y1="90" x2="90" y2="50" stroke="#d946ef" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="90" cy="90" r="4" fill="#fde047"/>
                </svg>
                <svg style="position:absolute;top:10px;left:10px;width:70px;height:70px;opacity:0.6;pointer-events:none;" viewBox="0 0 70 70" fill="none">
                    <path d="M35 8 L38 22 L52 22 L41 30 L44 44 L35 36 L26 44 L29 30 L18 22 L32 22 Z" fill="#fde047"/>
                </svg>
                <svg style="position:absolute;bottom:10px;right:10px;width:60px;height:60px;opacity:0.55;pointer-events:none;" viewBox="0 0 60 60" fill="none">
                    <path d="M30 8 L33 20 L45 20 L35 27 L38 39 L30 32 L22 39 L25 27 L15 20 L27 20 Z" fill="#d946ef"/>
                </svg>',
        ];
    }
}
