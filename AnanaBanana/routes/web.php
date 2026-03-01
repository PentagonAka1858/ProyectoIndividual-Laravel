<?php

use App\Http\Controllers\FrutaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/frutas', [FrutaController::class, 'index'])->name('frutas.index');
    Route::get('/frutas/crear', [FrutaController::class, 'create'])->name('frutas.create');
    Route::get('/frutas/{id}', [FrutaController::class, 'show'])->name('frutas.details');
    Route::post('/frutas', [FrutaController::class, 'store'])->name('frutas.store');
    Route::get('/frutas/{id}/editar', [FrutaController::class, 'edit'])->name('frutas.edit');
    Route::put('/frutas/{id}', [FrutaController::class, 'update'])->name('frutas.update');
    Route::get('/frutas/{id}/eliminar', [FrutaController::class, 'destroy'])->name('frutas.destroy');
});

require __DIR__.'/auth.php';
