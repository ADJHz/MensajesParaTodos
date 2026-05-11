<?php

namespace App\Http\Controllers;

use App\Models\Dedicatoria;
use Illuminate\Http\Request;

class DedicatoriaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'message'    => 'required|string|max:500',
            'remitente'  => 'nullable|string|max:100',
        ]);

        $dedicatoria = Dedicatoria::create([
            'mama_name'  => $validated['name'],
            'message'    => $validated['message'],
            'remitente'  => $validated['remitente'] ?? null,
        ]);

        $url = route('dedicatoria.show', $dedicatoria->code);

        return response()->json([
            'success' => true,
            'code'    => $dedicatoria->code,
            'url'     => $url,
        ]);
    }

    public function show(string $code)
    {
        $dedicatoria = Dedicatoria::where('code', $code)->firstOrFail();

        return view('dedicatoria-mama', compact('dedicatoria'));
    }
}
