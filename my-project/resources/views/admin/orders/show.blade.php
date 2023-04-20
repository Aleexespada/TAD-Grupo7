@extends('admin.layouts.show')

@section('title', 'Pedido ID - ' . $order->id . ' | Admin - Mr Penguin')

@section('section-title')
Pedido ID - {{ $order->id }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.orders') }}" class="text-black">Pedidos</a></li>
    <li class="breadcrumb-item active">Pedido ID - {{ $order->id }}</li>
</ol>
@endsection

@section('card-body')

<!-- CHANGE STATUS -->
<div class="row">
    <div class="col-md-3 mt-1">
        <form action="{{ route('dashboard.orders.changestatus', $order->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="status" value="pendiente">
            <button type="submit" class="btn btn-outline-dark w-100">Pendiente</button>
        </form>
    </div>
    <div class="col-md-3 mt-1">
        <form action="{{ route('dashboard.orders.changestatus', $order->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="status" value="en proceso">
            <button type="submit" class="btn btn-outline-dark w-100">En proceso</button>
        </form>
    </div>
    <div class="col-md-3 mt-1">
        <form action="{{ route('dashboard.orders.changestatus', $order->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="status" value="entregado">
            <button type="submit" class="btn btn-outline-dark w-100">Entregado</button>
        </form>
    </div>
    <div class="col-md-3 mt-1">
        <form action="{{ route('dashboard.orders.changestatus', $order->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="status" value="cancelado">
            <button type="submit" class="btn btn-outline-danger w-100">Cancelado</button>
        </form>
    </div>
</div>

<!-- MESSAGES -->
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show px-5 mt-3">
    <span class="m-0">{{ session('message') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show px-5 mt-3">
    <span class="m-0">{{ session('error') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- INFORMATION -->
<form id="showOrderForm" class="row g-3 mt-4">
    <div class="col-12">
        <h5 class="info-section">Usuario</h5>
    </div>

    <!-- NAME USER -->
    <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" value="{{ $order->user->name }} {{ $order->user->last_name }}" readonly>
    </div>

    <!-- EMAIL USER -->
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" value="{{ $order->user->email }}" readonly>
    </div>

    <div class="col-12">
        <h5 class="info-section">Información pedido</h5>
    </div>

    <!-- STATUS -->
    <div class="col-md-2">
        <p class="form-label">Estado</p>
        @if ($order->status == 'pendiente')
        <p class="badge text-bg-info">{{ $order->status }}</p>
        @elseif ($order->status == 'en proceso')
        <p class="badge text-bg-warning">{{ $order->status }}</p>
        @elseif ($order->status == 'entregado')
        <p class="badge text-bg-success">{{ $order->status }}</p>
        @elseif ($order->status == 'cancelado')
        <p class="badge text-bg-danger">{{ $order->status }}</p>
        @endif
    </div>

    <!-- DATE -->
    <div class="col-md-5">
        <label class="form-label">Fecha pedido</label>
        <input type="text" class="form-control" value="{{ $order->created_at }}" readonly>
    </div>

    <!-- TOTAL PRICE -->
    <div class="col-md-5">
        <label class="form-label">Precio total</label>
        <input type="text" class="form-control" value="{{ $order->total_price }} €" readonly>
    </div>

    <div class="col-12">
        <h5 class="info-section">Dirección de envío</h5>
    </div>

    <!-- ADDRESS -->
    <div class="col-md-6">
        <label class="form-label">Dirección</label>
        <input type="text" class="form-control" value="{{ $order->address }}" readonly>
    </div>

    <div class="col-12">
        <h5 class="info-section">Método de pago</h5>
    </div>

    <!-- CREDIT CARD -->
    <div class="col-md-6">
        <label class="form-label">Tarjeta bancaria</label>
        <input type="text" class="form-control" value="{{ $order->credit_card }}" readonly>
    </div>

    <div class="col-12">
        <h5 class="info-section">Productos</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-translate-middle">
            <thead class="table-light">
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Nombre</th>
                    <th class="align-middle">Talla</th>
                    <th class="align-middle">Precio unitario</th>
                    <th class="align-middle">Cantidad</th>
                    <th class="align-middle">Precio Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->product_size }}</td>
                    <td>@if ($product->discount){{ $product->discount }} €@else{{ $product->price }} €@endif</td>
                    <td>{{ $product->pivot->product_quantity }}</td>
                    <td>@if ($product->discount){{ $product->discount * $product->pivot->product_quantity }} €@else{{ $product->price * $product->pivot->product_quantity }} €@endif</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                    </td>
                    <th>
                        Total Pedido:
                    </th>
                    <th>
                        {{ $order->total_price }} €
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</form>
@endsection