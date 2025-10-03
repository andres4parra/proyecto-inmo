@extends('layouts.app')

@section('content')
    <h1 class="section-title mb-4">Nuestras Propiedades</h1>
    <div class="row g-4">
        @foreach ($propiedades as $propiedad)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('casa.png') }}" class="card-img-top" alt="{{ $propiedad->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $propiedad->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($propiedad->descripcion, 80) }}</p>
                        <p class="fw-bold text-danger">${{ number_format($propiedad->precio, 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
