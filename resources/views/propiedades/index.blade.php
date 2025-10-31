@extends('layouts.public')

@section('title', 'Propiedades en Arriendo')

@section('content')

{{-- Definición de Propiedades (simulando la data) --}}
@php
    // --- 1. DATOS FIJOS ---
    $defaultImageUrl = 'casa.png';
    
    $allProperties = [
        [
            'id' => 101,
            'title' => 'Apartamento 3H en Cabecera',
            'description' => 'Lujoso y espacioso apartamento con excelente ubicación, ideal para familias. Incluye parqueadero.',
            'price' => 1800000,
            'location' => 'Cabecera del Llano',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 120,
            'type' => 'Apartamento', // Agregamos el tipo para filtrar
            'imageUrl' => $defaultImageUrl, 
        ],
        [
            'id' => 102,
            'title' => 'Oficina moderna en Centro',
            'description' => 'Espacio de trabajo listo para ocupar en piso alto con vista panorámica. Seguridad 24/7.',
            'price' => 1100000,
            'location' => 'Bucaramanga Centro',
            'bedrooms' => 0,
            'bathrooms' => 1,
            'area' => 55,
            'type' => 'Oficina', // Agregamos el tipo para filtrar
            'imageUrl' => $defaultImageUrl, 
        ],
        [
            'id' => 103,
            'title' => 'Casa campestre con piscina',
            'description' => 'Hermosa casa a las afueras, perfecta para el descanso, con amplio jardín y zonas verdes.',
            'price' => 3500000,
            'location' => 'Piedecuesta',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'area' => 250,
            'type' => 'Casa', // Agregamos el tipo para filtrar
            'imageUrl' => $defaultImageUrl, 
        ],
        [
            'id' => 104,
            'title' => 'Apartaestudio Nuevo',
            'description' => 'Ideal para estudiantes o solteros. Cerca de universidades y centro comercial.',
            'price' => 850000,
            'location' => 'Universidad',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'area' => 40,
            'type' => 'Apartamento', // Agregamos el tipo para filtrar
            'imageUrl' => $defaultImageUrl, 
        ],
    ];

    $formatPrice = function ($price) {
        return '$' . number_format($price, 0, ',', '.') . ' /mes';
    };

    // --- 2. LÓGICA DE FILTRADO (LEYENDO QUERY PARAMS DE LA URL) ---

    // Obtener valores de los filtros, usando el helper request() de Laravel
    $tipoInmueble = request('tipoInmueble');
    $ubicacion = request('ubicacion');
    $habitaciones = request('habitaciones');
    $maxPrice = request('maxPrice');
    
    // Iniciar la lista de propiedades filtradas
    $filteredProperties = collect($allProperties)->filter(function ($property) use ($tipoInmueble, $ubicacion, $habitaciones, $maxPrice) {
        $match = true;

        // Filtro por Tipo de Inmueble
        if ($tipoInmueble && $tipoInmueble !== 'Todos' && $property['type'] !== $tipoInmueble) {
            $match = false;
        }

        // Filtro por Ubicación (búsqueda parcial)
        if ($ubicacion) {
            $locationMatch = stripos($property['location'], $ubicacion) !== false;
            if (!$locationMatch) {
                $match = false;
            }
        }
        
        // Filtro por Habitaciones
        if ($habitaciones && $habitaciones !== 'Cualquiera') {
            $minBedrooms = (int) str_replace('+', '', $habitaciones);
            if ($property['bedrooms'] < $minBedrooms) {
                $match = false;
            }
        }

        // Filtro por Precio Máximo
        if ($maxPrice && $property['price'] > $maxPrice) {
            $match = false;
        }

        return $match;
    });

    // Usaremos la lista filtrada en la vista
    $properties = $filteredProperties;
@endphp

<style>
    /* ... Tus estilos se mantienen igual ... */
    .property-card {
        border-radius: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border: none;
    }

    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .property-card-img {
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .property-card:hover .property-card-img {
        transform: scale(1.03);
    }
    
    .badge-custom {
        background-color: var(--primary-color, #dc3545);
        color: white;
        font-weight: 600;
        padding: 0.4rem 0.9rem;
        border-radius: 50px;
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 5;
    }
    
    .price-tag-index {
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--primary-dark-color, #A32835);
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-3" style="color: var(--dark-color, #1A1A1A);">Propiedades en Arriendo</h1>
        <p class="lead text-muted">Explora nuestra selección completa de inmuebles disponibles en tu zona.</p>
    </div>

    {{-- Área de Filtros y Búsqueda --}}
    <div class="card p-4 mb-5 shadow-sm border-0" style="border-radius: 15px;">
        <h3 class="h5 fw-bold mb-3">Filtra tu búsqueda</h3>
        {{-- El formulario se envía a la misma URL usando el método GET --}}
        <form method="GET" action="{{ route('propiedades.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="tipoInmueble" class="form-label small">Tipo de Inmueble</label>
                <select id="tipoInmueble" name="tipoInmueble" class="form-select">
                    <option value="Todos" {{ $tipoInmueble === 'Todos' || !$tipoInmueble ? 'selected' : '' }}>Todos</option>
                    {{-- Usamos el valor actual del filtro para marcar la opción seleccionada --}}
                    <option value="Apartamento" {{ $tipoInmueble === 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                    <option value="Casa" {{ $tipoInmueble === 'Casa' ? 'selected' : '' }}>Casa</option>
                    <option value="Oficina" {{ $tipoInmueble === 'Oficina' ? 'selected' : '' }}>Oficina</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ubicacion" class="form-label small">Ubicación</label>
                {{-- Mantenemos el valor actual en el campo de texto --}}
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ej: Cabecera" value="{{ $ubicacion }}">
            </div>
            <div class="col-md-2">
                <label for="habitaciones" class="form-label small">Habitaciones</label>
                <select id="habitaciones" name="habitaciones" class="form-select">
                    <option value="Cualquiera" {{ $habitaciones === 'Cualquiera' || !$habitaciones ? 'selected' : '' }}>Cualquiera</option>
                    <option value="1+" {{ $habitaciones === '1+' ? 'selected' : '' }}>1+</option>
                    <option value="2+" {{ $habitaciones === '2+' ? 'selected' : '' }}>2+</option>
                    <option value="3+" {{ $habitaciones === '3+' ? 'selected' : '' }}>3+</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="maxPrice" class="form-label small">Precio Máx.</label>
                {{-- Mantenemos el valor actual en el campo de número --}}
                <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Monto" value="{{ $maxPrice }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                    <i class="lucide lucide-search"></i>
                    Filtrar
                </button>
            </div>
        </form>
    </div>
    
    {{-- Cuadrícula de Propiedades --}}
    <div class="row g-4">
        {{-- Usamos la variable $properties que contiene la lista filtrada --}}
        @forelse ($properties as $property)
            <div class="col-md-6 col-lg-4">
                <div class="card property-card h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset($property['imageUrl']) }}" class="property-card-img w-100"
                            alt="{{ $property['title'] }}">
                        <span class="badge-custom">Arriendo</span>
                    </div>
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold">{{ $property['title'] }}</h3>
                        <p class="card-text text-muted mb-3">{{ Str::limit($property['description'], 80) }}</p>
                        
                        {{-- Detalles rápidos --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 small text-secondary">
                            <div class="d-flex align-items-center gap-1">
                                <i class="lucide lucide-bed" style="width: 1rem; height: 1rem;"></i>
                                {{ $property['bedrooms'] }} Hab.
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <i class="lucide lucide-bath" style="width: 1rem; height: 1rem;"></i>
                                {{ $property['bathrooms'] }} Baños
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <i class="lucide lucide-maximize-2" style="width: 1rem; height: 1rem;"></i>
                                {{ $property['area'] }} m²
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h4 class="price-tag-index mb-0">
                                {{ $formatPrice($property['price']) }}
                            </h4>
                            <span class="text-muted small"><i class="lucide lucide-map-pin me-1"></i>
                                {{ $property['location'] }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('propiedades.show', ['id' => $property['id']]) }}" class="btn btn-outline-secondary w-100 rounded-pill">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="lucide lucide-frown-open h2 text-muted"></i>
                <p class="lead text-muted mt-3">
                    No se encontraron propiedades que coincidan con los criterios de búsqueda. <br>
                    <a href="{{ route('propiedades.index') }}" class="btn btn-link mt-2">Mostrar todas las propiedades</a>
                </p>
            </div>
        @endforelse
    </div>

    {{-- Paginación (Opcional: solo muestra si hay propiedades) --}}
    @if ($properties->count() > 0)
        <div class="d-flex justify-content-center mt-5">
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    @endif
</div>

@endsection