<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Ocasion;
use Illuminate\Database\Seeder;

class OcasionSeeder extends Seeder
{
    public function run(): void
    {
        $ocasiones = [
            // Para Mamá
            'para-mama' => [
                ['nombre' => 'Día de las Madres',     'slug' => 'dia-de-las-madres',     'emoji' => '💐', 'plantilla_vista' => 'mensajes.tpl.dia-madres',    'descripcion' => '10 de mayo'],
                ['nombre' => 'Cumpleaños de Mamá',    'slug' => 'cumple-mama',           'emoji' => '🎂', 'plantilla_vista' => 'mensajes.tpl.cumple-mama',    'descripcion' => 'Su día especial'],
                ['nombre' => 'Amor sin fecha',        'slug' => 'amor-sin-fecha-mama',   'emoji' => '🌸', 'plantilla_vista' => 'mensajes.tpl.amor-mama',     'descripcion' => 'Amor sin fecha'],
            ],
            // Para Papá
            'para-papa' => [
                ['nombre' => 'Día del Padre',         'slug' => 'dia-del-padre',         'emoji' => '🎩', 'plantilla_vista' => 'mensajes.tpl.dia-padre',     'descripcion' => '3er domingo de junio'],
                ['nombre' => 'Cumpleaños de Papá',    'slug' => 'cumple-papa',           'emoji' => '🎂', 'plantilla_vista' => 'mensajes.tpl.cumple-papa',   'descripcion' => 'Su día especial'],
            ],
            // Para Herman@s
            'para-hermanos' => [
                ['nombre' => 'Día del Hermano',       'slug' => 'dia-del-hermano',       'emoji' => '🤝', 'plantilla_vista' => 'mensajes.tpl.dia-hermano',   'descripcion' => '5 de septiembre'],
                ['nombre' => 'Cumpleaños de Hermano', 'slug' => 'cumple-hermano',        'emoji' => '🎂', 'plantilla_vista' => 'mensajes.tpl.cumple-hermano','descripcion' => 'Su día especial'],
            ],
            // Para Parejas
            'para-parejas' => [
                ['nombre' => 'San Valentín',          'slug' => 'san-valentin',          'emoji' => '❤️', 'plantilla_vista' => 'mensajes.tpl.san-valentin',  'descripcion' => '14 de febrero'],
                ['nombre' => 'Aniversario',           'slug' => 'aniversario',           'emoji' => '💑', 'plantilla_vista' => 'mensajes.tpl.aniversario',   'descripcion' => 'Celebra su amor'],
                ['nombre' => 'Solo porque sí',        'slug' => 'solo-porque-si',        'emoji' => '💌', 'plantilla_vista' => 'mensajes.tpl.solo-porque-si','descripcion' => 'El amor no necesita fecha'],
            ],
            // Días Especiales
            'dias-especiales' => [
                ['nombre' => 'Día del Niño',          'slug' => 'dia-del-nino',          'emoji' => '🧒', 'plantilla_vista' => 'mensajes.tpl.dia-nino',      'descripcion' => '30 de abril'],
                ['nombre' => 'Día del Abuelo',        'slug' => 'dia-del-abuelo',        'emoji' => '👴', 'plantilla_vista' => 'mensajes.tpl.dia-abuelo',    'descripcion' => '26 de julio'],
                ['nombre' => 'Día de la Amistad',     'slug' => 'dia-de-la-amistad',     'emoji' => '🤗', 'plantilla_vista' => 'mensajes.tpl.dia-amistad',   'descripcion' => '14 de febrero'],
                ['nombre' => 'Navidad',               'slug' => 'navidad',               'emoji' => '🎄', 'plantilla_vista' => 'mensajes.tpl.navidad',       'descripcion' => '25 de diciembre'],
                ['nombre' => 'Año Nuevo',             'slug' => 'año-nuevo',             'emoji' => '🎆', 'plantilla_vista' => 'mensajes.tpl.ano-nuevo',     'descripcion' => '1 de enero'],
            ],
            // Cumpleaños
            'cumpleanos' => [
                ['nombre' => 'Cumpleaños Especial',   'slug' => 'cumpleanos-especial',   'emoji' => '🎂', 'plantilla_vista' => 'mensajes.tpl.cumple-especial','descripcion' => 'Un día único'],
                ['nombre' => 'Quinceañera',           'slug' => 'quinceanera',           'emoji' => '👑', 'plantilla_vista' => 'mensajes.tpl.quinceanera',   'descripcion' => 'Su gran día'],
                ['nombre' => 'Graduación',            'slug' => 'graduacion',            'emoji' => '🎓', 'plantilla_vista' => 'mensajes.tpl.graduacion',    'descripcion' => 'Celebra su logro'],
            ],
            // Para los más peques
            'para-mas-peques' => [
                ['nombre' => 'Mensaje para Niño',     'slug' => 'mensaje-para-nino',     'emoji' => '🕷️', 'plantilla_vista' => 'mensajes.tpl.peques-nino',   'descripcion' => 'Héroes y autos para peques'],
                ['nombre' => 'Mensaje para Niña',     'slug' => 'mensaje-para-nina',     'emoji' => '👑', 'plantilla_vista' => 'mensajes.tpl.peques-nina',   'descripcion' => 'Princesas y personajes tiernos'],
                ['nombre' => 'Mensaje Normal Peques', 'slug' => 'mensaje-peques-normal', 'emoji' => '💌', 'plantilla_vista' => 'mensajes.tpl.peques-normal', 'descripcion' => 'Diseños neutros y amistosos'],
            ],
        ];

        foreach ($ocasiones as $catSlug => $items) {
            $categoria = Categoria::where('slug', $catSlug)->first();
            if (!$categoria) continue;
            foreach ($items as $item) {
                Ocasion::updateOrCreate(
                    ['slug' => $item['slug']],
                    array_merge($item, ['categoria_id' => $categoria->id, 'activo' => true])
                );
            }
        }
    }
}
