<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Message;
use App\Models\Contrato;

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
        // Traer todas las propiedades con su dueño
        $properties = Propiedad::with('dueno')->get();

        // Traer todos los mensajes y contratos
        $messages = Message::orderBy('created_at', 'desc')->get();
        $contracts = Contrato::all();

        // Contadores
        $totalProperties = $properties->count();
        $totalMessages = $messages->count();
        $totalContracts = $contracts->count();
        $newMessages = $messages->where('is_resolved', 0)->count();

        return view('dashboard', [
            'properties' => $properties,
            'messages' => $messages,
            'contracts' => $contracts,

            // contadores
            'totalProperties' => $totalProperties,
            'totalMessages' => $totalMessages,
            'totalContracts' => $totalContracts,
            'newMessages' => $newMessages,

            // Control del formulario de nueva propiedad
            'showPropertyForm' => $request->query('new') === 'true'
        ]);
    }
}
