@extends('layouts.admin')

@section('content')
    @php
        // En un entorno real, $property vendría del controlador via compact('property')
        $property = [
            'id' => 1,
            'title' => 'Apartamento Céntrico con Balcón',
            'description' =>
                'Luminoso apartamento en el corazón de la ciudad, recién remodelado y con excelente transporte público.',
            'price' => 250000000,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'address' => 'Carrera 15 # 40-10',
            'status' => 'Disponible',
        ];
    @endphp

    <h2 class="text-3xl font-bold mb-6 text-gray-800">Editar Propiedad: #{{ $property['id'] }} - {{ $property['title'] }}
    </h2>

    <div class="bg-white p-8 rounded-xl shadow-lg">

        <form action="{{ route('admin.properties.update', $property['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <h3 class="text-xl font-semibold border-b pb-2 mb-4 text-indigo-600">Detalles Principales</h3>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título de la Propiedad</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                        value="{{ old('title', $property['title']) }}" placeholder="Ej: Casa con piscina">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción
                        Detallada</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                        placeholder="Mencione características, comodidades y ubicación...">{{ old('description', $property['description']) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio (COP)</label>
                    <input type="number" name="price" id="price" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('price') border-red-500 @enderror"
                        value="{{ old('price', $property['price']) }}" placeholder="Ej: 350000000">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-1">Habitaciones</label>
                    <input type="number" name="bedrooms" id="bedrooms"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('bedrooms', $property['bedrooms']) }}" min="0">
                </div>
                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-1">Baños</label>
                    <input type="number" name="bathrooms" id="bathrooms"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('bathrooms', $property['bathrooms'] ?? 0) }}" min="0">
                </div>
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Área (m²)</label>
                    <input type="number" name="area" id="area"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('area', $property['area'] ?? 0) }}" min="0">
                </div>



                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="Disponible"
                            {{ old('status', $property['status']) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Alquilado"
                            {{ old('status', $property['status']) == 'Alquilado' ? 'selected' : '' }}>Alquilado</option>
                        <option value="Vendido" {{ old('status', $property['status']) == 'Vendido' ? 'selected' : '' }}>
                            Vendido</option>
                    </select>
                </div>

            </div>

            <div class="mt-8 space-y-6">
                <h3 class="text-xl font-semibold border-b pb-2 mb-4 text-indigo-600">Ubicación y Archivos</h3>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Dirección Exacta</label>
                    <input type="text" name="address" id="address"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('address', $property['address']) }}" placeholder="Ej: Calle 50 # 10-25">
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
                    </label>

                    <select name="id_dueno" id="id_dueno"
                        class="form-select px-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-red-500 focus:border-red-500">
                        <option value="">Sin dueño asignado</option>

                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('id_dueno') == $usuario->id ? 'selected' : '' }}>
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
                    class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150">
                    Guardar Cambios
                </button>
            </div>
        </form>

    </div>
@endsection
