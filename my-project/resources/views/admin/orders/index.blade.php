@extends('admin.layouts.index')

@section('title', 'Pedidos - Mr Penguin')

@section('section-title')
Pedidos
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item active">Pedidos</li>
</ol>
@endsection

@section('card-body')
<div class="table-responsive">
    <table class="table align-translate-middle">
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
                        <a href="" class="btn">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="" class="btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection