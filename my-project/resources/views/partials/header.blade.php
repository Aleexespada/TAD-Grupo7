<header class="sticky-top">
    <nav class="navbar navbar-light bg-light p-sm-3 py-4">
        <div class="container-fluid justify-content-between p-0">
            <!-- LEFT ELEMENTS -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    cuerpo offcanvas
                </div>
            </div>

            <!-- CENTER ELEMENTS -->
            <div class="flex-row d-none d-md-flex">
                <a class="navbar-brand" href="/">
                    NAVBAR
                </a>
            </div>

            <!-- RIGHT ELEMENTS -->
            <ul class="navbar-nav flex-row">
                <!-- FAVORITOS -->
                <li class="nav-item me-3 me-lg-4">
                    <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Lista de deseos">
                        <span class="me-2">
                            <i class="fa-solid fa-heart" style="font-size: 16pt;"></i>
                        </span>
                        <span class="icon-text">
                            Lista de deseos
                        </span>
                    </a>
                </li>
                <!-- CESTA -->
                <li class="nav-item me-3 me-lg-4">
                    <a class="nav-link" href="{{ route('cart.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver cesta">
                        <span class="me-2">
                            <i class="fa-solid fa-cart-shopping position-relative" style="font-size: 16pt;">
                                <span class="items-cart badge position-absolute top-0 start-100 translate-middle bg-danger border border-light rounded-pill" style="font-size: 8pt;">
                                    @guest 0 @else {{ Auth::user()->cartItems->count() }} @endguest
                                </span>
                            </i>
                        </span>
                        <span class="icon-text">
                            Mi cesta
                        </span>
                    </a>
                </li>

                @guest
                <!-- INICIAR SESIÓN / REGISTRARSE -->
                <li class="nav-item me-3 me-lg-4">
                    <a class="nav-link" href="{{ route('login') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Mi cuenta">
                        <span class="me-2">
                            <i class="fa-solid fa-user" style="font-size: 16pt;"></i>
                        </span>
                        <span class="icon-text">
                            Mi cuenta
                        </span>
                    </a>
                </li>
                @else
                <!-- PERFIL -->
                <button id="profileNavbarToggler" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile" aria-label="Toggle navigation">
                    {{ Auth::user()->name }}
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Mi cuenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="accordion" id="accordionProfileOffcanvas">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        <i class="fa-solid fa-user me-2"></i>
                                        Mi cuenta
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body list-group">
                                        <a href="#" class="list-group-item list-group-item-action border-0">Mis datos</a>
                                        <a href="#" class="list-group-item list-group-item-action border-0">Métodos de pago</a>
                                        <a href="#" class="list-group-item list-group-item-action border-0">Opiniones</a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                        <i class="fa-sharp fa-solid fa-box me-2"></i>
                                        Pedidos
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                    <div class="accordion-body list-group">
                                        <a href="#" class="list-group-item list-group-item-action border-0">Pedidos</a>
                                        <a href="#" class="list-group-item list-group-item-action border-0">Pedidos cancelados</a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        <i class="fa-solid fa-credit-card me-2"></i>
                                        Pago
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body list-group">
                                        <a href="#" class="list-group-item list-group-item-action border-0">Tarjetas vinculadas</a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="accordion-button collapsed text-decoration-none" id="signout-link" type="button">
                                        <i class="fa-sharp fa-solid fa-right-from-bracket me-2"></i>
                                        Cerrar sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                @endguest
            </ul>
        </div>
    </nav>
</header>