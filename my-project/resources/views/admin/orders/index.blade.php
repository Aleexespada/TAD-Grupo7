@extends('admin.layouts.index')

@section('title', 'Pedidos | Admin - Mr Penguin')

@section('section-title')
Pedidos
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item active">Pedidos</li>
</ol>
@endsection

@section('card-body')
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show px-5">
    <span class="m-0">{{ session('message') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show px-5">
    <span class="m-0">{{ session('error') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row mb-2">
    <div class="col-12">
        <div class="dropdown text-md-end">
            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if ($order == 'id' && $direction == 'asc') <i class="fa-solid fa-arrow-down-1-9"></i> ID asc.
                @elseif ($order == 'id' && $direction == 'desc') <i class="fa-solid fa-arrow-down-9-1"></i> ID desc.
                @elseif ($order == 'status' && $direction == 'asc') <i class="fa-solid fa-arrow-down-a-z"></i> Estado asc.
                @elseif ($order == 'status' && $direction == 'desc') <i class="fa-solid fa-arrow-down-z-a"></i> Estado desc.
                @elseif ($order == 'total_price' && $direction == 'asc') <i class="fa-solid fa-arrow-down-1-9"></i> Precio total asc.
                @elseif ($order == 'total_price' && $direction == 'desc') <i class="fa-solid fa-arrow-down-9-1"></i> Precio total desc.
                @elseif ($order == 'created_at' && $direction == 'asc') <i class="fa-solid fa-arrow-down-short-wide"></i> Fecha creación asc.
                @elseif ($order == 'created_at' && $direction == 'desc') <i class="fa-solid fa-arrow-down-wide-short"></i> Fecha creación desc.
                @endif
            </button>
            <ul class="order-dropdown dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['id','asc']) }}">ID asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['id','desc']) }}">ID desc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['created_at','asc']) }}">Fecha creación asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['created_at','desc']) }}">Fecha creación desc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['total_price','asc']) }}">Precio total asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['total_price','desc']) }}">Precio total desc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['status','asc']) }}">Estado asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.orders', ['status','desc']) }}">Estado desc.</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped align-translate-middle">
        <thead class="table-light">
            <tr>
                <th class="align-middle">@if($order == 'id' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'id' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif ID</th>
                <th class="align-middle">Usuario</th>
                <th class="align-middle">@if($order == 'created_at' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'created_at' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif Fecha</th>
                <th class="align-middle">@if($order == 'total_price' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'total_price' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif Total</th>
                <th class="align-middle">@if($order == 'status' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'status' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif Estado</th>
                <th class="align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }} {{ $order->user->last_name }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->total_price }} €</td>
                @if ($order->status == 'pendiente')
                <td><span class="badge text-bg-info">{{ $order->status }}</span></td>
                @elseif ($order->status == 'en proceso')
                <td><span class="badge text-bg-warning">{{ $order->status }}</span></td>
                @elseif ($order->status == 'entregado')
                <td><span class="badge text-bg-success">{{ $order->status }}</span></td>
                @elseif ($order->status == 'cancelado')
                <td><span class="badge text-bg-danger">{{ $order->status }}</span></td>
                @endif
                <td>
                    <div class="d-flex gap-3">
                        <a href="{{ route('dashboard.orders.show', $order->id) }}" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver pedido">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if ($order->status == 'pendiente')
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal-cancel-order-{{ $order->id }}">
                            <i class="fa-solid fa-ban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cancelar pedido"></i>
                        </button>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row justify-content-center text-center">
    <div class="col-auto">
        {{ $orders->links() }}
    </div>
</div>
<!-- MODALS PARA CANCELAR PEDIDOS  -->
@foreach ($orders as $order)
@if ($order->status == 'pendiente')
<div class="modal fade" id="modal-cancel-order-{{ $order->id }}" tabindex="-1" aria-labelledby="modal-cancel-order-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-cancel-order-label">
                    Cancelar Pedido</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea cancelar este pedido?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('dashboard.orders.changestatus', $order->id) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="status" value="cancelado">
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection