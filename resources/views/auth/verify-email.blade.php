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
            --rojas-success: #28a745; /* Verde para el mensaje de éxito */
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
        .verify-card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            background: white; /* El interior de la tarjeta es blanco */
            border: none;
            max-width: 450px; /* Un poco más ancha para el texto descriptivo */
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        /* ---------------------------------------------------- */
        /* 3. ESTILOS DE COMPONENTES Y COLORES DE MARCA */
        /* ---------------------------------------------------- */
        
        /* Botón principal (Reenviar) - ROJO */
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
        
        /* Estilos de texto (Etiquetas y Texto Descriptivo) */
        .text-gray-600, .text-gray-400 {
            color: var(--rojas-dark) !important;
        }
        
        /* Texto Descriptivo al inicio del formulario */
        .description-text {
            color: var(--rojas-secondary-text) !important;
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 1.5rem;
        }
        
        /* Estilo del mensaje de éxito (verde) */
        .text-success-message {
            color: var(--rojas-success) !important;
            font-weight: 600;
        }
        
        /* Enlace Cerrar Sesión */
        .logout-link {
            color: var(--rojas-secondary-text) !important;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }
        .logout-link:hover {
            color: var(--rojas-primary) !important;
            text-decoration: underline;
        }
        
    </style>

    <div class="verify-card">

        {{-- LOGO DE LA INMOBILIARIA --}}
        <div class="mb-6 text-center">
            <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Logo Inmobiliaria" class="mx-auto" style="max-width: 120px; height: auto;">
        </div>

        <h2 class="text-center text-lg font-semibold mb-6" style="color: var(--rojas-dark);">Verificación de Correo</h2>

        {{-- Texto descriptivo traducido y estilizado --}}
        <div class="description-text">
            ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo, te enviaremos otro con gusto.
        </div>

        {{-- Mensaje de éxito al reenviar el correo --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-success-message">
                Un nuevo enlace de verificación ha sido enviado a la dirección de correo que proporcionaste durante el registro.
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between">
            
            {{-- Formulario para reenviar el enlace --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button class="btn-rojas-primary">
                        {{ __('REENVIAR CORREO DE VERIFICACIÓN') }}
                    </x-primary-button>
                </div>
            </form>

            {{-- Formulario para cerrar sesión --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout-link">
                    {{ __('Cerrar Sesión') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>