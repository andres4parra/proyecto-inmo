<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --color-rojo: #d32f2f;
            --color-negro: #000000;
            --color-blanco: #ffffff;
        }

        body {
            background-color: var(--color-blanco);
            color: var(--color-negro);
        }

        .navbar {
            background-color: var(--color-negro) !important;
        }

        .navbar-brand img {
            height: 50px;
        }

        .btn-primary {
            background-color: var(--color-rojo);
            border-color: var(--color-rojo);
        }

        .btn-primary:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }

        .section-title {
            color: var(--color-rojo);
            font-weight: bold;
        }

        footer {
            background-color: var(--color-negro);
            color: var(--color-blanco);
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Logo Inmobiliaria"
                    style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold"
                            href="{{ route('propiedades.index') }}">Propiedades</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold"
                            href="{{ route('contacto.form') }}">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Contenido dinámico -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Inmobiliaria. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
