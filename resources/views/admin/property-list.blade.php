@extends('layouts.admin')

@section('content')
    <div class="space-y-8">
        <!-- Encabezado y Botón de Acción -->
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <h1 class="text-4xl font-extrabold text-gray-900">Gestión de Propiedades</h1>
            <a href="{{ route('admin.properties.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transition duration-300 transform hover:scale-105">
                + Crear Nueva Propiedad
            </a>
        </div>

        <!-- Mensajes de Éxito o Error (opcional) -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabla de Propiedades -->
        <div class="overflow-x-auto shadow-2xl ring-1 ring-black ring-opacity-5 rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-gray-700 sm:pl-6">
                            ID / Título
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-700">
                            Tipo
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-700">
                            Precio
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-700">
                            Estado
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    
                    {{-- Simulando la variable $properties con datos reales --}}
                    @php
                        $properties = [
                            ['id' => 101, 'title' => 'Apartamento de Lujo en el Centro', 'type' => 'Apartamento', 'price' => 500000000, 'status' => 'Disponible'],
                            ['id' => 102, 'title' => 'Casa Campestre con Piscina', 'type' => 'Casa', 'price' => 950000000, 'status' => 'Vendido'],
                            ['id' => 103, 'title' => 'Local Comercial Esquinero', 'type' => 'Local', 'price' => 120000000, 'status' => 'Alquilado'],
                        ];
                    @endphp
                    
                    @forelse ($properties as $property)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <a href="{{ route('propiedades.show', $property['id']) }}" class="hover:text-indigo-600 transition">
                                    {{ $property['title'] }}
                                </a>
                                <span class="block text-xs text-gray-500 mt-0.5">ID: {{ $property['id'] }}</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                {{ $property['type'] }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 font-semibold">
                                ${{ number_format($property['price'], 0, ',', '.') }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                @php
                                    $status_classes = [
                                        'Disponible' => 'bg-green-100 text-green-800',
                                        'Vendido' => 'bg-red-100 text-red-800',
                                        'Alquilado' => 'bg-yellow-100 text-yellow-800',
                                        'Pendiente' => 'bg-blue-100 text-blue-800',
                                    ];
                                    $current_status = $property['status'];
                                @endphp
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $status_classes[$current_status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $current_status }}
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-4">
                                
                                {{-- Enlace de Edición --}}
                                <a href="{{ route('admin.properties.edit', $property['id']) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 transition duration-150">
                                    Editar
                                </a>

                                {{-- Formulario de Eliminación (botón corregido) --}}
                                <form action="{{ route('admin.properties.destroy', $property['id']) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition duration-150" 
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar la propiedad {{ $property['title'] }}?');">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-lg text-gray-500">
                                <p class="mb-2">No hay propiedades para mostrar en esta lista.</p>
                                <a href="{{ route('admin.propiedades.create') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                    ¡Haz clic aquí para agregar la primera!
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection