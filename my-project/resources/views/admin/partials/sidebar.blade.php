<nav class="sticky-top flex-shrink-0 py-4 bg-black min-vh-100">
    <a href="{{ route('index') }}" class="d-flex align-items-center px-3 px-md-4 pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
        <span class="brand-name fs-5 fw-semibold text-light d-none d-lg-block">MR PENGUIN</span>
        <img class="img-fluid d-md-block d-lg-none" src="{{ asset('img/logo.png') }}" alt="" style="height: 50px;">
    </a>
    <div class="list-group mt-4 rounded-0">
        <a href="{{ route('dashboard.products') }}" class="list-group-item list-group-item-action border-0 bg-black @if(Request::path() == 'admin/productos') text-light @else text-muted @endif" aria-current="true">
            <i class="fa-solid fa-truck me-2" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Productos"></i>
            <span class="d-none d-lg-inline">Productos</span>
        </a>
        <a href="{{ route('dashboard.orders') }}" class="list-group-item list-group-item-action border-0 bg-black @if(Request::path() == 'admin/pedidos') text-light @else text-muted @endif">
            <i class="fa-solid fa-rectangle-list me-2" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Pedidos"></i>
            <span class="d-none d-lg-inline">Pedidos</span>
        </a>        
    </div>
</nav>