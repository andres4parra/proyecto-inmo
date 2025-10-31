<x-guest-layout>

    {{-- Insertamos estilos para personalizar el formulario y el fondo --}}
    <style>
        /* ---------------------------------------------------- */
        /* 1. ESTILOS GLOBALES Y DE MARCA (ROJO/NEGRO/BLANCO) */
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
        /* 2. ESTILOS DE LA TARJETA PRINCIPAL */
        /* ---------------------------------------------------- */
        .confirm-card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            background: white; /* El interior de la tarjeta es blanco */
            border: none;
            max-width: 400px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        /* ---------------------------------------------------- */
        /* 3. ESTILOS DE COMPONENTES Y COLORES DE MARCA */
        /* ---------------------------------------------------- */
        
        /* Botón principal (Confirmar) - ROJO */
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

        /* Estilos de texto (Etiquetas y Texto Descriptivo) */
        .text-gray-600, .text-gray-400, label {
            color: var(--rojas-dark) !important;
        }
        
        /* Texto Descriptivo al inicio del formulario */
        .description-text {
            color: var(--rojas-secondary-text) !important;
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="confirm-card">

        {{-- LOGO DE LA INMOBILIARIA --}}
        <div class="mb-6 text-center">
            <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Logo Inmobiliaria" class="mx-auto" style="max-width: 120px; height: auto;">
        </div>

        <h2 class="text-center text-lg font-semibold mb-6" style="color: var(--rojas-dark);">Acceso a Área Segura</h2>

        {{-- Texto descriptivo traducido y estilizado --}}
        <div class="description-text">
            Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-6">
                <x-input-label for="password" :value="__('Contraseña')" style="color: var(--rojas-dark);" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button class="btn-rojas-primary">
                    {{ __('CONFIRMAR ACCESO') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>