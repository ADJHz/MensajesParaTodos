<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;

class OcasionApiController extends Controller
{
    public function byCategoria(string $slug)
    {
        $categoria = Categoria::where('slug', $slug)->where('activo', true)->firstOrFail();

        return response()->json([
            'categoria' => $categoria,
            'ocasiones' => $categoria->ocasiones,
        ]);
    }
}
