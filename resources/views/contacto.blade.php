@extends('layouts.public')

@section('title', 'Contáctanos')

@section('content')
    <style>
        /* Estilos específicos para la página de contacto, si son necesarios */
        /* Usamos el color claro de fondo de tu paleta anterior */
        .contact-section-bg {
            background-color: var(--off-white-color, #f8f9fa);
            /* Gris muy claro */
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
            border-color: #e9ecef;
            /* Borde gris muy suave */
            padding: 0.75rem 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color, #dc3545);
            box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, 0.25);
            /* Sombra de enfoque sutil */
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
                        {{-- Mensaje de éxito --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="lucide lucide-check-circle"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Cerrar"></button>
                            </div>
                        @endif


                        {{-- Usamos la ruta 'contacto.enviar' que es la que se usó en el controlador corregido --}}
                        <form method="POST" action="{{ route('contacto.enviar') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label fw-medium">
                                    <i class="lucide lucide-user me-1 text-primary"></i>
                                    Nombre completo
                                </label>
                                {{-- NAME: 'name' (COINCIDE CON LA DB) --}}
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Escribe tu nombre" required value="{{ old('name') }}">
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label fw-medium">
                                    <i class="lucide lucide-smartphone me-1 text-primary"></i>
                                    Número de Celular / WhatsApp
                                </label>
                                {{-- NAME: 'phone' (COINCIDE CON LA DB) --}}
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="Ej: 316 123 4567" required value="{{ old('phone') }}">
                                <div class="form-text text-muted mt-1">
                                    Asegúrate de incluir el código de área (si aplica). Usaremos este número para WhatsApp.
                                </div>
                            </div>

                            {{-- ELIMINADO: No necesitamos el campo oculto "senderEmail" ya que no existe en tu tabla de DB. --}}
                            {{-- <input type="hidden" name="senderEmail" value="no-provided@inmobiliaria.com"> --}}

                            <div class="mb-4">
                                <label for="subject" class="form-label fw-medium">
                                    <i class="lucide lucide-tag me-1 text-primary"></i>
                                    Asunto
                                </label>
                                <select id="subject" name="subject" class="form-select form-control" required>
                                    <option selected disabled value="">Selecciona un asunto...</option>
                                    <option value="Información sobre Arriendo">Información sobre Arriendo</option>
                                    <option value="Consulta sobre Pago de Canon">Consulta sobre Pago de Canon</option>
                                    <option value="Solicitud de Mantenimiento/Reparación">Solicitud de
                                        Mantenimiento/Reparación</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>


                            <div class="mb-5">
                                <label for="message" class="form-label fw-medium">
                                    <i class="lucide lucide-message-square me-1 text-primary"></i>
                                    Mensaje
                                </label>
                                <textarea id="message" name="message" rows="4" class="form-control"
                                    placeholder="Escribe tu mensaje o consulta aquí..." required>{{ old('message') }}</textarea>
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
