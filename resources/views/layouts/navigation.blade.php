<nav x-data="{ open: false }" class="navigation-bar">
    {{-- Insertamos estilos aquí para extender las variables definidas en app.blade.php --}}
    <style>
        /* Asumimos que las variables :root ya están definidas en app.blade.php */
        
        /* 1. Estilos de la Barra Principal */
        .navigation-bar {
            /* Reemplazamos bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 */
            background-color: var(--rojas-light) !important; /* Blanco */
            border-bottom: 1px solid #f0f0f0; /* Borde muy sutil */
        }

        /* 2. Estilos del Logo */
        /* Aplicamos el logo de la inmobiliaria en lugar del genérico de Breeze */
        .logo-placeholder {
            height: 3.5rem; /* Altura de la barra (h-16 en Tailwind) */
            display: flex;
            align-items: center;
        }

        /* 3. Enlaces de Navegación */
        /* Aplicamos color oscuro al texto de los enlaces no activos */
        .nav-link-text {
            color: var(--rojas-dark) !important;
            font-weight: 500;
        }
        /* Color rojo para el enlace activo */
        .nav-link-active {
            border-bottom: 3px solid var(--rojas-primary) !important;
            color: var(--rojas-dark) !important;
        }
        
        /* 4. Dropdown de Configuración (Nombre del Usuario) */
        .settings-button {
            /* Texto oscuro y fondo blanco */
            color: var(--rojas-dark) !important;
            background-color: var(--rojas-light) !important; 
        }
        .settings-button:hover {
            color: var(--rojas-primary) !important; /* Rojo al pasar el ratón */
            background-color: #f5f5f5 !important;
        }
        
        /* 5. Íconos (Flecha del Dropdown) */
        .settings-button svg {
            fill: var(--rojas-dark) !important;
        }

        /* 6. Menú Hamburguesa (para móvil) */
        .hamburger-button {
            /* Texto oscuro sobre fondo blanco */
            color: var(--rojas-dark) !important; 
            background-color: transparent !important;
        }
        .hamburger-button:hover {
            background-color: #f5f5f5 !important;
        }

    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center logo-placeholder">
                    <a href="{{ route('dashboard') }}">
                        {{-- USAMOS TU LOGO DE INMOBILIARIA --}}
                        <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Logo Inmobiliaria" class="h-9 w-auto" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                class="{{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link-text' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    {{-- Puedes añadir más enlaces aquí --}}
                    {{-- <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="{{ request()->routeIs('profile.edit') ? 'nav-link-active' : 'nav-link-text' }}">
                        {{ __('Mi Perfil') }}
                    </x-nav-link> --}}
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="settings-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name ?? 'Invitado' }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- El contenido del Dropdown (Enlaces en el menú desplegable) --}}
                        <x-dropdown-link :href="route('profile.edit')" style="color: var(--rojas-dark);">
                            {{ __('Mi Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" style="color: var(--rojas-dark);"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="hamburger-button inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden" style="background-color: var(--rojas-light);">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="color: var(--rojas-dark);">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t" style="border-color: #f0f0f0;">
            <div class="px-4">
                @if (Auth::check())
                    <div class="font-medium text-base" style="color: var(--rojas-dark);">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="font-medium text-sm" style="color: var(--rojas-secondary-text);">
                        {{ Auth::user()->email }}
                    </div>
                @else
                    <div class="font-medium text-base" style="color: var(--rojas-dark);">
                        Invitado
                    </div>
                    <div class="font-medium text-sm" style="color: var(--rojas-secondary-text);">
                        No autenticado
                    </div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" style="color: var(--rojas-dark);">
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" style="color: var(--rojas-dark);"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>