@extends('layouts.public')

@section('title', 'Detalle de Propiedad')

{{-- Definición de Variables (simulando la data de la propiedad) --}}
@php
    // NOTA: En una aplicación real de Laravel, esta data vendría de un controlador.
    $property = [
        'id' => '12345', // ID de la propiedad para el enlace de contacto
        'title' => "Apartamento moderno en el centro",
        'description' => "Estupendo apartamento de 2 habitaciones en el corazón de Santiago. Perfecto para profesionales que buscan comodidad y facilidades. Cuenta con una cocina moderna, sala de estar amplia y un baño completo. El apartamento está ubicado en un edificio seguro con ascensor y cerca de oficinas, restaurantes y tiendas. Ideal para quienes buscan un hogar cómodo en una zona vibrante.",
        'price' => 1200000,
        'location' => "Santiago Centro",
        'bedrooms' => 2,
        'bathrooms' => 1,
        'area' => 80,
        'type' => "arriendo",
        'imageUrl' => 'casa.png', // Usamos la imagen única
    ];

    $formatPrice = function ($price) {
        // Formato para pesos colombianos (COP)
        return '$' . number_format($price, 0, ',', '.') . ' /mes';
    };

    $features = [
        "Ascensor",
        "Seguridad 24/7",
        "Cerca de transporte público",
        "Cerca de oficinas",
        "Cerca de restaurantes",
        "Cerca de tiendas",
    ];

    // Asumimos que la ruta de contacto es 'contacto'
    $contactoRoute = '/contacto'; 
@endphp

@section('content')

<style>
    /* ... Tus estilos se mantienen ... */
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
        position: -webkit-sticky;
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
        {{-- Enlace para volver --}}
        <div class="col-12 mb-4">
            <a href="{{ route('propiedades.index') }}" class="text-secondary hover-link d-flex align-items-center gap-2 text-decoration-none">
                <i class="lucide lucide-arrow-left" style="width: 1.25rem; height: 1.25rem;"></i>
                Volver a propiedades
            </a>
        </div>

        {{-- Contenido Principal --}}
        <div class="col-lg-8">
            <div class="space-y-5">
                {{-- Galería de imágenes --}}
                <div class="bg-light rounded-3 overflow-hidden">
                    <img
                        src="{{ asset($property['imageUrl']) }}"
                        alt="{{ $property['title'] }}"
                        class="w-100 property-detail-img"
                    />
                </div>

                {{-- Información de la propiedad --}}
                <div class="card p-4 shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-danger text-white fw-bold p-2 rounded-pill">{{ $property['type'] }}</span>
                            <div class="text-muted small d-flex align-items-center">
                                <i class="lucide lucide-map-pin me-1" style="width: 1rem; height: 1rem;"></i>
                                {{ $property['location'] }}
                            </div>
                        </div>

                        <h1 class="h2 fw-bold mb-3">{{ $property['title'] }}</h1>
                        <div class="h3 fw-bolder mb-4" style="color: var(--primary-dark-color, #A32835);">
                            {{ $formatPrice($property['price']) }}
                        </div>

                        {{-- Características Clave --}}
                        <div class="d-flex flex-wrap gap-4 mb-5 border-top pt-4">
                            <div class="d-flex align-items-center text-secondary">
                                <i class="lucide lucide-bed me-2" style="width: 1.25rem; height: 1.25rem;"></i>
                                <span>{{ $property['bedrooms'] }} Habitaciones</span>
                            </div>
                            <div class="d-flex align-items-center text-secondary">
                                <i class="lucide lucide-bath me-2" style="width: 1.25rem; height: 1.25rem;"></i>
                                <span>{{ $property['bathrooms'] }} Baños</span>
                            </div>
                            <div class="d-flex align-items-center text-secondary">
                                <i class="lucide lucide-maximize-2 me-2" style="width: 1.25rem; height: 1.25rem;"></i>
                                <span>{{ $property['area'] }} m²</span>
                            </div>
                        </div>
                        
                        {{-- Sección Descripción --}}
                        <div class="border-top pt-4">
                            <h2 class="h4 fw-bold mb-3">Descripción</h2>
                            <p class="text-muted" style="white-space: pre-line;">{{ $property['description'] }}</p>
                        </div>

                        {{-- Sección Características --}}
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
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar (Formulario de Contacto) --}}
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card sticky-card border-0">
                <div class="card-body p-4">
                    <h2 class="h5 fw-bold mb-3">¿Te interesa esta propiedad?</h2>
                    <p class="text-muted small mb-4">
                        Puedes contactarnos llenando el formulario o agendando una visita.
                    </p>
                    
                    {{-- Botón principal: Contactar (Lleva a la vista de Contacto) --}}
                    {{-- Le pasamos el ID de la propiedad como parámetro 'interes' --}}
                    <a href="{{ url($contactoRoute . '?interes=' . $property['id']) }}" class="btn btn-primary-custom w-100 py-2 mb-4">
                        Contactar sobre esta propiedad
                    </a>

                    {{-- Opciones Adicionales --}}
                    <div class="pt-4 border-top">
                        <h6 class="fw-bold mb-3">Acciones Rápidas</h6>
                        
                        {{-- Agendar Visita (Lleva a la vista de Contacto) --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center text-secondary">
                                <i class="lucide lucide-calendar me-2" style="width: 1.2rem; height: 1.2rem;"></i>
                                <span class="small">Agendar visita</span>
                            </div>
                            {{-- Se redirige a contacto con un flag 'agenda' y el ID de la propiedad --}}
                            <a href="{{ url($contactoRoute . '?agenda=true&interes=' . $property['id']) }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                                Agendar
                            </a>
                        </div>
                        
                        {{-- Llamar al Agente (Llamada directa) --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center text-secondary">
                                <i class="lucide lucide-phone me-2" style="width: 1.2rem; height: 1.2rem;"></i>
                                <span class="small">Llamar al agente</span>
                            </div>
                            <a href="tel:3177499204" class="btn btn-outline-secondary btn-sm rounded-pill">
                                Llamar
                            </a>
                        </div>
                    </div>
                    
                    {{-- Compartir --}}
                    <div class="mt-4 pt-4 border-top">
                         <a href="javascript:void(0)" onclick="navigator.clipboard.writeText(window.location.href); alert('Enlace copiado al portapapeles!');" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill">
                            <i class="lucide lucide-share" style="width: 1.1rem; height: 1.1rem;"></i>
                            Compartir propiedad
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection