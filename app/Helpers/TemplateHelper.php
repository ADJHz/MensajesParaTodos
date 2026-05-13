<?php

namespace App\Helpers;

use App\Helpers\Templates\OcasionGroupA;
use App\Helpers\Templates\OcasionGroupB;
use App\Helpers\Templates\OcasionGroupC;
use App\Helpers\Templates\OcasionGroupD;

class TemplateHelper
{
    /**
     * Mapa COMPLETO: slug_ocasion => array de templates específicos.
     * Une los 4 grupos generados por los subagentes.
     */
    private static function templatesPorOcasionMap(): array
    {
        return array_merge(
            OcasionGroupA::templates(),
            OcasionGroupB::templates(),
            OcasionGroupC::templates(),
            OcasionGroupD::templates(),
            self::templatesPequesPorOcasion(),
        );
    }

    /**
     * Devuelve los templates de PREVIEW específicos a la ocasión.
     * Si la ocasión no tiene templates dedicados, cae a la categoría.
     */
    public static function porOcasion(?string $ocasionSlug, ?string $categoriaSlug = null): array
    {
        if ($ocasionSlug !== null) {
            $map = self::templatesPorOcasionMap();
            if (isset($map[$ocasionSlug])) {
                return $map[$ocasionSlug];
            }
        }
        return self::porCategoria($categoriaSlug);
    }

    /**
     * Devuelve los templates disponibles para una categoría dada.
     * Si la categoría no tiene templates específicos, retorna los genéricos.
     */
    public static function porCategoria(?string $categoriaSlug): array
    {
        $map = [
            'para-mama'       => self::templatesMama(),
            'para-papa'       => self::templatesPapa(),
            'para-hermanos'   => self::templatesHermanos(),
            'para-parejas'    => self::templatesParejas(),
            'dias-especiales' => self::templatesEspeciales(),
            'cumpleanos'      => self::templatesCumpleanos(),
            'para-mas-peques' => self::templatesPeques(),
        ];

        return $map[$categoriaSlug] ?? self::templatesGenericos();
    }

    /** Template por defecto: primer item de la lista de la ocasión (o categoría como fallback) */
    public static function defaultTemplate(?string $categoriaSlug, ?string $ocasionSlug = null): string
    {
        $tpls = self::porOcasion($ocasionSlug, $categoriaSlug);
        return $tpls[0]['id'] ?? 'clasico';
    }

    // ─── PARA MAMÁ ───────────────────────────────────────────────────────────

    public static function templatesMama(): array
    {
        return [
            [
                'id'     => 'mama-flores',
                'nombre' => 'Jardín de Flores',
                'emoji'  => '🌺',
                'desc'   => 'Cálido y florido, perfecto para mamá',
                'bg'     => 'from-rose-50 via-pink-50 to-fuchsia-50',
                'bar'    => 'bg-gradient-to-r from-rose-400 to-fuchsia-400',
            ],
            [
                'id'     => 'mama-carta',
                'nombre' => 'Carta de Amor',
                'emoji'  => '💌',
                'desc'   => 'Una carta íntima y emotiva',
                'bg'     => 'from-amber-50 via-orange-50 to-rose-50',
                'bar'    => 'bg-gradient-to-r from-amber-400 to-rose-400',
            ],
            [
                'id'     => 'mama-cielo',
                'nombre' => 'Cielo Pastel',
                'emoji'  => '🌸',
                'desc'   => 'Suave como el amor de mamá',
                'bg'     => 'from-sky-50 via-violet-50 to-pink-50',
                'bar'    => 'bg-gradient-to-r from-sky-300 to-violet-400',
            ],
            [
                'id'     => 'mama-dorada',
                'nombre' => 'Mamá Dorada',
                'emoji'  => '👑',
                'desc'   => 'Ella merece lo más especial',
                'bg'     => 'from-yellow-50 via-amber-50 to-orange-50',
                'bar'    => 'bg-gradient-to-r from-yellow-400 to-amber-500',
            ],
        ];
    }

    // ─── PARA PAPÁ ───────────────────────────────────────────────────────────

    public static function templatesPapa(): array
    {
        return [
            [
                'id'     => 'papa-aventura',
                'nombre' => 'Aventura',
                'emoji'  => '🏔️',
                'desc'   => 'Para el papá explorador',
                'bg'     => 'from-emerald-50 via-teal-50 to-cyan-50',
                'bar'    => 'bg-gradient-to-r from-emerald-500 to-teal-500',
            ],
            [
                'id'     => 'papa-noche',
                'nombre' => 'Noche Estrellada',
                'emoji'  => '🌙',
                'desc'   => 'Elegante y sereno',
                'bg'     => 'from-slate-900 via-blue-950 to-indigo-900',
                'bar'    => 'bg-gradient-to-r from-blue-500 to-indigo-400',
                'dark'   => true,
            ],
            [
                'id'     => 'papa-retro',
                'nombre' => 'Retro Clásico',
                'emoji'  => '📻',
                'desc'   => 'Nostálgico y con carácter',
                'bg'     => 'from-stone-100 via-amber-50 to-stone-100',
                'bar'    => 'bg-gradient-to-r from-stone-500 to-amber-600',
            ],
        ];
    }

    // ─── PARA HERMANOS ───────────────────────────────────────────────────────

    public static function templatesHermanos(): array
    {
        return [
            [
                'id'     => 'hermanos-fresco',
                'nombre' => 'Fresco y Joven',
                'emoji'  => '🎸',
                'desc'   => 'Vibrante como los buenos recuerdos',
                'bg'     => 'from-cyan-50 via-sky-50 to-blue-50',
                'bar'    => 'bg-gradient-to-r from-cyan-400 to-blue-500',
            ],
            [
                'id'     => 'hermanos-grafiti',
                'nombre' => 'Urban Grafiti',
                'emoji'  => '🎨',
                'desc'   => 'Moderno, urbano y atrevido',
                'bg'     => 'from-gray-900 via-gray-800 to-slate-900',
                'bar'    => 'bg-gradient-to-r from-violet-500 to-pink-500',
                'dark'   => true,
            ],
            [
                'id'     => 'hermanos-nostalgia',
                'nombre' => 'Nostalgia',
                'emoji'  => '📸',
                'desc'   => 'Para recordar juntos',
                'bg'     => 'from-orange-50 via-amber-50 to-yellow-50',
                'bar'    => 'bg-gradient-to-r from-orange-400 to-yellow-400',
            ],
        ];
    }

    // ─── PARA PAREJAS ────────────────────────────────────────────────────────

    public static function templatesParejas(): array
    {
        return [
            [
                'id'     => 'parejas-romantico',
                'nombre' => 'Romántico',
                'emoji'  => '❤️',
                'desc'   => 'Rojo pasión, para el amor',
                'bg'     => 'from-red-50 via-rose-50 to-pink-50',
                'bar'    => 'bg-gradient-to-r from-red-400 to-rose-500',
            ],
            [
                'id'     => 'parejas-cosmos',
                'nombre' => 'Cosmos',
                'emoji'  => '🌌',
                'desc'   => 'Un amor infinito como el universo',
                'bg'     => 'from-indigo-950 via-purple-950 to-slate-900',
                'bar'    => 'bg-gradient-to-r from-pink-500 to-violet-500',
                'dark'   => true,
            ],
            [
                'id'     => 'parejas-aquarela',
                'nombre' => 'Aquarela',
                'emoji'  => '🎨',
                'desc'   => 'Suave y artístico',
                'bg'     => 'from-teal-50 via-cyan-50 to-sky-50',
                'bar'    => 'bg-gradient-to-r from-teal-400 to-cyan-400',
            ],
        ];
    }

    // ─── DÍAS ESPECIALES ─────────────────────────────────────────────────────

    public static function templatesEspeciales(): array
    {
        return [
            [
                'id'     => 'especial-festivo',
                'nombre' => 'Gran Celebración',
                'emoji'  => '🎊',
                'desc'   => 'Confeti y alegría',
                'bg'     => 'from-yellow-50 via-orange-50 to-red-50',
                'bar'    => 'bg-gradient-to-r from-yellow-400 to-orange-500',
            ],
            [
                'id'     => 'especial-serenidad',
                'nombre' => 'Serenidad',
                'emoji'  => '🍃',
                'desc'   => 'Natural y tranquilo',
                'bg'     => 'from-green-50 via-emerald-50 to-teal-50',
                'bar'    => 'bg-gradient-to-r from-green-400 to-emerald-500',
            ],
            [
                'id'     => 'especial-tropical',
                'nombre' => 'Tropical',
                'emoji'  => '🌴',
                'desc'   => 'Colorido y tropical',
                'bg'     => 'from-lime-50 via-green-50 to-teal-50',
                'bar'    => 'bg-gradient-to-r from-lime-400 to-teal-500',
            ],
        ];
    }

    // ─── CUMPLEAÑOS ──────────────────────────────────────────────────────────

    public static function templatesCumpleanos(): array
    {
        return [
            [
                'id'     => 'cumple-confeti',
                'nombre' => '¡Confeti!',
                'emoji'  => '🎉',
                'desc'   => 'Festivo y lleno de colores',
                'bg'     => 'from-pink-50 via-yellow-50 to-blue-50',
                'bar'    => 'bg-gradient-to-r from-pink-400 via-yellow-400 to-blue-400',
            ],
            [
                'id'     => 'cumple-neon',
                'nombre' => 'Neon Party',
                'emoji'  => '🪩',
                'desc'   => 'Brillante y moderno',
                'bg'     => 'from-gray-900 via-violet-950 to-gray-900',
                'bar'    => 'bg-gradient-to-r from-fuchsia-500 to-cyan-400',
                'dark'   => true,
            ],
            [
                'id'     => 'cumple-dulce',
                'nombre' => 'Pastel Dulce',
                'emoji'  => '🎂',
                'desc'   => 'Suave y adorable',
                'bg'     => 'from-pink-50 via-rose-50 to-fuchsia-50',
                'bar'    => 'bg-gradient-to-r from-pink-300 to-fuchsia-400',
            ],
        ];
    }

    // ─── PARA LOS MAS PEQUES ────────────────────────────────────────────────

    public static function templatesPeques(): array
    {
        return [
            [
                'id'     => 'peques-heroe-amigo',
                'nombre' => 'Heroe Arana Amigo',
                'emoji'  => '🕷️',
                'desc'   => 'Un heroe divertido que presenta el mensaje',
                'bg'     => 'from-red-50 via-blue-50 to-sky-50',
                'bar'    => 'bg-gradient-to-r from-red-500 to-blue-500',
            ],
            [
                'id'     => 'peques-capitan-valiente',
                'nombre' => 'Capitan Valiente',
                'emoji'  => '🛡️',
                'desc'   => 'Mensaje con energia de lider y aventura',
                'bg'     => 'from-blue-50 via-indigo-50 to-red-50',
                'bar'    => 'bg-gradient-to-r from-blue-600 to-red-500',
            ],
            [
                'id'     => 'peques-tecno-armadura',
                'nombre' => 'Tecno Armadura',
                'emoji'  => '🤖',
                'desc'   => 'Estilo futurista para peques curiosos',
                'bg'     => 'from-amber-50 via-orange-50 to-red-50',
                'bar'    => 'bg-gradient-to-r from-amber-500 to-red-500',
            ],
            [
                'id'     => 'peques-pista-veloz',
                'nombre' => 'Pista Veloz',
                'emoji'  => '🏎️',
                'desc'   => 'Template de autos y velocidad',
                'bg'     => 'from-orange-50 via-amber-50 to-yellow-50',
                'bar'    => 'bg-gradient-to-r from-orange-500 to-yellow-500',
            ],
            [
                'id'     => 'peques-princesa-sueno',
                'nombre' => 'Princesa de Sueno',
                'emoji'  => '👑',
                'desc'   => 'Castillo, brillo y magia suave',
                'bg'     => 'from-pink-50 via-rose-50 to-fuchsia-50',
                'bar'    => 'bg-gradient-to-r from-pink-500 to-fuchsia-500',
            ],
            [
                'id'     => 'peques-stitch-tierno',
                'nombre' => 'Amiguito Galactico',
                'emoji'  => '🛸',
                'desc'   => 'Travieso, tierno y muy divertido',
                'bg'     => 'from-cyan-50 via-sky-50 to-blue-50',
                'bar'    => 'bg-gradient-to-r from-cyan-500 to-blue-500',
            ],
            [
                'id'     => 'peques-arcoiris',
                'nombre' => 'Arcoiris Feliz',
                'emoji'  => '🌈',
                'desc'   => 'Diseno neutral para cualquier peque',
                'bg'     => 'from-violet-50 via-pink-50 to-yellow-50',
                'bar'    => 'bg-gradient-to-r from-violet-500 via-pink-500 to-yellow-500',
            ],
            [
                'id'     => 'peques-cuento-clasico',
                'nombre' => 'Cuento Clasico',
                'emoji'  => '📚',
                'desc'   => 'Layout normal, limpio y afectivo',
                'bg'     => 'from-slate-50 via-zinc-50 to-stone-50',
                'bar'    => 'bg-gradient-to-r from-slate-500 to-zinc-500',
            ],
        ];
    }

    private static function templatesPequesPorOcasion(): array
    {
        return [
            'mensaje-para-nino' => [
                [
                    'id'     => 'peques-heroe-amigo',
                    'nombre' => 'Heroe Arana Amigo',
                    'emoji'  => '🕷️',
                    'desc'   => 'Personaje narrador estilo heroe arana',
                    'bg'     => 'from-red-50 via-blue-50 to-sky-50',
                    'bar'    => 'bg-gradient-to-r from-red-500 to-blue-500',
                ],
                [
                    'id'     => 'peques-capitan-valiente',
                    'nombre' => 'Capitan Valiente',
                    'emoji'  => '🛡️',
                    'desc'   => 'Personaje narrador estilo capitan',
                    'bg'     => 'from-blue-50 via-indigo-50 to-red-50',
                    'bar'    => 'bg-gradient-to-r from-blue-600 to-red-500',
                ],
                [
                    'id'     => 'peques-tecno-armadura',
                    'nombre' => 'Tecno Armadura',
                    'emoji'  => '🤖',
                    'desc'   => 'Personaje narrador estilo armadura',
                    'bg'     => 'from-amber-50 via-orange-50 to-red-50',
                    'bar'    => 'bg-gradient-to-r from-amber-500 to-red-500',
                ],
                [
                    'id'     => 'peques-pista-veloz',
                    'nombre' => 'Pista Veloz',
                    'emoji'  => '🏎️',
                    'desc'   => 'Template de carros sin narrador',
                    'bg'     => 'from-orange-50 via-amber-50 to-yellow-50',
                    'bar'    => 'bg-gradient-to-r from-orange-500 to-yellow-500',
                ],
            ],
            'mensaje-para-nina' => [
                [
                    'id'     => 'peques-princesa-sueno',
                    'nombre' => 'Princesa de Sueno',
                    'emoji'  => '👑',
                    'desc'   => 'Personaje narrador tipo princesa',
                    'bg'     => 'from-pink-50 via-rose-50 to-fuchsia-50',
                    'bar'    => 'bg-gradient-to-r from-pink-500 to-fuchsia-500',
                ],
                [
                    'id'     => 'peques-stitch-tierno',
                    'nombre' => 'Amiguito Galactico',
                    'emoji'  => '🛸',
                    'desc'   => 'Personaje narrador travieso y tierno',
                    'bg'     => 'from-cyan-50 via-sky-50 to-blue-50',
                    'bar'    => 'bg-gradient-to-r from-cyan-500 to-blue-500',
                ],
                [
                    'id'     => 'peques-arcoiris',
                    'nombre' => 'Arcoiris Feliz',
                    'emoji'  => '🌈',
                    'desc'   => 'Diseño colorido y neutro',
                    'bg'     => 'from-violet-50 via-pink-50 to-yellow-50',
                    'bar'    => 'bg-gradient-to-r from-violet-500 via-pink-500 to-yellow-500',
                ],
            ],
            'mensaje-peques-normal' => [
                [
                    'id'     => 'peques-cuento-clasico',
                    'nombre' => 'Cuento Clasico',
                    'emoji'  => '📚',
                    'desc'   => 'Mensaje normal para cualquier peque',
                    'bg'     => 'from-slate-50 via-zinc-50 to-stone-50',
                    'bar'    => 'bg-gradient-to-r from-slate-500 to-zinc-500',
                ],
                [
                    'id'     => 'peques-arcoiris',
                    'nombre' => 'Arcoiris Feliz',
                    'emoji'  => '🌈',
                    'desc'   => 'Template alegre de uso general',
                    'bg'     => 'from-violet-50 via-pink-50 to-yellow-50',
                    'bar'    => 'bg-gradient-to-r from-violet-500 via-pink-500 to-yellow-500',
                ],
            ],
        ];
    }

    // ─── GENÉRICOS (sin categoría) ───────────────────────────────────────────

    public static function templatesGenericos(): array
    {
        return [
            [
                'id'     => 'clasico',
                'nombre' => 'Clásico Elegante',
                'emoji'  => '💜',
                'desc'   => 'Elegante y atemporal',
                'bg'     => 'from-violet-50 to-purple-50',
                'bar'    => 'bg-gradient-to-r from-violet-500 to-purple-500',
            ],
            [
                'id'     => 'rosa-floral',
                'nombre' => 'Rosa Floral',
                'emoji'  => '🌸',
                'desc'   => 'Romántico y delicado',
                'bg'     => 'from-pink-50 to-rose-50',
                'bar'    => 'bg-gradient-to-r from-pink-400 to-rose-400',
            ],
            [
                'id'     => 'galaxia',
                'nombre' => 'Galaxia Oscura',
                'emoji'  => '🌌',
                'desc'   => 'Misterioso y profundo',
                'bg'     => 'from-indigo-900 to-purple-900',
                'bar'    => 'bg-gradient-to-r from-violet-500 to-indigo-500',
                'dark'   => true,
            ],
            [
                'id'     => 'vintage',
                'nombre' => 'Carta Vintage',
                'emoji'  => '📜',
                'desc'   => 'Nostálgico y clásico',
                'bg'     => 'from-amber-50 to-yellow-50',
                'bar'    => 'bg-gradient-to-r from-amber-400 to-yellow-500',
            ],
            [
                'id'     => 'minimalista',
                'nombre' => 'Minimalista',
                'emoji'  => '⬜',
                'desc'   => 'Moderno y limpio',
                'bg'     => 'from-white to-gray-50',
                'bar'    => 'bg-gray-800',
            ],
            [
                'id'     => 'fiesta',
                'nombre' => 'Fiesta',
                'emoji'  => '🎉',
                'desc'   => 'Festivo y divertido',
                'bg'     => 'from-yellow-50 to-orange-50',
                'bar'    => 'bg-gradient-to-r from-yellow-400 to-orange-500',
            ],
        ];
    }

    /**
     * SVG decorativo único por template, posicionado dentro de la carta.
     * Cada entrada retorna HTML completo con SVGs inline absolutos para layered art premium.
     * Usar dentro de un contenedor con position:relative y overflow:hidden.
     */
    public static function svgArte(): array
    {
        return array_merge(self::svgArteBase(), OcasionGroupA::svg(), OcasionGroupB::svg(), OcasionGroupC::svg(), OcasionGroupD::svg());
    }

    private static function svgArteBase(): array
    {
        return [
            // ════ MAMÁ ════
            'mama-flores' => '
                <svg style="position:absolute;top:-20px;right:-20px;width:170px;height:170px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 200" fill="none">
                    <g><circle cx="140" cy="60" r="14" fill="#fb7185"/><circle cx="160" cy="50" r="10" fill="#f472b6"/><circle cx="155" cy="70" r="11" fill="#fb7185"/><circle cx="135" cy="78" r="10" fill="#f472b6"/><circle cx="148" cy="62" r="6" fill="#fef3c7"/></g>
                    <g><circle cx="100" cy="30" r="8" fill="#e879f9" opacity="0.7"/><circle cx="115" cy="20" r="6" fill="#f0abfc" opacity="0.7"/><circle cx="108" cy="42" r="6" fill="#f0abfc" opacity="0.7"/></g>
                    <path d="M140 75 Q120 110 95 130" stroke="#86efac" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    <ellipse cx="105" cy="115" rx="8" ry="3" fill="#86efac" transform="rotate(-30 105 115)"/>
                </svg>
                <svg style="position:absolute;bottom:-15px;left:-10px;width:130px;height:130px;opacity:0.4;pointer-events:none;" viewBox="0 0 150 150" fill="none">
                    <g transform="translate(40 90)"><circle cx="0" cy="-10" r="8" fill="#fb7185"/><circle cx="-9" cy="3" r="8" fill="#fb7185"/><circle cx="9" cy="3" r="8" fill="#fb7185"/><circle cx="0" cy="0" r="5" fill="#fff7ed"/></g>
                    <g transform="translate(80 110)"><circle cx="0" cy="-7" r="6" fill="#f472b6"/><circle cx="-6" cy="2" r="6" fill="#f472b6"/><circle cx="6" cy="2" r="6" fill="#f472b6"/><circle cx="0" cy="0" r="3" fill="#fff7ed"/></g>
                </svg>',

            'mama-carta' => '
                <svg style="position:absolute;top:14px;right:16px;width:90px;height:90px;opacity:0.55;pointer-events:none;" viewBox="0 0 100 100" fill="none">
                    <rect x="15" y="20" width="70" height="55" rx="2" fill="#fff" stroke="#9a3412" stroke-width="1.5" stroke-dasharray="3 2"/>
                    <text x="50" y="50" text-anchor="middle" font-size="22" fill="#dc2626">♥</text>
                    <text x="50" y="68" text-anchor="middle" font-size="6" fill="#9a3412" font-family="serif">PARA TI</text>
                    <circle cx="78" cy="28" r="6" fill="#fb923c" opacity="0.5"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;right:-10px;width:120px;height:120px;opacity:0.25;pointer-events:none;" viewBox="0 0 120 120" fill="none">
                    <path d="M30 60 Q45 30 60 60 T90 60" stroke="#9a3412" stroke-width="1.5" fill="none"/>
                    <circle cx="60" cy="80" r="3" fill="#dc2626"/>
                </svg>
                <svg style="position:absolute;bottom:18px;left:18px;width:55px;height:55px;opacity:0.4;pointer-events:none;" viewBox="0 0 50 50">
                    <path d="M10 20 Q25 5 40 20 L25 40 Z" fill="#fb923c"/>
                </svg>',

            'mama-cielo' => '
                <svg style="position:absolute;top:-10px;right:-10px;width:160px;height:120px;opacity:0.6;pointer-events:none;" viewBox="0 0 200 150" fill="none">
                    <ellipse cx="140" cy="40" rx="35" ry="14" fill="#fff"/>
                    <ellipse cx="155" cy="35" rx="22" ry="10" fill="#fff"/>
                    <ellipse cx="125" cy="35" rx="20" ry="9" fill="#fff"/>
                    <circle cx="170" cy="22" r="14" fill="#fde68a" opacity="0.7"/>
                    <circle cx="170" cy="22" r="9" fill="#fef9c3"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;left:-15px;width:140px;height:100px;opacity:0.45;pointer-events:none;" viewBox="0 0 200 150" fill="none">
                    <ellipse cx="60" cy="80" rx="40" ry="15" fill="#e0e7ff"/>
                    <ellipse cx="80" cy="72" rx="22" ry="10" fill="#e0e7ff"/>
                    <g transform="translate(120 50)"><circle cx="0" cy="-7" r="5" fill="#f472b6"/><circle cx="-5" cy="2" r="5" fill="#f472b6"/><circle cx="5" cy="2" r="5" fill="#f472b6"/></g>
                </svg>
                <svg style="position:absolute;top:50%;left:8px;width:18px;height:18px;opacity:0.5;pointer-events:none;" viewBox="0 0 20 20"><path d="M10 0 L11 8 L20 10 L11 12 L10 20 L9 12 L0 10 L9 8 Z" fill="#a78bfa"/></svg>',

            'mama-dorada' => '
                <svg style="position:absolute;top:8px;right:8px;width:80px;height:80px;opacity:0.55;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <path d="M15 50 L25 25 L35 45 L40 18 L45 45 L55 25 L65 50 Z" fill="#fbbf24" stroke="#d97706" stroke-width="1"/>
                    <circle cx="25" cy="25" r="3" fill="#fef3c7"/>
                    <circle cx="40" cy="18" r="3.5" fill="#fef3c7"/>
                    <circle cx="55" cy="25" r="3" fill="#fef3c7"/>
                    <rect x="15" y="50" width="50" height="6" fill="#d97706"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;left:-10px;width:130px;height:130px;opacity:0.3;pointer-events:none;" viewBox="0 0 150 150" fill="none">
                    <g fill="#fbbf24"><path d="M30 90 L33 100 L43 100 L35 106 L38 116 L30 110 L22 116 L25 106 L17 100 L27 100 Z"/></g>
                    <g fill="#f59e0b"><path d="M70 110 L72 116 L78 116 L73 120 L75 126 L70 122 L65 126 L67 120 L62 116 L68 116 Z"/></g>
                </svg>
                <svg style="position:absolute;top:50%;right:6px;width:20px;height:20px;opacity:0.6;pointer-events:none;" viewBox="0 0 20 20"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" fill="#f59e0b"/></svg>',

            // ════ PAPÁ ════
            'papa-aventura' => '
                <svg style="position:absolute;top:-5px;right:-5px;width:200px;height:130px;opacity:0.6;pointer-events:none;" viewBox="0 0 200 130" fill="none">
                    <path d="M0 100 L40 50 L65 75 L95 30 L130 70 L165 40 L200 80 L200 130 L0 130 Z" fill="#10b981" opacity="0.35"/>
                    <path d="M30 100 L60 60 L85 85 L115 45 L150 80 L180 55 L200 90 L200 130 L30 130 Z" fill="#059669" opacity="0.5"/>
                    <path d="M85 50 L95 30 L102 47 Z" fill="#fff" opacity="0.7"/>
                    <path d="M125 60 L130 70 L140 55 Z" fill="#fff" opacity="0.6"/>
                    <circle cx="170" cy="20" r="8" fill="#fde047" opacity="0.7"/>
                </svg>
                <svg style="position:absolute;bottom:8px;right:14px;width:50px;height:50px;opacity:0.55;pointer-events:none;" viewBox="0 0 50 50" fill="none">
                    <circle cx="25" cy="25" r="20" stroke="#047857" stroke-width="2" fill="none"/>
                    <circle cx="25" cy="25" r="15" stroke="#047857" stroke-width="1" fill="none"/>
                    <path d="M25 12 L29 25 L25 38 L21 25 Z" fill="#dc2626"/>
                    <path d="M25 12 L29 25 L25 25 Z" fill="#7f1d1d"/>
                    <text x="25" y="9" text-anchor="middle" font-size="6" fill="#047857" font-weight="bold">N</text>
                </svg>
                <svg style="position:absolute;bottom:10px;left:14px;width:50px;height:60px;opacity:0.5;pointer-events:none;" viewBox="0 0 50 60" fill="none">
                    <path d="M25 5 L40 50 L10 50 Z" fill="#065f46"/>
                    <path d="M25 15 L37 47 L13 47 Z" fill="#047857"/>
                    <rect x="22" y="50" width="6" height="8" fill="#78350f"/>
                </svg>',

            'papa-noche' => '
                <svg style="position:absolute;top:10px;right:18px;width:80px;height:80px;opacity:0.85;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="28" fill="#e0e7ff"/>
                    <circle cx="50" cy="35" r="26" fill="#0f172a"/>
                    <circle cx="20" cy="30" r="2" fill="#cbd5e1" opacity="0.6"/>
                    <circle cx="25" cy="55" r="1.5" fill="#cbd5e1" opacity="0.5"/>
                    <circle cx="15" cy="45" r="2.5" fill="#cbd5e1" opacity="0.7"/>
                </svg>
                <svg style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0.7;pointer-events:none;" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none">
                    <g fill="#e0e7ff"><circle cx="50" cy="80" r="1.5"/><circle cx="120" cy="40" r="1"/><circle cx="200" cy="100" r="1.2"/><circle cx="280" cy="50" r="1.5"/><circle cx="350" cy="120" r="1"/><circle cx="80" cy="200" r="1"/><circle cx="160" cy="180" r="1.3"/><circle cx="320" cy="220" r="1"/><circle cx="40" cy="320" r="1.2"/><circle cx="180" cy="380" r="1"/><circle cx="290" cy="350" r="1.5"/><circle cx="370" cy="420" r="1"/></g>
                    <g stroke="#818cf8" stroke-width="0.5" opacity="0.5"><line x1="120" y1="40" x2="200" y2="100"/><line x1="200" y1="100" x2="280" y2="50"/><line x1="160" y1="180" x2="200" y2="100"/></g>
                    <g fill="#fff"><path d="M120 40 L121 45 L126 45 L122 48 L124 53 L120 50 L116 53 L118 48 L114 45 L119 45 Z" opacity="0.9"/></g>
                </svg>
                <svg style="position:absolute;bottom:14px;left:14px;width:30px;height:30px;opacity:0.7;pointer-events:none;" viewBox="0 0 30 30">
                    <path d="M15 2 L17 12 L27 13 L19 18 L22 28 L15 22 L8 28 L11 18 L3 13 L13 12 Z" fill="#a5b4fc"/>
                </svg>',

            'papa-retro' => '
                <svg style="position:absolute;top:14px;right:14px;width:75px;height:75px;opacity:0.6;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="35" fill="#1c1917"/>
                    <circle cx="40" cy="40" r="33" fill="none" stroke="#5c4033" stroke-width="0.5"/>
                    <circle cx="40" cy="40" r="28" fill="none" stroke="#5c4033" stroke-width="0.5"/>
                    <circle cx="40" cy="40" r="22" fill="none" stroke="#5c4033" stroke-width="0.5"/>
                    <circle cx="40" cy="40" r="14" fill="#dc2626"/>
                    <circle cx="40" cy="40" r="3" fill="#1c1917"/>
                    <text x="40" y="33" text-anchor="middle" font-size="4" fill="#fff" font-family="serif">CLASSIC</text>
                </svg>
                <svg style="position:absolute;bottom:10px;left:14px;width:90px;height:30px;opacity:0.4;pointer-events:none;" viewBox="0 0 100 30" fill="none">
                    <g stroke="#5c4033" stroke-width="2" stroke-linecap="round">
                        <line x1="5" y1="15" x2="5" y2="20"/>
                        <line x1="12" y1="10" x2="12" y2="20"/>
                        <line x1="19" y1="5" x2="19" y2="25"/>
                        <line x1="26" y1="8" x2="26" y2="22"/>
                        <line x1="33" y1="3" x2="33" y2="27"/>
                        <line x1="40" y1="12" x2="40" y2="18"/>
                        <line x1="47" y1="6" x2="47" y2="24"/>
                        <line x1="54" y1="14" x2="54" y2="16"/>
                        <line x1="61" y1="9" x2="61" y2="21"/>
                        <line x1="68" y1="11" x2="68" y2="19"/>
                        <line x1="75" y1="7" x2="75" y2="23"/>
                        <line x1="82" y1="13" x2="82" y2="17"/>
                    </g>
                </svg>',

            // ════ HERMANOS ════
            'hermanos-fresco' => '
                <svg style="position:absolute;top:-15px;right:-15px;width:160px;height:140px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 180" fill="none">
                    <path d="M180 30 Q140 50 130 90 Q150 70 180 60 Z" fill="#22c55e"/>
                    <path d="M170 50 Q130 70 120 110 Q140 90 170 80 Z" fill="#16a34a"/>
                    <path d="M150 100 Q110 100 90 140 Q120 110 150 110 Z" fill="#15803d"/>
                    <path d="M130 120 L135 150" stroke="#15803d" stroke-width="1.5"/>
                </svg>
                <svg style="position:absolute;bottom:-5px;left:-10px;width:170px;height:80px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 100" fill="none">
                    <path d="M0 70 Q50 40 100 60 T200 50 L200 100 L0 100 Z" fill="#22d3ee"/>
                    <path d="M0 80 Q50 60 100 75 T200 70 L200 100 L0 100 Z" fill="#0891b2" opacity="0.7"/>
                    <path d="M40 50 Q45 45 55 50" stroke="#fff" stroke-width="2" fill="none" opacity="0.7"/>
                    <path d="M120 45 Q125 40 135 45" stroke="#fff" stroke-width="2" fill="none" opacity="0.7"/>
                </svg>
                <svg style="position:absolute;top:14px;left:14px;width:30px;height:30px;opacity:0.6;pointer-events:none;" viewBox="0 0 30 30" fill="none">
                    <circle cx="15" cy="15" r="11" fill="#fde047"/>
                    <g stroke="#f59e0b" stroke-width="1.5" stroke-linecap="round"><line x1="15" y1="2" x2="15" y2="6"/><line x1="15" y1="24" x2="15" y2="28"/><line x1="2" y1="15" x2="6" y2="15"/><line x1="24" y1="15" x2="28" y2="15"/></g>
                </svg>',

            'hermanos-grafiti' => '
                <svg style="position:absolute;top:-15px;left:-15px;width:200px;height:140px;opacity:0.7;pointer-events:none;" viewBox="0 0 200 140" fill="none">
                    <circle cx="40" cy="40" r="25" fill="#ec4899" opacity="0.5"/>
                    <circle cx="60" cy="55" r="15" fill="#7c3aed" opacity="0.5"/>
                    <circle cx="30" cy="70" r="8" fill="#f59e0b" opacity="0.7"/>
                    <circle cx="80" cy="30" r="5" fill="#ec4899"/>
                    <circle cx="100" cy="50" r="4" fill="#7c3aed"/>
                    <path d="M20 90 Q40 75 60 90 Q80 75 100 90" stroke="#ec4899" stroke-width="3" fill="none" stroke-linecap="round"/>
                    <text x="120" y="40" font-family="Impact, sans-serif" font-size="22" fill="#a855f7" transform="rotate(-8 120 40)" font-style="italic" font-weight="bold">FAM</text>
                </svg>
                <svg style="position:absolute;bottom:-10px;right:-10px;width:160px;height:130px;opacity:0.6;pointer-events:none;" viewBox="0 0 160 130" fill="none">
                    <circle cx="120" cy="80" r="20" fill="#ec4899" opacity="0.4"/>
                    <circle cx="100" cy="100" r="12" fill="#7c3aed" opacity="0.5"/>
                    <circle cx="135" cy="60" r="6" fill="#f59e0b"/>
                    <circle cx="80" cy="90" r="4" fill="#22d3ee"/>
                    <path d="M50 60 L60 50 M55 65 L65 55 M60 70 L70 60" stroke="#a855f7" stroke-width="2" stroke-linecap="round"/>
                </svg>',

            'hermanos-nostalgia' => '
                <svg style="position:absolute;top:14px;right:14px;width:80px;height:90px;opacity:0.6;pointer-events:none;" viewBox="0 0 80 90" fill="none">
                    <rect x="10" y="10" width="60" height="70" rx="2" fill="#fffbf5" stroke="#92400e" stroke-width="1.5"/>
                    <rect x="14" y="14" width="52" height="48" fill="#fcd34d" opacity="0.5"/>
                    <circle cx="40" cy="38" r="14" fill="#fb923c" opacity="0.4"/>
                    <text x="40" y="74" text-anchor="middle" font-size="7" fill="#92400e" font-family="cursive" font-style="italic">recuerdos</text>
                </svg>
                <svg style="position:absolute;top:50px;right:60px;width:70px;height:80px;opacity:0.4;pointer-events:none;transform:rotate(-12deg);" viewBox="0 0 70 80" fill="none">
                    <rect x="5" y="5" width="55" height="65" rx="2" fill="#fffbf5" stroke="#92400e" stroke-width="1.2"/>
                    <rect x="9" y="9" width="47" height="44" fill="#86efac" opacity="0.5"/>
                </svg>
                <svg style="position:absolute;bottom:18px;left:14px;width:90px;height:35px;opacity:0.55;pointer-events:none;" viewBox="0 0 90 35" fill="none">
                    <rect x="5" y="8" width="80" height="22" rx="3" fill="#fbbf24"/>
                    <rect x="10" y="13" width="35" height="12" rx="2" fill="#92400e"/>
                    <circle cx="55" cy="19" r="5" fill="#fffbf5" stroke="#92400e" stroke-width="1"/>
                    <circle cx="72" cy="19" r="5" fill="#fffbf5" stroke="#92400e" stroke-width="1"/>
                </svg>',

            // ════ PAREJAS ════
            'parejas-romantico' => '
                <svg style="position:absolute;top:-10px;right:-10px;width:170px;height:170px;opacity:0.5;pointer-events:none;" viewBox="0 0 200 200" fill="none">
                    <g transform="translate(140 50)">
                        <path d="M0 -10 Q-15 -30 -30 -15 Q-30 5 0 30 Q30 5 30 -15 Q15 -30 0 -10" fill="#dc2626"/>
                        <ellipse cx="-10" cy="-15" rx="3" ry="2" fill="#fff" opacity="0.6"/>
                    </g>
                    <g transform="translate(110 100) rotate(-25)">
                        <line x1="-30" y1="0" x2="30" y2="0" stroke="#7f1d1d" stroke-width="1.5"/>
                        <path d="M30 0 L25 -4 L25 4 Z" fill="#7f1d1d"/>
                        <path d="M-30 0 L-35 -3 L-30 0 L-35 3" fill="#7f1d1d"/>
                    </g>
                </svg>
                <svg style="position:absolute;bottom:-15px;left:-10px;width:140px;height:140px;opacity:0.45;pointer-events:none;" viewBox="0 0 150 150" fill="none">
                    <g transform="translate(50 100)">
                        <circle cx="0" cy="0" r="14" fill="#dc2626"/>
                        <circle cx="-4" cy="-4" r="9" fill="#fb7185"/>
                        <circle cx="-2" cy="-2" r="4" fill="#fff" opacity="0.5"/>
                        <path d="M14 0 Q22 -5 30 5" stroke="#16a34a" stroke-width="2" fill="none"/>
                        <ellipse cx="26" cy="0" rx="6" ry="3" fill="#16a34a" transform="rotate(30 26 0)"/>
                    </g>
                    <g transform="translate(95 115)" opacity="0.7">
                        <circle cx="0" cy="0" r="9" fill="#fb7185"/>
                        <circle cx="-2" cy="-2" r="6" fill="#fda4af"/>
                    </g>
                </svg>',

            'parejas-cosmos' => '
                <svg style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0.85;pointer-events:none;" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none">
                    <g fill="#fff"><circle cx="40" cy="60" r="1"/><circle cx="100" cy="30" r="1.5"/><circle cx="180" cy="80" r="1"/><circle cx="260" cy="40" r="1.2"/><circle cx="340" cy="100" r="1"/><circle cx="60" cy="180" r="1.3"/><circle cx="200" cy="220" r="1"/><circle cx="320" cy="180" r="1.5"/><circle cx="80" cy="320" r="1"/><circle cx="180" cy="380" r="1.2"/><circle cx="290" cy="340" r="1"/><circle cx="370" cy="430" r="1.4"/><circle cx="30" cy="450" r="1"/></g>
                    <g fill="#fbcfe8" opacity="0.8"><circle cx="120" cy="100" r="2"/><circle cx="280" cy="270" r="2.5"/><circle cx="50" cy="380" r="1.8"/></g>
                </svg>
                <svg style="position:absolute;top:14px;right:14px;width:80px;height:80px;opacity:0.7;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="22" fill="#ec4899" opacity="0.3"/>
                    <ellipse cx="40" cy="40" rx="35" ry="8" stroke="#f9a8d4" stroke-width="1.5" fill="none" transform="rotate(-15 40 40)"/>
                    <circle cx="40" cy="40" r="14" fill="#fbcfe8"/>
                    <circle cx="36" cy="36" r="3" fill="#fff" opacity="0.6"/>
                </svg>
                <svg style="position:absolute;bottom:18px;left:18px;width:70px;height:70px;opacity:0.6;pointer-events:none;" viewBox="0 0 70 70" fill="none">
                    <g transform="translate(35 35)">
                        <path d="M0 -25 Q15 -10 25 0 Q15 10 0 25 Q-15 10 -25 0 Q-15 -10 0 -25" stroke="#a78bfa" stroke-width="1" fill="none" opacity="0.7"/>
                        <circle cx="0" cy="0" r="6" fill="#a78bfa"/>
                        <circle cx="-2" cy="-2" r="2" fill="#fff" opacity="0.7"/>
                    </g>
                </svg>',

            'parejas-aquarela' => '
                <svg style="position:absolute;top:-30px;right:-30px;width:220px;height:180px;opacity:0.45;pointer-events:none;" viewBox="0 0 200 180" fill="none">
                    <ellipse cx="140" cy="60" rx="55" ry="40" fill="#5eead4" opacity="0.5"/>
                    <ellipse cx="160" cy="40" rx="35" ry="28" fill="#67e8f9" opacity="0.5"/>
                    <ellipse cx="120" cy="80" rx="30" ry="22" fill="#a5b4fc" opacity="0.4"/>
                    <ellipse cx="170" cy="80" rx="20" ry="15" fill="#5eead4" opacity="0.6"/>
                </svg>
                <svg style="position:absolute;bottom:-20px;left:-20px;width:200px;height:150px;opacity:0.4;pointer-events:none;" viewBox="0 0 200 150" fill="none">
                    <ellipse cx="60" cy="100" rx="50" ry="35" fill="#a5b4fc" opacity="0.5"/>
                    <ellipse cx="40" cy="120" rx="30" ry="20" fill="#67e8f9" opacity="0.5"/>
                    <ellipse cx="100" cy="110" rx="25" ry="18" fill="#5eead4" opacity="0.5"/>
                </svg>
                <svg style="position:absolute;top:50%;right:14px;width:30px;height:30px;opacity:0.5;pointer-events:none;" viewBox="0 0 30 30" fill="none">
                    <ellipse cx="15" cy="15" rx="6" ry="11" fill="#0d9488" transform="rotate(-30 15 15)"/>
                    <ellipse cx="15" cy="15" rx="6" ry="11" fill="#0d9488" transform="rotate(30 15 15)"/>
                </svg>',

            // ════ ESPECIALES ════
            'especial-festivo' => '
                <svg style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0.55;pointer-events:none;" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none">
                    <g><rect x="50" y="40" width="6" height="14" rx="1" fill="#ec4899" transform="rotate(20 53 47)"/><rect x="120" y="80" width="6" height="14" rx="1" fill="#fbbf24" transform="rotate(-15 123 87)"/><rect x="200" y="50" width="6" height="14" rx="1" fill="#3b82f6" transform="rotate(40 203 57)"/><rect x="280" y="100" width="6" height="14" rx="1" fill="#10b981" transform="rotate(-25 283 107)"/><rect x="350" y="60" width="6" height="14" rx="1" fill="#f97316" transform="rotate(15 353 67)"/><rect x="80" y="200" width="6" height="14" rx="1" fill="#a855f7" transform="rotate(-30 83 207)"/><rect x="320" y="280" width="6" height="14" rx="1" fill="#ec4899" transform="rotate(45 323 287)"/><rect x="60" y="380" width="6" height="14" rx="1" fill="#fbbf24" transform="rotate(-10 63 387)"/><rect x="280" y="420" width="6" height="14" rx="1" fill="#3b82f6" transform="rotate(25 283 427)"/></g>
                    <g><circle cx="160" cy="160" r="3" fill="#ec4899"/><circle cx="240" cy="200" r="3" fill="#10b981"/><circle cx="100" cy="260" r="3" fill="#fbbf24"/><circle cx="350" cy="350" r="3" fill="#a855f7"/></g>
                </svg>
                <svg style="position:absolute;top:14px;right:14px;width:90px;height:100px;opacity:0.65;pointer-events:none;" viewBox="0 0 80 100" fill="none">
                    <ellipse cx="25" cy="30" rx="16" ry="20" fill="#ef4444"/>
                    <path d="M22 50 L25 55 L28 50 Z" fill="#ef4444"/>
                    <line x1="25" y1="55" x2="22" y2="95" stroke="#7f1d1d" stroke-width="1"/>
                    <ellipse cx="55" cy="40" rx="14" ry="18" fill="#3b82f6"/>
                    <path d="M52 58 L55 63 L58 58 Z" fill="#3b82f6"/>
                    <line x1="55" y1="63" x2="58" y2="95" stroke="#1e3a8a" stroke-width="1"/>
                </svg>',

            'especial-serenidad' => '
                <svg style="position:absolute;top:8px;right:8px;width:120px;height:120px;opacity:0.45;pointer-events:none;" viewBox="0 0 120 120" fill="none">
                    <circle cx="60" cy="60" r="45" stroke="#059669" stroke-width="3" fill="none" stroke-linecap="round" stroke-dasharray="220 30" transform="rotate(-90 60 60)"/>
                </svg>
                <svg style="position:absolute;bottom:-10px;left:-10px;width:160px;height:130px;opacity:0.55;pointer-events:none;" viewBox="0 0 200 150" fill="none">
                    <path d="M30 130 Q40 70 60 60 Q70 90 65 130" fill="#10b981" opacity="0.6"/>
                    <path d="M60 60 L65 130" stroke="#047857" stroke-width="1"/>
                    <path d="M90 130 Q100 90 110 80 Q120 110 115 130" fill="#059669" opacity="0.5"/>
                    <path d="M110 80 L115 130" stroke="#065f46" stroke-width="1"/>
                </svg>
                <svg style="position:absolute;top:50%;left:14px;width:35px;height:35px;opacity:0.5;pointer-events:none;" viewBox="0 0 35 35" fill="none">
                    <ellipse cx="17" cy="17" rx="6" ry="13" fill="#34d399" transform="rotate(45 17 17)"/>
                </svg>',

            'especial-tropical' => '
                <svg style="position:absolute;top:-15px;right:-15px;width:170px;height:200px;opacity:0.6;pointer-events:none;" viewBox="0 0 180 220" fill="none">
                    <path d="M120 200 Q115 130 100 60" stroke="#78350f" stroke-width="6" fill="none" stroke-linecap="round"/>
                    <path d="M100 60 Q60 50 30 70 Q60 60 100 70 Z" fill="#16a34a"/>
                    <path d="M100 60 Q140 40 175 55 Q140 55 100 70 Z" fill="#15803d"/>
                    <path d="M100 60 Q80 20 50 15 Q80 30 100 70 Z" fill="#22c55e"/>
                    <path d="M100 60 Q130 25 165 25 Q130 40 100 70 Z" fill="#16a34a"/>
                    <circle cx="98" cy="55" r="6" fill="#a16207"/>
                    <circle cx="105" cy="58" r="5" fill="#92400e"/>
                </svg>
                <svg style="position:absolute;top:14px;left:14px;width:50px;height:50px;opacity:0.65;pointer-events:none;" viewBox="0 0 50 50" fill="none">
                    <circle cx="25" cy="25" r="14" fill="#fbbf24"/>
                    <g stroke="#f59e0b" stroke-width="2.5" stroke-linecap="round"><line x1="25" y1="3" x2="25" y2="9"/><line x1="25" y1="41" x2="25" y2="47"/><line x1="3" y1="25" x2="9" y2="25"/><line x1="41" y1="25" x2="47" y2="25"/><line x1="9" y1="9" x2="14" y2="14"/><line x1="36" y1="36" x2="41" y2="41"/><line x1="9" y1="41" x2="14" y2="36"/><line x1="36" y1="14" x2="41" y2="9"/></g>
                </svg>
                <svg style="position:absolute;bottom:14px;left:18px;width:50px;height:50px;opacity:0.55;pointer-events:none;" viewBox="0 0 50 50" fill="none">
                    <g transform="translate(25 25)">
                        <path d="M0 -15 Q-12 -8 0 0 Q12 -8 0 -15" fill="#ec4899"/>
                        <path d="M0 0 Q-12 -8 -15 0 Q-12 8 0 0" fill="#ec4899"/>
                        <path d="M0 0 Q12 -8 15 0 Q12 8 0 0" fill="#ec4899"/>
                        <path d="M0 0 Q-8 12 0 15 Q8 12 0 0" fill="#ec4899"/>
                        <path d="M0 0 Q8 12 15 8 Q12 -2 0 0" fill="#f472b6"/>
                        <circle cx="0" cy="0" r="3" fill="#fde047"/>
                    </g>
                </svg>',

            // ════ CUMPLEAÑOS ════
            'cumple-confeti' => '
                <svg style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0.7;pointer-events:none;" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none">
                    <g><circle cx="50" cy="60" r="4" fill="#ec4899"/><rect x="120" y="40" width="8" height="8" fill="#fbbf24" transform="rotate(30 124 44)"/><polygon points="200,30 208,45 192,45" fill="#3b82f6"/><circle cx="280" cy="80" r="5" fill="#10b981"/><rect x="350" y="50" width="6" height="14" fill="#a855f7" transform="rotate(20 353 57)"/><circle cx="80" cy="180" r="3" fill="#f97316"/><polygon points="160,200 168,215 152,215" fill="#ec4899"/><rect x="240" y="240" width="8" height="8" fill="#fbbf24" transform="rotate(45 244 244)"/><circle cx="340" cy="280" r="4" fill="#3b82f6"/><circle cx="60" cy="350" r="5" fill="#10b981"/><polygon points="180,380 188,395 172,395" fill="#a855f7"/><rect x="280" y="400" width="6" height="14" fill="#ec4899" transform="rotate(-20 283 407)"/><circle cx="370" cy="440" r="4" fill="#fbbf24"/></g>
                </svg>
                <svg style="position:absolute;top:14px;right:14px;width:75px;height:90px;opacity:0.7;pointer-events:none;" viewBox="0 0 70 90" fill="none">
                    <ellipse cx="22" cy="25" rx="14" ry="18" fill="#ec4899"/>
                    <path d="M19 43 L22 48 L25 43 Z" fill="#ec4899"/>
                    <path d="M22 48 Q24 65 20 85" stroke="#9d174d" stroke-width="1" fill="none"/>
                    <ellipse cx="50" cy="35" rx="12" ry="16" fill="#fbbf24"/>
                    <path d="M47 51 L50 55 L53 51 Z" fill="#fbbf24"/>
                    <path d="M50 55 Q52 70 50 85" stroke="#92400e" stroke-width="1" fill="none"/>
                    <ellipse cx="20" cy="20" rx="3" ry="4" fill="#fff" opacity="0.4"/>
                </svg>',

            'cumple-neon' => '
                <svg style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0.8;pointer-events:none;" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none">
                    <g fill="#fff"><circle cx="40" cy="80" r="1"/><circle cx="120" cy="40" r="1.2"/><circle cx="200" cy="100" r="1"/><circle cx="280" cy="50" r="1.5"/><circle cx="350" cy="120" r="1"/><circle cx="80" cy="200" r="1"/><circle cx="320" cy="220" r="1.3"/><circle cx="180" cy="380" r="1"/><circle cx="290" cy="350" r="1.4"/></g>
                </svg>
                <svg style="position:absolute;top:14px;right:14px;width:80px;height:80px;opacity:0.85;pointer-events:none;" viewBox="0 0 80 80" fill="none">
                    <defs><radialGradient id="disco-grad-neon" cx="0.4" cy="0.4" r="0.6"><stop offset="0%" stop-color="#fdf4ff"/><stop offset="60%" stop-color="#d946ef"/><stop offset="100%" stop-color="#7e22ce"/></radialGradient></defs>
                    <circle cx="40" cy="40" r="26" fill="url(#disco-grad-neon)"/>
                    <g stroke="#fff" stroke-width="0.5" opacity="0.4"><line x1="14" y1="40" x2="66" y2="40"/><line x1="40" y1="14" x2="40" y2="66"/><line x1="22" y1="22" x2="58" y2="58"/><line x1="58" y1="22" x2="22" y2="58"/></g>
                    <circle cx="40" cy="40" r="26" fill="none" stroke="#22d3ee" stroke-width="1" opacity="0.6"/>
                    <circle cx="32" cy="32" r="5" fill="#fff" opacity="0.6"/>
                </svg>
                <svg style="position:absolute;bottom:14px;left:14px;width:60px;height:60px;opacity:0.7;pointer-events:none;" viewBox="0 0 60 60" fill="none">
                    <path d="M25 5 L18 28 L30 28 L20 55 L40 22 L28 22 L35 5 Z" fill="#22d3ee" stroke="#fff" stroke-width="0.5"/>
                </svg>',

            'cumple-dulce' => '
                <svg style="position:absolute;top:14px;right:14px;width:90px;height:100px;opacity:0.65;pointer-events:none;" viewBox="0 0 90 100" fill="none">
                    <rect x="20" y="55" width="50" height="35" rx="3" fill="#fbcfe8"/>
                    <path d="M20 55 Q25 45 30 55 Q35 45 40 55 Q45 45 50 55 Q55 45 60 55 Q65 45 70 55" fill="#f9a8d4"/>
                    <rect x="44" y="30" width="2" height="22" fill="#fb7185"/>
                    <path d="M45 22 Q42 28 45 30 Q48 28 45 22" fill="#fbbf24"/>
                    <circle cx="32" cy="68" r="2" fill="#ec4899"/>
                    <circle cx="58" cy="72" r="2" fill="#ec4899"/>
                    <circle cx="45" cy="78" r="2" fill="#a855f7"/>
                </svg>
                <svg style="position:absolute;bottom:-15px;left:-10px;width:160px;height:120px;opacity:0.45;pointer-events:none;" viewBox="0 0 160 120" fill="none">
                    <g transform="translate(40 80)"><circle cx="0" cy="0" r="14" fill="#f9a8d4"/><circle cx="-3" cy="-3" r="9" fill="#fbcfe8"/><circle cx="-1" cy="-1" r="3" fill="#fff" opacity="0.7"/></g>
                    <g transform="translate(95 95)"><circle cx="0" cy="0" r="11" fill="#f0abfc"/><circle cx="-2" cy="-2" r="7" fill="#fae8ff"/></g>
                    <g transform="translate(125 70)" opacity="0.7"><path d="M0 -8 L3 -3 L8 -3 L4 1 L6 6 L0 3 L-6 6 L-4 1 L-8 -3 L-3 -3 Z" fill="#ec4899"/></g>
                </svg>
                <svg style="position:absolute;top:50%;right:8px;width:25px;height:25px;opacity:0.6;pointer-events:none;" viewBox="0 0 25 25" fill="none">
                    <path d="M12 22 Q4 14 4 8 Q4 4 8 4 Q12 4 12 8 Q12 4 16 4 Q20 4 20 8 Q20 14 12 22 Z" fill="#fb7185"/>
                </svg>',

            // ════ Genéricos legacy (sin SVG decorativo)
            'peques-heroe-amigo'      => '',
            'peques-capitan-valiente' => '',
            'peques-tecno-armadura'   => '',
            'peques-pista-veloz'      => '',
            'peques-princesa-sueno'   => '',
            'peques-stitch-tierno'    => '',
            'peques-arcoiris'         => '',
            'peques-cuento-clasico'   => '',
            'clasico'      => '',
            'rosa-floral'  => '',
            'galaxia'      => '',
            'vintage'      => '',
            'minimalista'  => '',
            'fiesta'       => '',
        ];
    }

    /**
     * Configuración visual para buildPreviewHTML en JS (formato JSON-ready)
     * Devuelve un array indexado por template ID con los estilos CSS inline.
     * Combina los configs base con los configs por ocasión (4 grupos).
     */
    public static function configsParaPreview(): array
    {
        return array_merge(
            self::configsBase(),
            OcasionGroupA::configs(),
            OcasionGroupB::configs(),
            OcasionGroupC::configs(),
            OcasionGroupD::configs(),
        );
    }

    private static function configsBase(): array
    {
        return [
            // ── Mamá
            'mama-flores'  => ['wrap'=>'background:linear-gradient(135deg,#fff1f2,#fdf2f8,#fae8ff);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px solid #fecdd3;box-shadow:0 20px 50px rgba(244,63,94,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#fb7185,#e879f9);height:5px;', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#e879f9', 'bg'=>'#fff1f2', 'tx'=>'#4b5563', 'fc'=>'#be185d', 'deco'=>'🌺🌸🌷'],
            'mama-carta'   => ['wrap'=>'background:linear-gradient(135deg,#fff7ed,#fef9c3,#fff1f2);', 'card'=>'background:#fffbf5;border-radius:1.5rem;border:1px solid #fed7aa;box-shadow:4px 8px 30px rgba(234,88,12,0.12);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#fb923c,#fb7185);height:4px;', 'bc'=>'', 'tc'=>'#92400e', 'ac'=>'#ea580c', 'bg'=>'#fff7ed', 'tx'=>'#78350f', 'fc'=>'#9a3412', 'deco'=>'💌✉️🕊️'],
            'mama-cielo'   => ['wrap'=>'background:linear-gradient(160deg,#f0f9ff,#f5f3ff,#fdf2f8);', 'card'=>'background:rgba(255,255,255,0.9);border-radius:2rem;border:1px solid #e0e7ff;box-shadow:0 25px 50px rgba(139,92,246,0.12);overflow:hidden;backdrop-filter:blur(10px);', 'bar'=>'background:linear-gradient(90deg,#38bdf8,#a78bfa,#f472b6);height:4px;', 'bc'=>'', 'tc'=>'#1e1b4b', 'ac'=>'#7c3aed', 'bg'=>'#f5f3ff', 'tx'=>'#374151', 'fc'=>'#7c3aed', 'deco'=>'🌸☁️✨'],
            'mama-dorada'  => ['wrap'=>'background:linear-gradient(135deg,#fffbeb,#fef3c7,#fde68a22);', 'card'=>'background:#fffef5;border-radius:1.5rem;border:2px solid #fcd34d;box-shadow:0 20px 60px rgba(245,158,11,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#fbbf24,#f59e0b,#d97706);height:5px;', 'bc'=>'', 'tc'=>'#78350f', 'ac'=>'#d97706', 'bg'=>'#fffbeb', 'tx'=>'#92400e', 'fc'=>'#b45309', 'deco'=>'👑⭐💛'],
            // ── Papá
            'papa-aventura'=> ['wrap'=>'background:linear-gradient(135deg,#ecfdf5,#f0fdfa,#f0f9ff);', 'card'=>'background:rgba(255,255,255,0.92);border-radius:1.5rem;border:2px solid #6ee7b7;box-shadow:0 20px 40px rgba(16,185,129,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#10b981,#0d9488);height:5px;', 'bc'=>'', 'tc'=>'#064e3b', 'ac'=>'#059669', 'bg'=>'#ecfdf5', 'tx'=>'#065f46', 'fc'=>'#047857', 'deco'=>'🏔️⛺🌿'],
            'papa-noche'   => ['wrap'=>'background:linear-gradient(160deg,#0f172a,#1e1b4b,#0c1a3a);', 'card'=>'background:rgba(255,255,255,0.07);border-radius:1.5rem;border:1px solid rgba(99,102,241,0.3);box-shadow:0 30px 70px rgba(0,0,0,0.6);overflow:hidden;backdrop-filter:blur(20px);', 'bar'=>'background:linear-gradient(90deg,#6366f1,#818cf8);height:3px;', 'bc'=>'', 'tc'=>'#e0e7ff', 'ac'=>'#818cf8', 'bg'=>'rgba(99,102,241,0.08)', 'tx'=>'rgba(224,231,255,0.85)', 'fc'=>'#a5b4fc', 'deco'=>'🌙⭐🌃'],
            'papa-retro'   => ['wrap'=>'background:#f5f0e8;', 'card'=>'background:#faf7f0;border-radius:0.75rem;border:2px solid #d6cdb8;box-shadow:5px 8px 25px rgba(0,0,0,0.2);overflow:hidden;', 'bar'=>'background:#5c4033;height:6px;', 'bc'=>'', 'tc'=>'#2c1810', 'ac'=>'#7c5c3a', 'bg'=>'transparent', 'tx'=>'#3d2b1f', 'fc'=>'#5c3d2e', 'deco'=>'📻🎶🏆'],
            // ── Hermanos
            'hermanos-fresco'  => ['wrap'=>'background:linear-gradient(135deg,#ecfeff,#e0f2fe,#eff6ff);', 'card'=>'background:rgba(255,255,255,0.9);border-radius:1.5rem;border:2px solid #7dd3fc;box-shadow:0 20px 40px rgba(14,165,233,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#22d3ee,#3b82f6);height:4px;', 'bc'=>'', 'tc'=>'#0c4a6e', 'ac'=>'#0284c7', 'bg'=>'#e0f2fe', 'tx'=>'#0369a1', 'fc'=>'#0c4a6e', 'deco'=>'🎸🏄🎮'],
            'hermanos-grafiti' => ['wrap'=>'background:#111;', 'card'=>'background:#1a1a2e;border-radius:1.5rem;border:1px solid #7c3aed55;box-shadow:0 0 40px rgba(124,58,237,0.3),0 0 80px rgba(236,72,153,0.1);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#7c3aed,#ec4899,#f59e0b);height:4px;', 'bc'=>'', 'tc'=>'#fff', 'ac'=>'#a855f7', 'bg'=>'rgba(124,58,237,0.1)', 'tx'=>'rgba(255,255,255,0.8)', 'fc'=>'#e879f9', 'deco'=>'🎨🖌️🎭'],
            'hermanos-nostalgia'=> ['wrap'=>'background:linear-gradient(135deg,#fff7ed,#fef9c3);', 'card'=>'background:#fffbf5;border-radius:1rem;border:2px solid #fcd34d;box-shadow:3px 6px 20px rgba(0,0,0,0.12);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f97316,#eab308);height:4px;', 'bc'=>'', 'tc'=>'#7c2d12', 'ac'=>'#ea580c', 'bg'=>'transparent', 'tx'=>'#92400e', 'fc'=>'#c2410c', 'deco'=>'📸🎞️📷'],
            // ── Parejas
            'parejas-romantico'=> ['wrap'=>'background:linear-gradient(135deg,#fff1f2,#fce7f3,#fff1f2);', 'card'=>'background:rgba(255,255,255,0.92);border-radius:2rem;border:2px solid #fecdd3;box-shadow:0 25px 60px rgba(225,29,72,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#e11d48,#f43f5e,#fb7185);height:5px;', 'bc'=>'', 'tc'=>'#881337', 'ac'=>'#e11d48', 'bg'=>'#fff1f2', 'tx'=>'#9f1239', 'fc'=>'#be123c', 'deco'=>'❤️🌹💋'],
            'parejas-cosmos'   => ['wrap'=>'background:radial-gradient(ellipse at top,#1e1b4b,#0f0f23);', 'card'=>'background:rgba(255,255,255,0.06);border-radius:2rem;border:1px solid rgba(244,114,182,0.25);box-shadow:0 0 60px rgba(244,114,182,0.15),0 30px 60px rgba(0,0,0,0.5);overflow:hidden;backdrop-filter:blur(20px);', 'bar'=>'background:linear-gradient(90deg,#ec4899,#8b5cf6,#6366f1);height:3px;', 'bc'=>'', 'tc'=>'#fdf2f8', 'ac'=>'#f472b6', 'bg'=>'rgba(244,114,182,0.08)', 'tx'=>'rgba(253,242,248,0.85)', 'fc'=>'#f9a8d4', 'deco'=>'🌌💫✨'],
            'parejas-aquarela' => ['wrap'=>'background:linear-gradient(135deg,#f0fdfa,#e0f2fe,#f5f3ff);', 'card'=>'background:rgba(255,255,255,0.88);border-radius:2rem;border:1px solid #99f6e4;box-shadow:0 20px 50px rgba(20,184,166,0.15);overflow:hidden;backdrop-filter:blur(8px);', 'bar'=>'background:linear-gradient(90deg,#2dd4bf,#38bdf8,#818cf8);height:4px;', 'bc'=>'', 'tc'=>'#134e4a', 'ac'=>'#0d9488', 'bg'=>'rgba(204,251,241,0.5)', 'tx'=>'#0f766e', 'fc'=>'#0d9488', 'deco'=>'🎨💧🦋'],
            // ── Especiales
            'especial-festivo'  => ['wrap'=>'background:linear-gradient(135deg,#fffbeb,#fff7ed,#fef2f2);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.5rem;border:2px solid #fde68a;box-shadow:0 20px 40px rgba(234,179,8,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f59e0b,#ef4444,#8b5cf6,#3b82f6);height:5px;', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#d97706', 'bg'=>'#fffbeb', 'tx'=>'#374151', 'fc'=>'#b45309', 'deco'=>'🎊🎈🎁'],
            'especial-serenidad'=> ['wrap'=>'background:linear-gradient(135deg,#f0fdf4,#ecfdf5,#f0fdfa);', 'card'=>'background:rgba(255,255,255,0.92);border-radius:1.5rem;border:1px solid #a7f3d0;box-shadow:0 20px 40px rgba(16,185,129,0.12);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#34d399,#10b981);height:4px;', 'bc'=>'', 'tc'=>'#064e3b', 'ac'=>'#059669', 'bg'=>'#f0fdf4', 'tx'=>'#065f46', 'fc'=>'#047857', 'deco'=>'🍃🌿☘️'],
            'especial-tropical' => ['wrap'=>'background:linear-gradient(135deg,#f7fee7,#ecfdf5,#f0fdfa);', 'card'=>'background:rgba(255,255,255,0.9);border-radius:1.5rem;border:2px solid #bbf7d0;box-shadow:0 20px 40px rgba(20,184,166,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#84cc16,#10b981,#06b6d4);height:5px;', 'bc'=>'', 'tc'=>'#14532d', 'ac'=>'#16a34a', 'bg'=>'#f7fee7', 'tx'=>'#166534', 'fc'=>'#15803d', 'deco'=>'🌴🦜🌺'],
            // ── Cumpleaños
            'cumple-confeti'   => ['wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fefce8,#eff6ff);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px dashed #f9a8d4;box-shadow:0 20px 50px rgba(236,72,153,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#ec4899,#eab308,#3b82f6,#ec4899);background-size:200%;height:5px;', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#db2777', 'bg'=>'#fdf2f8', 'tx'=>'#374151', 'fc'=>'#9d174d', 'deco'=>'🎉🎊🎈'],
            'cumple-neon'      => ['wrap'=>'background:radial-gradient(ellipse at center,#1e0533,#0d0d1a);', 'card'=>'background:rgba(255,255,255,0.05);border-radius:2rem;border:1px solid rgba(217,70,239,0.4);box-shadow:0 0 40px rgba(217,70,239,0.3),0 0 80px rgba(6,182,212,0.1),inset 0 0 30px rgba(217,70,239,0.05);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#d946ef,#22d3ee);height:3px;box-shadow:0 0 15px #d946ef;', 'bc'=>'', 'tc'=>'#fdf4ff', 'ac'=>'#d946ef', 'bg'=>'rgba(217,70,239,0.08)', 'tx'=>'rgba(253,244,255,0.85)', 'fc'=>'#e879f9', 'deco'=>'🪩🎶💫'],
            'cumple-dulce'     => ['wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fce7f3,#fae8ff);', 'card'=>'background:rgba(255,255,255,0.93);border-radius:2rem;border:2px solid #fbcfe8;box-shadow:0 20px 50px rgba(236,72,153,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f9a8d4,#e879f9);height:4px;', 'bc'=>'', 'tc'=>'#831843', 'ac'=>'#db2777', 'bg'=>'#fdf2f8', 'tx'=>'#9d174d', 'fc'=>'#be185d', 'deco'=>'🎂🍰🎀'],
            // ── Peques
            'peques-heroe-amigo'      => ['wrap'=>'background:linear-gradient(135deg,#eff6ff,#dbeafe,#fee2e2);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.75rem;border:2px solid #93c5fd;box-shadow:0 20px 45px rgba(59,130,246,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#2563eb,#ef4444);height:5px;', 'bc'=>'', 'tc'=>'#1e3a8a', 'ac'=>'#2563eb', 'bg'=>'#eff6ff', 'tx'=>'#1f2937', 'fc'=>'#1d4ed8', 'deco'=>'🕷️🦸⚡'],
            'peques-capitan-valiente' => ['wrap'=>'background:linear-gradient(135deg,#dbeafe,#e0e7ff,#fee2e2);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.75rem;border:2px solid #60a5fa;box-shadow:0 20px 45px rgba(37,99,235,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#1d4ed8,#dc2626);height:5px;', 'bc'=>'', 'tc'=>'#1e40af', 'ac'=>'#1d4ed8', 'bg'=>'#dbeafe', 'tx'=>'#1f2937', 'fc'=>'#1e3a8a', 'deco'=>'🛡️⭐🚀'],
            'peques-tecno-armadura'   => ['wrap'=>'background:linear-gradient(135deg,#fff7ed,#ffedd5,#fee2e2);', 'card'=>'background:rgba(255,255,255,0.96);border-radius:1.75rem;border:2px solid #fdba74;box-shadow:0 20px 45px rgba(234,88,12,0.22);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f59e0b,#ef4444);height:5px;', 'bc'=>'', 'tc'=>'#9a3412', 'ac'=>'#ea580c', 'bg'=>'#fff7ed', 'tx'=>'#374151', 'fc'=>'#c2410c', 'deco'=>'🤖⚙️🔥'],
            'peques-pista-veloz'      => ['wrap'=>'background:linear-gradient(135deg,#fff7ed,#fef3c7,#ffedd5);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.75rem;border:2px solid #f59e0b;box-shadow:0 20px 45px rgba(245,158,11,0.2);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f97316,#fbbf24);height:5px;', 'bc'=>'', 'tc'=>'#9a3412', 'ac'=>'#f97316', 'bg'=>'#fffbeb', 'tx'=>'#374151', 'fc'=>'#c2410c', 'deco'=>'🏎️🏁💨'],
            'peques-princesa-sueno'   => ['wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fce7f3,#fae8ff);', 'card'=>'background:rgba(255,255,255,0.96);border-radius:2rem;border:2px solid #f9a8d4;box-shadow:0 22px 48px rgba(236,72,153,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#ec4899,#d946ef);height:5px;', 'bc'=>'', 'tc'=>'#831843', 'ac'=>'#db2777', 'bg'=>'#fdf2f8', 'tx'=>'#6b7280', 'fc'=>'#be185d', 'deco'=>'👑✨🦄'],
            'peques-stitch-tierno'    => ['wrap'=>'background:linear-gradient(135deg,#ecfeff,#e0f2fe,#dbeafe);', 'card'=>'background:rgba(255,255,255,0.96);border-radius:2rem;border:2px solid #67e8f9;box-shadow:0 22px 48px rgba(14,165,233,0.18);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#06b6d4,#3b82f6);height:5px;', 'bc'=>'', 'tc'=>'#075985', 'ac'=>'#0284c7', 'bg'=>'#ecfeff', 'tx'=>'#334155', 'fc'=>'#0369a1', 'deco'=>'🛸💙🌺'],
            'peques-arcoiris'         => ['wrap'=>'background:linear-gradient(135deg,#ede9fe,#fce7f3,#fef3c7,#dcfce7);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:2rem;border:2px solid #c4b5fd;box-shadow:0 22px 48px rgba(124,58,237,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#8b5cf6,#ec4899,#eab308,#22c55e);height:5px;', 'bc'=>'', 'tc'=>'#4c1d95', 'ac'=>'#7c3aed', 'bg'=>'#faf5ff', 'tx'=>'#374151', 'fc'=>'#6d28d9', 'deco'=>'🌈⭐🎈'],
            'peques-cuento-clasico'   => ['wrap'=>'background:linear-gradient(135deg,#f8fafc,#f1f5f9,#e2e8f0);', 'card'=>'background:#ffffff;border-radius:1.5rem;border:1px solid #cbd5e1;box-shadow:0 18px 40px rgba(15,23,42,0.1);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#64748b,#334155);height:4px;', 'bc'=>'', 'tc'=>'#1e293b', 'ac'=>'#475569', 'bg'=>'#f8fafc', 'tx'=>'#334155', 'fc'=>'#0f172a', 'deco'=>'📚🧸💌'],
            // ── Genéricos legacy
            'clasico'      => ['wrap'=>'background:#F8F6FF;', 'card'=>'background:white;border-radius:1.5rem;border:1px solid #ede9fe;box-shadow:0 20px 40px rgba(0,0,0,0.08);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#7C3AED,#EC4899);height:4px;', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#7C3AED', 'bg'=>'#F5F3FF', 'tx'=>'#374151', 'fc'=>'#7C3AED', 'deco'=>'💜✨🌟'],
            'rosa-floral'  => ['wrap'=>'background:linear-gradient(135deg,#fdf2f8,#fff1f2);', 'card'=>'background:rgba(255,255,255,0.92);border-radius:2rem;border:2px solid #fce7f3;box-shadow:0 20px 40px rgba(244,114,182,0.15);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,#f472b6,#fb7185);padding:0.75rem;text-align:center;font-size:1.5rem;color:white;', 'bc'=>'🌸', 'tc'=>'#831843', 'ac'=>'#f472b6', 'bg'=>'#fce7f3', 'tx'=>'#6b7280', 'fc'=>'#f43f5e', 'deco'=>'🌸🌷💕'],
            'galaxia'      => ['wrap'=>'background:#0B0B2B;', 'card'=>'background:rgba(255,255,255,0.07);border-radius:1.5rem;border:1px solid rgba(255,255,255,0.1);backdrop-filter:blur(20px);box-shadow:0 25px 60px rgba(0,0,0,0.5);overflow:hidden;', 'bar'=>'background:linear-gradient(90deg,transparent,#A78BFA,transparent);height:1px;', 'bc'=>'', 'tc'=>'#fff', 'ac'=>'#A78BFA', 'bg'=>'rgba(255,255,255,0.05)', 'tx'=>'rgba(255,255,255,0.85)', 'fc'=>'#A78BFA', 'deco'=>'🌌⭐🔮'],
            'vintage'      => ['wrap'=>'background:#F5ECD7;', 'card'=>'background:#FFFBF0;border-radius:1rem;border:1px solid #DDD0A8;box-shadow:4px 6px 20px rgba(0,0,0,0.15);overflow:hidden;', 'bar'=>'', 'bc'=>'', 'tc'=>'#1f2937', 'ac'=>'#C8A96E', 'bg'=>'transparent', 'tx'=>'#4b5563', 'fc'=>'#92400e', 'deco'=>'📜🕊️🌿'],
            'minimalista'  => ['wrap'=>'background:white;', 'card'=>'background:white;border-left:4px solid #7C3AED;', 'bar'=>'', 'bc'=>'', 'tc'=>'#111827', 'ac'=>'#7C3AED', 'bg'=>'transparent', 'tx'=>'#374151', 'fc'=>'#1f2937', 'deco'=>'⬜◻️▫️'],
            'fiesta'       => ['wrap'=>'background:linear-gradient(135deg,#FFF7ED,#FEF3C7,#ECFDF5);', 'card'=>'background:rgba(255,255,255,0.95);border-radius:1.5rem;border:2px solid #fde68a;box-shadow:0 20px 40px rgba(0,0,0,0.1);overflow:hidden;', 'bar'=>'background:linear-gradient(135deg,#FDE68A,#FCA5A5,#A5B4FC);padding:0.75rem;text-align:center;font-size:1.5rem;', 'bc'=>'🎉', 'tc'=>'#78350f', 'ac'=>'#F59E0B', 'bg'=>'#FFF7ED', 'tx'=>'#374151', 'fc'=>'#d97706', 'deco'=>'🎉🎊🎈'],
        ];
    }
}
