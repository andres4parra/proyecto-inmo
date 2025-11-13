@extends('layouts.admin')

@section('title', 'Panel de Administración')

@section('content')

@php
// --- SIMULACIÓN DE DATOS (En la vida real, estos vienen del controlador) ---
$properties = $properties ?? [
['id' => '1', 'title' => 'Apartamento céntrico', 'price' => 800, 'type' => 'arriendo'],
['id' => '2', 'title' => 'Casa familiar en condominio', 'price' => 320000, 'type' => 'venta'], // Cambié a 'venta' para variedad
];

$messages = $messages ?? [
    ['id' => '1', 'senderName' => 'Juan Pérez', 'senderEmail' => 'juan.perez@email.com', 'subject' => 'Consulta sobre arriendo', 'status' => 'nuevo', 'createdAt' => now()->subHours(2)->toDateTimeString(), 'propertyTitle' => 'Apartamento céntrico', 'message' => 'Me gustaría saber si el arriendo incluye los gastos comunes y si hay disponibilidad inmediata.'],
    ['id' => '3', 'senderName' => 'Carlos R.', 'senderEmail' => 'carlos@email.com', 'subject' => 'Proceso de compra', 'status' => 'nuevo', 'createdAt' => now()->subHours(3)->toDateTimeString(), 'propertyTitle' => null, 'message' => 'Necesito iniciar el proceso de compra. ¿A quién debo contactar?'],
    ['id' => '2', 'senderName' => 'María G.', 'senderEmail' => 'maria@email.com', 'subject' => 'Visita a la propiedad', 'status' => 'leido', 'createdAt' => now()->subDays(1)->toDateTimeString(), 'propertyTitle' => 'Casa familiar en condominio', 'message' => 'Confirmo la visita para mañana por la tarde, por favor.'],
    ['id' => '4', 'senderName' => 'Ana M.', 'senderEmail' => 'ana.m@email.com', 'subject' => 'Garantías solicitadas', 'status' => 'respondido', 'createdAt' => now()->subDays(2)->toDateTimeString(), 'propertyTitle' => null, 'message' => 'Ya envié todos los documentos de garantía. Gracias.'],
];

// Esta variable se usa para el botón "Nueva Propiedad" que ya no se usará aquí
$showPropertyForm = request()->query('new') === 'true';

// Se asume que todas las funciones helper están definidas
$newMessagesCount = collect($messages)->where('status', 'nuevo')->count();

$getStatusColor = fn($status) => match($status) {
    'nuevo' => 'bg-red-600 text-white',
    'leido' => 'bg-gray-200 text-gray-800',
    'respondido' => 'border border-gray-300 text-gray-700 bg-white',
    default => 'bg-gray-200 text-gray-800',
};

$getStatusLabel = fn($status) => match($status) {
    'nuevo' => 'Nuevo',
    'leido' => 'Leído',
    'respondido' => 'Respondido',
    default => ucfirst($status),
};

$formatDate = function ($dateString) {
    $date = \Carbon\Carbon::parse($dateString);
    return $date->diffForHumans(); // Usamos Carbon para mejor manejo de tiempo
};


@endphp

<div class="flex min-h-screen">



{{-- Main Content --}}
<div class="flex-1">
    <header class="md:hidden p-4 border-b flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="RV Inmobiliaria" class="h-10 w-10" />
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="flex items-center justify-center w-10 h-10 border rounded-lg hover:bg-gray-100">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-13v1"></path></svg>
        </a>
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </header>

    <main class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Panel de Administración</h1>
            
            {{-- Botón para ir a Agregar Propiedad --}}
            <a href="{{ route('admin.properties.index', ['new' => 'true']) }}" class="flex items-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Añadir Propiedad
            </a>
        </div>

        <div class="grid gap-6 grid-cols-1 xl:grid-cols-2">
            {{-- Card de Resumen (Se mantiene) --}}
            <div class="border rounded-lg shadow-md bg-white xl:col-span-2">
                <div class="p-6">
                    <h2 class="text-xl font-bold">Resumen</h2>
                    <p class="text-gray-500 mb-6">Visión general de las propiedades y actividad reciente</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        {{-- ... Métricas iguales ... --}}
                        <div class="bg-gray-100 p-4 rounded-lg flex items-center gap-2">
                            <div class="bg-red-100 p-2 rounded-full">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Total Propiedades</p>
                                <p class="text-2xl font-bold">{{ count($properties) }}</p>
                            </div>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex items-center gap-2">
                            <div class="bg-red-100 p-2 rounded-full">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">En Arriendo</p>
                                <p class="text-2xl font-bold">{{ collect($properties)->where('type', 'arriendo')->count() }}</p>
                            </div>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex items-center gap-2">
                            <div class="bg-red-100 p-2 rounded-full">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Contratos Activos</p>
                                <p class="text-2xl font-bold">12</p>
                            </div>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg flex items-center gap-2">
                            <div class="bg-orange-100 p-2 rounded-full">
                                <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 21L15 15M17 12a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Mensajes Nuevos</p>
                                <p class="text-2xl font-bold">{{ $newMessagesCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card de Mensajes Recientes (Se mantiene) --}}
            <div class="border rounded-lg shadow-md bg-white">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-bold flex items-center gap-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 21L15 15M17 12a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                Mensajes Recientes
                            </h2>
                            <p class="text-gray-500">Los 3 mensajes más recientes</p>
                        </div>
                        <a href="{{ route('admin.messages') }}" class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-1 px-3 rounded text-sm">
                            Ver todos
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse (collect($messages)->sortByDesc('createdAt')->take(3) as $message)
                            <div class="p-4 border rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2-3H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $message['senderName'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $message['senderEmail'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $getStatusColor($message['status']) }}">
                                            {{ $getStatusLabel($message['status']) }}
                                        </span>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $formatDate($message['createdAt']) }}
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font-medium mb-1 line-clamp-1">{{ $message['subject'] }}</h3>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-2">{{ $message['message'] ?? 'Sin contenido' }}</p>
                                @if ($message['propertyTitle'])
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14"></path></svg>
                                        Propiedad: {{ $message['propertyTitle'] }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500 border rounded-lg">No hay mensajes recientes.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Card de Propiedades en Resumen (Nuevo componente) --}}
            <div class="border rounded-lg shadow-md bg-white">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-bold flex items-center gap-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14"></path></svg>
                                Propiedades Listadas
                            </h2>
                            <p class="text-gray-500">Vista rápida de tus inmuebles</p>
                        </div>
                        <a href="{{ route('admin.properties.index') }}" class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-1 px-3 rounded text-sm">
                            Ir a Gestión
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse (collect($properties)->take(3) as $property)
                            <div class="border-b last:border-b-0 py-2">
                                <div class="font-medium text-gray-800">{{ $property['title'] }}</div>
                                <div class="text-sm text-gray-500 flex justify-between">
                                    <span>ID: {{ $property['id'] }}</span>
                                    <span class="font-semibold text-red-600">{{ ucfirst($property['type']) }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 p-4">Aún no hay propiedades agregadas.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>


</div>
@endsection