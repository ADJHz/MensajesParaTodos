<?php

use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\MensajeApiController;
use App\Http\Controllers\Api\OcasionApiController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DedicatoriaController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

// ─── Página pública (home de la plataforma) ──────────────────────────────────
Route::get('/', [GuestController::class, 'index'])->name('home');

// ─── Autenticación ───────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',                [LoginController::class,    'show'])->name('login');
    Route::post('/login',               [LoginController::class,    'store']);
    Route::get('/register',             [RegisterController::class, 'show'])->name('register');
    Route::post('/register',            [RegisterController::class, 'store'])->name('register.store');
    Route::get('/auth/google',          [GoogleController::class,   'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleController::class,   'callback']);
});
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

// ─── Zona autenticada ─────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',            [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/mensajes/crear',       [MensajeController::class,   'crear'])->name('mensajes.crear');
    Route::post('/mensajes',            [MensajeController::class,   'store'])->name('mensajes.store');
    Route::get('/mis-mensajes',         [MensajeController::class,   'mios'])->name('mensajes.mios');
    Route::get('/mensajes/{code}/editar', [MensajeController::class, 'edit'])->name('mensajes.editar');
    Route::put('/mensajes/{code}',      [MensajeController::class,   'update'])->name('mensajes.update');
    Route::delete('/mensajes/{code}',   [MensajeController::class,   'destroy'])->name('mensajes.destroy');
    Route::get('/pago/{code}',          [PagoController::class,      'checkout'])->name('pago.checkout');
    Route::post('/pago/{code}/sesion',  [PagoController::class,      'crearSesion'])->name('pago.sesion');
    Route::get('/pago/{code}/exito',    [PagoController::class,      'exito'])->name('pago.exito');
    Route::get('/pago/cancelado',       [PagoController::class,      'cancelado'])->name('pago.cancelado');

    // ─── Asistente IA (OpenRouter) ──────────────────────────────────────────
    Route::post('/api/ia/generar', [\App\Http\Controllers\AiAsistenteController::class, 'generar'])
        ->middleware('throttle:20,1')
        ->name('ia.generar');
    Route::post('/api/ia/corregir', [\App\Http\Controllers\AiAsistenteController::class, 'corregir'])
        ->middleware('throttle:30,1')
        ->name('ia.corregir');
});

// ─── Stripe webhook (sin CSRF) ────────────────────────────────────────────────
Route::post('/webhook/stripe', [PagoController::class, 'webhook'])
    ->name('webhook.stripe')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// ─── Link público del mensaje pagado ─────────────────────────────────────────
Route::get('/mensaje/{code}', [MensajeController::class, 'show'])->name('mensajes.show');

// ─── Proxy TTS (voz natural española vía Google Translate) ───────────────────
Route::get('/tts', [\App\Http\Controllers\TtsController::class, 'speak'])->name('tts.speak');

// ─── Buscador de música (Deezer + iTunes, previews 30s) ──────────────────────
Route::get('/api/musica/buscar', [\App\Http\Controllers\MusicSearchController::class, 'search'])
    ->middleware('throttle:60,1')
    ->name('musica.buscar');

Route::get('/api/musica/sugerencias', [\App\Http\Controllers\MusicSearchController::class, 'suggest'])
    ->middleware('throttle:30,1')
    ->name('musica.sugerencias');

Route::get('/api/musica/letra', [\App\Http\Controllers\MusicSearchController::class, 'lyrics'])
    ->middleware('throttle:40,1')
    ->name('musica.letra');

// ─── Módulo original Día de las Madres (backward compat) ─────────────────────
Route::post('/dedicatoria',   [DedicatoriaController::class, 'store'])->name('dedicatoria.store');
Route::get('/para-mama/{code}', [DedicatoriaController::class, 'show'])->name('dedicatoria.show');

// ─── API REST ─────────────────────────────────────────────────────────────────
Route::prefix('api')->group(function () {
    Route::get('/categorias',       [CategoriaApiController::class, 'index']);
    Route::get('/ocasiones/{slug}', [OcasionApiController::class,   'byCategoria']);
    Route::get('/mensajes/{code}',  [MensajeApiController::class,   'show']);
});
