@extends('layouts.admin')

@section('title', 'Crear Nuevo Usuario')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

        {{-- Título + volver --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">Crear Nuevo Usuario</h1>

            <a href="{{ route('admin.users.index') }}" 
               class="text-blue-600 hover:text-blue-700 flex items-center font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Volver al Listado
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white shadow-2xl rounded-xl p-8 border border-gray-100">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                {{-- Nombre --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
                    <input type="text" name="name" required
                           value="{{ old('name') }}"
                           placeholder="Ej: Juan Pérez"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm 
                                  focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" required
                           value="{{ old('email') }}"
                           placeholder="Ej: usuario@dominio.com"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                                  focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dirección --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección (opcional)</label>
                    <input type="text" name="direccion"
                           value="{{ old('direccion') }}"
                           placeholder="Ej: Calle 123 #45-67"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                                  focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Contraseña / Confirmación --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                        <input type="password" name="password" required
                               placeholder="Mínimo 8 caracteres"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                                      focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" required
                               placeholder="Repite la contraseña"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                                      focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                {{-- Roles (Checkbox) --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Asignar Roles</label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($roles as $rol)
                            <label class="flex items-center space-x-3 p-3 border rounded-lg shadow-sm cursor-pointer hover:bg-gray-50 transition">
                                <input type="checkbox"
                                       name="roles[]"
                                       value="{{ $rol->id_rol }}"
                                       class="h-5 w-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="text-gray-700 font-medium">{{ $rol->nombre_rol }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Botón --}}
                <div class="mt-8">
                    <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-extrabold py-3 px-4 rounded-xl shadow-lg 
                                   transition duration-300 transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-red-500/50">
                        <span class="text-lg">Crear y Guardar Usuario</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
