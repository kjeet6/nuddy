<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ComandaController;
use App\Http\Controllers\CarretController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/coleccions', [ProducteController::class, 'coleccions'])->name('coleccions.index');

// Rutes per a la gestió d'usuaris (administrador)
Route::get('/users', [ProfileController::class, 'index'])->name('users.index');
Route::post('/users/{id}/update-role', [ProfileController::class, 'updateRole'])->name('users.updateRole');
Route::delete('/comandes/{id}', [ComandaController::class, 'destroy'])->name('comandes.destroy');

Route::middleware(['auth', 'verified'])->group(function () {

    // Comprovació del rol per accedir al dashboard
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin) {
            return view('dashboard'); 
        }
        return redirect('/'); 
    })->name('dashboard');

    // Rutes per a productes
    Route::get('/productes', function () {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'No tens permís per accedir aquí.');
        }
        return app()->call([App\Http\Controllers\ProducteController::class, 'index']);
    })->name('productes.index');
    
    Route::resource('productes', ProducteController::class)->except(['show']);

    // Rutes per a comandes i cistelles
    Route::get('/comandes', [ComandaController::class, 'index'])->name('comandes.index');
    
    // Comandes només accessibles per l'admin
    Route::middleware(['auth', 'verified'])->group(function () {
        
        Route::get('/comandes', [ComandaController::class, 'index'])->name('comandes.index');
        Route::get('/comandes/{comanda}/edit', [ComandaController::class, 'edit'])->name('comandes.edit');
        Route::put('/comandes/{comanda}', [ComandaController::class, 'update'])->name('comandes.update');
        Route::delete('/comandes/{comanda}', [ComandaController::class, 'destroy'])->name('comandes.destroy');
    });
    
    

    // Rutes per a la cistella de la compra
    Route::get('/carret', [CarretController::class, 'index'])->name('carret.index');
    Route::post('/carret/afegir', [CarretController::class, 'store'])->name('carret.afegir');
    Route::post('/carret/restar/{producteId}', [CarretController::class, 'restar'])->name('carret.restar');
    Route::delete('/carret/eliminar/{producteId}', [CarretController::class, 'destroy'])->name('carret.eliminar');
    Route::post('/carret/finalitzar', [CarretController::class, 'finalitzar'])->name('carret.finalitzar');
});

// Altres pàgines
Route::view('/sobre-nosaltres', 'about')->name('sobre-nosaltres');
Route::view('/contacte', 'contact')->name('contacte');

// Rutes del perfil d'usuari
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta per canviar idioma
Route::get('/lang/{idioma}', 'App\Http\Controllers\LocalizationController@index')
    ->where('idioma', 'ca|en|es|fr');

require __DIR__.'/auth.php';
