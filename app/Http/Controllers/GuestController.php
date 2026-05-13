<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class GuestController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('activo', true)
            ->orderBy('orden')
            ->with('ocasiones')
            ->get();

        return view('guest.home', compact('categorias'));
    }
}
