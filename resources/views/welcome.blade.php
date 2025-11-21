<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RV Inmobiliaria - Encuentra tu hogar ideal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/css/lucide.min.css">
    <style>
        :root {
            --primary-color: #dc3545;
            --primary-dark-color: #A32835;
            --dark-color: #1A1A1A;
            --light-color: #ffffff;
            --off-white-color: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
        }

        .navbar {
            border-radius: 0;
            padding: 0.75rem 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn {
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom {
            background: linear-gradient(90deg, var(--primary-dark-color), var(--primary-color));
            border: none;
            font-weight: 600;
            color: var(--light-color);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
            background: linear-gradient(90deg, #ff4d5e, var(--primary-dark-color));
        }

        .btn-outline-primary-custom {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary-custom:hover {
            background-color: var(--primary-color);
            color: var(--light-color);
            border-color: var(--primary-color);
        }

        .hero-section {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.85), rgba(26, 26, 26, 0.85)),
                url('/images/hero-bg.jpg') center/cover no-repeat;
            padding: 8rem 0;
            border-radius: 0 0 50px 50px;
            color: var(--light-color);
        }

        .hero-section h1 {
            color: var(--light-color);
        }

        .search-section {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .search-card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            background-color: var(--light-color);
        }

        .property-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .property-card-img {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .property-card:hover .property-card-img {
            transform: scale(1.03);
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
            color: #adb5bd;
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
            font-size: 1.3rem;
            color: var(--primary-dark-color);
        }

        .badge-custom {
            background-color: var(--primary-color);
            color: var(--light-color);
            font-weight: 600;
            padding: 0.4rem 0.9rem;
            border-radius: 50px;
        }

        .section-subtle-bg {
            background-color: var(--off-white-color);
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="sticky-top bg-white">
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
                            <li class="nav-item"><a class="nav-link nav-link-custom" href="/propiedades">Propiedades</a></li>
                            <li class="nav-item"><a class="nav-link nav-link-custom" href="/pagos">Pagar Arriendo</a></li>
                            <li class="nav-item"><a class="nav-link nav-link-custom" href="/contacto">Contacto</a></li>
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

    <!-- HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-4 fw-bold mb-4">Encuentra la propiedad de tus sueños</h1>
                    <p class="lead mb-5 text-white-50">
                        En Rojas Valbuena Inmobiliaria te ayudamos a encontrar el hogar perfecto con nuestra amplia selección de propiedades exclusivas en arriendo.
                    </p>
                    <a href="/propiedades" class="btn btn-primary-custom btn-lg d-flex align-items-center gap-2">
                        <i class="lucide lucide-building"></i>
                        Explorar Propiedades
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- BUSCADOR -->
    <section class="search-section">
        <div class="container">
            <div class="card search-card p-4 p-md-5">
                <h2 class="h3 fw-bold mb-4 text-center">Busca tu propiedad ideal</h2>
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="inmueble" class="form-label">Tipo de Inmueble</label>
                        <select id="inmueble" class="form-select">
                            <option value="todos">Cualquier tipo</option>
                            <option value="apartamento">Apartamento</option>
                            <option value="casa">Casa</option>
                            <option value="oficina">Oficina</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" placeholder="Ciudad o sector">
                    </div>
                    <div class="col-md-3">
                        <label for="precio" class="form-label">Precio Máximo (COP)</label>
                        <input type="number" class="form-control" id="precio" placeholder="Precio máximo">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="lucide lucide-search"></i> Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- PROPIEDADES DESTACADAS -->
    <section class="py-5 section-subtle-bg">
        <div class="container py-5 text-center">
            <h2 class="display-5 fw-bold mb-3">Propiedades Destacadas</h2>
            <p class="lead text-muted mb-5">Explora nuestras mejores propiedades seleccionadas para ti</p>
            <div class="row g-4">
                @foreach ($featuredProperties->take(3) as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card property-card h-100 border-0 shadow-sm">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset('casa.png') }}" class="property-card-img w-100" alt="{{ $property->titulo }}">
                            <span class="badge-custom position-absolute top-3 start-3">Arriendo</span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 fw-bold">{{ $property->titulo }}</h3>
                            <p class="text-muted mb-3">{{ Str::limit($property->descripcion, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center small text-secondary mb-3">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="lucide lucide-bed"></i> {{ $property->habitaciones }} Hab.
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="lucide lucide-bath"></i> {{ $property->banos }} Baños
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="lucide lucide-maximize-2"></i> {{ $property->area }} m²
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h4 class="price-tag mb-0">${{ number_format($property->precio,0,',','.') }}/mes</h4>
                                <span class="text-muted small"><i class="lucide lucide-map-pin"></i> {{ $property->ubicacion }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ route('propiedades.show', ['id'=>$property->id]) }}" class="btn btn-outline-primary-custom w-100">Ver Detalles</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- POR QUÉ ELEGIRNOS -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-3">¿Por qué elegir RV Inmobiliaria?</h2>
            <p class="lead text-muted mb-5">Nuestro compromiso es brindarte el mejor servicio</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 bg-transparent text-center p-4">
                        <div class="feature-icon"><i class="lucide lucide-search text-primary"></i></div>
                        <h3 class="h4 fw-bold mb-3">Amplia Selección</h3>
                        <p class="text-muted">Contamos con el portafolio más extenso de propiedades premium.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 bg-transparent text-center p-4">
                        <div class="feature-icon"><i class="lucide lucide-shield-check text-primary"></i></div>
                        <h3 class="h4 fw-bold mb-3">Asesoría Experta</h3>
                        <p class="text-muted">Nuestros agentes certificados te guiarán en cada paso del proceso.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 bg-transparent text-center p-4">
                        <div class="feature-icon"><i class="lucide lucide-award text-primary"></i></div>
                        <h3 class="h4 fw-bold mb-3">Calidad Garantizada</h3>
                        <p class="text-muted">Todas nuestras propiedades pasan por un riguroso proceso de verificación.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ASESORÍA PERSONALIZADA -->
    <section class="py-5 section-subtle-bg">
        <div class="container text-center">
            <div class="card border-0 shadow-lg p-5 mx-auto" style="max-width: 600px; border-radius: 20px;">
                <h3 class="mb-3 fw-bold">¿Quieres asesoría personalizada?</h3>
                <p class="text-muted mb-4">Conéctate con nuestros agentes certificados y encuentra la propiedad ideal para ti.</p>
                <a href="/contacto" class="btn btn-primary-custom px-5 py-3 fw-bold">Contáctanos</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer pt-5">
        <div class="container pt-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <a href="/" class="d-flex align-items-center gap-2 mb-4 text-decoration-none">
                        <img src="logo-removebg-preview.png" alt="RV Inmobiliaria" height="60">
                    </a>
                    <p class="mb-4">Líderes en el mercado inmobiliario con más de 15 años de experiencia.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="lucide lucide-facebook"></i></a>
                        <a href="#" class="text-light"><i class="lucide lucide-instagram"></i></a>
                        <a href="#" class="text-light"><i class="lucide lucide-linkedin"></i></a>
                        <a href="#" class="text-light"><i class="lucide lucide-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h3 class="h5 mb-4 text-white">Enlaces Rápidos</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="/" class="nav-link p-0">Inicio</a></li>
                        <li class="nav-item mb-2"><a href="/propiedades" class="nav-link p-0">Propiedades</a></li>
                        <li class="nav-item mb-2"><a href="/pagos" class="nav-link p-0">Pagar Arriendo</a></li>
                        <li class="nav-item mb-2"><a href="/contacto" class="nav-link p-0">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h3 class="h5 mb-4 text-white">Contacto</h3>
                    <address>
                        <p class="mb-2 d-flex align-items-center gap-2"><i class="lucide lucide-map-pin"></i> Cra 22 # 35 - 43 Bucaramanga, Colombia</p>
                        <p class="mb-2 d-flex align-items-center gap-2"><i class="lucide lucide-mail"></i> rojasvalbuenainmobiliaria@gmail.com</p>
                        <p class="mb-0 d-flex align-items-center gap-2"><i class="lucide lucide-phone"></i> +57 316 749 9204</p>
                    </address>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h3 class="h5 mb-4 text-white">Horario de atención</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">Lunes a Viernes: 8:30 AM - 5:30 PM</li>
                        <li>Jornada continua</li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-secondary mt-5 pt-4 text-center">
                <p class="mb-0 text-muted">&copy; {{ date('Y') }} RV Inm
