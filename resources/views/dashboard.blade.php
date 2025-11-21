@extends('layouts.admin')

@section('title', 'Panel de Administración')

@section('content')

<div class="flex min-h-screen bg-gray-100">

    {{-- Main Content --}}
    <div class="flex-1">
        <header class="md:hidden p-4 border-b flex items-center justify-between bg-white shadow">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="RV Inmobiliaria" class="h-10 w-10" />
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                class="flex items-center justify-center w-10 h-10 border rounded-lg hover:bg-gray-100">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-13v1"></path>
                </svg>
            </a>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
            </form>
        </header>

        <main class="p-6">
            {{-- Título --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-red-600">Panel de Administración</h1>
            </div>

            {{-- Grid Resumen --}}
            <div class="grid gap-6 grid-cols-1 xl:grid-cols-2 mb-6">

                {{-- Resumen --}}
                <div class="border rounded-lg shadow-md bg-gradient-to-r from-red-50 to-white p-6 xl:col-span-2">
                    <h2 class="text-xl font-bold text-red-600 mb-2">Resumen</h2>
                    <p class="text-gray-600 mb-4">Visión general de las propiedades y actividad reciente</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-red-100 shadow rounded-lg text-center hover:bg-red-200 transition">
                            <p class="text-2xl font-bold text-red-700">{{ $totalProperties }}</p>
                            <p class="text-red-600">Propiedades Registradas</p>
                        </div>
                        <div class="p-4 bg-yellow-100 shadow rounded-lg text-center hover:bg-yellow-200 transition">
                            <p class="text-2xl font-bold text-yellow-700">{{ $totalMessages }}</p>
                            <p class="text-yellow-600">Mensajes Recibidos</p>
                        </div>
                        <div class="p-4 bg-green-100 shadow rounded-lg text-center hover:bg-green-200 transition">
                            <p class="text-2xl font-bold text-green-700">{{ $totalContracts }}</p>
                            <p class="text-green-600">Contratos Generados</p>
                        </div>
                    </div>
                </div>

                {{-- Mensajes Recientes --}}
                <div class="border rounded-lg shadow-md bg-gradient-to-b from-yellow-50 to-white p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold flex items-center gap-2 text-yellow-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 21L15 15M17 12a5 5 0 11-10 0 5 5 0 0110 0z"></path>
                            </svg>
                            Mensajes Recientes
                        </h2>
                        <a href="{{ route('admin.messages.index') }}"
                            class="border border-yellow-300 hover:bg-yellow-100 text-yellow-700 font-semibold py-1 px-3 rounded text-sm">
                            Ver todos
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse (collect($messages)->sortByDesc('createdAt')->take(3) as $message)
                            <div class="p-4 border-l-4 border-yellow-400 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-semibold text-yellow-800">{{ $message['senderName'] }}</p>
                                        <p class="text-sm text-yellow-600">{{ $message['senderEmail'] }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium
                                        @if($message['status'] === 'nuevo') bg-red-600 text-white
                                        @elseif($message['status'] === 'leido') bg-gray-200 text-gray-800
                                        @else bg-green-200 text-green-800 @endif">
                                        {{ ucfirst($message['status']) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-800 mb-1 font-medium">{{ $message['subject'] }}</p>
                                <p class="text-sm text-gray-600 mb-1 line-clamp-2">{{ $message['message'] ?? 'Sin contenido' }}</p>
                                @if ($message['propertyTitle'])
                                    <p class="text-xs text-gray-500">Propiedad: {{ $message['propertyTitle'] }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500 text-center">No hay mensajes recientes.</p>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- Propiedades --}}
            <h2 class="text-lg font-semibold mb-3 text-red-600">Propiedades</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse ($properties as $property)
                    <div class="bg-gradient-to-b from-red-50 to-white border-l-4 border-red-500 rounded-lg shadow p-4 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-xl font-bold text-red-700">{{ $property->titulo }}</p>
                                <p class="text-sm text-gray-500">{{ $property->ciudad }} — {{ $property->ubicacion }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if ($property->estado === 'Disponible') bg-green-600 text-white
                                @elseif($property->estado === 'Arrendada') bg-blue-600 text-white
                                @else bg-gray-600 text-white @endif">
                                {{ $property->estado }}
                            </span>
                        </div>
                        <p class="text-gray-800 mb-2 font-semibold">💲 {{ number_format($property->precio, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mb-2">
                            Tipo: <strong>{{ ucfirst($property->tipo) }}</strong><br>
                            Propietario: <strong>{{ $property->dueno->name ?? 'N/A' }}</strong>
                        </p>
                        <a href="{{ route('propiedades.show', $property->id) }}"
                            class="inline-block mt-2 text-red-600 hover:underline text-sm font-semibold">Ver detalle →</a>
                    </div>
                @empty
                    <p class="text-gray-500">No hay propiedades registradas.</p>
                @endforelse
            </div>

        </main>
    </div>

</div>
@endsection
