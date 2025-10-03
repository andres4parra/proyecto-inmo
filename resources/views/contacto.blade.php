@extends('layouts.app')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 p-5" style="background-color: #b00000; color: white;">
                    <h2 class="fw-bold mb-4 text-center">Contáctanos</h2>
                    <form method="POST" action="{{ route('contacto.enviar') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-white">Nombre</label>
                            <input type="text" name="nombre" class="form-control bg-light text-dark border-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Correo</label>
                            <input type="email" name="correo" class="form-control bg-light text-dark border-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Mensaje</label>
                            <textarea name="mensaje" rows="5" class="form-control bg-light text-dark border-0" required></textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn px-4 py-2 fw-bold" style="background-color: white; color: #b00000;">
                                Enviar Mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
