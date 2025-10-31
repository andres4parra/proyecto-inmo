<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- INICIO DE ESTILOS DE AUTENTICACIÓN CENTRALIZADOS --}}
    <style>
        /* ---------------------------------------------------- */
        /* 1. DEFINICIÓN DE COLORES DE LA MARCA */
        /* ---------------------------------------------------- */
        :root {
            --rojas-primary: #dc3545; /* Rojo fuerte */
            --rojas-dark: #343a40; /* Negro/Gris oscuro para texto interior */
            --rojas-background: #000000; /* Fondo Negro Puro (¡Tu elección!) */
            --rojas-secondary-text: #6c757d; /* Gris para texto secundario */
            --rojas-success: #28a745; /* Verde para el mensaje de éxito */
        }
        
        /* 2. ESTILOS GLOBALES Y DE FONDO */
        
        /* Aplicar el fondo oscuro (negro) al cuerpo de la página */
        body {
            background-color: var(--rojas-background) !important;
        }

        /* El ícono de Laravel Breeze/Jetstream arriba debe ser blanco para contraste */
        /* Sobrescribimos el color de texto por defecto */
        .fill-current {
            color: white !important; 
        }

        /* ---------------------------------------------------- */
        /* 3. ESTILOS DE LA TARJETA PRINCIPAL (El contenedor central) */
        /* Usaremos la clase genérica .auth-card en tus vistas */
        /* Reemplazamos las clases bg-white dark:bg-gray-800 shadow-md sm:rounded-lg */
        .auth-card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            background: white !important; /* El interior de la tarjeta es blanco */
            border: none;
            max-width: 450px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        /* ---------------------------------------------------- */
        /* 4. ESTILOS DE COMPONENTES DE FORMA (Para consistencia) */
        /* ---------------------------------------------------- */
        
        /* Botón principal (Generalmente x-primary-button) - ROJO */
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
        
        /* Estilos de campos de texto e inputs (Generalmente x-text-input) */
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
        
        /* Estilo general para enlaces (Olvidé / Registrarse / Cerrar Sesión) */
        a.underline, .logout-link {
            color: var(--rojas-secondary-text) !important;
            font-size: 0.85rem;
            text-decoration: none;
        }
        a.underline:hover, .logout-link:hover {
            color: var(--rojas-primary) !important;
            text-decoration: underline;
        }

        /* Checkbox (Recordarme) */
        .rounded {
            color: var(--rojas-primary) !important;
            --tw-ring-color: var(--rojas-primary) !important;
        }
        
        /* Texto Descriptivo al inicio del formulario */
        .description-text {
            color: var(--rojas-secondary-text) !important;
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 1.5rem;
        }
    </style>
    {{-- FIN DE ESTILOS DE AUTENTICACIÓN CENTRALIZADOS --}}
</head>

{{-- ELIMINAMOS LAS CLASES DE FONDO DE TAILWIND AQUÍ YA QUE LAS DEFINIMOS EN EL CSS --}}
<body class="font-sans text-gray-900 antialiased"> 
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        {{-- Aquí se muestra el logo (Laravel Breeze por defecto) --}}
        <div>
            <a href="/">
                {{-- Aquí va tu logo si lo quieres arriba del formulario --}}
                <x-application-logo class="w-20 h-20 fill-current text-white" /> 
            </a>
        </div>

        {{-- REEMPLAZAMOS LAS CLASES POR .auth-card PARA USAR NUESTRO ESTILO --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 auth-card overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>