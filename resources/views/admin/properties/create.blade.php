@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Añadir Nueva Propiedad</h2>

    <div class="bg-white p-8 rounded-xl shadow-lg">

        <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <h3 class="text-xl font-semibold border-b pb-2 mb-4 text-red-600">Detalles Principales</h3>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título de la Propiedad</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}" placeholder="Ej: Apartamento con vista al mar">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción
                        Detallada</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('description') border-red-500 @enderror"
                        placeholder="Mencione características, comodidades y ubicación...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Sección de Métricas (Habitaciones, Baños, Área) --}}
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio (COP)</label>
                    <input type="number" name="price" id="price" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('price') border-red-500 @enderror"
                        value="{{ old('price') }}" placeholder="Ej: 350000000">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-1">Habitaciones</label>
                    <input type="number" name="bedrooms" id="bedrooms" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('bedrooms') border-red-500 @enderror"
                        value="{{ old('bedrooms', 1) }}" min="0">
                    @error('bedrooms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-1">Baños</label>
                    <input type="number" name="bathrooms" id="bathrooms" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('bathrooms') border-red-500 @enderror"
                        value="{{ old('bathrooms', 1) }}" min="0">
                    @error('bathrooms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CAMPO FALTANTE: AREA (columna 'area') --}}
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Área (m²)</label>
                    <input type="number" name="area" id="area" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('area') border-red-500 @enderror"
                        value="{{ old('area') }}" placeholder="Ej: 120" min="1">
                    @error('area')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-8 space-y-6">
                <h3 class="text-xl font-semibold border-b pb-2 mb-4 text-red-600">Ubicación y Tipo</h3>

                {{-- Fila para Ciudad y Tipo --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- CAMPO FALTANTE: CIUDAD (columna 'ciudad') --}}
                    <div>
                        <label for="ciudad" class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('ciudad') border-red-500 @enderror"
                            value="{{ old('ciudad') }}" placeholder="Ej: Bogotá">
                        @error('ciudad')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CAMPO FALTANTE: TIPO (columna 'tipo' - ENUM) --}}
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Operación</label>
                        <select name="tipo" id="tipo" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('tipo') border-red-500 @enderror">
                            <option value="">Seleccione el tipo</option>

                            <option value="arriendo" {{ old('tipo') == 'arriendo' ? 'selected' : '' }}>Arriendo</option>
                        </select>
                        @error('tipo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <div>
                    {{-- CAMPO EXISTENTE: ADDRESS (corresponde a 'ubicacion' en la DB) --}}
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Dirección Exacta</label>
                    <input type="text" name="address" id="address"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('address') border-red-500 @enderror"
                        value="{{ old('address') }}" placeholder="Ej: Calle 50 # 10-25">
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="main_image" class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen Principal
                    </label>

                    <div class="input-group">
                        <input type="file" name="main_image" id="main_image"
                            class="form-control block w-full border border-gray-300 rounded-lg cursor-pointer bg-white focus:ring-red-500 focus:border-red-500">
                    </div>

                    @error('main_image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <label for="id_dueno" class="block text-sm font-medium text-gray-700 mb-1">
                        Dueño de la Propiedad
                        <label for="id_dueno" class="block text-sm font-medium text-gray-700 mb-1">Dueño de la
                            Propiedad</label>
                        <select name="id_dueno" id="id_dueno" required
                            class="form-select px-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-red-500 focus:border-red-500">
                            <option value="">Seleccione un dueño</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ old('id_dueno') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }} (ID: {{ $usuario->id }})
                                </option>
                            @endforeach
                        </select>
                </div>
            </div>





            <div class="mt-10 flex justify-end space-x-4">
                <a href="{{ route('admin.properties.index') }}"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-150">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-150">
                    Guardar Propiedad
                </button>
            </div>
        </form>

    </div>
@endsection
