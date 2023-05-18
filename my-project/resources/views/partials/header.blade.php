<header class="sticky-top">
    <nav class="navbar navbar-dark bg-dark p-sm-3 py-4">
        <div class="container-fluid justify-content-between p-0">
            <!-- LEFT ELEMENTS -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">@lang('header.categories')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="list-group">
                        <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action border-0" aria-current="true">
                            @lang('header.all_products')
                        </a>
                        @php
                        $categories = app('App\Http\Controllers\CategoryController')->getAllCategories();
                        @endphp
                        @foreach ($categories as $category)
                        <form class="m-0" action="{{ route('products.index') }}" method="GET">
                            <input type="hidden" name="categories[]" value="{{ $category->id }}">
                            <button type="submit" class="list-group-item list-group-item-action border-0">
                                {{ $category->name }}
                            </button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- CENTER ELEMENTS -->
            <div class="flex-row d-none d-md-flex">
                <a class="navbar-brand" href="{{ route('index') }}">
                    MR PENGUIN
                </a>
            </div>

            <!-- RIGHT ELEMENTS -->
            <ul class="navbar-nav flex-row">
                <!-- FAVORITOS -->
                <li class="nav-item me-3 me-lg-4">
                    <a class="nav-link" href="{{ route('favorites.wish-list') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="@lang('header.wishlist')">
                        <span class="me-2">
                            <i class="fa-solid fa-heart" style="font-size: 16pt;"></i>
                        </span>
                        <span class="icon-text">
                            @lang('header.wishlist')
                        </span>
                    </a>
                </li>
                <!-- CESTA -->
                <li class="nav-item me-3 me-lg-4">
                    <a class="nav-link" href="{{ route('cart.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="@lang('header.view_cart')">
                        <span class="me-2">
                            <i class="fa-solid fa-cart-shopping position-relative" style="font-size: 16pt;">
                                <span class="items-cart badge position-absolute top-0 start-100 translate-middle bg-danger border border-danger rounded-pill" style="font-size: 8pt;">
                                    @guest 0 @else {{ Auth::user()->cartItems->count() }} @endguest
                                </span>
                            </i>
                        </span>
                        <span class="icon-text">
                            @lang('header.cart')
                        </span>
                    </a>
                </li>

                @guest
                <!-- INICIAR SESIÓN / REGISTRARSE -->
                <li class="nav-item me-3 me-lg-4">
                    <a class="nav-link" href="{{ route('login') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="@lang('header.my_account')">
                        <span class="me-2">
                            <i class="fa-solid fa-user" style="font-size: 16pt;"></i>
                        </span>
                        <span class="icon-text">
                            @lang('header.my_account')
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
                        <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">@lang('header.my_account')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="accordion" id="accordionProfileOffcanvas">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        <i class="fa-solid fa-user me-2"></i>
                                        @lang('header.my_profile')
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body list-group">
                                        <a href="{{ route('profile.profile') }}" class="list-group-item list-group-item-action border-0">@lang('header.my_account')</a>
                                        <a href="{{ route('profile.changepassword') }}" class="list-group-item list-group-item-action border-0">@lang('header.change_pass')</a>
                                        <a href="{{ route('profile.addresses') }}" class="list-group-item list-group-item-action border-0">@lang('header.shipping_addresses')</a>
                                        <a href="{{ route('profile.reviews') }}" class="list-group-item list-group-item-action border-0">@lang('header.reviews')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                        <i class="fa-sharp fa-solid fa-box me-2"></i>
                                        @lang('header.orders')
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                    <div class="accordion-body list-group">
                                        <a href="{{ route('profile.orders') }}" class="list-group-item list-group-item-action border-0">@lang('header.orders')</a>
                                        <a href="{{ route('profile.canceledorders') }}" class="list-group-item list-group-item-action border-0">@lang('header.cancelled_orders')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        <i class="fa-solid fa-credit-card me-2"></i>
                                        @lang('header.payment')
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body list-group">
                                        <a href="{{ route('profile.creditcards') }}" class="list-group-item list-group-item-action border-0">@lang('header.credit_cards')</a>
                                    </div>
                                </div>
                            </div>

                            @if (Auth::user()->roles->contains('name', 'admin'))
                            <div class="accordion-item border-0 mt-3">
                                <h2 class="accordion-header">
                                    <a href="{{ route('dashboard') }}" class="accordion-button collapsed text-decoration-none text-dark" id="admin-link" type="button">
                                        <i class="fa-solid fa-gear me-2"></i>
                                        @lang('header.admin_pane')
                                    </a>
                                </h2>
                            </div>
                            @endif

                            <div class="accordion-item border-0 mt-3">
                                <h2 class="accordion-header">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="accordion-button collapsed text-decoration-none text-dark" id="signout-link" type="button">
                                        <i class="fa-sharp fa-solid fa-right-from-bracket me-2"></i>
                                        @lang('header.logout')
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-footer p-4">
                        <a class="link-dark" href="{{ url('lang/en') }}"><img src="{{ asset('img/reino-unido.png') }}" alt="Bandera reino unido">English</a> |
                        <a class="link-dark" href="{{ url('lang/es') }}"><img src="{{ asset('img/espana.png') }}" alt="Bandera españa">Español</a>
                    </div>
                </div>
                @endguest
            </ul>
        </div>
    </nav>
</header>