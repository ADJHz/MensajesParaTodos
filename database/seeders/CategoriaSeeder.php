<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Para Mamá',      'slug' => 'para-mama',      'emoji' => '💐', 'color' => '#F4A0BF', 'orden' => 1, 'descripcion' => 'Mensajes llenos de amor para ella'],
            ['nombre' => 'Para Papá',      'slug' => 'para-papa',      'emoji' => '🎩', 'color' => '#6C9BE0', 'orden' => 2, 'descripcion' => 'Honra a ese superhéroe en tu vida'],
            ['nombre' => 'Para Herman@s',  'slug' => 'para-hermanos',  'emoji' => '🤝', 'color' => '#F59E0B', 'orden' => 3, 'descripcion' => 'Lazos de sangre y complicidad'],
            ['nombre' => 'Para Parejas',   'slug' => 'para-parejas',   'emoji' => '💑', 'color' => '#EF4444', 'orden' => 4, 'descripcion' => 'Dile cuánto la/lo amas'],
            ['nombre' => 'Días Especiales','slug' => 'dias-especiales','emoji' => '🎉', 'color' => '#8B5CF6', 'orden' => 5, 'descripcion' => 'Fechas que nunca se olvidan'],
            ['nombre' => 'Cumpleaños',     'slug' => 'cumpleanos',     'emoji' => '🎂', 'color' => '#10B981', 'orden' => 6, 'descripcion' => 'Celebra su día especial'],
            ['nombre' => 'Para los más peques', 'slug' => 'para-mas-peques', 'emoji' => '🧸', 'color' => '#38BDF8', 'orden' => 7, 'descripcion' => 'Mensajes para niño, niña o estilo normal'],
        ];

        foreach ($categorias as $cat) {
            Categoria::updateOrCreate(['slug' => $cat['slug']], array_merge($cat, ['activo' => true]));
        }
    }
}
