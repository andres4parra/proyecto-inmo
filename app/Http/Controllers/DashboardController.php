<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Importa tus modelos si ya existen. Si no existen, los crearemos temporalmente.
use App\Models\Propiedad; 
use App\Models\Mensaje; 

class DashboardController extends Controller
{
    /**
     * Muestra el panel de administración principal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 1. OBTENER DATOS (Usando datos simulados si los Modelos no existen aún)
        
        // Simulación: Si aún no tienes los modelos, puedes crear arrays vacíos o simulados.
        // Si ya tienes los modelos Propiedad y Mensaje, descomenta el código de la DB.
        
        // === Lógica para simular variables ===
        // Requerido por dashboard.blade.php para evitar "Undefined Variable"
        $properties = [];
        $messages = [];
        $showPropertyForm = $request->query('new') === 'true'; // Necesario para el botón "Nueva Propiedad"

        // === Lógica REAL (si ya tienes los Modelos) ===
        /*
        if (class_exists(Propiedad::class)) {
             $properties = Propiedad::all();
        }
        if (class_exists(Mensaje::class)) {
            // Asumiendo que existe un modelo Mensaje
            $messages = Mensaje::where('status', 'nuevo')->get(); 
        }
        */

        // 2. RETORNAR LA VISTA
        // Importante: Pasa las variables que tu vista espera.
        return view('dashboard', [
            'properties' => $properties,
            'messages' => $messages,
            'showPropertyForm' => $showPropertyForm,
        ]);
    }
}