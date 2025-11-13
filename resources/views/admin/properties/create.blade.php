@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Añadir Nueva Propiedad</h2>

    <div class="bg-white p-8 rounded-xl shadow-lg">

        <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <h3 class="text-xl font-semibold border-b pb-2 mb-4 text-indigo-600">Detalles Principales</h3>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título de la Propiedad</label>
                    <input type="text" name="title" id="title" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" 
                           value="{{ old('title') }}" placeholder="Ej: Apartamento con vista al mar">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción Detallada</label>
                    <textarea name="description" id="description" rows="4" required 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" 
                              placeholder="Mencione características, comodidades y ubicación...">{{ old('description') }}</textarea>
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
                           value="{{ old('price') }}" placeholder="Ej: 350000000">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-1">Habitaciones</label>
                    <input type="number" name="bedrooms" id="bedrooms" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                           value="{{ old('bedrooms', 1) }}" min="0">
                </div>

                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-1">Baños</label>
                    <input type="number" name="bathrooms" id="bathrooms" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                           value="{{ old('bathrooms', 1) }}" min="0">
                </div>
                
            </div>

            <div class="mt-8 space-y-6">
                <h3 class="text-xl font-semibold border-b pb-2 mb-4 text-indigo-600">Ubicación y Archivos</h3>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Dirección Exacta</label>
                    <input type="text" name="address" id="address" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                           value="{{ old('address') }}" placeholder="Ej: Calle 50 # 10-25">
                </div>

                <div>
                    <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Imagen Principal</label>
                    <input type="file" name="main_image" id="main_image" accept="image/*"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
            </div>


            <div class="mt-10 flex justify-end space-x-4">
                <a href="{{ route('admin.properties.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-150">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150">
                    Guardar Propiedad
                </button>
            </div>
        </form>

    </div>
@endsection