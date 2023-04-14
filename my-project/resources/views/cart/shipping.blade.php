@extends('layouts.app')

@section('title', 'Dirección de envío - Mr Penguin')

@section('content')

<div class="row cart-container pt-5">
    <div class="col-12">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- LEFT COLUMN -->
                    <div class="col-lg-8">
                        <div id="cart-content" class="p-5">
                            <div id="cart-header" class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black text-uppercase">Dirección de envío</h1>
                            </div>

                            <div>
                                <p>Selecciona una dirección o introduce los datos de la dirección deseada</p>
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

                            <form action="{{ route('cart.shipping_select') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="total_price_cart" value="{{ $total_price_cart }}">

                                <div class="mb-3">
                                    <label class="form-label" for="shippingAddress">Direcciones de envío guardadas</label>
                                    <!-- <input type="text" name="name" autocomplete="given-name" class="form-control @error('name') is-invalid @enderror" id="nameRegister" value="{{ old('name') }}" required autofocus placeholder="Nombre" /> -->
                                    <select class="form-select" id="shippingAddress" name="shipping_address" aria-label="Seleccionar dirección de envío">
                                        <option selected>--</option>
                                        @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}">{{ $address->street }}, {{ $address->number }} {{ $address->floor }}, ({{ $address->postal_code }}), {{ $address->province }} {{ $address->country }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <p class="text-center col-12">- o -</p>

                                <!-- STREET -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="shippingStreet">Calle*</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="shippingStreet" value="{{ old('street') }}">
                                        <!-- Errores street -->
                                        @error('street')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- NUMBER -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="shippingNumber">Número*</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="shippingNumber" value="{{ old('number') }}">
                                        <!-- Errores number -->
                                        @error('number')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- FLOOR -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="shippingFloor">Piso</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" id="shippingFloor" value="{{ old('floor') }}" placeholder="Piso, Apartamento, Bloque, etc">
                                        <!-- Errores floor -->
                                        @error('floor')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- POSTAL CODE -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="shippingPostalCode">Código Postal*</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="shippingPostalCode" value="{{ old('postal_code') }}">
                                        <!-- Errores postal code -->
                                        @error('postal_code')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- PROVINCE -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="shippingProvince">Provincia*</label>
                                    <div class="col-md-10">
                                        <select class="form-select @error('province') is-invalid @enderror" id="shippingProvince" name="province" aria-label="Seleccionar provincia">
                                            <option selected disabled>--</option>
                                            @foreach (config('provinces') as $province)
                                            <option value="{{ $province }}">{{ $province }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Errores province -->
                                        @error('province')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- COUNTRY -->
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="shippingCountry">País*</label>
                                    <div class="col-md-10">
                                        <select class="form-select @error('country') is-invalid @enderror" id="shippingCountry" name="country" aria-label="Seleccionar país">
                                            <option selected disabled>--</option>
                                            @foreach (config('countries') as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Errores country -->
                                        @error('country')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-4">

                                <button type="submit" class="btn btn-dark btn-block btn-lg w-100" data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#payment-modal">
                                    Continuar
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
    @endsection