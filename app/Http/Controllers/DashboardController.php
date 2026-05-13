<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('activo', true)
            ->orderBy('orden')
            ->with('ocasiones')
            ->get();

        $mensajes = Auth::user()->mensajes()
            ->with(['ocasion.categoria', 'pago'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('categorias', 'mensajes'));
    }
}
