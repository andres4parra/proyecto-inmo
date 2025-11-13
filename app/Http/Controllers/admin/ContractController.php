<?php

namespace App\Http\Controllers\Admin; // Namespace ajustado para el área de Administración

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
// Asume que tienes un modelo Contrato (o Contract)
use App\Models\Contrato; 
// Asume que necesitas el modelo Propiedad para crear contratos
use App\Models\Propiedad; 
// Asume que necesitas el modelo User para asignar clientes/agentes
use App\Models\User; 

class ContractController extends Controller
{
    /**
     * Muestra la lista de todos los contratos en el panel de administración.
     */
    public function index()
    {
        // Carga los contratos con sus relaciones (propiedad, cliente, agente)
        // Usamos Contrato::paginate(10) en producción para grandes conjuntos de datos
        $contracts = Contrato::with(['propiedad', 'user'])->latest()->get(); 

        // La vista debe estar en resources/views/admin/contracts/index.blade.php
        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Muestra el formulario para crear un nuevo contrato.
     */
    public function create()
    {
        // Necesitas pasar las propiedades disponibles y los usuarios (clientes/agentes)
        $properties = Propiedad::where('status', 'Disponible')->get(['id', 'title']);
        $clients = User::where('role', 'Cliente')->get(['id', 'name']);

        // La vista debe estar en resources/views/admin/contracts/create.blade.php
        return view('admin.contracts.create', compact('properties', 'clients'));
    }

    /**
     * Guarda un nuevo contrato en la base de datos.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'propiedad_id' => 'required|exists:propiedads,id',
            'client_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:Alquiler,Venta', 
            'pdf_file' => 'nullable|file|mimes:pdf|max:5000', // Máx 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el contrato sin el archivo PDF por ahora
        $contract = Contrato::create($request->except('pdf_file'));

        // Manejo del Archivo (PDF)
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('contracts', 'public');
            $contract->pdf_path = $pdfPath;
            $contract->save();
        }

        return redirect()->route('admin.contracts')->with('success', 'Contrato creado y registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un contrato específico (opcional en CRUD).
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
        $properties = Propiedad::get(['id', 'title']);
        $clients = User::where('role', 'Cliente')->get(['id', 'name']);

        // La vista debe estar en resources/views/admin/contracts/edit.blade.php
        return view('admin.contracts.edit', compact('contract', 'properties', 'clients'));
    }

    /**
     * Actualiza un contrato existente en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $contract = Contrato::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'propiedad_id' => 'required|exists:propiedads,id',
            'client_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:Alquiler,Venta',
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

        return redirect()->route('admin.contracts')->with('success', 'Contrato actualizado exitosamente.');
    }

    /**
     * Elimina un contrato de la base de datos.
     */
    public function destroy(string $id)
    {
        $contract = Contrato::findOrFail($id);
        
        // Opcional: Eliminar el archivo PDF asociado del disco
        if ($contract->pdf_path) {
            Storage::disk('public')->delete($contract->pdf_path); 
        }

        $contract->delete();

        return redirect()->route('admin.contracts')->with('success', 'Contrato eliminado exitosamente.');
    }
}