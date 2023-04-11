@extends('layouts.app')

@section('title', 'Mi perfil - Mr Penguin')

@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">

        <!-- TARJETA CON LOS PEDIDOS DEL USUARIO -->
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
                                <p class="mb-0">mdbootstrap</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- TARJETA CON LOS DATOS DEL USUARIO -->
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

                <!-- TARJETA CON LAS DIRECCIONES DEL USUARIO -->
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
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- TARJETA CON LAS TARJETAS DE CRÉDITO DEL USUARIO -->
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