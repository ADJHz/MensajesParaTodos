<?php

namespace App\Helpers\Templates;

class OcasionGroupB
{
    public static function templates(): array
    {
        return [
            'dia-del-hermano' => [
                ['id'=>'her-polaroid','nombre'=>'Polaroid','emoji'=>'📸','desc'=>'Recuerdos de scrapbook','bg'=>'from-cyan-50 via-teal-50 to-orange-50','bar'=>'bg-gradient-to-r from-cyan-400 to-orange-400'],
                ['id'=>'her-highfive','nombre'=>'High Five','emoji'=>'🙌','desc'=>'Choca esos cinco','bg'=>'from-orange-50 via-amber-50 to-cyan-50','bar'=>'bg-gradient-to-r from-orange-500 via-amber-400 to-cyan-500'],
                ['id'=>'her-skate','nombre'=>'Skate Urbano','emoji'=>'🛹','desc'=>'Estilo callejero','bg'=>'from-slate-100 via-cyan-50 to-orange-50','bar'=>'bg-gradient-to-r from-slate-700 via-cyan-500 to-orange-500'],
            ],
            'cumple-hermano' => [
                ['id'=>'chrm-arcade','nombre'=>'Arcade Retro','emoji'=>'👾','desc'=>'Pixel art clásico','bg'=>'from-purple-900 via-indigo-900 to-black','bar'=>'bg-gradient-to-r from-lime-400 via-cyan-400 to-purple-500'],
                ['id'=>'chrm-neon','nombre'=>'Neón Vibrante','emoji'=>'💡','desc'=>'Brillos de neón','bg'=>'from-black via-purple-950 to-fuchsia-950','bar'=>'bg-gradient-to-r from-fuchsia-500 via-cyan-400 to-lime-400'],
                ['id'=>'chrm-gaming','nombre'=>'Gamer Pro','emoji'=>'🎮','desc'=>'Controles y energía','bg'=>'from-slate-900 via-purple-900 to-cyan-900','bar'=>'bg-gradient-to-r from-purple-600 via-cyan-500 to-lime-400'],
            ],
            'san-valentin' => [
                ['id'=>'sv-rosas','nombre'=>'Rosas Rojas','emoji'=>'🌹','desc'=>'Pétalos de pasión','bg'=>'from-red-100 via-rose-100 to-pink-100','bar'=>'bg-gradient-to-r from-red-600 via-rose-500 to-pink-500'],
                ['id'=>'sv-cupido','nombre'=>'Flecha Cupido','emoji'=>'💘','desc'=>'Corazón flechado','bg'=>'from-pink-100 via-rose-50 to-amber-50','bar'=>'bg-gradient-to-r from-pink-500 via-rose-400 to-amber-400'],
                ['id'=>'sv-bombones','nombre'=>'Bombones','emoji'=>'🍫','desc'=>'Caja de chocolates','bg'=>'from-amber-100 via-rose-100 to-red-100','bar'=>'bg-gradient-to-r from-amber-700 via-rose-500 to-red-600'],
            ],
            'aniversario' => [
                ['id'=>'ani-anillos','nombre'=>'Anillos','emoji'=>'💍','desc'=>'Brillo eterno','bg'=>'from-amber-50 via-yellow-50 to-stone-100','bar'=>'bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-600'],
                ['id'=>'ani-champagne','nombre'=>'Champagne','emoji'=>'🥂','desc'=>'Brindis dorado','bg'=>'from-yellow-50 via-amber-100 to-stone-50','bar'=>'bg-gradient-to-r from-yellow-500 via-amber-400 to-yellow-600'],
                ['id'=>'ani-artdeco','nombre'=>'Art Déco','emoji'=>'✨','desc'=>'Elegancia geométrica','bg'=>'from-stone-900 via-amber-950 to-stone-900','bar'=>'bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500'],
            ],
            'solo-porque-si' => [
                ['id'=>'sps-postit','nombre'=>'Post-its','emoji'=>'🗒️','desc'=>'Notitas de colores','bg'=>'from-yellow-50 via-sky-50 to-green-50','bar'=>'bg-gradient-to-r from-yellow-400 via-sky-400 to-green-400'],
                ['id'=>'sps-garabatos','nombre'=>'Garabatos','emoji'=>'✏️','desc'=>'Trazos a mano','bg'=>'from-white via-sky-50 to-yellow-50','bar'=>'bg-gradient-to-r from-slate-700 via-sky-500 to-yellow-500'],
                ['id'=>'sps-corcho','nombre'=>'Corcho','emoji'=>'📌','desc'=>'Tablero de notas','bg'=>'from-amber-100 via-orange-50 to-yellow-50','bar'=>'bg-gradient-to-r from-amber-700 via-orange-500 to-yellow-500'],
            ],
        ];
    }

    public static function configs(): array
    {
        return [
            // ===== Día del Hermano =====
            'her-polaroid' => [
                'wrap' => 'background:linear-gradient(135deg,#ecfeff 0%,#f0fdfa 50%,#fff7ed 100%);',
                'card' => 'background:#fffefb;border-radius:18px;border:1px solid #cffafe;box-shadow:0 18px 50px -18px rgba(8,145,178,0.35);overflow:hidden;',
                'bar'  => 'background:repeating-linear-gradient(45deg,#fb923c 0 14px,#fef3c7 14px 28px,#22d3ee 28px 42px);height:14px;',
                'bc'   => '',
                'tc'   => '#0e7490',
                'ac'   => '#ea580c',
                'bg'   => '#ffffff',
                'tx'   => '#0f172a',
                'fc'   => '#0891b2',
                'deco' => '📸🎞️🤝',
            ],
            'her-highfive' => [
                'wrap' => 'background:linear-gradient(135deg,#fff7ed 0%,#fffbeb 45%,#ecfeff 100%);',
                'card' => 'background:#fffaf3;border-radius:24px;border:3px dashed #fb923c;box-shadow:0 22px 55px -20px rgba(234,88,12,0.45);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#f97316,#fbbf24,#22d3ee);height:10px;',
                'bc'   => '🙌 ¡CHOCA ESOS CINCO!',
                'tc'   => '#c2410c',
                'ac'   => '#0891b2',
                'bg'   => '#fff7ed',
                'tx'   => '#1e293b',
                'fc'   => '#ea580c',
                'deco' => '🙌✋⚡',
            ],
            'her-skate' => [
                'wrap' => 'background:linear-gradient(135deg,#f1f5f9 0%,#ecfeff 50%,#fff7ed 100%);',
                'card' => 'background:#fafafa;border-radius:6px;border:2px solid #1e293b;box-shadow:8px 8px 0 #0e7490,16px 16px 0 #f97316;overflow:hidden;',
                'bar'  => 'background:#0f172a;height:18px;border-bottom:3px solid #f97316;',
                'bc'   => '🛹 STREET STYLE',
                'tc'   => '#0f172a',
                'ac'   => '#f97316',
                'bg'   => '#ffffff',
                'tx'   => '#1e293b',
                'fc'   => '#0891b2',
                'deco' => '🛹⭐🏙️',
            ],

            // ===== Cumple Hermano =====
            'chrm-arcade' => [
                'wrap' => 'background:linear-gradient(135deg,#1e1b4b 0%,#312e81 50%,#000000 100%);',
                'card' => 'background:#0f0f1f;border-radius:0;border:4px solid #a3e635;box-shadow:0 0 0 4px #000,0 0 30px #a3e635,0 0 60px #22d3ee;overflow:hidden;image-rendering:pixelated;',
                'bar'  => 'background:repeating-linear-gradient(90deg,#a3e635 0 12px,#22d3ee 12px 24px,#a855f7 24px 36px);height:16px;',
                'bc'   => '👾 PRESS START 👾',
                'tc'   => '#a3e635',
                'ac'   => '#22d3ee',
                'bg'   => '#1a1a2e',
                'tx'   => '#e0e7ff',
                'fc'   => '#a855f7',
                'deco' => '👾🕹️🎯',
            ],
            'chrm-neon' => [
                'wrap' => 'background:radial-gradient(circle at 30% 20%,#581c87 0%,#000000 60%);',
                'card' => 'background:#0a0014;border-radius:20px;border:2px solid #d946ef;box-shadow:0 0 25px #d946ef,0 0 50px #22d3ee,inset 0 0 20px rgba(217,70,239,0.3);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#d946ef,#22d3ee,#a3e635);height:6px;box-shadow:0 0 15px #d946ef;',
                'bc'   => '',
                'tc'   => '#f0abfc',
                'ac'   => '#67e8f9',
                'bg'   => 'rgba(15,5,30,0.85)',
                'tx'   => '#fce7f3',
                'fc'   => '#a3e635',
                'deco' => '💡✨🌃',
            ],
            'chrm-gaming' => [
                'wrap' => 'background:linear-gradient(135deg,#0f172a 0%,#581c87 50%,#164e63 100%);',
                'card' => 'background:#1e293b;border-radius:14px;border:2px solid #22d3ee;box-shadow:0 0 0 6px #0f172a,0 20px 50px rgba(168,85,247,0.5);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#a855f7 0%,#a855f7 70%,#22c55e 70%,#22c55e 90%,#ef4444 90%,#ef4444 100%);height:12px;',
                'bc'   => '🎮 PLAYER 1 — HP ████████░░',
                'tc'   => '#67e8f9',
                'ac'   => '#a3e635',
                'bg'   => '#0f172a',
                'tx'   => '#e2e8f0',
                'fc'   => '#a855f7',
                'deco' => '🎮🕹️⚔️',
            ],

            // ===== San Valentín =====
            'sv-rosas' => [
                'wrap' => 'background:linear-gradient(135deg,#fee2e2 0%,#ffe4e6 50%,#fce7f3 100%);',
                'card' => 'background:#fff5f5;border-radius:22px;border:1px solid #fecaca;box-shadow:0 25px 60px -25px rgba(190,18,60,0.55);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#dc2626,#e11d48,#be185d);height:12px;',
                'bc'   => '🌹 con todo mi amor 🌹',
                'tc'   => '#9f1239',
                'ac'   => '#dc2626',
                'bg'   => '#fff1f2',
                'tx'   => '#450a0a',
                'fc'   => '#be123c',
                'deco' => '🌹🌹🌹',
            ],
            'sv-cupido' => [
                'wrap' => 'background:linear-gradient(135deg,#fce7f3 0%,#fff1f2 50%,#fffbeb 100%);',
                'card' => 'background:#fffafc;border-radius:50% 12px 50% 12px / 12px 50% 12px 50%;border:2px solid #f9a8d4;box-shadow:0 20px 50px -20px rgba(236,72,153,0.5);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#ec4899,#f43f5e,#fbbf24);height:8px;',
                'bc'   => '💘 flechazo certero 💘',
                'tc'   => '#be185d',
                'ac'   => '#f59e0b',
                'bg'   => '#fdf2f8',
                'tx'   => '#831843',
                'fc'   => '#db2777',
                'deco' => '💘🏹💖',
            ],
            'sv-bombones' => [
                'wrap' => 'background:linear-gradient(135deg,#fef3c7 0%,#ffe4e6 50%,#fee2e2 100%);',
                'card' => 'background:#fdf6e3;border-radius:14px;border:6px solid #b91c1c;box-shadow:inset 0 0 0 3px #fbbf24,0 18px 45px -18px rgba(120,53,15,0.55);overflow:hidden;',
                'bar'  => 'background:repeating-linear-gradient(90deg,#7c2d12 0 22px,#a16207 22px 44px);height:14px;',
                'bc'   => '🍫 endulzando tu día',
                'tc'   => '#7c2d12',
                'ac'   => '#dc2626',
                'bg'   => '#fffbeb',
                'tx'   => '#451a03',
                'fc'   => '#b91c1c',
                'deco' => '🍫🎁🍬',
            ],

            // ===== Aniversario =====
            'ani-anillos' => [
                'wrap' => 'background:linear-gradient(135deg,#fffbeb 0%,#fefce8 50%,#f5f5f4 100%);',
                'card' => 'background:#fffdf5;border-radius:16px;border:2px solid #f59e0b;box-shadow:0 0 0 1px #fde68a,0 25px 60px -22px rgba(180,83,9,0.5);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#b45309,#f59e0b,#fbbf24,#f59e0b,#b45309);height:10px;',
                'bc'   => '💍 ∞ por siempre ∞ 💍',
                'tc'   => '#92400e',
                'ac'   => '#d97706',
                'bg'   => '#fffbeb',
                'tx'   => '#451a03',
                'fc'   => '#b45309',
                'deco' => '💍✨💛',
            ],
            'ani-champagne' => [
                'wrap' => 'background:linear-gradient(135deg,#fefce8 0%,#fef3c7 50%,#fafaf9 100%);',
                'card' => 'background:linear-gradient(180deg,#fffdf0 0%,#fef9c3 100%);border-radius:24px 24px 8px 8px;border:1px solid #fbbf24;box-shadow:0 22px 55px -22px rgba(202,138,4,0.55);overflow:hidden;',
                'bar'  => 'background:linear-gradient(90deg,#ca8a04,#eab308,#fde047,#eab308,#ca8a04);height:8px;',
                'bc'   => '🥂 ¡Salud por nosotros! 🥂',
                'tc'   => '#854d0e',
                'ac'   => '#ca8a04',
                'bg'   => '#fefce8',
                'tx'   => '#422006',
                'fc'   => '#a16207',
                'deco' => '🥂🍾✨',
            ],
            'ani-artdeco' => [
                'wrap' => 'background:linear-gradient(135deg,#1c1917 0%,#451a03 50%,#0c0a09 100%);',
                'card' => 'background:#0c0a09;border-radius:0;border:2px solid #f59e0b;box-shadow:inset 0 0 0 6px #0c0a09,inset 0 0 0 7px #fbbf24,0 25px 60px rgba(0,0,0,0.7);overflow:hidden;',
                'bar'  => 'background:repeating-linear-gradient(90deg,#f59e0b 0 4px,#0c0a09 4px 10px);height:8px;',
                'bc'   => '✦ ✦ ✦  ANIVERSARIO  ✦ ✦ ✦',
                'tc'   => '#fbbf24',
                'ac'   => '#fde68a',
                'bg'   => '#1c1917',
                'tx'   => '#fef3c7',
                'fc'   => '#f59e0b',
                'deco' => '✨◆✨',
            ],

            // ===== Solo porque sí =====
            'sps-postit' => [
                'wrap' => 'background:linear-gradient(135deg,#fefce8 0%,#f0f9ff 50%,#f0fdf4 100%);',
                'card' => 'background:#fef9c3;border-radius:4px;border:none;box-shadow:3px 3px 0 #facc15,8px 12px 25px rgba(0,0,0,0.15);overflow:hidden;transform:rotate(-1deg);',
                'bar'  => 'background:#fde047;height:10px;border-bottom:1px dashed #ca8a04;',
                'bc'   => '📌 nota para ti',
                'tc'   => '#713f12',
                'ac'   => '#0284c7',
                'bg'   => '#fef9c3',
                'tx'   => '#422006',
                'fc'   => '#ca8a04',
                'deco' => '🗒️📌💛',
            ],
            'sps-garabatos' => [
                'wrap' => 'background:linear-gradient(135deg,#ffffff 0%,#f0f9ff 50%,#fefce8 100%);',
                'card' => 'background:#fefefe;border-radius:12px;border:3px solid #0f172a;box-shadow:6px 6px 0 #0f172a;overflow:hidden;',
                'bar'  => 'background:#ffffff;height:16px;border-bottom:3px solid #0f172a;background-image:radial-gradient(circle,#0f172a 2px,transparent 2px);background-size:18px 18px;',
                'bc'   => '✏️ ~~~ scribble scribble ~~~',
                'tc'   => '#0f172a',
                'ac'   => '#0284c7',
                'bg'   => '#ffffff',
                'tx'   => '#0f172a',
                'fc'   => '#ca8a04',
                'deco' => '✏️〰️⭐',
            ],
            'sps-corcho' => [
                'wrap' => 'background:linear-gradient(135deg,#fef3c7 0%,#ffedd5 50%,#fefce8 100%);',
                'card' => 'background:#d97706;background-image:radial-gradient(circle at 20% 30%,#b45309 1px,transparent 1px),radial-gradient(circle at 70% 60%,#92400e 1px,transparent 1px),radial-gradient(circle at 40% 80%,#a16207 1px,transparent 1px);background-size:14px 14px,18px 18px,11px 11px;border-radius:10px;border:8px solid #78350f;box-shadow:inset 0 0 30px rgba(0,0,0,0.25),0 18px 45px -18px rgba(120,53,15,0.6);overflow:hidden;',
                'bar'  => 'background:#78350f;height:12px;border-bottom:2px solid #451a03;',
                'bc'   => '📌 pinned just for you',
                'tc'   => '#fef3c7',
                'ac'   => '#fbbf24',
                'bg'   => '#fefce8',
                'tx'   => '#422006',
                'fc'   => '#92400e',
                'deco' => '📌📋🧷',
            ],
        ];
    }

    public static function svg(): array
    {
        return [
            // ===== Día del Hermano =====
            'her-polaroid' => '<svg style="position:absolute;top:12px;right:14px;width:90px;height:90px;opacity:0.55;pointer-events:none;transform:rotate(8deg);" viewBox="0 0 100 100"><rect x="15" y="15" width="70" height="80" rx="3" fill="#fff" stroke="#0e7490" stroke-width="2"/><rect x="20" y="20" width="60" height="50" fill="#cffafe"/><circle cx="38" cy="40" r="6" fill="#fb923c"/><path d="M20 70 L40 55 L55 65 L80 45 L80 70 Z" fill="#0891b2" opacity="0.6"/><rect x="8" y="10" width="35" height="10" fill="#fde68a" opacity="0.8" transform="rotate(-15 25 15)"/></svg><svg style="position:absolute;bottom:18px;left:16px;width:75px;height:75px;opacity:0.45;pointer-events:none;transform:rotate(-12deg);" viewBox="0 0 100 100"><rect x="20" y="20" width="60" height="70" rx="3" fill="#fff" stroke="#ea580c" stroke-width="2"/><rect x="25" y="25" width="50" height="40" fill="#fed7aa"/><circle cx="50" cy="45" r="8" fill="#0891b2"/></svg>',

            'her-highfive' => '<svg style="position:absolute;top:18px;right:18px;width:130px;height:130px;opacity:0.5;pointer-events:none;" viewBox="0 0 120 120"><g transform="translate(20 20)"><path d="M10 40 L10 20 Q10 12 18 12 Q26 12 26 20 L26 35 L26 12 Q26 4 34 4 Q42 4 42 12 L42 35 L42 8 Q42 0 50 0 Q58 0 58 8 L58 38 L58 18 Q58 10 66 10 Q74 10 74 18 L74 50 Q74 75 50 78 Q26 75 10 60 Z" fill="#fb923c" stroke="#c2410c" stroke-width="2"/></g><line x1="10" y1="60" x2="25" y2="55" stroke="#0891b2" stroke-width="3" stroke-linecap="round"/><line x1="8" y1="75" x2="22" y2="72" stroke="#0891b2" stroke-width="3" stroke-linecap="round"/><line x1="12" y1="90" x2="26" y2="86" stroke="#0891b2" stroke-width="3" stroke-linecap="round"/><text x="60" y="20" font-size="22" font-weight="bold" fill="#f97316">⚡</text></svg>',

            'her-skate' => '<svg style="position:absolute;bottom:14px;right:18px;width:140px;height:80px;opacity:0.55;pointer-events:none;" viewBox="0 0 160 80"><rect x="20" y="30" width="120" height="14" rx="7" fill="#f97316" stroke="#0f172a" stroke-width="2"/><rect x="30" y="44" width="20" height="8" fill="#0891b2"/><rect x="110" y="44" width="20" height="8" fill="#0891b2"/><circle cx="40" cy="58" r="8" fill="#0f172a"/><circle cx="120" cy="58" r="8" fill="#0f172a"/><circle cx="40" cy="58" r="3" fill="#94a3b8"/><circle cx="120" cy="58" r="3" fill="#94a3b8"/><polygon points="80,8 84,20 96,20 86,28 90,40 80,32 70,40 74,28 64,20 76,20" fill="#fbbf24" opacity="0.8"/></svg><svg style="position:absolute;top:18px;left:14px;width:70px;height:50px;opacity:0.4;pointer-events:none;" viewBox="0 0 70 50"><line x1="0" y1="10" x2="70" y2="10" stroke="#0f172a" stroke-width="2"/><line x1="0" y1="25" x2="70" y2="25" stroke="#f97316" stroke-width="2"/><line x1="0" y1="40" x2="70" y2="40" stroke="#0891b2" stroke-width="2"/></svg>',

            // ===== Cumple Hermano =====
            'chrm-arcade' => '<svg style="position:absolute;top:14px;right:14px;width:80px;height:80px;opacity:0.7;pointer-events:none;image-rendering:pixelated;" viewBox="0 0 16 16" shape-rendering="crispEdges"><rect x="2" y="3" width="12" height="2" fill="#a3e635"/><rect x="1" y="5" width="14" height="2" fill="#a3e635"/><rect x="3" y="5" width="2" height="2" fill="#000"/><rect x="11" y="5" width="2" height="2" fill="#000"/><rect x="0" y="7" width="16" height="2" fill="#a3e635"/><rect x="2" y="9" width="2" height="2" fill="#a3e635"/><rect x="6" y="9" width="4" height="2" fill="#a3e635"/><rect x="12" y="9" width="2" height="2" fill="#a3e635"/></svg><svg style="position:absolute;bottom:14px;left:14px;width:70px;height:70px;opacity:0.6;pointer-events:none;image-rendering:pixelated;" viewBox="0 0 16 16" shape-rendering="crispEdges"><rect x="6" y="6" width="4" height="4" fill="#22d3ee"/><rect x="7" y="2" width="2" height="4" fill="#22d3ee"/><rect x="7" y="10" width="2" height="4" fill="#22d3ee"/><rect x="2" y="7" width="4" height="2" fill="#22d3ee"/><rect x="10" y="7" width="4" height="2" fill="#22d3ee"/><rect x="2" y="2" width="2" height="2" fill="#a855f7"/><rect x="12" y="2" width="2" height="2" fill="#a855f7"/><rect x="2" y="12" width="2" height="2" fill="#a855f7"/><rect x="12" y="12" width="2" height="2" fill="#a855f7"/></svg>',

            'chrm-neon' => '<svg style="position:absolute;top:16px;right:16px;width:120px;height:120px;opacity:0.6;pointer-events:none;" viewBox="0 0 120 120"><defs><filter id="glow1"><feGaussianBlur stdDeviation="3" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter></defs><circle cx="60" cy="60" r="40" fill="none" stroke="#d946ef" stroke-width="2" filter="url(#glow1)"/><circle cx="60" cy="60" r="28" fill="none" stroke="#22d3ee" stroke-width="2" filter="url(#glow1)"/><circle cx="60" cy="60" r="14" fill="none" stroke="#a3e635" stroke-width="2" filter="url(#glow1)"/></svg><svg style="position:absolute;bottom:18px;left:18px;width:140px;height:50px;opacity:0.5;pointer-events:none;" viewBox="0 0 140 50"><defs><filter id="glow2"><feGaussianBlur stdDeviation="2"/></filter></defs><text x="10" y="35" font-family="monospace" font-size="28" font-weight="bold" fill="#d946ef" filter="url(#glow2)">★ ★ ★</text></svg>',

            'chrm-gaming' => '<svg style="position:absolute;top:14px;right:14px;width:130px;height:90px;opacity:0.6;pointer-events:none;" viewBox="0 0 140 90"><path d="M30 25 Q15 25 12 45 Q9 65 18 72 Q28 78 35 65 L50 50 L90 50 L105 65 Q112 78 122 72 Q131 65 128 45 Q125 25 110 25 Z" fill="#22d3ee" stroke="#0f172a" stroke-width="2"/><circle cx="35" cy="48" r="5" fill="#0f172a"/><circle cx="105" cy="48" r="4" fill="#a855f7"/><circle cx="115" cy="40" r="4" fill="#a3e635"/><rect x="30" y="44" width="3" height="9" fill="#0f172a"/><rect x="27" y="46" width="9" height="3" fill="#0f172a"/></svg><svg style="position:absolute;bottom:14px;left:14px;width:120px;height:18px;opacity:0.7;pointer-events:none;" viewBox="0 0 120 18"><rect x="0" y="2" width="120" height="14" rx="3" fill="#1e293b" stroke="#22d3ee" stroke-width="1"/><rect x="2" y="4" width="80" height="10" rx="2" fill="#a3e635"/><rect x="84" y="4" width="20" height="10" rx="2" fill="#fbbf24"/></svg>',

            // ===== San Valentín =====
            'sv-rosas' => '<svg style="position:absolute;top:12px;right:14px;width:120px;height:120px;opacity:0.55;pointer-events:none;" viewBox="0 0 120 120"><g transform="translate(60 50)"><circle r="22" fill="#dc2626"/><circle r="16" fill="#b91c1c"/><circle r="10" fill="#7f1d1d"/><circle r="5" fill="#450a0a"/></g><path d="M60 70 Q55 90 45 110" stroke="#15803d" stroke-width="3" fill="none"/><path d="M52 88 Q42 85 38 95 Q48 95 52 88" fill="#22c55e"/><circle cx="20" cy="100" r="4" fill="#dc2626" opacity="0.6"/><circle cx="100" cy="105" r="3" fill="#e11d48" opacity="0.6"/><circle cx="15" cy="50" r="3" fill="#be185d" opacity="0.5"/></svg><svg style="position:absolute;bottom:14px;left:14px;width:80px;height:80px;opacity:0.45;pointer-events:none;" viewBox="0 0 80 80"><g transform="translate(40 35)"><circle r="16" fill="#e11d48"/><circle r="11" fill="#9f1239"/></g></svg>',

            'sv-cupido' => '<svg style="position:absolute;top:14px;right:14px;width:140px;height:120px;opacity:0.55;pointer-events:none;" viewBox="0 0 140 120"><path d="M70 30 C70 10, 35 10, 35 40 C35 65, 70 90, 70 90 C70 90, 105 65, 105 40 C105 10, 70 10, 70 30 Z" fill="#ec4899" stroke="#be185d" stroke-width="2"/><line x1="10" y1="20" x2="130" y2="100" stroke="#78350f" stroke-width="3"/><polygon points="130,100 118,98 124,108" fill="#78350f"/><polygon points="130,100 130,90 138,96" fill="#dc2626"/><path d="M10 20 L4 14 M10 20 L4 26 M10 20 L0 20" stroke="#fbbf24" stroke-width="2"/></svg>',

            'sv-bombones' => '<svg style="position:absolute;top:14px;right:16px;width:140px;height:110px;opacity:0.6;pointer-events:none;" viewBox="0 0 140 110"><rect x="15" y="35" width="110" height="65" rx="5" fill="#7c2d12" stroke="#451a03" stroke-width="2"/><rect x="15" y="35" width="110" height="14" fill="#a16207"/><circle cx="38" cy="68" r="11" fill="#92400e"/><circle cx="70" cy="68" r="11" fill="#451a03"/><circle cx="102" cy="68" r="11" fill="#92400e"/><circle cx="38" cy="65" r="3" fill="#fbbf24"/><circle cx="70" cy="65" r="3" fill="#fef3c7"/><circle cx="102" cy="65" r="3" fill="#fbbf24"/><path d="M55 25 Q70 5 85 25 Q95 18 90 38 L70 32 L50 38 Q45 18 55 25 Z" fill="#dc2626" stroke="#7f1d1d" stroke-width="1.5"/><circle cx="70" cy="32" r="5" fill="#b91c1c"/></svg>',

            // ===== Aniversario =====
            'ani-anillos' => '<svg style="position:absolute;top:14px;right:16px;width:140px;height:100px;opacity:0.6;pointer-events:none;" viewBox="0 0 140 100"><defs><radialGradient id="g1"><stop offset="0%" stop-color="#fef3c7"/><stop offset="100%" stop-color="#b45309"/></radialGradient></defs><circle cx="55" cy="55" r="28" fill="none" stroke="url(#g1)" stroke-width="6"/><circle cx="85" cy="55" r="28" fill="none" stroke="url(#g1)" stroke-width="6"/><circle cx="55" cy="55" r="28" fill="none" stroke="#fbbf24" stroke-width="1"/><circle cx="85" cy="55" r="28" fill="none" stroke="#fbbf24" stroke-width="1"/><text x="20" y="25" font-size="16" fill="#fbbf24">✦</text><text x="115" y="22" font-size="14" fill="#f59e0b">✧</text><text x="65" y="98" font-size="12" fill="#fde68a">✦</text></svg>',

            'ani-champagne' => '<svg style="position:absolute;top:12px;right:16px;width:140px;height:140px;opacity:0.55;pointer-events:none;" viewBox="0 0 140 140"><path d="M30 20 L50 20 L48 55 Q48 70 40 72 Q32 70 32 55 Z" fill="#fef9c3" stroke="#a16207" stroke-width="1.5"/><line x1="40" y1="72" x2="40" y2="115" stroke="#a16207" stroke-width="1.5"/><ellipse cx="40" cy="118" rx="14" ry="3" fill="#a16207"/><path d="M90 20 L110 20 L108 55 Q108 70 100 72 Q92 70 92 55 Z" fill="#fef9c3" stroke="#a16207" stroke-width="1.5" transform="rotate(15 100 60)"/><line x1="100" y1="72" x2="105" y2="115" stroke="#a16207" stroke-width="1.5" transform="rotate(15 100 60)"/><ellipse cx="105" cy="118" rx="14" ry="3" fill="#a16207"/><circle cx="38" cy="35" r="2" fill="#fde047"/><circle cx="44" cy="42" r="1.5" fill="#fde047"/><circle cx="98" cy="38" r="2" fill="#fde047"/><circle cx="60" cy="10" r="1.5" fill="#facc15"/><circle cx="80" cy="8" r="1.5" fill="#facc15"/></svg>',

            'ani-artdeco' => '<svg style="position:absolute;top:0;left:0;right:0;bottom:0;width:100%;height:100%;opacity:0.35;pointer-events:none;" viewBox="0 0 200 200" preserveAspectRatio="none"><g stroke="#fbbf24" stroke-width="1" fill="none"><polygon points="100,10 130,40 100,70 70,40"/><polygon points="100,130 130,160 100,190 70,160"/><line x1="20" y1="20" x2="60" y2="60"/><line x1="180" y1="20" x2="140" y2="60"/><line x1="20" y1="180" x2="60" y2="140"/><line x1="180" y1="180" x2="140" y2="140"/><circle cx="100" cy="100" r="50"/><circle cx="100" cy="100" r="35"/><polygon points="100,75 110,100 100,125 90,100"/></g><g fill="#fbbf24"><text x="95" y="22" font-size="14">✦</text><text x="95" y="195" font-size="14">✦</text></g></svg>',

            // ===== Solo porque sí =====
            'sps-postit' => '<svg style="position:absolute;top:10px;right:18px;width:90px;height:90px;opacity:0.7;pointer-events:none;transform:rotate(8deg);" viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" fill="#7dd3fc" stroke="#0284c7" stroke-width="1"/><circle cx="50" cy="14" r="3" fill="#dc2626"/><line x1="20" y1="35" x2="80" y2="35" stroke="#0c4a6e" stroke-width="1" opacity="0.4"/><line x1="20" y1="50" x2="70" y2="50" stroke="#0c4a6e" stroke-width="1" opacity="0.4"/><line x1="20" y1="65" x2="75" y2="65" stroke="#0c4a6e" stroke-width="1" opacity="0.4"/></svg><svg style="position:absolute;bottom:14px;left:16px;width:85px;height:85px;opacity:0.65;pointer-events:none;transform:rotate(-12deg);" viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" fill="#86efac" stroke="#16a34a" stroke-width="1"/><circle cx="50" cy="14" r="3" fill="#dc2626"/><text x="50" y="58" text-anchor="middle" font-size="36">💚</text></svg><svg style="position:absolute;top:45%;right:8px;width:60px;height:60px;opacity:0.6;pointer-events:none;transform:rotate(20deg);" viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" fill="#fde047" stroke="#ca8a04" stroke-width="1"/><circle cx="50" cy="14" r="3" fill="#dc2626"/></svg>',

            'sps-garabatos' => '<svg style="position:absolute;top:14px;right:14px;width:120px;height:120px;opacity:0.55;pointer-events:none;" viewBox="0 0 120 120"><path d="M10 60 Q30 20, 50 60 T90 60 T110 60" stroke="#0f172a" stroke-width="2.5" fill="none" stroke-linecap="round"/><circle cx="60" cy="30" r="15" stroke="#0284c7" stroke-width="2.5" fill="none" stroke-dasharray="4 3"/><polygon points="60,80 70,100 50,100" stroke="#ca8a04" stroke-width="2.5" fill="none" stroke-linejoin="round"/><path d="M85 95 L95 105 M95 95 L85 105" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/><text x="15" y="105" font-size="22" fill="#0f172a">✦</text></svg><svg style="position:absolute;bottom:18px;left:14px;width:90px;height:50px;opacity:0.5;pointer-events:none;" viewBox="0 0 90 50"><path d="M5 25 Q15 10, 25 25 T45 25 T65 25 T85 25" stroke="#0284c7" stroke-width="2" fill="none"/><path d="M5 40 Q15 30, 25 40 T45 40 T65 40 T85 40" stroke="#0f172a" stroke-width="2" fill="none"/></svg>',

            'sps-corcho' => '<svg style="position:absolute;top:14px;right:14px;width:90px;height:90px;opacity:0.85;pointer-events:none;transform:rotate(6deg);" viewBox="0 0 100 100"><rect x="10" y="14" width="80" height="78" fill="#fef9c3" stroke="#ca8a04" stroke-width="1"/><circle cx="50" cy="16" r="6" fill="#dc2626" stroke="#7f1d1d" stroke-width="1"/><circle cx="50" cy="14" r="2" fill="#fca5a5"/><line x1="20" y1="38" x2="80" y2="38" stroke="#a16207" stroke-width="1" opacity="0.5"/><line x1="20" y1="55" x2="70" y2="55" stroke="#a16207" stroke-width="1" opacity="0.5"/><line x1="20" y1="72" x2="78" y2="72" stroke="#a16207" stroke-width="1" opacity="0.5"/></svg><svg style="position:absolute;bottom:18px;left:18px;width:80px;height:80px;opacity:0.8;pointer-events:none;transform:rotate(-9deg);" viewBox="0 0 100 100"><rect x="10" y="14" width="80" height="78" fill="#ffffff" stroke="#94a3b8" stroke-width="1"/><circle cx="50" cy="16" r="6" fill="#1e40af" stroke="#1e3a8a" stroke-width="1"/><circle cx="50" cy="14" r="2" fill="#93c5fd"/><text x="50" y="60" text-anchor="middle" font-size="30">💌</text></svg>',
        ];
    }
}
