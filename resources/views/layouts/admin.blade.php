<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'App')) | Admin</title>

    {{-- SIMULACIÓN DE CSS: Reemplaza @vite para que funcione en el preview --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased bg-gray-100">

    {{-- SIMULACIÓN PHP/BLADE PARA EL ENTORNO DE PREVIEW --}}
    @php
        // 1. Simulación de la función route()
        if (!function_exists('route')) {
            function route($name, $params = [])
            {
                $base = match ($name) {
                    'dashboard' => '/dashboard',
                    'admin.properties.index' => '/admin/properties',
                    'admin.contracts' => '/admin/contracts',
                    'admin.users' => '/admin/users',
                    'admin.messages' => '/admin/messages',
                    'logout' => '/logout',
                    default => '/',
                };
                if (!empty($params) && !is_numeric($params) && !is_array($params)) {
                    $base .= '?' . http_build_query($params);
                }
                return $base;
            }
        }

        // 2. Simulación de request() (especialmente routeIs)
        if (!function_exists('request')) {
            function request()
            {
                // Simulación: Asumimos que estamos en el dashboard por defecto.
                $currentRoute = '/dashboard';
                // Para probar otras rutas, cambia el valor de $currentRoute
                // $currentRoute = '/admin/propiedades/1/edit';

                return new class ($currentRoute) {
                    protected $route;
                    public function __construct($route)
                    {
                        $this->route = $route;
                    }
                    public function routeIs($pattern)
                    {
                        // Lógica básica para simular routeIs
                        if ($pattern === 'dashboard' && $this->route === '/dashboard') {
                            return true;
                        }
                        if ($pattern === 'admin.propiedades.*' && str_starts_with($this->route, '/admin/propiedades')) {
                            return true;
                        }
                        if ($pattern === 'admin.contracts.*' && str_starts_with($this->route, '/admin/contracts')) {
                            return true;
                        }
                        if ($pattern === 'admin.users' && $this->route === '/admin/users') {
                            return true;
                        }
                        if ($pattern === 'admin.messages' && str_starts_with($this->route, '/admin/messages')) {
                            return true;
                        }
                        if ($pattern === 'admin.messages.show' && str_starts_with($this->route, '/admin/messages/')) {
                            return true;
                        }
                        return false;
                    }
                    public function route($key)
                    {
                        // Simulación de obtener el nombre de la ruta actual
                        return $key === 'name' ? 'dashboard' : null;
                    }
                };
            }
        }

        // 3. Simulación de Auth::user()
        // FIX: Se envuelve la declaración de las clases dentro de if (!class_exists)
        // para evitar el error "Cannot declare class MockUser, because the name is already in use"
        if (!class_exists('MockUser')) {
            class MockUser
            {
                public $name = 'Juan Administrador';
                public $email = 'admin@rv.com';
            }
        }
        if (!class_exists('MockAuth')) {
            class MockAuth
            {
                public static function user()
                {
                    return new MockUser();
                }
            }
        }
        if (!class_exists('Auth')) {
            class Auth extends MockAuth {}
        }

        // Definición de clases para el sidebar
        $navClasses = 'flex items-center py-2.5 px-4 rounded-lg transition duration-200';
        $activeClasses = 'bg-red-600 text-white font-semibold shadow-md';
        $inactiveClasses = 'hover:bg-gray-100 text-gray-700';

        // Lógica de activación de Propiedades (Ajustada para usar 'admin.propiedades.*' como lo tenías)
        $isPropiedadesActive = request()->routeIs('admin.propiedades.*') || request()->routeIs('admin.properties.*');

    @endphp

    <div id="app" class="min-h-screen flex">

        {{-- 1. Sidebar/Menú de Navegación (CLARO con texto oscuro) --}}
        <aside class="w-64 bg-white text-gray-700 flex-shrink-0 p-4 shadow-xl">

            {{-- Título --}}
            {{-- COLOR DEL TÍTULO CAMBIADO A ROJO (red-600) --}}
            <h2 class="text-2xl font-extrabold mb-8 border-b border-gray-200 pb-4 text-red-600">
                <span class="inline-block transform rotate-[-5deg] mr-1">🏡</span> Admin Panel
            </h2>

            <nav class="space-y-2">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="{{ $navClasses }} @if (request()->routeIs('dashboard')) {{ $activeClasses }} @else {{ $inactiveClasses }} @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-10v10a1 1 0 001 1h3m-9 0V9a1 1 0 00-1-1H7a1 1 0 00-1 1v10m9-10l-7 7">
                        </path>
                    </svg>
                    Dashboard
                </a>

                {{-- Propiedades --}}
                <a href="{{ route('admin.properties.index') }}"
                    class="{{ $navClasses }} @if (request()->routeIs('admin.properties.*')) {{ $activeClasses }} @else {{ $inactiveClasses }} @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-1 0H7m0 0h-2M5 5v16m0-4h14">
                        </path>
                    </svg>
                    Propiedades
                </a>

                {{-- Contratos --}}
                <a href="{{ route('admin.contracts.index') }}"
                    class="{{ $navClasses }} @if (request()->routeIs('admin.contracts.*')) {{ $activeClasses }} @else {{ $inactiveClasses }} @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    Contratos
                </a>

                {{-- Usuarios --}}
                <a href="{{ route('admin.users.index') }}"
                    class="{{ $navClasses }} @if (request()->routeIs('admin.users.*')) {{ $activeClasses }} @else {{ $inactiveClasses }} @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 15L11 19m0 0l-4-4m4 4v7">
                        </path>
                    </svg>
                    Usuarios
                </a>

                {{-- Mensajes --}}
                <a href="{{ route('admin.messages.index') }}"
                    class="{{ $navClasses }} @if (request()->routeIs('admin.messages.*')) {{ $activeClasses }} @else {{ $inactiveClasses }} @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    Mensajes
                </a>

            </nav>
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="w-full {{ $navClasses }} bg-gray-200 text-gray-700 hover:bg-red-600 hover:text-white">
                    Cerrar sesión
                </button>
            </form>

        </aside>

        {{-- 2. Área de Contenido Principal --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Header/Navbar Superior --}}
            <header class="bg-white shadow p-4 flex justify-between items-center z-10">
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">@yield('header')</h1>
                <div class="flex items-center space-x-4">
                    <p class="text-sm text-gray-700">Bienvenido, <span
                            class="font-semibold">{{ Auth::user()->name ?? 'Usuario' }}</span></p>
                </div>
            </header>

            {{-- Contenido Específico de la Página --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6">
                {{-- Contenido de mensajes (session flash) --}}
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Éxito!</strong>
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
