@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-xl p-8">
        
        <!-- Encabezado -->
        <div class="border-b border-gray-200 pb-5 mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
                Editar Contrato #{{ $contract->id }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Actualiza los términos y el archivo asociado del contrato.
            </p>
        </div>

        <!-- Formulario de Edición (Ruta: admin.contracts.update) -->
        <form action="{{ route('admin.contracts.update', $contract->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- O PATCH -->

            <div class="space-y-6">
                
                <!-- SELECCIÓN DE PROPIEDAD -->
                <div>
                    <label for="propiedad_id" class="block text-sm font-medium text-gray-700 required">Propiedad Asociada</label>
                    <div class="mt-1">
                        <select id="propiedad_id" name="propiedad_id" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                            <option value="">-- Seleccione una Propiedad --</option>
                            @foreach ($propiedades as $propiedad)
                                <option value="{{ $propiedad->id }}" 
                                    @selected(old('propiedad_id', $contract->propiedad_id) == $propiedad->id)>
                                    {{ $propiedad->titulo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('propiedad_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <!-- SELECCIÓN DE CLIENTE -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 required">Cliente (Usuario)</label>
                    <div class="mt-1">
                        <select id="user_id" name="user_id" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                            <option value="">-- Seleccione un Cliente --</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" 
                                    @selected(old('user_id', $contract->user_id) == $client->id)>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>


                <!-- TIPO DE CONTRATO (Alquiler / Venta) -->
                <div>
                    <label for="tipo_contrato" class="block text-sm font-medium text-gray-700 required">Tipo de Contrato</label>
                    <div class="mt-1">
                        <select id="tipo_contrato" name="tipo_contrato" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                            <option value="alquiler" @selected(old('tipo_contrato', $contract->tipo_contrato) == 'alquiler')>Alquiler</option>
                            <option value="venta" @selected(old('tipo_contrato', $contract->tipo_contrato) == 'venta')>Venta</option>
                        </select>
                    </div>
                    @error('tipo_contrato') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- DATOS DEL CLIENTE (Adicionales) -->
                <h2 class="text-xl font-semibold border-t pt-4 mt-6">Información del Cliente</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    
                    <div>
                        <label for="nombre_cliente" class="block text-sm font-medium text-gray-700 required">Nombre Completo del Cliente</label>
                        <input type="text" name="nombre_cliente" id="nombre_cliente" required 
                               value="{{ old('nombre_cliente', $contract->nombre_cliente) }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('nombre_cliente') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="cedula_cliente" class="block text-sm font-medium text-gray-700 required">Cédula o Identificación</label>
                        <input type="text" name="cedula_cliente" id="cedula_cliente" required 
                               value="{{ old('cedula_cliente', $contract->cedula_cliente) }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('cedula_cliente') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- DETALLES FINANCIEROS Y DE TIEMPO -->
                <h2 class="text-xl font-semibold border-t pt-4 mt-6">Términos del Contrato</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    
                    <!-- MONTO -->
                    <div>
                        <label for="monto_acordado" class="block text-sm font-medium text-gray-700 required">Monto Acordado ($)</label>
                        <input type="number" step="0.01" name="monto_acordado" id="monto_acordado" required 
                               value="{{ old('monto_acordado', $contract->monto_acordado) }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('monto_acordado') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- FECHA INICIO -->
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 required">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" required 
                               value="{{ old('fecha_inicio', $contract->fecha_inicio ? \Carbon\Carbon::parse($contract->fecha_inicio)->format('Y-m-d') : '') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('fecha_inicio') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- FECHA FIN (Opcional) -->
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Finalización (Alquiler)</label>
                        <input type="date" name="fecha_fin" id="fecha_fin"
                               value="{{ old('fecha_fin', $contract->fecha_fin ? \Carbon\Carbon::parse($contract->fecha_fin)->format('Y-m-d') : '') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('fecha_fin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- DETALLES (Textarea) -->
                <div>
                    <label for="detalles" class="block text-sm font-medium text-gray-700">Detalles Adicionales</label>
                    <div class="mt-1">
                        <textarea id="detalles" name="detalles" rows="3" 
                                  class="shadow-sm focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('detalles', $contract->detalles) }}</textarea>
                    </div>
                    @error('detalles') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <!-- PDF EXISTENTE Y CARGA DE NUEVO PDF -->
                <h2 class="text-xl font-semibold border-t pt-4 mt-6">Documento PDF</h2>
                <div class="space-y-4">
                    @if ($contract->pdf_path)
                        <div class="p-3 bg-gray-50 border border-dashed border-gray-300 rounded-md flex justify-between items-center">
                            <span class="text-sm text-gray-600 flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Archivo actual: <a href="{{ Storage::url($contract->pdf_path) }}" target="_blank" class="ml-1 font-medium text-red-600 hover:text-red-800">Ver PDF</a>
                            </span>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No hay un archivo PDF adjunto actualmente.</p>
                    @endif

                    <div>
                        <label for="pdf_file" class="block text-sm font-medium text-gray-700">Subir nuevo PDF (Máx 5MB)</label>
                        <input type="file" name="pdf_file" id="pdf_file" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                        @error('pdf_file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="pt-5 mt-8 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.contracts.index') }}" 
                   class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Cancelar
                </a>
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Actualizar Contrato
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


Ahora que tenemos las vistas `create.blade.php` y `edit.blade.php`, el siguiente paso crucial es asegurarnos de que la vista principal, **`index.blade.php`**, muestre la lista de contratos y los botones de acción (Crear, Editar, Eliminar).

¿Quieres que trabajemos en la vista **`index.blade.php`** ahora?