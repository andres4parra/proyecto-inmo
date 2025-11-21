@extends('layouts.admin')

@section('title', 'Bandeja de Mensajes')

@section('content')

<div class="container mx-auto px-4 py-6">
<div class="max-w-7xl mx-auto">

    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b-4 border-red-500 pb-2">
        Gestión de Mensajes de Contacto
    </h1>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4" role="alert">
            <p class="font-bold">Éxito</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if ($messages->isEmpty())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <p class="font-semibold text-lg">¡No hay mensajes nuevos!</p>
            <p>Tu bandeja de entrada de contacto está completamente vacía y resuelta.</p>
        </div>
    @else
        <div class="bg-white shadow-2xl rounded-xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Contacto
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Asunto / Mensaje
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="relative px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($messages as $message)
                        <tr class="{{ $message->is_resolved ? 'bg-gray-50 text-gray-500 hover:bg-gray-100' : 'hover:bg-yellow-50 font-semibold' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                <div class="text-sm text-gray-500">{{ $message->phone ?? 'Sin Teléfono' }}</div>
                            </td>
                            <td class="px-6 py-4 max-w-lg">
                                <div class="text-sm font-semibold text-gray-700">{{ $message->subject ?? 'Sin asunto' }}</div>
                                <div class="text-xs text-gray-500 overflow-hidden line-clamp-2 mt-1">
                                    {{ Str::limit($message->message, 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($message->is_resolved)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">
                                        Resuelto
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 animate-pulse border border-yellow-400">
                                        Pendiente
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                {{-- Botón para cambiar estado --}}
                                <form action="{{ route('admin.messages.resolve', $message->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH') 
                                    <button type="submit" 
                                            title="{{ $message->is_resolved ? 'Marcar como Pendiente' : 'Marcar como Resuelto' }}"
                                            class="text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105
                                                {{ $message->is_resolved ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-red-500 hover:bg-red-600' }}">
                                        {{ $message->is_resolved ? 'Marcar Pendiente' : 'Marcar Resuelto' }}
                                    </button>
                                </form>

                                {{-- Botón de eliminar --}}
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este mensaje?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            title="Eliminar Mensaje"
                                            class="text-gray-400 hover:text-red-600 ml-2 p-2 rounded-full hover:bg-red-100 transition duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</div>

@endsection
