@extends('layouts.admin')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previsualización - Gestión de Propiedades</title>
    <!-- Carga de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Estilo para simular el layout principal del admin */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <div class="space-y-8 max-w-6xl mx-auto">
        <!-- Título y Botón de Creación -->
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <h1 class="text-4xl font-extrabold text-gray-900">Gestión de Propiedades</h1>
            
            <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transition duration-300 transform hover:scale-105 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Añadir Propiedad</span>
            </a>
        </div>

        <!-- Mensaje de Éxito Simulado -->
        <!-- <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
            <span class="block sm:inline">¡Propiedad actualizada exitosamente!</span>
        </div> -->

        <!-- Contenedor de la tabla con sombra y esquinas mejoradas -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Título
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Precio
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Agente
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        <!-- FILA 1: Disponible (Verde) -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                1
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                Apartamento Céntrico
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                250,000,000 COP
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disponible
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                Agente A
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 transition duration-150">Editar</a>
                                <button type="button" onclick="alert('Simulación: Confirmación para eliminar la propiedad 1')" class="text-red-600 hover:text-red-900 transition duration-150">Eliminar</button>
                            </td>
                        </tr>

                        <!-- FILA 2: Vendido (Rojo) -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                2
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                Casa Campestre con Piscina
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                850,000,000 COP
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Vendido
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                Agente B
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 transition duration-150">Editar</a>
                                <button type="button" onclick="alert('Simulación: Confirmación para eliminar la propiedad 2')" class="text-red-600 hover:text-red-900 transition duration-150">Eliminar</button>
                            </td>
                        </tr>

                        <!-- FILA 3: Alquilado (Amarillo) -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                3
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                Oficina Edificio Moderno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                150,000,000 COP
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Alquilado
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                Agente A
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 transition duration-150">Editar</a>
                                <button type="button" onclick="alert('Simulación: Confirmación para eliminar la propiedad 3')" class="text-red-600 hover:text-red-900 transition duration-150">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>

</body>
</html>

@endsection