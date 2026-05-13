<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;

class CategoriaApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Categoria::where('activo', true)
                ->orderBy('orden')
                ->with('ocasiones')
                ->get()
        );
    }
}
