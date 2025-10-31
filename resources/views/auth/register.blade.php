<x-guest-layout>

    {{-- Insertamos estilos para personalizar el formulario y el fondo --}}
    <style>
        /* ---------------------------------------------------- */
        /* 1. ESTILOS GLOBALES Y DE MARCA */
        /* ---------------------------------------------------- */
        :root {
            --rojas-primary: #dc3545; /* Rojo fuerte */
            --rojas-dark: #343a40; /* Negro/Gris oscuro para texto interior */
            --rojas-background: #1a202c; /* Fondo Azul Oscuro/Negro */
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
        /* 2. ESTILOS DE LA TARJETA DE REGISTRO */
        /* ---------------------------------------------------- */
        .register-card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            background: white; /* El interior de la tarjeta es blanco */
            border: none;
            /* Aseguramos que la tarjeta no sea demasiado ancha */
            max-width: 400px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        /* ---------------------------------------------------- */
        /* 3. ESTILOS DE COMPONENTES Y COLORES DE MARCA */
        /* ---------------------------------------------------- */
        
        /* Botón principal (Register) - ROJO */
        .btn-rojas-primary {
            background-color: var(--rojas-primary) !important;
            border-color: var(--rojas-primary) !important;
            color: white !important;
            font-weight: 700 !important;
            border-radius: 4px !important; /* Cuadrado */
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
            /* Usamos la sombra roja para el enfoque */
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25) !important; 
            outline: none !important;
            --tw-ring-color: var(--rojas-primary) !important;
        }

        /* Estilos de texto (Etiquetas y enlaces) */
        .text-gray-600, .text-gray-400, label {
            color: var(--rojas-dark) !important;
        }
        
        /* Enlace (Ya registrado?) */
        a.underline {
            color: var(--rojas-secondary-text) !important;
            font-size: 0.85rem;
            text-decoration: none;
        }
        a.underline:hover {
            color: var(--rojas-primary) !important;
            text-decoration: underline;
        }

    </style>

    <div class="register-card">

        {{-- LOGO DE LA INMOBILIARIA --}}
        <div class="mb-6 text-center">
            {{-- Usando el logo de la imagen --}}
            <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Logo Inmobiliaria" class="mx-auto" style="max-width: 120px; height: auto;">
        </div>

        <h2 class="text-center text-lg font-semibold mb-6" style="color: var(--rojas-dark);">Registro de Nuevo Usuario</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre')" style="color: var(--rojas-dark);" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4 mb-4">
                <x-input-label for="email" :value="__('Email')" style="color: var(--rojas-dark);" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4 mb-4">
                <x-input-label for="password" :value="__('Contraseña')" style="color: var(--rojas-dark);" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4 mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" style="color: var(--rojas-dark);" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                
                {{-- Enlace a Login --}}
                <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                {{-- Botón de Registro con la clase personalizada --}}
                <x-primary-button class="ms-4 btn-rojas-primary">
                    {{ __('REGISTRAR') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>