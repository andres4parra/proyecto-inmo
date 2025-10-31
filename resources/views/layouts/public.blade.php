<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rojas Valbuena Inmobiliaria - Encuentra tu hogar ideal')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos Lucide -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/css/lucide.min.css">

    <!-- Fuente moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #dc3545;
            --dark-color: #212529;
            --light-color: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn {
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom {
            background: linear-gradient(45deg, #dc3545, #ff4d5e);
            border: none;
        }

        .btn-primary-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        .nav-link-custom {
            color: var(--dark-color);
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            margin: 0 1rem;
        }

        .nav-link-custom:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover:after,
        .nav-link-custom.active:after {
            width: 100%;
        }

        .footer {
            background-color: var(--dark-color);
            color: var(--light-color);
            margin-top: 5rem;
            padding: 3rem 0;
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>

    <!-- 🔹 NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger" href="{{ url('/') }}">Rojas Valbuena Inmobiliaria</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('propiedades*') ? 'active' : '' }}" href="{{ url('/propiedades') }}">Propiedades</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('contacto') ? 'active' : '' }}" href="{{ url('/contacto') }}">Contacto</a></li>
                    <li class="nav-item"><a class="btn btn-primary-custom px-3 text-white" href="{{ route('login') }}">Iniciar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 🔹 CONTENIDO -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- 🔹 FOOTER -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-2">© {{ date('Y') }} Rojas Valbuena Inmobiliaria - Todos los derechos reservados</p>
            <a href="{{ url('/contacto') }}">Contáctanos</a> |
            <a href="{{ url('/propiedades') }}">Propiedades</a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
