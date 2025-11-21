@extends('layouts.public')

@section('title', 'Propiedades en Arriendo')

@section('content')

<style>
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
        <form method="GET" action="{{ route('propiedades.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="tipoInmueble" class="form-label small">Tipo de Inmueble</label>
                <select id="tipoInmueble" name="tipoInmueble" class="form-select">
                    <option value="Todos" {{ $tipoInmueble === 'Todos' || !$tipoInmueble ? 'selected' : '' }}>Todos</option>
                    <option value="Apartamento" {{ $tipoInmueble === 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                    <option value="Casa" {{ $tipoInmueble === 'Casa' ? 'selected' : '' }}>Casa</option>
                    <option value="Oficina" {{ $tipoInmueble === 'Oficina' ? 'selected' : '' }}>Oficina</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ubicacion" class="form-label small">Ubicación</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ej: Cabecera"
                    value="{{ $ubicacion }}">
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
                <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Monto"
                    value="{{ $maxPrice }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                    <i class="lucide lucide-search"></i> Filtrar
                </button>
            </div>
        </form>
    </div>

    {{-- Cuadrícula de Propiedades --}}
    <div class="row g-4">
        @forelse ($properties as $property)
            <div class="col-md-6 col-lg-4">
                <div class="card property-card h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset($property->imagen ?? 'casa.png') }}" class="property-card-img w-100"
                            alt="{{ $property->titulo }}">
                        <span class="badge-custom">Arriendo</span>
                    </div>
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold">{{ $property->titulo }}</h3>
                        <p class="card-text text-muted mb-3">{{ Str::limit($property->descripcion, 80) }}</p>

                        <div class="d-flex justify-content-between align-items-center mb-4 small text-secondary">
                            <div class="d-flex align-items-center gap-1">
                                <i class="lucide lucide-bed" style="width: 1rem; height: 1rem;"></i>
                                {{ $property->habitaciones }} Hab.
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <i class="lucide lucide-bath" style="width: 1rem; height: 1rem;"></i>
                                {{ $property->banos }} Baños
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <i class="lucide lucide-maximize-2" style="width: 1rem; height: 1rem;"></i>
                                {{ $property->area }} m²
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h4 class="price-tag-index mb-0">
                                {{ '$' . number_format($property->precio, 0, ',', '.') }} /mes
                            </h4>
                            <span class="text-muted small"><i class="lucide lucide-map-pin me-1"></i>
                                {{ $property->ubicacion }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('propiedades.show', ['id' => $property->id]) }}"
                            class="btn btn-outline-secondary w-100 rounded-pill">Ver Detalles</a>
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

    {{-- Paginación (opcional si usas paginate en el controlador) --}}
    @if (method_exists($properties, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $properties->links() }}
        </div>
    @endif
</div>

@endsection
