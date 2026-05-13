<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MensajePlataforma;

class MensajeApiController extends Controller
{
    public function show(string $code)
    {
        $mensaje = MensajePlataforma::with(['ocasion.categoria'])
            ->where('code', $code)
            ->where('estado', 'pagado')
            ->firstOrFail();

        return response()->json([
            'code'        => $mensaje->code,
            'destinatario'=> $mensaje->destinatario,
            'mensaje'     => $mensaje->mensaje,
            'remitente'   => $mensaje->remitente,
            'youtube_url' => $mensaje->youtube_url,
            'ocasion'     => $mensaje->ocasion->nombre,
            'categoria'   => $mensaje->ocasion->categoria->nombre,
            'creado'      => $mensaje->created_at->toDateString(),
        ]);
    }
}
