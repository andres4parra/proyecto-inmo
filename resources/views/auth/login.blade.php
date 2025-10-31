<x-guest-layout>

    {{-- Insertamos estilos para personalizar el formulario y el fondo --}}
    <style>
        /* ---------------------------------------------------- */
        /* 1. ESTILOS GLOBALES Y DE MARCA */
        /* ---------------------------------------------------- */
        :root {
            --rojas-primary: #dc3545; /* Rojo fuerte */
            --rojas-dark: #343a40; /* Negro/Gris oscuro para texto interior */
            --rojas-background: #1a202c; /* Fondo Azul Oscuro/Negro (como en la imagen) */
            --rojas-secondary-text: #6c757d; /* Gris para texto secundario */
        }
        
        /* Aplicar el fondo oscuro al cuerpo de la página */
        body {
            background-color: var(--rojas-background) !important;
        }

        /* El ícono de Laravel Breeze/Jetstream arriba debe ser blanco para contraste */
        .fill-current {
            color: white !important;
        }

        /* ---------------------------------------------------- */
        /* 2. ESTILOS DE LA TARJETA DE LOGIN */
        /* ---------------------------------------------------- */
        .login-card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background: white;
            border: none;
            max-width: 400px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        /* ---------------------------------------------------- */
        /* 3. ESTILOS DE COMPONENTES Y COLORES DE MARCA */
        /* ---------------------------------------------------- */
        
        /* Botón principal (Ingresar) - ROJO */
        .btn-rojas-primary {
            background-color: var(--rojas-primary) !important;
            border-color: var(--rojas-primary) !important;
            color: white !important;
            font-weight: 700 !important;
            border-radius: 4px !important;
            padding: 0.5rem 1.5rem !important;
            transition: background-color 0.2s ease;
        }
        .btn-rojas-primary:hover {
            background-color: #a32835 !important;
            border-color: #a32835 !important;
        }
        
        /* Estilos de campos de texto e inputs */
        .text-input, .block input {
            border-color: #ced4da !important;
            border-radius: 4px !important;
            padding: 0.6rem 0.75rem !important;
        }
        .text-input:focus, .block input:focus {
            border-color: var(--rojas-primary) !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25) !important;
            outline: none !important;
            --tw-ring-color: var(--rojas-primary) !important;
        }

        /* Estilos de texto (Etiquetas y enlaces) */
        .text-gray-600, .text-gray-400, label {
            color: var(--rojas-dark) !important;
        }
        
        /* Estilo general para enlaces (Olvidé / Registrarse) */
        a.underline {
            color: var(--rojas-secondary-text) !important;
            font-size: 0.85rem;
            text-decoration: none;
        }
        a.underline:hover {
            color: var(--rojas-primary) !important;
            text-decoration: underline;
        }

        /* Checkbox (Recordarme) */
        .rounded {
            color: var(--rojas-primary) !important;
            --tw-ring-color: var(--rojas-primary) !important;
        }
        
        /* Contenedor de acciones */
        .auth-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
            padding-top: 0.5rem;
        }
        /* Nueva regla: Contenedor para enlaces de texto */
        .link-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    </style>

    <div class="login-card">

        {{-- LOGO DE LA INMOBILIARIA --}}
        <div class="mb-6 text-center">
            <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Logo Inmobiliaria" class="mx-auto" style="max-width: 120px; height: auto;">
        </div>

        <h2 class="text-center text-lg font-semibold mb-6" style="color: var(--rojas-dark);">Acceso a Clientes y Arrendatarios</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" style="color: var(--rojas-dark);" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4 mb-4">
                <x-input-label for="password" :value="__('Contraseña')" style="color: var(--rojas-dark);" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm">{{ __('Recordarme') }}</span>
                </label>
            </div>

            {{-- Contenedor de acciones: Enlaces (izquierda) y Botón (derecha) --}}
            <div class="flex items-center justify-between mt-6 auth-actions">
                
                <div class="link-group">
                    {{-- 1. Enlace ¿Olvidaste tu contraseña? --}}
                    @if (Route::has('password.request'))
                        <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                    
                    {{-- 2. ENLACE A REGISTRO (¡El que faltaba!) --}}
                    @if (Route::has('register'))
                        <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                            {{ __('¿No tienes cuenta? Regístrate') }}
                        </a>
                    @endif
                </div>

                {{-- El botón "Ingresar" debe estar a la derecha --}}
                <x-primary-button class="ms-3 btn-rojas-primary">
                    {{ __('INGRESAR') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>