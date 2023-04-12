@extends('layouts.app')

@section('title', 'Mi perfil - Mr Penguin')

@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">

        <!-- CARD CON LOS PEDIDOS DEL USUARIO -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16" class="rounded-circle img-fluid" style="width: 100px; height: 100px;">
                            <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                        <hr>
                        <ul class="list-group list-group-flush rounded-3">
                            @foreach ($orders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <p class="mb-0">Pedido con id #{{$order->id}}</p>

                                <div class="ms-auto my-auto col-auto row">

                                    <!-- BOTÓN PARA VISUALIZAR TODO EL PEDIDO -->
                                    <div class="col-6" data-bs-toggle="modal" data-bs-target="#modal-view-order">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </div>

                                    <!-- MODAL PARA VISUALIZAR TODO EL PEDIDO  -->
                                    <div class="modal fade" id="modal-view-order" tabindex="-1"
                                        aria-labelledby="modal-delete-order-label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-delete-order-label">
                                                        Pedido con id #{{$order->id}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
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
                                                        <hr>
                                                    </div>
                                                    <hr>

                                                    <!-- TARJETA DE CRÉDITO DEL PEDIDO -->
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Titular</p>
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
                                                    <ul class="list-group list-group-flush rounded-3">
                                                        @foreach($order->products as $product)
                                                        <li class="list-group-item p-3">
                                                            <div class="row">
                                                            <div class="col-sm-9">
                                                                <p class="mb-0">{{ $product->name }} x {{ $product->pivot->product_quantity }}</p>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">{{ $product->price * $product->pivot->product_quantity}}€</p>
                                                            </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BOTÓN PARA ELIMINAR PEDIDO -->
                                    <div class="ms-auto my-auto col-auto" data-bs-toggle="modal" data-bs-target="#modal-delete-order-{{$order->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </div>

                                    <!-- MODAL PARA ELIMINAR PEDIDO  -->
                                    <div class="modal fade" id="modal-delete-order-{{$order->id}}" tabindex="-1"
                                        aria-labelledby="modal-delete-order-label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-delete-order-label">
                                                        Eliminar pedido</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea eliminar este pedido?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <form method="POST" action="{{ route('profile.delete.order', $order->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CARD CON LOS DATOS DEL USUARIO -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Last Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->last_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD CON LAS DIRECCIONES DEL USUARIO -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <p class="mb-4">Direcciones</p>
                                <ul class="list-group list-group-flush rounded-3">
                                    @foreach ($addresses as $address)
                                    <li class="list-group-item p-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="mb-0">{{ $address->country }}</p>
                                                <p class="mb-0">{{ $address->province }}</p>
                                                <p class="mb-0">{{ $address->postal_code }}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-0">{{ $address->street }}, {{ $address->number }}</p>
                                                <p class="mb-0">{{ $address->floor }}</p>
                                            </div>

                                            <!-- BOTÓN PARA ELIMINAR DIRECCIÓN -->
                                            <div class="ms-auto my-auto col-auto" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-address-{{$address->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </div>

                                            <!-- MODAL PARA ELIMINAR DIRECCIÓN -->
                                            <div class="modal fade" id="modal-delete-address-{{$address->id}}" tabindex="-1"
                                                aria-labelledby="modal-delete-address-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="modal-delete-address-label">
                                                                Eliminar direcci&oacute;n</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Desea eliminar esta direcci&oacute;n?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form method="POST" action="{{ route('profile.delete.address', $address->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- CARD CON LAS TARJETAS DE CRÉDITO DEL USUARIO -->
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <p class="mb-4">Tarjetas de Crédito</p>
                                <ul class="list-group list-group-flush rounded-3">
                                    @foreach ($credit_cards as $credit_card)
                                    <li class="list-group-item p-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="mb-0">{{ $credit_card->card_number }}</p>
                                                <p class="mb-0">{{ $credit_card->cardholder_name }}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-0">{{ $credit_card->cvv }}</p>
                                                <p class="mb-0">{{ $credit_card->expiration_month }} / {{ $credit_card->expiration_year }}</p>
                                            </div>

                                            <!-- BOTÓN PARA ELIMINAR TARJETA DE CRÉDITO -->
                                            <div class="ms-auto my-auto col-auto" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-credit-card-{{$credit_card->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </div>

                                            <!-- MODAL PARA ELIMINAR TARJETA DE CRÉDITO  -->
                                            <div class="modal fade" id="modal-delete-credit-card-{{$credit_card->id}}" tabindex="-1"
                                                aria-labelledby="modal-delete-credit-card-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="modal-delete-credit-card-label">
                                                                Eliminar tarjeta de crédito cr&eacute;dito</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Desea eliminar esta tarjeta de cr&eacute;dito?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form method="POST" action="{{ route('profile.delete.credit_card', $credit_card->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection