<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <!--logo-->
        <a href="/" class="navbar-brand d-flex align-items-center gap-2">
            <div class="logo-circle">
                <i class="bi bi-clipboard-pulse"></i>
            </div>
            <span class="fw semibold-text-success">Huellas Felices</span>
        </a>

        <!--btn mobile-->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-3"></i>
        </button>

        <!---contenido-->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!--links-->
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
            </ul>

            <!--derecha-->
            <div class="d-flex align-items-center gap-3 justify-content-center mt-3 mt-lg-0">

                <!--carrito-->
                <div class="position-relative">
                    <a href="#" class="text-dark fs-5">
                        <i class="carrito bi bi-cart3"></i>
                    </a>
                    <span class="cart-badge">0</span>
                </div>

                <!--btn login-->
                <a href="/login" class="btn btn-success px-4 rounded-3">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>