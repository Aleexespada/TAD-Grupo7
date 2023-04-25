<header class="sticky-top">
    <nav class="navbar navbar-dark bg-black p-sm-3 py-4">
        <div class="container-fluid justify-content-between p-0">
            <!-- LEFT ELEMENTS -->
            <button class="navbar-toggler btn btn-dark border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
            </button>

            <!-- RIGHT ELEMENTS -->
            <div class="navbar-nav flex-row">
                <button id="adminNavbarToggler" class="py-2 btn btn-dark border-0 navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAdmin" aria-controls="offcanvasAdmin" aria-label="Toggle navigation">
                    {{ Auth::user()->name }}
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAdmin" aria-labelledby="offcanvasProfileLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Opciones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="accordion" id="accordionProfileOffcanvas">
                            <div class="accordion-item border-0 mt-3">
                                <h2 class="accordion-header">
                                    <a href="{{ route('index') }}" class="accordion-button collapsed text-decoration-none text-dark" id="admin-link" type="button">
                                        <i class="fa-solid fa-basket-shopping me-2"></i>
                                        Volver a la tienda
                                    </a>
                                </h2>
                            </div>

                            <div class="accordion-item border-0 mt-3">
                                <h2 class="accordion-header">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="accordion-button collapsed text-decoration-none text-dark" id="signout-link" type="button">
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
            </div>
        </div>
    </nav>
</header>