@extends('layouts.admin') {{-- Asume que tienes un layout principal para el admin --}}

@section('title', 'Crear Nuevo Usuario')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">Crear Nuevo Usuario</h1>
            {{-- El enlace de retroceso se mantiene en azul para distinción, o puedes cambiarlo a gris/rojo claro --}}
            <a href="{{ route('admin.users.index') }}" 
               class="text-blue-600 hover:text-blue-700 flex items-center font-medium transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Volver al Listado
            </a>
        </div>

        <div class="bg-white shadow-2xl rounded-xl p-8 border border-gray-100">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                {{-- Nombre --}}
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name') }}"
                           placeholder="Ej: Juan Pérez"
                           {{-- Focus ring en color rojo principal --}}
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email') }}"
                           placeholder="Ej: usuario@dominio.com"
                           {{-- Focus ring en color rojo principal --}}
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Rol --}}
                <div class="mb-5">
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Rol del Usuario</label>
                    <select name="role" id="role" required
                            {{-- Focus ring en color rojo principal --}}
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('role') border-red-500 @enderror">
                        <option value="" disabled selected>Selecciona un Rol</option>
                        {{-- Ejemplo de cómo deberías tener tu array $roles en el controlador (usando un mock si no existe) --}}
                        @php
                            $mockRoles = ['admin' => 'Administrador', 'agent' => 'Agente Inmobiliario', 'client' => 'Cliente'];
                            $roles = $roles ?? $mockRoles; 
                        @endphp
                        @foreach ($roles as $key => $roleName)
                            <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                                {{ $roleName }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                        <input type="password" name="password" id="password" required
                               placeholder="Mínimo 8 caracteres"
                               {{-- Focus ring en color rojo principal --}}
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Confirmar Contraseña --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               placeholder="Repite la contraseña"
                               {{-- Focus ring en color rojo principal --}}
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
                
                <div class="mt-8">
                    <button type="submit"
                            {{-- Botón principal en color rojo --}}
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-extrabold py-3 px-4 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-opacity-50">
                        <span class="text-lg">Crear y Guardar Usuario</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection