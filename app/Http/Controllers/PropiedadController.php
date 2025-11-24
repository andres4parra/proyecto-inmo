<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedad; // Asegúrate de que este modelo existe y apunta a tu tabla 'propiedades'

class PropiedadController extends Controller
{
    /**
     * Muestra la lista de todas las propiedades en arriendo.
     */
    public function index(Request $request)
    {
        // Obtener filtros desde la URL
        $tipoInmueble = $request->get('tipoInmueble');
        $ubicacion = $request->get('ubicacion');
        $habitaciones = $request->get('habitaciones');
        $maxPrice = $request->get('maxPrice');

        // Construir la query
        $query = Propiedad::query();

        // Filtro por tipo de inmueble
        if ($tipoInmueble && $tipoInmueble !== 'Todos') {
            $query->where('tipo', $tipoInmueble);
        }

        // Filtro por ubicación (búsqueda parcial)
        if ($ubicacion) {
            $query->where('ubicacion', 'like', "%$ubicacion%");
        }

        // Filtro por habitaciones mínimas
        if ($habitaciones && $habitaciones !== 'Cualquiera') {
            $minHabitaciones = (int) str_replace('+', '', $habitaciones);
            $query->where('habitaciones', '>=', $minHabitaciones);
        }

        // Filtro por precio máximo
        if ($maxPrice) {
            $query->where('precio', '<=', $maxPrice);
        }

        // Obtener resultados (puedes paginar si quieres)
        $properties = $query->get();

        // Pasar filtros actuales al Blade para mantener valores seleccionados
        return view('propiedades.index', compact(
            'properties',
            'tipoInmueble',
            'ubicacion',
            'habitaciones',
            'maxPrice'
        ));
    }

    /**
     * Muestra una propiedad específica por su ID.
     */
    public function show($id)
    {
        $property = Propiedad::findOrFail($id);

        // Initialize features (adjust to your actual relation or attribute)
        $features = $property->features ?? [];

        return view('propiedades.show', compact('property', 'features'));
    }
}
