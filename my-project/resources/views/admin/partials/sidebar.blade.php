<nav class="sticky-top flex-shrink-0 py-4 bg-black" style="min-height: 100vh;">
    <a href="#" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
        <span class="brand-name ms-4 fs-5 fw-semibold text-light">MR PENGUIN</span>
    </a>
    <div class="list-group mt-4 rounded-0">
        <a href="{{ route('dashboard.products') }}" class="list-group-item list-group-item-action border-0 bg-black @if(Request::path() == 'admin/productos') text-light @else text-muted @endif" aria-current="true">
        <i class="fa-solid fa-truck me-2"></i>
            Productos
        </a>
        <a href="{{ route('dashboard.orders') }}" class="list-group-item list-group-item-action border-0 bg-black @if(Request::path() == 'admin/pedidos') text-light @else text-muted @endif">
        <i class="fa-solid fa-rectangle-list me-2"></i>
            Pedidos
        </a>        
    </div>
</nav>