<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <!--logo-->
        <a href="/" class="navbar-brand d-flex align-items-center gap-2">
            <div class="logo-circle">
                <img src="{{ asset('images/logoSF.png') }}" class="img-logo">
            </div>
            <span class="brand-text">Huellas Felices</span>
        </a>

        <!--derecha(mobile)carrito+toggler--->
        <div class="d-flex align-items-center gap-3 ms-auto">

            <!--carrito-->
            @auth
                <div class="position-relative d-lg-none">
                    <a href="#" class="text-dark fs-5" data-bs-toggle="offcanvas" data-bs-target="#carritoCanvas">
                        <i class="bi bi-cart carrito"></i>
                    </a>
                    <span class="cart-badge contador-carrito">0</span>
                </div>
            @endauth

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
                    @guest
                        <a href="/login" class="btn-login w-100 text-center d-block">Login</a>
                    @endguest

                    <div class="d-lg-none mt-3 px-3">
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle w-100" type="button"
                                    data-bs-toggle="dropdown">
                                    {{ Auth::user()->nombre }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    @if (Auth::user()->rol_id == 1)
                                        <li>
                                            <a href="#" class="dropdown-item">Panel de administración</a>
                                        </li>

                                    @else
                                        <li>
                                            <a class="dropdown-item" href="#">Mi perfil</a>
                                        </li>
                                    @endif
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="/login" class="btn-login w-100 text-center d-block">
                                Login
                            </a>
                        @endauth

                    </div>
                </div>
            </ul>

            <!--derecha desktop-->
            <div class="d-none d-lg-flex align-items-center gap-3">

                <!--carrito desktop--->
                @auth
                <div class="position-relative">
                    <a href="#" class="text-dark fs-5" data-bs-toggle="offcanvas" data-bs-target="#carritoCanvas">
                        <i class="bi bi-cart3 carrito"></i>
                    </a>
                    <span class="cart-badge  contador-carrito">0</span>
                </div>
                @endauth

                <!---login desktop--->
                @guest
                <a href="/login" class="btn btn-success px-4 rounded-3">Login</a>
                @endguest

                @auth
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle px-4 rounded-3" data-bs-toggle="dropdown">
                        {{ Auth::user()->nombre }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (Auth::user()->rol_id == 1)
                        <li>
                            <a href="#" class="dropdown-item">Panel de administración</a>
                        </li>
                        @else
                        <li>
                            <a href="/perfil" class="dropdown-item">Mi perfil</a>
                        </li>
                        @endif
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>