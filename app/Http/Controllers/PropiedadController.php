<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Propiedad; // Descomentar si usas modelos de Eloquent

class PropiedadController extends Controller
{
    /**
     * Muestra la lista de todas las propiedades en arriendo (propiedades/index.blade.php).
     */
    public function index()
    {
        // En un caso real: $propiedades = Propiedad::where('tipo', 'arriendo')->paginate(9);

        // Por ahora, solo devuelve la vista:
        return view('propiedades.index'); 
    }

    /**
     * Muestra una propiedad específica por su ID (propiedades/show.blade.php).
     */
    public function show(string $id)
    {
        // En un caso real: $propiedad = Propiedad::findOrFail($id);
        
        // Por ahora, solo devuelve la vista, pasando el ID si es necesario para el ejemplo:
        return view('propiedades.show', compact('id')); 
    }
}