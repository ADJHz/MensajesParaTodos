{{--
    Router de Día del Padre.
    Selecciona el template correcto según el diseño elegido (`$mensaje->template`).
    - pad-corbata  → Caballero Clásico
    - pad-brujula  → Aventurero
    - pad-madera   → Roble Fuerte
--}}
@php
    $tpl = $mensaje->template ?? 'pad-corbata';
    $vista = match($tpl) {
        'pad-brujula' => 'mensajes.tpl.dia-padre-aventurero',
        'pad-madera'  => 'mensajes.tpl.dia-padre-roble',
        default       => 'mensajes.tpl.dia-padre-caballero',
    };
@endphp
@include($vista, ['mensaje' => $mensaje])
