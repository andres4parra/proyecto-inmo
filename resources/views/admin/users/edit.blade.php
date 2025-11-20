@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

        {{-- Encabezado --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">Editar Usuario</h1>

            <a href="{{ route('admin.users.index') }}" 
               class="text-red-600 hover:text-red-700 flex items-center font-medium transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Volver
            </a>
        </div>

        <div class="bg-white shadow-2xl rounded-xl p-8 border border-gray-100">

            <form action="{{ route('admin.users.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
                    <input type="text" name="name" required
                           value="{{ old('name', $usuario->name) }}"
                           class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                                  focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" required
                           value="{{ old('email', $usuario->email) }}"
                           class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                                  focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Dirección --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                    <input type="text" name="direccion"
                           value="{{ old('direccion', $usuario->direccion) }}"
                           class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                                  focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Roles --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Roles del Usuario</label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($roles as $rol)
                            <label class="flex items-center space-x-2 p-2 rounded hover:bg-gray-100 cursor-pointer">
                                <input type="checkbox" name="roles[]" 
                                       value="{{ $rol->id_rol }}"
                                       class="text-red-600 focus:ring-red-500 rounded"
                                       {{ $usuario->roles->contains('id_rol', $rol->id_rol) ? 'checked' : '' }}>
                                <span class="text-gray-800">{{ $rol->nombre_rol }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Contraseña --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nueva Contraseña (opcional)</label>
                        <input type="password" name="password"
                               class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                                      focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation"
                               class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                                      focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                {{-- Botón Guardar --}}
                <div class="mt-8">
                    <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-extrabold py-3 px-4 rounded-xl shadow-lg
                                   transition duration-300 ease-in-out transform hover:scale-[1.01]">
                        Guardar Cambios
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
