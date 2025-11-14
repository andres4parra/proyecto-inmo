@extends('layouts.admin')

@section('content')
    <div class="space-y-8">
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <h1 class="text-4xl font-extrabold text-gray-900">Gestión de Contratos</h1>
            {{-- Asumo que la ruta es 'admin.contratos.create' o 'admin.contracts.create' --}}
            <a href="{{ route('admin.contracts.create') }}" 
               class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transition duration-300 transform hover:scale-105">
                + Nuevo Contrato
            </a>
        </div>

        <div class="overflow-x-auto shadow-2xl ring-1 ring-black ring-opacity-5 rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-gray-700 sm:pl-6">
                            Cliente / Propiedad
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-700">
                            Tipo
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-700">
                            Monto
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-700">
                            Inicio / Fin
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    
                    @forelse ($contratos as $contrato)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <span class="block text-sm font-semibold">{{ $contrato->nombre_cliente }}</span>
                                <span class="block text-xs text-gray-500">Propiedad: {{ $contrato->propiedad->titulo }}</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                {{ ucfirst($contrato->tipo_contrato) }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 font-semibold">
                                ${{ number_format($contrato->monto_acordado, 0, ',', '.') }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                <span class="block text-xs">Inicio: {{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}</span>
                                @if($contrato->fecha_fin)
                                    <span class="block text-xs">Fin: {{ \Carbon\Carbon::parse($contrato->fecha_fin)->format('d/m/Y') }}</span>
                                @endif
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-4">
                                {{-- Aquí irían los enlaces de editar y eliminar --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-lg text-gray-500">
                                <p class="mb-2">Aún no hay contratos registrados.</p>
                                <a href="{{ route('admin.contracts.create') }}" class="text-red-600 hover:text-red-800 font-semibold">
                                    ¡Registra el primer contrato!
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection