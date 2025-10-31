// app/Http/Controllers/Admin/PropiedadController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropiedadController extends Controller
{
    // Muestra la lista de propiedades de administración
    public function index()
    {
        // Obtener datos (puedes usar datos simulados por ahora o Propiedad::all())
        $properties = []; // O Propiedad::all();
        return view('admin.properties.index', compact('properties')); 
        // ¡Necesitas crear resources/views/admin/properties/index.blade.php!
    }

    // Muestra el formulario para crear una nueva propiedad
    public function create()
    {
        return view('admin.properties.create');
    }

    // Guarda una nueva propiedad en la base de datos
    public function store(Request $request)
    {
        // Lógica de validación y guardado
        return redirect()->route('admin.properties.index')->with('success', 'Propiedad creada.');
    }

    // Muestra el formulario para editar una propiedad
    public function edit($id)
    {
        // $property = Propiedad::findOrFail($id);
        return view('admin.properties.edit', compact('property'));
    }

    // Actualiza una propiedad en la base de datos
    public function update(Request $request, $id)
    {
        // Lógica de validación y actualización
        return redirect()->route('admin.properties.index')->with('success', 'Propiedad actualizada.');
    }

    // Elimina una propiedad de la base de datos
    public function destroy($id)
    {
        // Lógica de eliminación
        return redirect()->route('admin.properties.index')->with('success', 'Propiedad eliminada.');
    }
    
    // El método 'show' se ha excluido en routes/web.php
}