@extends('layouts.app')
@section('title', 'Completar pago')
@section('robots', 'noindex, nofollow')

@section('content')
<div class="max-w-lg mx-auto px-4 py-16">
    <div class="text-center mb-8">
        <div class="text-6xl mb-3">💳</div>
        <h1 class="font-app-heading text-3xl font-bold text-gray-800 mb-2">Un paso más</h1>
        <p class="text-gray-500">Completa el pago para activar y compartir tu mensaje</p>
    </div>

    {{-- Resumen del mensaje --}}
    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 mb-6">
        <h2 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Resumen de tu mensaje</h2>

        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Ocasión</span>
                <span class="font-semibold text-gray-700">{{ $mensaje->ocasion->emoji }} {{ $mensaje->ocasion->nombre }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Para</span>
                <span class="font-semibold text-gray-700">{{ $mensaje->destinatario }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">De</span>
                <span class="font-semibold text-gray-700">{{ $mensaje->remitente }}</span>
            </div>
            @if($mensaje->youtube_url)
            <div class="flex justify-between">
                <span class="text-gray-500">Música</span>
                <span class="font-semibold text-violet-600">🎵 Incluida</span>
            </div>
            @endif
            <div class="border-t pt-3 flex justify-between">
                <span class="font-bold text-gray-700">Total</span>
                <span class="font-extrabold text-violet-700 text-lg">${{ number_format($montoMxn, 2) }} MXN</span>
            </div>
        </div>
    </div>

    {{-- Beneficios --}}
    <div class="bg-violet-50 rounded-2xl p-5 mb-6 border border-violet-100">
        <p class="font-semibold text-violet-700 text-sm mb-3">✨ Al pagar recibirás:</p>
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex gap-2"><span class="text-emerald-500">✓</span> Link único compartible para el destinatario</li>
            <li class="flex gap-2"><span class="text-emerald-500">✓</span> Mensaje con animaciones y efectos visuales</li>
            <li class="flex gap-2"><span class="text-emerald-500">✓</span> Música de fondo si la configuraste</li>
            <li class="flex gap-2"><span class="text-emerald-500">✓</span> Guardado permanentemente</li>
        </ul>
    </div>

    {{-- Botón de pago --}}
    <form method="POST" action="{{ route('pago.sesion', $mensaje->code) }}">
        @csrf
        <button type="submit"
                class="w-full py-5 bg-linear-to-r from-violet-600 to-pink-500 text-white font-extrabold text-xl rounded-full hover:opacity-90 transition shadow-lg">
            🔐 Pagar ${{ number_format($montoMxn, 2) }} MXN con Stripe →
        </button>
    </form>

    @if(app()->isLocal())
    <a href="{{ route('mensajes.show', $mensaje->code) }}"
       class="mt-3 w-full inline-flex items-center justify-center py-3 border-2 border-violet-200 text-violet-700 font-bold rounded-full hover:bg-violet-50 transition">
        👀 Vista previa (desarrollo, sin pagar)
    </a>
    @endif

    <p class="text-center text-xs text-gray-400 mt-4">
        🔒 Pago 100% seguro con Stripe · No guardamos datos de tarjeta
    </p>
    <div class="text-center mt-3">
        <a href="{{ route('dashboard') }}" class="text-xs text-gray-400 hover:text-gray-600 underline">
            Pagar después (el mensaje se guarda como borrador)
        </a>
    </div>
</div>
@endsection
