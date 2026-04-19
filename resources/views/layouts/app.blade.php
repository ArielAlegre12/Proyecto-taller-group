<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Huellas Felices - Tienda para animales">
    <title>@yield('title', 'Huellas Felices')</title>
    <link rel="preload" as="image" href="{{ asset('images/carrusel/slide1.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('images/carrusel/slide2.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('images/carrusel/slide3.jpg') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @stack('styles')


</head>

<body class="d-flex flex-column min-vh-100">

    <!--Cabezera-->
    <header>
        @include('partials.nav')
        <div class="header-turno">
            <div class="container">
                <h1 class="text-center">@yield('h1', 'Bienvenido')</h1>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>

</html>