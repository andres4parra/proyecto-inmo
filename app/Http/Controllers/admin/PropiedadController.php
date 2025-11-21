<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Asegúrate de que este modelo exista y esté importado
use App\Models\Propiedad;
use App\Models\User;

class PropiedadController extends Controller
{
    // Muestra la lista de propiedades de administración
    public function index()
    {
        // En un entorno real, usarías el modelo para obtener los datos
        $properties = Propiedad::orderBy('created_at', 'desc')->get();

        return view('admin.properties.index', compact('properties'));
    }

    // Muestra el formulario para crear una nueva propiedad
    public function create()
    {
        $usuarios = User::all();
        return view('admin.properties.create', compact('usuarios'));
    }

    /**
     * Guarda una nueva propiedad en la base de datos.
     * Implementa validación básica.
     */
    public function store(Request $request)
    {
        // 1. Reglas de Validación: Usamos los nombres del formulario
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'address' => 'nullable|string|max:255',
            // El formulario no tenía 'ciudad', 'tipo', 'area'. Debes validar si son obligatorios en tu DB.
            // Asumiendo que son obligatorios (No en la columna Nulo de tu imagen)
            'ciudad' => 'required|string|max:255',
            'tipo' => 'required|in:venta,arriendo', // Basado en el tipo ENUM de tu DB
            'area' => 'required|integer|min:1', // Basado en tu DB (int(11) NO NULL)
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_dueno' => 'required|exists:usuarios,id',


        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Manejo de Archivo (Guardar la imagen en el servidor)
        if ($request->hasFile('main_image')) {
            // Guarda el archivo en storage/app/public/properties
            $imagePath = $request->file('main_image')->store('properties', 'public');
            // Aquí puedes hacer algo con $imagePath si fuera necesario, pero como
            // no hay columna en la DB, simplemente lo guardamos en el servidor.
        }

        // 3. Crear y Guardar la Propiedad: Mapeando los nombres
        // Usamos el método create y mapeamos manualmente para evitar un error 'Unknown column'
        $property = Propiedad::create([
            'titulo' => $request->title, // Mapeo: title (form) -> titulo (DB)
            'descripcion' => $request->description, // Mapeo: description (form) -> descripcion (DB)
            'precio' => $request->price,
            'ciudad' => $request->ciudad, // Campo que debes asegurar que envías desde el formulario
            'ubicacion' => $request->address, // Mapeo: address (form) -> ubicacion (DB)
            'tipo' => $request->tipo, // Campo que debes asegurar que envías desde el formulario
            'habitaciones' => $request->bedrooms, // Mapeo: bedrooms (form) -> habitaciones (DB)
            'banos' => $request->bathrooms, // Mapeo: bathrooms (form) -> banos (DB)
            'area' => $request->area, // Campo que debes asegurar que envías desde el formulario
            'id_dueno' => $request->id_dueno, // La imagen NO se guarda en la DB
        ]);

        return redirect()->route('admin.properties.index')->with('success', 'Propiedad creada exitosamente.');
    }

    // Muestra el formulario para editar una propiedad
    public function edit($id)
    {
        // En un entorno real, buscarías la propiedad por ID
        try {
            $property = Propiedad::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.properties.index')
                ->with('error', 'Propiedad no encontrada.');
        }

        $property = Propiedad::findOrFail($id);
        $usuarios = User::all();
        return view('admin.properties.edit', compact('property', 'usuarios'));
    }

    /**
     * Actualiza una propiedad existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // 1. Validación
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'status' => 'required|string|in:Disponible,Alquilado,Vendido',
            'id_dueno' => 'nullable|exists:usuarios,id',
            'main_image' => 'nullable|image|max:2048',
        ]);

        // 2. Buscar la propiedad
        $property = Propiedad::findOrFail($id);

        // 3. Manejo de imagen (si se sube)
        if ($request->hasFile('main_image')) {
            $imagePath = $request->file('main_image')->store('propiedades', 'public');
            $property->main_image = $imagePath;
        }

        // 4. Actualizar campos
        $property->update([
            'titulo' => $request->title,
            'descripcion' => $request->description,
            'precio' => $request->price,
            'habitaciones' => $request->bedrooms,
            'banos' => $request->bathrooms,
            'area' => $request->area,
            'ubicacion' => $request->address,
            'status' => $request->status,
            'id_dueno' => $request->id_dueno,
        ]);

        // 5. Redireccionar con mensaje
        return redirect()->route('admin.properties.index')
            ->with('success', 'Propiedad actualizada correctamente.');
    }


    /**
     * Elimina una propiedad de la base de datos.
     */
    public function destroy($id)
    {
        // Buscar y eliminar la propiedad
        try {
            $property = Propiedad::findOrFail($id);
            $property->delete();
            // Opcional: Eliminar la imagen del disco
            // Storage::disk('public')->delete($property->main_image_path);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.properties.index')
                ->with('error', 'Propiedad no encontrada para eliminar.');
        }

        return redirect()->route('admin.properties.index')
            ->with('success', 'Propiedad eliminada exitosamente.');
    }


    // El método 'show' se ha excluido en routes/web.php
}
