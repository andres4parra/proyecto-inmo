<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\ContactoController;
use App\Models\Propiedad;

// Página principal
Route::get('/', function () {
    $featuredProperties = Propiedad::take(6)->get(); // 6 propiedades destacadas
    return view('welcome', compact('featuredProperties'));
});

// Propiedades
// 1. RUTA DE ÍNDICE (LISTA DE PROPIEDADES): Debe ir PRIMERO
Route::get('/propiedades', [PropiedadController::class, 'index'])->name('propiedades.index');

// 2. RUTA DE DETALLE (PROPIEDAD INDIVIDUAL): Debe ir DESPUÉS
// {id} es un parámetro que le dice a Laravel que es una propiedad específica
Route::get('/propiedades/{id}', [PropiedadController::class, 'show'])->name('propiedades.show');
// Nosotros
Route::view('/nosotros', 'nosotros')->name('nosotros');
//pagar arriendo
Route::view('/pagos', 'pagos')->name('pagos.index');
// Contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.form');
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

// Dashboard (solo usuarios autenticados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

