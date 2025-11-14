@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-xl p-8">
        
        <div class="border-b border-gray-200 pb-5 mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
                Crear Nuevo Contrato
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Registra los detalles del acuerdo de alquiler o venta.
            </p>
        </div>

        <form action="{{ route('admin.contracts.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                
                <div>
                    <label for="propiedad_id" class="block text-sm font-medium text-gray-700 required">Propiedad Asociada</label>
                    <div class="mt-1">
                        <select id="propiedad_id" name="propiedad_id" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                            <option value="">-- Seleccione una Propiedad --</option>
                            
                            {{-- 
                                NOTA: Necesitas pasar la variable $propiedades (o $properties) desde el controlador 'create' 
                                @foreach ($propiedades as $propiedad)
                                    <option value="{{ $propiedad->id }}">{{ $propiedad->titulo }} ({{ $propiedad->tipo }})</option>
                                @endforeach
                            --}}
                            <option value="1">Casa Grande en el Centro</option>
                            <option value="2">Apartamento con Vista al Mar</option>
                            
                        </select>
                    </div>
                    @error('propiedad_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tipo_contrato" class="block text-sm font-medium text-gray-700 required">Tipo de Contrato</label>
                    <div class="mt-1">
                        <select id="tipo_contrato" name="tipo_contrato" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                            <option value="">-- Seleccionar --</option>
                            <option value="alquiler">Alquiler</option>
                            <option value="venta">Venta</option>
                        </select>
                    </div>
                    @error('tipo_contrato') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <h2 class="text-xl font-semibold border-t pt-4 mt-6">Información del Cliente</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    
                    <div>
                        <label for="nombre_cliente" class="block text-sm font-medium text-gray-700 required">Nombre Completo del Cliente</label>
                        <input type="text" name="nombre_cliente" id="nombre_cliente" required 
                               value="{{ old('nombre_cliente') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('nombre_cliente') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="cedula_cliente" class="block text-sm font-medium text-gray-700 required">Cédula o Identificación</label>
                        <input type="text" name="cedula_cliente" id="cedula_cliente" required 
                               value="{{ old('cedula_cliente') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('cedula_cliente') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <h2 class="text-xl font-semibold border-t pt-4 mt-6">Términos del Contrato</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    
                    <div>
                        <label for="monto_acordado" class="block text-sm font-medium text-gray-700 required">Monto Acordado ($)</label>
                        <input type="number" step="0.01" name="monto_acordado" id="monto_acordado" required 
                               value="{{ old('monto_acordado') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('monto_acordado') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 required">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" required 
                               value="{{ old('fecha_inicio') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('fecha_inicio') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Finalización (Alquiler)</label>
                        <input type="date" name="fecha_fin" id="fecha_fin"
                               value="{{ old('fecha_fin') }}"
                               class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('fecha_fin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="detalles" class="block text-sm font-medium text-gray-700">Detalles Adicionales</label>
                    <div class="mt-1">
                        <textarea id="detalles" name="detalles" rows="3" 
                                  class="shadow-sm focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('detalles') }}</textarea>
                    </div>
                    @error('detalles') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-5 mt-8 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.contracts.index') }}" 
                   class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Cancelar
                </a>
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Guardar Contrato
                </button>
            </div>
        </form>
    </div>
</div>
@endsection