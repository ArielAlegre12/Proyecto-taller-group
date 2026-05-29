<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Huellas Felices - Tienda para animales">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Huellas Felices')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="icon" href="{{ asset('images/logoSF.png') }}" type="image/png">
    @stack('styles')


</head>

<body class="d-flex flex-column min-vh-100">

    <!--Cabezera-->
    <header>
        @include('partials.nav')
        @if(View::hasSection('h1'))
            <div class="header-turno">
                <div class="container">
                    <h1 class="text-center">
                        @yield('h1')
                    </h1>
                </div>
            </div>
        @endif
    </header>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('partials.footer')

    <!--menú del carrito-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="carritoCanvas">
        <div class="offcanvas-header">
            <h5>Carrito
                <i class="bi bi-cart"></i>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body" id="carrito-contenido">
            <p class="text-muted">Tu carrito está vacío</p>
        </div>
        <div id="carrito-total"></div>

        <div class="p-3 border-top">
            <button id="btn-vaciar-carrito" class="btn btn-danger w-100 mb-2" onclick="vaciarCarrito()">Vaciar carrito</button>
            <a id="btn-checkout" href="/compra" class="btn btn-success w-100" onclick="event.preventDefault(); irCheckout()">
                Seguir Compra
            </a>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="/js/global/cart.js"></script>
    <script type="module" src="{{ asset('js/global/toast.js') }}"></script>
        @if (session('success'))
            <script type="module">
                mostrarToast("{{ session('success') }}", 3000);
            </script>
        @endif

        @if (session('error'))
            <script type="module">
                mostrarToast("{{ session('error') }}", "error");
            </script>
        @endif

    @stack('scripts')
    <script src="//code.tidio.co/gadbg2xxdfpixlgurzjm4uerf2bqvwlx.js" async></script>

    <!--toast para mostrar msj en general-->
    <div class="toast-global" id="toast-global"></div>
</body>

</html>