@extends('layouts.admin') 

@section('title', 'Panel de Administración')

@section('content')

@php
    // --- SIMULACIÓN DE DATOS (En la vida real, estos vienen del controlador) ---
    // ... (El bloque de datos PHP/Blade y funciones se mantiene igual)
    $properties = $properties ?? [
        ['id' => '1', 'title' => 'Apartamento céntrico', 'price' => 800, 'type' => 'arriendo'],
        ['id' => '2', 'title' => 'Casa familiar en condominio', 'price' => 320000, 'type' => 'arriendo'],
    ];

    $messages = $messages ?? [
        ['id' => '1', 'senderName' => 'Juan Pérez', 'senderEmail' => 'juan.perez@email.com', 'subject' => 'Consulta...', 'status' => 'nuevo', 'createdAt' => now()->subHours(2)->toDateTimeString(), 'propertyTitle' => 'Apartamento céntrico'],
        ['id' => '3', 'senderName' => 'Carlos R.', 'senderEmail' => 'carlos@email.com', 'subject' => 'Proceso...', 'status' => 'nuevo', 'createdAt' => now()->subHours(3)->toDateTimeString(), 'propertyTitle' => null],
        ['id' => '2', 'senderName' => 'María G.', 'senderEmail' => 'maria@email.com', 'subject' => 'Visita...', 'status' => 'leido', 'createdAt' => now()->subDays(1)->toDateTimeString(), 'propertyTitle' => 'Casa familiar en condominio'],
        ['id' => '4', 'senderName' => 'Ana M.', 'senderEmail' => 'ana.m@email.com', 'subject' => 'Garantías', 'status' => 'respondido', 'createdAt' => now()->subDays(2)->toDateTimeString(), 'propertyTitle' => null],
    ];
    
    $showPropertyForm = request()->query('new') === 'true';

    // Se asume que todas las funciones helper (getStatusColor, formatDate, etc.) están definidas o en un helper.
    $newMessagesCount = collect($messages)->where('status', 'nuevo')->count();

    // Se recomienda crear helpers para estas funciones o usar el paquete Laravel Collective/Html para las clases de badge
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
    
    {{-- Sidebar (Barra Lateral) --}}
    <div class="w-64 border-r bg-gray-50 hidden md:block">
        <div class="flex flex-col h-full">
            <div class="p-4 border-b">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="RV Inmobiliaria" class="h-12 w-12" />
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                
                {{-- ! EL CAMBIO CLAVE: Usa solo route('dashboard') ! --}}
                <a href="{{ route('dashboard') }}" class="flex items-center w-full justify-start p-2 rounded-lg font-semibold bg-gray-200 text-red-600">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                {{-- Los demás siguen usando el prefijo admin. --}}
                <a href="{{ route('admin.properties.index') }}" class="flex items-center w-full justify-start p-2 rounded-lg text-gray-700 hover:bg-gray-200">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14"></path></svg>
                    Propiedades
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center w-full justify-start p-2 rounded-lg text-gray-700 hover:bg-gray-200">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-9m5-5v3a2 2 0 01-2 2H8a2 2 0 01-2-2v-3m11 0a4 4 0 10-8 0m8 0h-8"></path></svg>
                    Usuarios
                </a>
                <a href="{{ route('admin.contracts') }}" class="flex items-center w-full justify-start p-2 rounded-lg text-gray-700 hover:bg-gray-200">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Contratos
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center w-full justify-start p-2 rounded-lg text-gray-700 hover:bg-gray-200">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 21L15 15M17 12a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                    Mensajes
                    @if ($newMessagesCount > 0)
                        <span class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-600 text-white">
                            {{ $newMessagesCount }}
                        </span>
                    @endif
                </a>
            </nav>
            <div class="p-4 border-t mt-auto">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="h-4 w-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@ejemplo.com' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full justify-center gap-2 border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-1.5 px-3 rounded text-sm">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-13v1"></path></svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>

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
                
                {{-- ! EL CAMBIO CLAVE: Usamos route('dashboard') con el parámetro 'new' ! --}}
                <a href="{{ route('dashboard', ['new' => $showPropertyForm ? 'false' : 'true']) }}" class="flex items-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    {{ $showPropertyForm ? "Cancelar" : "Nueva Propiedad" }}
                </a>
            </div>

            {{-- Formulario de Nueva Propiedad (Condicional) --}}
            @if ($showPropertyForm)
                <div class="mb-6 border rounded-lg shadow-lg bg-white">
                    <div class="p-6">
                        <h2 class="text-xl font-bold">Agregar Nueva Propiedad</h2>
                        <p class="text-gray-500 mb-4">Complete el formulario para agregar una nueva propiedad al sistema</p>
                        @include('admin.property-form')
                    </div>
                </div>
            @endif

            <div class="grid gap-6">
                {{-- Card de Resumen --}}
                <div class="border rounded-lg shadow-md bg-white">
                    <div class="p-6">
                        <h2 class="text-xl font-bold">Resumen</h2>
                        <p class="text-gray-500 mb-6">Visión general de las propiedades y actividad reciente</p>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            {{-- ... Métricas iguales ... --}}
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="bg-red-100 p-2 rounded-full">
                                        <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Total Propiedades</p>
                                        <p class="text-2xl font-bold">{{ count($properties) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="bg-red-100 p-2 rounded-full">
                                        <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">En Arriendo</p>
                                        <p class="text-2xl font-bold">{{ collect($properties)->where('type', 'arriendo')->count() }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <div class="bg-red-100 p-2 rounded-full">
                                        <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Contratos Activos</p>
                                        <p class="text-2xl font-bold">12</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center gap-2">
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
                </div>

                {{-- Card de Mensajes Recientes --}}
                <div class="border rounded-lg shadow-md bg-white">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold flex items-center gap-2">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 21L15 15M17 12a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    Mensajes Recientes
                                </h2>
                                <p class="text-gray-500">Consultas y mensajes de usuarios</p>
                            </div>
                            <a href="{{ route('admin.messages') }}" class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-1 px-3 rounded text-sm">
                                Ver todos
                            </a>
                        </div>
                        <div class="space-y-4">
                            @foreach (collect($messages)->sortByDesc('createdAt')->take(3) as $message)
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
                                    <h3 class="font-medium mb-1">{{ $message['subject'] }}</h3>
                                    <p class="text-sm text-gray-500 line-clamp-2 mb-2">{{ $message['message'] }}</p>
                                    @if ($message['propertyTitle'])
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14"></path></svg>
                                            Propiedad: {{ $message['propertyTitle'] }}
                                        </div>
                                    @endif
                                    <div class="flex gap-2 mt-3">
                                        @if ($message['status'] === 'nuevo')
                                            <a href="{{ route('admin.messages.markRead', $message['id']) }}" class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-1 px-3 rounded text-sm">
                                                Marcar como leído
                                            </a>
                                        @endif
                                        @if ($message['status'] !== 'respondido')
                                            <a href="{{ route('admin.messages.markResponded', $message['id']) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                Marcar como respondido
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.messages.show', $message['id']) }}" class="text-gray-700 hover:bg-gray-100 py-1 px-3 rounded text-sm">
                                            Ver detalles
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Card de Gestión de Propiedades --}}
                <div class="border rounded-lg shadow-md bg-white">
                    <div class="p-6">
                        <h2 class="text-xl font-bold">Gestión de Propiedades</h2>
                        <p class="text-gray-500 mb-6">Administre todas las propiedades disponibles en el sistema</p>

                        {{-- Tabs --}}
                        <div class="mb-4 border-b">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                {{-- ! USAMOS route('dashboard') para la pestaña 'all' ! --}}
                                <a href="{{ route('dashboard', ['tab' => 'all']) }}" class="@if(request()->query('tab', 'all') === 'all') border-red-600 text-red-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Todas
                                </a>
                                {{-- ! USAMOS route('dashboard') con el parámetro 'tab' para 'arriendo' ! --}}
                                <a href="{{ route('dashboard', ['tab' => 'arriendo']) }}" class="@if(request()->query('tab') === 'arriendo') border-red-600 text-red-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    En Arriendo
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
            </div>
        </main>
    </div>
</div>
@endsection