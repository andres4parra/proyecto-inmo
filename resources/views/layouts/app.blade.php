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

    {{-- INICIO DE ESTILOS DE LA APLICACIÓN CENTRALIZADOS (APP LAYOUT) --}}
    <style>
        /* ---------------------------------------------------- */
        /* 1. DEFINICIÓN DE COLORES DE LA MARCA */
        /* ---------------------------------------------------- */
        :root {
            --rojas-primary: #dc3545; /* Rojo fuerte */
            --rojas-dark: #343a40; /* Negro/Gris oscuro para texto y fondo */
            --rojas-light: #ffffff; /* Fondo/Base Blanco Puro */
            --rojas-secondary-text: #6c757d; /* Gris para texto secundario */
        }
        
        /* 2. FONDO PRINCIPAL DE LA APLICACIÓN */
        /* Esto asegura que el fondo sea blanco, reemplazando bg-gray-100 */
        .app-bg {
            background-color: var(--rojas-light) !important;
        }

        /* 3. ENCABEZADO DE PÁGINA (PAGE HEADING) */
        /* Aseguramos que el encabezado (donde va el título de la página) sea blanco y tenga nuestro texto oscuro */
        .page-header {
            background-color: var(--rojas-light) !important; /* Fondo blanco */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Sombra sutil para separar */
            /* El color del texto dentro del header debe ser oscuro */
            color: var(--rojas-dark) !important; 
        }
        
        /* Asegura que cualquier texto dentro del header tome el color oscuro */
        .page-header h2 {
            color: var(--rojas-dark) !important;
            font-weight: 600;
        }

        /* 4. CONTENIDO PRINCIPAL */
        /* Aseguramos que el contenido principal también se vea limpio */
        main {
            background-color: var(--rojas-light) !important;
        }
        
    </style>
    {{-- FIN DE ESTILOS DE LA APLICACIÓN CENTRALIZADOS --}}

</head>

<body class="font-sans antialiased">
    
    {{-- CAMBIO CLAVE: Usamos app-bg para el fondo blanco --}}
    <div class="min-h-screen app-bg"> 
        
        {{-- navigation.blade.php (Necesita ser estilizado aparte) --}}
        @include('layouts.navigation')

        @isset($header)
            {{-- Aplicamos la clase de estilo al encabezado --}}
            <header class="page-header"> 
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }} 
                </div>
            </header>
        @endisset

        <main>
            {{-- El contenido principal de la página --}}
            {{ $slot }} 
        </main>

    </div>
</body>

</html>