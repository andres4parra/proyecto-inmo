{{-- resources/views/admin/property-list.blade.php --}}

<div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Título
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Tipo
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Precio
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Estado
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Acciones</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($properties as $property)
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                        {{ $property['title'] ?? 'Sin Título' }}
                        <span class="block text-xs text-gray-500">{{ $property['id'] ?? 'N/A' }}</span>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {{ ucfirst($property['type'] ?? 'Venta') }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        ${{ number_format($property['price'] ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        {{-- Esto es un campo simulado, deberías tener una columna de estado real --}}
                        <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                            Activa
                        </span>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        {{-- 🔑 Enlace de Edición: Esto debería apuntar a una ruta como admin.properties.edit --}}
                        <a href="{{ route('admin.properties.edit', $property['id'] ?? '1') }}" 
                           class="text-red-600 hover:text-red-900 mr-4">
                           Editar
                        </a>

                        {{-- 🔑 Formulario de Eliminación: Se necesita un formulario para usar el método DELETE --}}
                        <form action="{{ route('admin.properties.destroy', $property['id'] ?? '1') }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-600" 
                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta propiedad? Esta acción afectará a los usuarios que ven la página de inicio.')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-sm text-gray-500">
                        No hay propiedades para mostrar en esta lista. ¡Agrega una nueva!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>