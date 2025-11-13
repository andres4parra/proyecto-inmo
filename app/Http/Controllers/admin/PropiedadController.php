<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Asegúrate de que este modelo exista y esté importado
use App\Models\Propiedad; 

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
        return view('admin.properties.create');
    }

    /**
     * Guarda una nueva propiedad en la base de datos.
     * Implementa validación básica.
     */
    public function store(Request $request) 
    {
        // 1. Reglas de Validación
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'address' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // 2. Crear y Guardar la Propiedad
        $property = Propiedad::create($request->except('main_image'));
        
        // 3. Manejo de Archivo (Imagen)
        if ($request->hasFile('main_image')) {
            $imagePath = $request->file('main_image')->store('properties', 'public');
            $property->main_image_path = $imagePath;
            $property->save();
        }

        return redirect()->route('admin.properties.index')
                         ->with('success', 'Propiedad "' . $property->title . '" creada exitosamente.');
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

        return view('admin.properties.edit', compact('property'));
    }

    /**
     * Actualiza una propiedad existente en la base de datos.
     */
    public function update(Request $request, $id) 
    {
        // Buscar la propiedad a actualizar
        try {
            $property = Propiedad::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.properties.index')
                             ->with('error', 'Propiedad no encontrada para actualizar.');
        }

        // 1. Reglas de Validación (similar al store, pero el archivo es opcional)
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opcional en update
            // ... otras reglas
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // 2. Actualizar la Propiedad
        $property->update($request->except('main_image', '_token', '_method')); // Excluir campos de control
        
        // 3. Manejo de Archivo (Imagen): Sobreescribir si se subió una nueva
        if ($request->hasFile('main_image')) {
            // Opcional: Eliminar la imagen antigua del disco
            // Storage::disk('public')->delete($property->main_image_path); 

            $imagePath = $request->file('main_image')->store('properties', 'public');
            $property->main_image_path = $imagePath;
            $property->save();
        }
        
        return redirect()->route('admin.properties.index')
                         ->with('success', 'Propiedad "' . $property->title . '" actualizada exitosamente.');
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