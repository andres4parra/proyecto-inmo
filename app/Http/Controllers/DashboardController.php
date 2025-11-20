<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Importa tus modelos si ya existen. Si no existen, los crearemos temporalmente.
use App\Models\Propiedad;
use App\Models\Message;

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
        // Obtener propiedades reales
        $properties = Propiedad::all();

        // Obtener mensajes reales según tu tabla
        $messages = Message::orderBy('created_at', 'desc')->get();

        // Mostrar formulario nueva propiedad si ?new=true
        $showPropertyForm = $request->query('new') === 'true';

        return view('dashboard', [
            'properties' => $properties,
            'messages' => $messages,
            'showPropertyForm' => $showPropertyForm,
        ]);
    }
}
