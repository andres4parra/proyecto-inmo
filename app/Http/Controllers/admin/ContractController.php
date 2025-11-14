<?php

namespace App\Http\Controllers\Admin; // Namespace ajustado para el área de Administración

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
// Modelos
use App\Models\Contrato; 
use App\Models\Propiedad; 
use App\Models\User; // Usamos el modelo User para obtener los clientes

class ContractController extends Controller
{
    /**
     * Muestra la lista de todos los contratos en el panel de administración.
     */
    public function index()
    {
        // Carga las relaciones propiedad y user (cliente/agente)
        $contratos = Contrato::with(['propiedad', 'user'])->latest()->get(); 

        // La vista debe estar en resources/views/admin/contracts/index.blade.php
        return view('admin.contracts.index', compact('contratos')); 
    }

    /**
     * Muestra el formulario para crear un nuevo contrato.
     */
    public function create()
    {
        // Obtenemos todas las propiedades para que el usuario pueda seleccionar.
        $propiedades = Propiedad::select('id', 'titulo')->get();
        
        // CORRECCIÓN: Obtenemos TODOS los usuarios (clientes potenciales).
        // Usamos 'name as nombre' para que el campo se mapee a 'nombre' en la vista.
        $clientes = User::select('id', 'name as nombre')->get(); 
        
        return view('admin.contracts.create', compact('propiedades', 'clientes'));
    }

    /**
     * Guarda un nuevo contrato en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación ajustada a los campos del formulario
        $validator = Validator::make($request->all(), [
            'propiedad_id' => 'required|exists:propiedades,id', 
            'user_id' => 'required|exists:users,id', // ID del usuario (cliente)
            'nombre_cliente' => 'required|string|max:255', 
            'cedula_cliente' => 'required|string|max:50|unique:contratos,cedula_cliente', 
            'fecha_inicio' => 'required|date', 
            'fecha_fin' => 'nullable|date|after:fecha_inicio', 
            'monto_acordado' => 'required|numeric|min:0', 
            'tipo_contrato' => 'required|in:alquiler,venta', 
            'pdf_file' => 'nullable|file|mimes:pdf|max:5000', // Máx 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el contrato con los datos validados
        $contract = Contrato::create($request->except('pdf_file'));

        // Manejo del Archivo (PDF)
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('contracts', 'public');
            $contract->pdf_path = $pdfPath;
            $contract->save();
        }

        return redirect()->route('admin.contracts.index')->with('success', 'Contrato creado y registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un contrato específico.
     */
    public function show(string $id)
    {
        $contract = Contrato::with(['propiedad', 'user'])->findOrFail($id);
        // La vista debe estar en resources/views/admin/contracts/show.blade.php
        return view('admin.contracts.show', compact('contract'));
    }

    /**
     * Muestra el formulario para editar un contrato existente.
     */
    public function edit(string $id)
    {
        $contract = Contrato::findOrFail($id);
        $propiedades = Propiedad::get(['id', 'titulo']); 
        
        // Obtenemos todos los usuarios para la edición.
        $clients = User::select('id', 'name')->get(); 

        // La vista debe estar en resources/views/admin/contracts/edit.blade.php
        return view('admin.contracts.edit', compact('contract', 'propiedades', 'clients')); 
    }

    /**
     * Actualiza un contrato existente en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $contract = Contrato::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'propiedad_id' => 'required|exists:propiedades,id',
            'user_id' => 'required|exists:users,id',
            'nombre_cliente' => 'required|string|max:255', 
            // unique con ignore para que permita mantener la misma cédula
            'cedula_cliente' => 'required|string|max:50|unique:contratos,cedula_cliente,'.$id, 
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'monto_acordado' => 'required|numeric|min:0', 
            'tipo_contrato' => 'required|in:alquiler,venta',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5000', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar datos del contrato
        $contract->update($request->except('pdf_file'));

        // Manejo de la actualización del archivo PDF
        if ($request->hasFile('pdf_file')) {
            // 1. Eliminar el archivo PDF anterior si existe
            if ($contract->pdf_path) {
                Storage::disk('public')->delete($contract->pdf_path); 
            }
            // 2. Guardar el nuevo archivo
            $pdfPath = $request->file('pdf_file')->store('contracts', 'public');
            $contract->pdf_path = $pdfPath;
            $contract->save();
        }

        return redirect()->route('admin.contracts.index')->with('success', 'Contrato actualizado exitosamente.');
    }

    /**
     * Elimina un contrato de la base de datos.
     */
    public function destroy(string $id)
    {
        $contract = Contrato::findOrFail($id);
        
        // Eliminar el archivo PDF asociado del disco
        if ($contract->pdf_path) {
            Storage::disk('public')->delete($contract->pdf_path); 
        }

        $contract->delete();

        return redirect()->route('admin.contracts.index')->with('success', 'Contrato eliminado exitosamente.');
    }
}