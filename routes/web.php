<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Rutas Públicas
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\ContactoController;
// Rutas de Administración
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\UserController as AdminUserController; // Usamos un alias para el controlador de Admin
use App\Http\Controllers\Admin\PropiedadController as AdminPropiedadController; // Usamos un alias para el controlador de Admin
use App\Http\Controllers\Admin\MessageController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // =======================================================
    // RUTAS DE ADMINISTRACIÓN
    // =======================================================
    Route::prefix('admin')->name('admin.')->group(function () {

        // 2. PROPIEDADES (CRUD completo)
        Route::resource('properties', AdminPropiedadController::class)
            ->except(['show']);


        // 3. CONTRATOS
        Route::resource('contracts', ContractController::class);

        // 4. USUARIOS (CORRECCIÓN: Usamos resource para obtener todas las rutas CRUD)
        Route::resource('usuarios', AdminUserController::class)
            ->except(['show']) // No necesitamos la vista individual
            ->names('users'); // Usa nombres de ruta como admin.users.index, admin.users.create, etc.

        // 5. MENSAJES
        // Rutas para la gestión de mensajes de contacto
        Route::get('/mensajes', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/mensajes/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::patch('/mensajes/{message}/resolve', [MessageController::class, 'resolve'])->name('messages.resolve');
        Route::delete('/mensajes/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });
});


require __DIR__ . '/auth.php';
