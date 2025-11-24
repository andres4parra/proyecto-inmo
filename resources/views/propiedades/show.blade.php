@extends('layouts.public')

@section('title', 'Detalle de Propiedad')

@section('content')

    <style>
        .btn-primary-custom {
            background: linear-gradient(90deg, var(--primary-dark-color, #A32835), var(--primary-color, #dc3545));
            border: none;
            font-weight: 600;
            color: white;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
        }

        .property-detail-img {
            height: 500px;
            object-fit: cover;
            border-radius: 15px;
        }

        .sticky-card {
            position: sticky;
            top: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feature-dot {
            width: 8px;
            height: 8px;
            background-color: var(--primary-color, #dc3545);
            border-radius: 50%;
            margin-right: 0.5rem;
        }
    </style>

    <div class="container py-5">
        <div class="row">

            {{-- Volver --}}
            <div class="col-12 mb-4">
                <a href="{{ route('propiedades.index') }}"
                    class="text-secondary hover-link d-flex align-items-center gap-2 text-decoration-none">
                    <i class="lucide lucide-arrow-left" style="width: 1.25rem; height: 1.25rem;"></i>
                    Volver a propiedades
                </a>
            </div>

            {{-- Contenido Principal --}}
            <div class="col-lg-8">
                <div class="space-y-5">

                    {{-- Imagen principal predeterminada --}}
                    <div class="bg-light rounded-3 overflow-hidden">
                        <img src="{{ asset('casa.png') }}" class="property-card-img w-100"
                            alt="{{ $property->titulo }}">

                    </div>

                    {{-- Información --}}
                    <div class="card p-4 shadow-sm border-0">
                        <div class="card-body p-0">

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge bg-danger text-white fw-bold p-2 rounded-pill">
                                    {{ $property->tipo }}
                                </span>

                                <div class="text-muted small d-flex align-items-center">
                                    <i class="lucide lucide-map-pin me-1" style="width: 1rem; height: 1rem;"></i>
                                    {{ $property->ubicacion }}
                                </div>
                            </div>

                            <h1 class="h2 fw-bold mb-3">{{ $property->titulo }}</h1>

                            <div class="h3 fw-bolder mb-4" style="color: var(--primary-dark-color, #A32835);">
                                ${{ number_format($property->precio, 0, ',', '.') }} / mes
                            </div>

                            {{-- Características --}}
                            <div class="d-flex flex-wrap gap-4 mb-5 border-top pt-4">
                                <div class="d-flex align-items-center text-secondary">
                                    <i class="lucide lucide-bed me-2"></i>
                                    <span>{{ $property->habitaciones }} Habitaciones</span>
                                </div>

                                <div class="d-flex align-items-center text-secondary">
                                    <i class="lucide lucide-bath me-2"></i>
                                    <span>{{ $property->banos }} Baños</span>
                                </div>

                                <div class="d-flex align-items-center text-secondary">
                                    <i class="lucide lucide-maximize-2 me-2"></i>
                                    <span>{{ $property->area }} m²</span>
                                </div>
                            </div>

                            {{-- Descripción --}}
                            <div class="border-top pt-4">
                                <h2 class="h4 fw-bold mb-3">Descripción</h2>
                                <p class="text-muted" style="white-space: pre-line;">
                                    {{ $property->descripcion }}
                                </p>
                            </div>

                            {{-- Características adicionales --}}
                            @if (isset($features) && count($features) > 0)
                                <div class="border-top pt-4 mt-4">
                                    <h2 class="h4 fw-bold mb-3">Características Adicionales</h2>
                                    <ul class="row list-unstyled g-2">
                                        @foreach ($features as $feature)
                                            <li class="col-12 col-md-6 d-flex align-items-center text-secondary">
                                                <div class="feature-dot"></div>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card sticky-card border-0">
                    <div class="card-body p-4">

                        <h2 class="h5 fw-bold mb-3">¿Te interesa esta propiedad?</h2>
                        <p class="text-muted small mb-4">
                            Puedes contactarnos llenando el formulario o agendando una visita.
                        </p>

                        {{-- Contactar --}}
                        <a href="{{ url('/contacto?interes=' . $property->id) }}"
                            class="btn btn-primary-custom w-100 py-2 mb-4">
                            Contactar sobre esta propiedad
                        </a>

                        {{-- Acciones --}}
                        <div class="pt-4 border-top">
                            <h6 class="fw-bold mb-3">Acciones Rápidas</h6>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center text-secondary">
                                    <i class="lucide lucide-calendar me-2"></i>
                                    <span class="small">Agendar visita</span>
                                </div>

                                <a href="{{ url('/contacto?interes=' . $property->id) }}"
                                    class="btn btn-primary-custom btn-sm">
                                    Agendar
                                </a>
                            </div>

                            {{-- Llamar --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center text-secondary">
                                    <i class="lucide lucide-phone me-2"></i>
                                    <span class="small">Llamar al agente</span>
                                </div>

                                <a href="tel:3177499204" class="btn btn-outline-secondary btn-sm rounded-pill">
                                    Llamar
                                </a>
                            </div>
                        </div>

                        {{-- Compartir --}}
                        <div class="mt-4 pt-4 border-top">
                            <a href="javascript:void(0)"
                                onclick="navigator.clipboard.writeText(window.location.href); alert('Enlace copiado!');"
                                class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill">
                                <i class="lucide lucide-share"></i>
                                Compartir propiedad
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
