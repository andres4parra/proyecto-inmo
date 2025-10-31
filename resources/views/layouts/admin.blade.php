{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Inmobiliaria')) | Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div id="app" class="min-h-screen flex">
        
        {{-- 1. Sidebar/Menú de Navegación (El menú principal de admin) --}}
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0 p-4">
            <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
            <nav>
                
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
                   @if(request()->routeIs('dashboard')) bg-gray-700 font-semibold @endif">
                    Dashboard
                </a>
                
                {{-- Propiedades (Ruta corregida y activa para CRUD: admin.properties.*) --}}
                <a href="{{ route('admin.properties.index') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
                   @if(request()->routeIs('admin.properties.*')) bg-gray-700 font-semibold @endif">
                    Propiedades
                </a>
                
                {{-- Contratos --}}
                <a href="{{ route('admin.contracts') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
                   @if(request()->routeIs('admin.contracts')) bg-gray-700 font-semibold @endif">
                    Contratos
                </a>
                
                {{-- Usuarios --}}
                <a href="{{ route('admin.users') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
                   @if(request()->routeIs('admin.users')) bg-gray-700 font-semibold @endif">
                    Usuarios
                </a>
                
                {{-- Mensajes --}}
                <a href="{{ route('admin.messages') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 
                   @if(request()->routeIs('admin.messages')) bg-gray-700 font-semibold @endif">
                    Mensajes
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t border-gray-700 pt-4">
                    @csrf
                    <button type="submit" class="block py-2.5 px-4 rounded transition duration-200 bg-red-600 hover:bg-red-700 w-full text-left">
                        Cerrar Sesión
                    </button>
                </form>
            </nav>
        </aside>

        {{-- 2. Área de Contenido Principal --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            
            {{-- Header/Navbar Superior --}}
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">@yield('header')</h1>
                <p class="text-gray-600">Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</p>
            </header>

            {{-- Contenido Específico de la Página --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @yield('content') 
            </main>
        </div>
    </div>
</body>
</html>