@extends('layouts.admin')

@section('title', 'Gestión de Propiedades')

@section('content')

@php
// --- SIMULACIÓN DE DATOS (Solo necesitamos los datos de propiedades aquí) ---
$properties = $properties ?? [
['id' => '1', 'title' => 'Apartamento céntrico', 'price' => 800, 'type' => 'arriendo'],
['id' => '2', 'title' => 'Casa familiar en condominio', 'price' => 320000, 'type' => 'venta'],
['id' => '3', 'title' => 'Local Comercial Esquinero', 'price' => 1500, 'type' => 'arriendo'],
['id' => '4', 'title' => 'Terreno de Playa', 'price' => 950000, 'type' => 'venta'],
];

// La variable showPropertyForm controla la visibilidad del formulario
$showPropertyForm = request()->query('new') === 'true';


@endphp

<div class="flex-1">
<main class="p-6">
<div class="flex items-center justify-between mb-6">
<h1 class="text-3xl font-bold">Gestión de Propiedades</h1>

        {{-- Botón para agregar o cancelar --}}
        <a href="{{ route('admin.properties.index', ['new' => $showPropertyForm ? 'false' : 'true']) }}" 
           class="flex items-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            {{ $showPropertyForm ? "Cancelar Formulario" : "Añadir Propiedad" }}
        </a>
    </div>

    {{-- Formulario de Nueva Propiedad (Condicional) --}}
    @if ($showPropertyForm)
        <div class="mb-6 border rounded-lg shadow-xl bg-white p-6">
            <h2 class="text-xl font-bold mb-4">Formulario de Nueva Propiedad</h2>
            @include('admin.property-form')
        </div>
    @endif

    {{-- Card de Gestión de Propiedades (Tabla y Tabs) --}}
    <div class="border rounded-lg shadow-md bg-white">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Listado de Propiedades</h2>

            {{-- Tabs --}}
            <div class="mb-4 border-b">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="{{ route('admin.properties.index', ['tab' => 'all']) }}" class="@if(request()->query('tab', 'all') === 'all') border-red-600 text-red-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Todas ({{ count($properties) }})
                    </a>
                    <a href="{{ route('admin.properties.index', ['tab' => 'arriendo']) }}" class="@if(request()->query('tab') === 'arriendo') border-red-600 text-red-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        En Arriendo ({{ collect($properties)->where('type', 'arriendo')->count() }})
                    </a>
                </nav>
            </div>

            <div>
                @if (request()->query('tab', 'all') === 'arriendo')
                    {{-- Contenido 'En Arriendo' --}}
                    @include('admin.property-list', ['properties' => collect($properties)->where('type', 'arriendo')->all()])
                @else
                    {{-- Contenido 'Todas' (Default) --}}
                    @include('admin.property-list', ['properties' => $properties])
                @endif
            </div>
            
        </div>
    </div>
    
</main>


</div>
@endsection