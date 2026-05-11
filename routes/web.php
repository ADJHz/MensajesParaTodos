<?php

use App\Http\Controllers\DedicatoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/dedicatoria', [DedicatoriaController::class, 'store'])->name('dedicatoria.store');
Route::get('/para-mama/{code}', [DedicatoriaController::class, 'show'])->name('dedicatoria.show');
