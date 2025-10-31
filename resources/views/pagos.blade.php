@extends('layouts.public')

@section('title', 'Página de Pagos de Arriendo')

@section('content')

<style>
    /* Definición de Colores de la Marca (Rojas Valbuena Inmobiliaria) */
    :root {
        --rojas-primary: var(--primary-color, #dc3545); /* Rojo fuerte (asumiendo tu color principal) */
        --rojas-dark: #343a40; /* Negro o Gris oscuro para texto/énfasis */
        --rojas-light-bg: #f8d7da; /* Fondo rojo muy claro para alerta */
        --rojas-light-border: #f5c6cb; /* Borde rojo claro */
        --rojas-info-text: #6c757d; /* Gris para la nota informativa */
    }

    /* Contenedor principal del formulario */
    .payment-container {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background-color: #ffffff;
    }

    /* Estilos del Botón Principal (ROJO) */
    .btn-pay {
        background-color: var(--rojas-primary); 
        border-color: var(--rojas-primary);
        color: white; 
        font-weight: 700;
        border-radius: 50px;
    }
    .btn-pay:hover {
        background-color: #a32835; 
        border-color: #a32835;
    }
    
    /* Estilos para campos de texto (placeholder) */
    .form-control {
        font-size: 1rem;
    }
    
    /* Icono principal (Banco/Pagos) */
    .main-icon {
        color: var(--rojas-primary); 
    }

    /* Adaptación de la alerta de Bootstrap al tema Rojo/Blanco */
    .custom-alert {
        background-color: var(--rojas-light-bg); 
        border-color: var(--rojas-light-border);
        color: var(--rojas-dark); 
        font-size: 0.95rem;
    }
    .custom-alert i {
        color: var(--rojas-primary); 
    }
    
    /* Enlace Cancelar y volver */
    .text-secondary {
        color: #6c757d !important; 
    }
    .text-secondary:hover {
        color: var(--rojas-primary) !important; 
    }

    /* Estilo para la nota de carga automática del monto */
    .amount-info {
        color: var(--rojas-info-text);
        font-style: italic;
        font-size: 0.9rem;
        padding: 5px 0 10px 0;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            
            <div class="payment-container p-5">
                <div class="text-center mb-4">
                    {{-- Icono principal --}}
                    <i class="lucide lucide-banknote h1 mb-3 main-icon" style="width: 3rem; height: 3rem;"></i>
                    <h1 class="h3 fw-bold mb-1">Pago de Canon de Arriendo</h1>
                    <p class="text-muted">Procesa tu pago mensual de forma segura.</p>
                </div>

                {{-- Formulario de Pago --}}
                <form action="#" method="POST">
                    @csrf 

                    {{-- CAMPO: Nombre o ID del Arrendatario --}}
                    <div class="mb-4">
                        <label for="tenant_name" class="form-label fw-bold small">Nombre Completo o Documento de Identidad (ID)</label>
                        <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Ej: Juan Pérez o 12.345.678-9" required>
                    </div>
                    
                    {{-- NOTA: El monto se carga automáticamente --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Monto a Pagar</label>
                        {{-- Texto indicando que el monto se cargará --}}
                        <p class="amount-info">El valor de tu arriendo mensual será cargado automáticamente al presionar "Continuar a la Pasarela".</p>
                    </div>

                    {{-- Alerta de Seguridad --}}
                    <div class="custom-alert d-flex align-items-center gap-2 small" role="alert">
                        <i class="lucide lucide-lock" style="width: 1rem; height: 1rem;"></i>
                        Serás redirigido a nuestra pasarela de pago certificada.
                    </div>

                    {{-- Botón de Acción --}}
                    <button type="submit" class="btn btn-pay w-100 py-3 mt-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="lucide lucide-credit-card" style="width: 1.1rem; height: 1.1rem;"></i>
                        Continuar a la Pasarela
                    </button>
                </form>
                
                <div class="text-center mt-3">
                    <a href="{{ url()->previous() }}" class="text-secondary small text-decoration-none">
                        Cancelar y volver
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection