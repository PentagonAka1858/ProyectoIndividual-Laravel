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

Route::middleware('auth')->group(function () {
    Route::get('/frutas', [FrutaController::class, 'index'])->name('fruta.all');
    Route::get('/frutas', [FrutaController::class, 'show'])->name('fruta.details');
    Route::get('/frutas', [FrutaController::class, 'create'])->name('fruta.create');
    Route::post('/frutas', [FrutaController::class, 'store'])->name('fruta.store');
    Route::get('/frutas', [FrutaController::class, 'edit'])->name('fruta.edit');
    Route::put('/frutas', [FrutaController::class, 'update'])->name('fruta.update');
    Route::get('/frutas', [FrutaController::class, 'destroy'])->name('fruta.destroy');
});

require __DIR__.'/auth.php';
