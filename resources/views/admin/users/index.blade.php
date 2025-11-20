@extends('layouts.admin') {{-- Asume que tienes un layout principal para el admin --}}

@section('title', 'Gestión de Usuarios')

@section('content')

<div class="container mx-auto px-4 py-6">
<h1 class="text-3xl font-bold mb-6 text-gray-800">Gestión de Usuarios</h1>

{{-- Enlace para Crear Nuevo Usuario (Ajustado a color Rojo) --}}
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.users.create') }}"
        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-[1.01]">
        + Crear Nuevo Usuario
    </a>
</div>

{{-- Mensajes de Sesión (Éxito/Error) --}}
@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-center">Rol</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($users as $user)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    {{ $user->id }}
                </td>
                <td class="py-3 px-6 text-left">
                    {{ $user->name }}
                </td>
                <td class="py-3 px-6 text-left">
                    {{ $user->email }}
                </td>
                <td class="py-3 px-6 text-center">
                    {{ $user->role ?? 'Cliente' }}
                </td>
                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center space-x-2">
                        {{-- Botón Editar (Cambiado a gris neutro) --}}
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-gray-600 hover:text-gray-900" title="Editar">
                            <i class="lucide lucide-edit" style="width: 18px; height: 18px;"></i>
                        </a>

                        {{-- Botón Eliminar (Ya estaba en rojo) --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a este usuario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                <i class="lucide lucide-trash-2" style="width: 18px; height: 18px;"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-6 text-center text-gray-500">
                    No hay usuarios registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


</div>

<script>
// Para asegurar que los iconos de Lucide se rendericen
if (typeof lucide !== 'undefined') {
lucide.createIcons();
}
</script>

@endsection