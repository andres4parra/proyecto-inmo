@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Imagen -->
            <div class="col-lg-6">
                <img src="{{ asset('images/casa.png') }}" class="img-fluid rounded shadow" alt="{{ $property->titulo }}">
            </div>

            <!-- Info -->
            <div class="col-lg-6">
                <h1 class="fw-bold">{{ $property->titulo }}</h1>
                <p class="text-muted">{{ $property->ubicacion }}</p>
                <h3 class="text-primary-custom fw-bold mb-3">
                    ${{ number_format($property->precio, 0, ',', '.') }}
                </h3>

                <ul class="list-unstyled mb-4">
                    <li><strong>Habitaciones:</strong> {{ $property->habitaciones }}</li>
                    <li><strong>Baños:</strong> {{ $property->banos }}</li>
                    <li><strong>Área:</strong> {{ $property->area }} m²</li>
                </ul>

                <p>{{ $property->descripcion }}</p>

                <a href="/contacto" class="btn btn-primary-custom px-4 py-2">Contactar un Agente</a>
            </div>
        </div>
    </div>
</section>
@endsection
