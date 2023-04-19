@extends('layouts.app')

@section('title', 'Método de pago - Mr Penguin')

@section('content')
<div class="container">
    <div class="row cart-container pt-5">
        <div class="col-12">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- LEFT COLUMN -->
                        <div class="col-lg-8">
                            <div id="cart-content" class="p-5">
                                <div id="cart-header" class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black text-uppercase">Método de pago</h1>
                                </div>

                                <div>
                                    <p>Selecciona un método de pago guardado o introduce los datos de la tarjeta que desee</p>
                                </div>

                                @if(session('error'))
                                <div class="row">
                                    <div class="col-12 alert alert-danger alert-dismissible fade show px-5 mt-4">
                                        <span class="m-0">{{ session('error') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endif

                                <hr class="my-4">

                                <form action="{{ route('cart.pay') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="total_price_cart" value="{{ $total_price_cart }}">

                                    <div class="mb-3">
                                        <label class="form-label" for="payMethod">Métodos de pago guardados</label>
                                        <select class="form-select" id="payMethod" name="pay_method" aria-label="Seleccionar método de pago">
                                            <option selected>--</option>
                                            @foreach ($creditCards as $creditCard)
                                            <option value="{{ $creditCard->id }}">{{ $creditCard->cardholder_name }} - {{ $creditCard->expiration_month }}/{{ $creditCard->expiration_year }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <p class="text-center col-12">- o -</p>

                                    <!-- CARDHOLDER -->
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label" for="cardholder">Titular*</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('cardholder') is-invalid @enderror" name="cardholder" id="cardholder" value="{{ old('cardholder') }}">
                                            <!-- Errores cardholder -->
                                            @error('cardholder')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- NUMBER -->
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label" for="cardNumber">Número*</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" id="cardNumber" value="{{ old('card_number') }}" placeholder="XXXXXXXXXXXXXXXX">
                                            <!-- Errores card_number -->
                                            @error('card_number')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- EXPIRATION DATE -->
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label" for="expirationDate">Fecha de expiración*</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" id="expirationDate" value="{{ old('expiration_date') }}" placeholder="XX/XXXX">
                                            <!-- Errores expiration_date -->
                                            @error('expiration_date')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- CVV -->
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label" for="cvv">CVV*</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('cvv') is-invalid @enderror" name="cvv" id="cvv" value="{{ old('cvv') }}" placeholder="XXX">
                                            <!-- Errores cvv -->
                                            @error('cvv')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <button type="submit" class="btn btn-dark btn-block btn-lg w-100" data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#payment-modal">
                                        Finalizar Compra
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- END LEFT COLUMN -->

                        <!-- RIGHT COLUMN -->
                        <div class="col-right col-lg-4 bg-grey">
                            <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Resumen</h3>
                                <hr class="my-4">

                                <!-- TOTAL ITEMS -->
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-uppercase num-articles">{{ count(Auth::user()->cartItems) }} artículos</h5>
                                </div>

                                <!-- SHIPMENT -->
                                <h5 class="text-uppercase mb-3">Envío</h5>
                                <div class="mb-4 pb-2">
                                    @if ($total_price_cart > 24.90) Gratis @else 2.90 € | Te faltan {{ 24.90 - $total_price_cart }} € para envío gratis @endif
                                </div>

                                <!-- ADDRESS -->
                                <h5 class="text-uppercase mb-3">Dirección de envío</h5>
                                <div class="mb-4 pb-2">
                                    {{ $address->street }}, {{ $address->number }} {{ $address->floor }}, ({{ $address->postal_code }}), {{ $address->province }} {{ $address->country }}
                                </div>

                                <hr class="my-4">

                                <!-- TOTAL PRICE -->
                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">Precio total</h5>
                                    <h5 class="total-price-final">@if ($total_price_cart > 24.90) {{ $total_price_cart }} @else {{ $total_price_cart + 2.90 }} @endif €</h5>
                                </div>
                            </div>
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection