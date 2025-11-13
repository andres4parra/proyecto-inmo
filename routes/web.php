<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Rutas Públicas
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\ContactoController;
// Rutas de Administración
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\PropiedadController as AdminPropiedadController; // Usamos un alias para el controlador de Admin
use App\Models\Propiedad;


// =======================================================
// RUTAS PÚBLICAS (Sin autenticación requerida)
// =======================================================

// Página principal
Route::get('/', function () {
    // Si usas datos simulados, asegúrate de que esto no falle si la tabla Propiedad está vacía
    $featuredProperties = Propiedad::take(6)->get(); 
    return view('welcome', compact('featuredProperties'));
})->name('home');

// Propiedades Públicas
Route::get('/propiedades', [PropiedadController::class, 'index'])->name('propiedades.index');
Route::get('/propiedades/{id}', [PropiedadController::class, 'show'])->name('propiedades.show');

// Páginas estáticas
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/pagos', 'pagos')->name('pagos.index');

// Contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.form');
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');


// =======================================================
// RUTAS PROTEGIDAS (Requiere 'auth' y 'verified')
// =======================================================

Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. DASHBOARD PRINCIPAL
    // Esta ruta toma precedencia sobre la otra ruta /dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    
    // Perfil de usuario (requiere solo 'auth', pero incluimos 'verified' en el grupo superior)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    // =======================================================
    // RUTAS DE ADMINISTRACIÓN
    // Prefijo de URL: /admin
    // Prefijo de Nombre: admin.
    // =======================================================
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // 2. PROPIEDADES (CRUD completo)
        // Crea admin.properties.index, admin.properties.create, admin.properties.edit, etc.
        Route::resource('properties', AdminPropiedadController::class)
             ->except(['show']); // No necesitamos la vista individual ya que la pública existe

        // 3. CONTRATOS
        // 3. CONTRATOS
        Route::get('/contratos', [ContractController::class, 'index'])->name('contracts'); 
        
        // 4. USUARIOS
        // Si no existe el controlador Admin\UserController, usa una ruta con closure que carga la vista de usuarios del admin.
        Route::get('/usuarios', function () {
             return view('admin.users.index');
        })->name('users'); 

        // 5. MENSAJES
        Route::get('/mensajes', function () { 
             return view('admin.messages.index'); 
        })->name('messages'); 
    });

});


require __DIR__.'/auth.php';