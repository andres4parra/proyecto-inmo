<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\ContactoController;
use App\Models\Propiedad;

Route::get('/', function () {
    $featuredProperties = Propiedad::take(6)->get(); // 6 propiedades destacadas
    return view('welcome', compact('featuredProperties'));
});

Route::get('/propiedades', [PropiedadController::class, 'index'])->name('propiedades.index');
// Propiedades
Route::get('/propiedades', [PropiedadController::class, 'index'])->name('propiedades.index');
Route::get('/propiedades/{id}', [PropiedadController::class, 'show'])->name('propiedades.show');

// Nosotros
Route::view('/nosotros', 'nosotros')->name('nosotros');

// Contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');



// Página de contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Enviar formulario de contacto
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])
    ->name('contacto.enviar');

Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.form');