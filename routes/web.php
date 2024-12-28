<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ComandaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/coleccions', [ProducteController::class, 'coleccions'])->name('coleccions.index');






Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutes de gestió de productes
    Route::get('/productes', [ProducteController::class, 'index'])->name('productes.index');
    Route::get('/comandes', [ComandaController::class, 'index'])->name('comandes.index');
});

Route::view('/sobre-nosaltres', 'about')->name('sobre-nosaltres');
Route::view('/contacte', 'contact')->name('contacte');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/lang/{idioma}', 'App\Http\Controllers\LocalizationController@index')
    ->where('idioma', 'ca|en|es|fr');

require __DIR__.'/auth.php';
