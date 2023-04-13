@extends('layouts.app')

@section('title', 'Mis Pedidos - Mr Penguin')

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LOS PEDIDOS DEL USUARIO -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16" class="rounded-circle img-fluid" style="width: 100px; height: 100px;">
                            <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg>
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
                        <hr>
                        <ul class="list-group list-group-flush rounded-3">
                            @foreach (Auth::user()->orders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <p class="mb-0">
                                    <span class="me-3">Pedido con id <b>#{{$order->id}}</b> - {{ $order->created_at }}</span>
                                    @if ($order->status == 'pendiente')
                                    <td><span class="badge text-bg-info">{{ $order->status }}</span></td>
                                    @elseif ($order->status == 'en proceso')
                                    <td><span class="badge text-bg-warning">{{ $order->status }}</span></td>
                                    @elseif ($order->status == 'entregado')
                                    <td><span class="badge text-bg-success">{{ $order->status }}</span></td>
                                    @elseif ($order->status == 'cancelado')
                                    <td><span class="badge text-bg-danger">{{ $order->status }}</span></td>
                                    @endif
                                </p>

                                <div class="ms-auto my-auto col-auto row">

                                    <!-- BOTÓN PARA VISUALIZAR TODO EL PEDIDO -->
                                    <div class="col-6 btn" data-bs-toggle="modal" data-bs-target="#modal-view-order-{{ $order->id }}">
                                        <i class="fa-solid fa-eye" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver pedido" data-bs-offset="0, 10"></i>
                                    </div>

                                    <!-- MODAL PARA VISUALIZAR TODO EL PEDIDO  -->
                                    <div class="modal fade" id="modal-view-order-{{ $order->id }}" tabindex="-1" aria-labelledby="modal-cancel-order-label" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-cancel-order-label">
                                                        Pedido con id #{{$order->id}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- ESTADO -->
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Estado</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">
                                                                    @if ($order->status == 'pendiente')
                                                                    <td><span class="badge text-bg-info">{{ $order->status }}</span></td>
                                                                    @elseif ($order->status == 'en proceso')
                                                                    <td><span class="badge text-bg-warning">{{ $order->status }}</span></td>
                                                                    @elseif ($order->status == 'entregado')
                                                                    <td><span class="badge text-bg-success">{{ $order->status }}</span></td>
                                                                    @elseif ($order->status == 'cancelado')
                                                                    <td><span class="badge text-bg-danger">{{ $order->status }}</span></td>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <!-- DIRECCIÓN DEL PEDIDO -->
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Lugar</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $order->address->postal_code }}, {{ $order->address->province }}, {{ $order->address->country }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Direcci&oacute;n</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $order->address->street }}, {{ $order->address->number }} {{ $order->address->floor }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <!-- TARJETA DE CRÉDITO DEL PEDIDO -->
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Titular</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $order->creditCard->cardholder_name }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Número</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $order->creditCard->card_number }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">CVV</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $order->creditCard->cvv }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Caducidad</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $order->creditCard->expiration_month }} / {{ $order->creditCard->expiration_year }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <!-- LISTA DE PRODUCTOS DEL PEDIDO -->
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
                                                                    <td>{{ $product->price }} €</td>
                                                                    <td>{{ $product->pivot->product_quantity }}</td>
                                                                    <td>{{ $product->price * $product->pivot->product_quantity }} €</td>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($order->status != 'cancelado')
                                    <!-- BOTÓN PARA CANCELAR PEDIDO -->
                                    <div class="btn ms-auto my-auto col-auto" data-bs-toggle="modal" data-bs-target="#modal-cancel-order-{{$order->id}}">
                                        <i class="fa-solid fa-ban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cancelar pedido" data-bs-offset="0, 10"></i>
                                    </div>

                                    <!-- MODAL PARA CANCELAR PEDIDO  -->
                                    <div class="modal fade" id="modal-cancel-order-{{$order->id}}" tabindex="-1" aria-labelledby="modal-cancel-order-label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-cancel-order-label">
                                                        Cancelar pedido</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea cancelar este pedido?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form method="POST" action="{{ route('profile.cancel.order', $order->id) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection