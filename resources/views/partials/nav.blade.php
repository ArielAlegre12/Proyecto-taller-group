<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <!--logo-->
        <a href="/" class="navbar-brand d-flex align-items-center gap-2">
            <div class="logo-circle">
                <i class="bi bi-clipboard-pulse"></i>
            </div>
            <span class="brand-text">Huellas Felices</span>
        </a>

        <!--derecha(mobile)carrito+toggler--->
        <div class="d-flex align-items-center gap-3 ms-auto">

            <!--carrito-->
            <div class="position-relative d-lg-none">
                <a href="#" class="text-dark fs-5"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#carritoCanvas">
                    <i class="bi bi-cart carrito"></i>
                </a>
                <span class="cart-badge contador-carrito">0</span>
            </div>

            <!--toggler--->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-3"></i>
            </button>
        </div>

        <!--collapse(links) + pantalla desktop--->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!--links--->
            <ul class="navbar-nav mx-auto gap-lg-4 text-center">

                <li class="nav-item">
                    <a href="/principal" class="nav-link {{ request()->is('principal') ? 'active' : '' }}">Inicio</a>
                </li>

                <li class="nav-item">
                    <a href="/servicios" class="nav-link {{ request()->is('servicios') ? 'active' : '' }}">Servicios</a>
                </li>

                <li class="nav-item">
                    <a href="/tienda" class="nav-link {{ request()->is('tienda') ? 'active' : '' }}">Tienda</a>
                </li>
                <!--login mobile oculto en desktop-->
                <div class="d-lg-none mt-3 px-3">
                    <a href="/login" class="btn-login w-100 text-center d-block">Login</a>
                </div>
            </ul>

            <!--derecha desktop-->
            <div class="d-none d-lg-flex align-items-center gap-3">

                <!--carrito desktop--->
                <div class="position-relative">
                    <a href="#" class="text-dark fs-5"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#carritoCanvas">
                        <i class="bi bi-cart3 carrito"></i>
                    </a>
                    <span class="cart-badge  contador-carrito">0</span>
                </div>

                <!---login desktop--->
                <a href="/login" class="btn btn-success px-4 rounded-3">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>