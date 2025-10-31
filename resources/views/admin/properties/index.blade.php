{{-- resources/views/admin/properties/index.blade.php --}}
@extends('layouts.admin')

@section('header', 'Gestión de Propiedades')

@section('content')

    <div class="flex justify-end mb-4">
        {{-- Enlace para crear una nueva propiedad --}}
        <a href="{{ route('admin.properties.create') }}" 
           class="btn btn-primary-custom py-2 px-4 rounded-md">
            + Añadir Nueva Propiedad
        </a>
    </div>

    {{-- Aquí incluirías la tabla de listado (property-list.blade.php modificado) --}}
    @if (!empty($properties))
        {{-- ASUMIMOS que el controlador pasa la variable $properties --}}
        @include('admin.property-list', ['properties' => $properties])
    @else
        <div class="text-center py-10 bg-white rounded-lg shadow">
            <p class="text-gray-500">Aún no hay propiedades registradas en el sistema.</p>
        </div>
    @endif

@endsection