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
<div class="table-responsive">
    <table class="table table-striped align-translate-middle">
        <thead class="table-light">
            <tr>
                <th class="align-middle">ID</th>
                <th class="align-middle">Usuario</th>
                <th class="align-middle">Fecha</th>
                <th class="align-middle">Total</th>
                <th class="align-middle">Estado</th>
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
                        <form action="{{ route('dashboard.orders.changestatus', $order->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="status" value="cancelado">
                            <button type="submit" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cancelar pedido">
                                <i class="fa-solid fa-ban"></i>
                            </button>
                        </form>
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
@endsection