<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RV Inmobiliaria - Encuentra tu hogar ideal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Lucide -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/css/lucide.min.css">
    <style>
        :root {
            --primary-color: #dc3545;
            /* Rojo */
            --dark-color: #212529;
            /* Negro */
            --light-color: #ffffff;
            /* Blanco */
        }

        /* Fuente moderna */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar más moderno */
        .navbar {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Botones estilo pill */
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

        /* Hero diagonal */
        .hero-section {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.95), rgba(0, 0, 0, 0.9)),
                url('/images/hero-bg.jpg') center/cover no-repeat;
            padding: 8rem 0;
            border-radius: 0 0 80px 80px;
        }

        /* Buscador flotante */
        .search-card {
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        /* Propiedades */
        .property-card {
            border-radius: 20px;
            overflow: hidden;
        }

        .property-card-img {
            height: 220px;
            object-fit: cover;
            border-bottom: 5px solid #dc3545;
        }


        .property-card {
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .property-card-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .property-card:hover .property-card-img {
            transform: scale(1.05);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background-color: rgba(220, 53, 69, 0.1);
            border-radius: 50%;
        }

        .search-section {
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }

        .search-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: none;
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
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .price-tag {
            font-weight: 700;
            font-size: 1.2rem;
        }

        .badge-custom {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--primary-color);
            font-weight: 500;
            padding: 0.35rem 0.75rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="sticky-top bg-white shadow-sm">
        <div class="container py-2">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('inmobiliaria-removebg-preview.png') }}" alt="Inmobiliaria" height="60">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="/propiedades?tipo=venta">Propiedades en
                                    Venta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="/propiedades?tipo=arriendo">Propiedades en
                                    Arriendo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom text-primary-custom fw-bold" href="/pagos">Pagar
                                    Arriendo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="/contacto">Contacto</a>
                            </li>
                        </ul>

                        <div class="d-flex">
                            <a href="/login" class="btn btn-outline-primary-custom d-flex align-items-center gap-2">
                                <i class="lucide lucide-user"></i>
                                <span class="d-none d-lg-inline">Iniciar Sesión</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">Encuentra la propiedad de tus sueños</h1>
                    <p class="lead mb-5">En RV Inmobiliaria te ayudamos a encontrar el hogar perfecto con nuestra amplia
                        selección de propiedades exclusivas.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="/propiedades?tipo=venta"
                            class="btn btn-primary-custom btn-lg d-flex align-items-center gap-2">
                            <i class="lucide lucide-home"></i>
                            Propiedades en Venta
                        </a>
                        <a href="/propiedades?tipo=arriendo"
                            class="btn btn-outline-light btn-lg d-flex align-items-center gap-2">
                            <i class="lucide lucide-building"></i>
                            Propiedades en Arriendo
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="card search-card bg-white border-0 p-4 p-md-5">
                <h2 class="h3 fw-bold mb-4 text-center">Busca tu propiedad ideal</h2>
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" class="form-select">
                            <option value="todos">Todos</option>
                            <option value="venta">Venta</option>
                            <option value="arriendo">Arriendo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" placeholder="Ciudad o sector">
                    </div>
                    <div class="col-md-3">
                        <label for="precio" class="form-label">Precio Máximo</label>
                        <input type="number" class="form-control" id="precio" placeholder="Precio máximo">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit"
                            class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="lucide lucide-search"></i>
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Propiedades Destacadas</h2>
                <p class="lead text-muted">Explora nuestras mejores propiedades seleccionadas para ti</p>
            </div>

            <div class="row g-4">
                @foreach ($featuredProperties as $property)
                    <div class="col-md-6 col-lg-4">
                        <div class="card property-card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('casa.png') }}" class="property-card-img w-100"
                                    alt="{{ $property['title'] }}">
                                <span
                                    class="badge-custom position-absolute top-3 start-3">{{ ucfirst($property['type']) }}</span>
                            </div>
                            <div class="card-body">
                                <h3 class="h5 card-title fw-bold">{{ $property['title'] }}</h3>
                                <p class="card-text text-muted mb-4">{{ Str::limit($property['description'], 100) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <small class="text-muted d-flex align-items-center gap-1">
                                            <i class="lucide lucide-bed"></i>
                                            {{ $property['bedrooms'] }} Hab.
                                        </small>
                                    </div>
                                    <div>
                                        <small class="text-muted d-flex align-items-center gap-1">
                                            <i class="lucide lucide-bath"></i>
                                            {{ $property['bathrooms'] }} Baños
                                        </small>
                                    </div>
                                    <div>
                                        <small class="text-muted d-flex align-items-center gap-1">
                                            <i class="lucide lucide-maximize-2"></i>
                                            {{ $property['area'] }} m²
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <h4 class="price-tag text-primary-custom mb-0">
                                        @if ($property['type'] == 'venta')
                                            ${{ number_format($property['price'], 0, ',', '.') }}
                                        @else
                                            ${{ number_format($property['price'], 0, ',', '.') }} /mes
                                        @endif
                                    </h4>
                                    <span class="text-muted small"><i class="lucide lucide-map-pin"></i>
                                        {{ $property['location'] }}</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="#" class="btn btn-outline-primary-custom w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="/propiedades" class="btn btn-primary-custom px-4 py-2">Ver todas las propiedades</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5" style="background-color: #b4b4b4;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">¿Por qué elegir RV Inmobiliaria?</h2>
                <p class="lead text-muted">Nuestro compromiso es brindarte el mejor servicio</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 bg-transparent text-center p-4">
                        <div class="feature-icon">
                            <i class="lucide lucide-search text-primary-custom" style="font-size: 1.75rem;"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Amplia Selección</h3>
                        <p class="text-muted">
                            Contamos con el portafolio más extenso de propiedades premium en las mejores ubicaciones de
                            la ciudad.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 bg-transparent text-center p-4">
                        <div class="feature-icon">
                            <i class="lucide lucide-shield-check text-primary-custom" style="font-size: 1.75rem;"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Asesoría Experta</h3>
                        <p class="text-muted">
                            Nuestros agentes certificados te guiarán en cada paso del proceso con transparencia y
                            profesionalismo.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 bg-transparent text-center p-4">
                        <div class="feature-icon">
                            <i class="lucide lucide-award text-primary-custom" style="font-size: 1.75rem;"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Calidad Garantizada</h3>
                        <p class="text-muted">
                            Todas nuestras propiedades pasan por un riguroso proceso de verificación de calidad y
                            legalidad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Call to Action -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <div class="card border-0 shadow-lg p-5 mx-auto" style="max-width: 600px; border-radius: 20px;">
                <h3 class="mb-3">¿Quieres asesoría personalizada?</h3>
                <p class="text-muted mb-4">Conéctate con nuestros agentes certificados y encuentra la propiedad ideal
                    para ti.</p>
                <a href="/contacto" class="btn btn-primary-custom px-4 py-2">Contáctanos</a>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="footer pt-5">
        <div class="container pt-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <a href="/" class="d-flex align-items-center gap-2 mb-4 text-decoration-none">
                        <img src="logo-removebg-preview.png" alt="RV Inmobiliaria" height="60">
                    </a>
                    <p class="mb-4">
                        Líderes en el mercado inmobiliario con más de 15 años de experiencia ayudando a nuestros
                        clientes a encontrar su hogar ideal.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="lucide lucide-facebook"
                                style="font-size: 1.5rem;"></i></a>
                        <a href="#" class="text-white"><i class="lucide lucide-instagram"
                                style="font-size: 1.5rem;"></i></a>
                        <a href="#" class="text-white"><i class="lucide lucide-linkedin"
                                style="font-size: 1.5rem;"></i></a>
                        <a href="#" class="text-white"><i class="lucide lucide-twitter"
                                style="font-size: 1.5rem;"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h3 class="h5 mb-4">Enlaces Rápidos</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="/" class="nav-link p-0">Inicio</a></li>
                        <li class="nav-item mb-2"><a href="/propiedades?tipo=venta" class="nav-link p-0">Propiedades
                                en Venta</a></li>
                        <li class="nav-item mb-2"><a href="/propiedades?tipo=arriendo"
                                class="nav-link p-0">Propiedades en Arriendo</a></li>
                        <li class="nav-item mb-2"><a href="/pagos" class="nav-link p-0">Pagar Arriendo</a></li>
                        <li class="nav-item mb-2"><a href="/contacto" class="nav-link p-0">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h3 class="h5 mb-4">Contacto</h3>
                    <address>
                        <p class="mb-2 d-flex align-items-center gap-2">
                            <i class="lucide lucide-map-pin"></i> Cra 22 # 35 - 43 Bucaramanga, Colombia
                        </p>
                        <p class="mb-2 d-flex align-items-center gap-2">
                            <i class="lucide lucide-mail"></i> rojasvalbuenainmobiliaria@gmail.com
                        </p>
                        <p class="mb-0 d-flex align-items-center gap-2">
                            <i class="lucide lucide-phone"></i> +57 316 749 9204
                        </p>
                    </address>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h3 class="h5 mb-4">Horario de atención</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">Lunes a Viernes: 8:30 AM - 5:30 PM</li>
                        <li>Jornada continua</li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-secondary mt-5 pt-4 text-center">
                <p class="mb-0">&copy; {{ date('Y') }} RV Inmobiliaria. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
