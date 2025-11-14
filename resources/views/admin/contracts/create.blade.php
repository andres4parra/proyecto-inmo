@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-xl p-8 border-t-4 border-red-600">
        
        <div class="border-b border-gray-200 pb-5 mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
                Crear Nuevo Contrato
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Registra los detalles de un acuerdo de arrendamiento, asociando la propiedad y el cliente.
            </p>
        </div>

        {{-- SECCIÓN DE ERRORES DE VALIDACIÓN (CRÍTICO) --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
                <p class="font-bold">¡Por favor, corrige los siguientes errores:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mostrar error de base de datos (del controlador) --}}
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
                <p class="font-bold">Error al intentar guardar:</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- INICIO DEL FORMULARIO --}}
        {{-- Importante el enctype para subir archivos PDF --}}
        <form action="{{ route('admin.contracts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Detalles del Acuerdo</h2>

                {{-- SELECCIÓN DE PROPIEDAD --}}
                <div>
                    <label for="propiedad_id" class="block text-sm font-medium text-gray-700">Propiedad Asociada <span class="text-red-600">*</span></label>
                    <div class="mt-1">
                        <select id="propiedad_id" name="propiedad_id" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md shadow-sm @error('propiedad_id') border-red-500 @enderror">
                            <option value="">-- Seleccione una Propiedad --</option>
                            {{-- $propiedades debe ser pasado desde el controlador --}}
                            @foreach ($propiedades as $propiedad)
                                <option value="{{ $propiedad->id }}" {{ old('propiedad_id') == $propiedad->id ? 'selected' : '' }}>
                                    {{ $propiedad->titulo }} (ID: {{ $propiedad->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('propiedad_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- SELECCIÓN DE TIPO DE CONTRATO (ARRENDAMIENTO) --}}
                <div>
                    <label for="tipo_contrato" class="block text-sm font-medium text-gray-700">Tipo de Contrato <span class="text-red-600">*</span></label>
                    <div class="mt-1">
                        {{-- $tipos_contrato debe ser pasado desde el controlador con los nuevos ENUM --}}
                        <select id="tipo_contrato" name="tipo_contrato" required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md shadow-sm @error('tipo_contrato') border-red-500 @enderror">
                            <option value="">-- Seleccionar Tipo de Arrendamiento --</option>
                            @foreach ($tipos_contrato as $value => $label)
                                <option value="{{ $value }}" {{ old('tipo_contrato') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_contrato') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>


                <h2 class="text-xl font-semibold border-t pt-4 mt-6 text-gray-800">Información del Cliente</h2>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    {{-- SELECCIÓN DE CLIENTE (USER ID) --}}
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Seleccionar Cliente (Usuario) <span class="text-red-600">*</span></label>
                        <div class="mt-1">
                            <select id="user_id" name="user_id" required 
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md shadow-sm @error('user_id') border-red-500 @enderror">
                                <option value="">-- Seleccionar Usuario Existente --</option>
                                {{-- $clientes (usuarios) debe ser pasado desde el controlador --}}
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('user_id') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->name }} (ID: {{ $cliente->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- NOMBRE COMPLETO DEL CLIENTE (Aunque ya se tiene el ID, se mantiene para registro histórico) --}}
                    <div>
                        <label for="nombre_cliente" class="block text-sm font-medium text-gray-700">Nombre Completo del Cliente <span class="text-red-600">*</span></label>
                        <input type="text" name="nombre_cliente" id="nombre_cliente" required 
                                value="{{ old('nombre_cliente') }}"
                                class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('nombre_cliente') border-red-500 @enderror">
                        @error('nombre_cliente') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- CÉDULA DEL CLIENTE --}}
                <div>
                    <label for="cedula_cliente" class="block text-sm font-medium text-gray-700">Cédula o Identificación <span class="text-red-600">*</span></label>
                    <input type="text" name="cedula_cliente" id="cedula_cliente" required 
                            value="{{ old('cedula_cliente') }}"
                            class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('cedula_cliente') border-red-500 @enderror">
                    @error('cedula_cliente') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <h2 class="text-xl font-semibold border-t pt-4 mt-6 text-gray-800">Monto y Vigencia</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    
                    {{-- MONTO ACORDADO --}}
                    <div>
                        <label for="monto_acordado" class="block text-sm font-medium text-gray-700">Monto Acordado ($) <span class="text-red-600">*</span></label>
                        <input type="number" step="0.01" name="monto_acordado" id="monto_acordado" required 
                                value="{{ old('monto_acordado') }}"
                                class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('monto_acordado') border-red-500 @enderror">
                        @error('monto_acordado') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- FECHA DE INICIO --}}
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio <span class="text-red-600">*</span></label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" required 
                                value="{{ old('fecha_inicio') }}"
                                class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('fecha_inicio') border-red-500 @enderror">
                        @error('fecha_inicio') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- FECHA DE FINALIZACIÓN --}}
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Finalización (Opcional)</label>
                        <input type="date" name="fecha_fin" id="fecha_fin"
                                value="{{ old('fecha_fin') }}"
                                class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('fecha_fin') border-red-500 @enderror">
                        @error('fecha_fin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- DETALLES ADICIONALES --}}
                <div>
                    <label for="detalles" class="block text-sm font-medium text-gray-700">Detalles Adicionales</label>
                    <div class="mt-1">
                        <textarea id="detalles" name="detalles" rows="3" 
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md @error('detalles') border-red-500 @enderror">{{ old('detalles') }}</textarea>
                    </div>
                    @error('detalles') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <h2 class="text-xl font-semibold border-t pt-4 mt-6 text-gray-800">Documento Adjunto</h2>

                {{-- SUBIDA DE DOCUMENTO PDF --}}
                <div>
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700">Subir Contrato PDF (Máx. 5MB, Opcional)</label>
                    <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    @error('pdf_file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- BOTONES DE ACCIÓN --}}
            <div class="pt-5 mt-8 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.contracts.index') }}" 
                   class="inline-flex items-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                    Cancelar
                </a>
                <button type="submit" 
                        class="inline-flex items-center py-2 px-4 border border-transparent shadow-lg text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
                        <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v10a3 3 0 01-3 3H5a3 3 0 01-3-3V6zm4 2a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm0 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm0 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    Guardar Contrato
                </button>
            </div>
        </form>
    </div>
</div>
@endsection