@extends('layouts.public')

@section('title', 'Contáctanos')

@section('content')
<style>
    /* Estilos específicos para la página de contacto, si son necesarios */
    /* Usamos el color claro de fondo de tu paleta anterior */
    .contact-section-bg {
        background-color: var(--off-white-color, #f8f9fa); /* Gris muy claro */
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    /* Estilo para la tarjeta del formulario */
    .contact-form-card {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 2.5rem;
    }

    /* Ajuste de inputs para un look moderno */
    .form-control {
        border-radius: 10px;
        border-color: #e9ecef; /* Borde gris muy suave */
        padding: 0.75rem 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color, #dc3545);
        box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, 0.25); /* Sombra de enfoque sutil */
    }

    /* Importante: Necesitas las clases btn-primary-custom definidas en tu CSS principal */
</style>

<section class="contact-section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card contact-form-card">
                    <h1 class="text-center mb-5 fw-bold" style="color: var(--dark-color, #1A1A1A);">
                        Asesoría Personalizada
                    </h1>

                    <form method="POST" action="{{ route('contacto.enviar') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-medium">
                                <i class="lucide lucide-user me-1 text-primary"></i>
                                Nombre completo
                            </label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe tu nombre" required>
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="form-label fw-medium">
                                <i class="lucide lucide-mail me-1 text-primary"></i>
                                Correo electrónico
                            </label>
                            <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="asunto" class="form-label fw-medium">
                                <i class="lucide lucide-tag me-1 text-primary"></i>
                                Asunto
                            </label>
                            <select id="asunto" name="asunto" class="form-select form-control" required>
                                <option selected disabled value="">Selecciona un asunto...</option>
                                <option value="arriendo">Información sobre Arriendo</option>
                                <option value="pago">Consulta sobre Pago de Canon</option>
                                <option value="mantenimiento">Solicitud de Mantenimiento/Reparación</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>


                        <div class="mb-5">
                            <label for="mensaje" class="form-label fw-medium">
                                <i class="lucide lucide-message-square me-1 text-primary"></i>
                                Mensaje
                            </label>
                            <textarea id="mensaje" name="mensaje" rows="4" class="form-control" placeholder="Escribe tu mensaje o consulta aquí..." required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary-custom btn-lg w-75 py-2">
                                Enviar Mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="p-4 rounded border">
                    <i class="lucide lucide-phone-call text-primary-dark" style="font-size: 2rem;"></i>
                    <h5 class="mt-3 fw-bold">Llámanos</h5>
                    <p class="text-muted mb-0">+57 316 749 9204</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded border">
                    <i class="lucide lucide-map-pin text-primary-dark" style="font-size: 2rem;"></i>
                    <h5 class="mt-3 fw-bold">Oficina Principal</h5>
                    <p class="text-muted mb-0">Cra 22 # 35 - 43 Bucaramanga</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded border">
                    <i class="lucide lucide-send text-primary-dark" style="font-size: 2rem;"></i>
                    <h5 class="mt-3 fw-bold">Escríbenos</h5>
                    <p class="text-muted mb-0">rojasvalbuenainmobiliaria@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Asegúrate de que los iconos se creen si no se cargan automáticamente
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endsection