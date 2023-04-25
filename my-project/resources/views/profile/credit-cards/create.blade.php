@extends('layouts.app')

@section('title', 'Crear tarjeta de crédito - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON FORMULARIO PARA CREAR TARJETA DE CRÉDITO -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <div class="row">
                            <!-- TÍTULO SECCIÓN -->
                            <h4 class="col-12 mb-4">Crear tarjeta de crédito</h4>

                            <!-- MIGA DE PAN -->
                            <div class="col-12">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('profile.creditcards') }}" class="text-black">Mis tarjetas de crédito</a></li>
                                    <li class="breadcrumb-item active">Crear nueva tarjeta de crédito</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12">
                                <!-- MENSAJES -->
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

                                <!-- FORMULARIO -->
                                <form method="POST" action="{{ route('profile.creditcards.create') }}" id="createCreditCardForm">
                                    @csrf
                                    @method('POST')

                                    <div class="row mb-lg-4">
                                        <!-- CARDHOLDER -->
                                        <label class="col-lg-2 col-form-label" for="cardholder">Titular*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('cardholder') is-invalid @enderror" name="cardholder" id="cardholder" value="{{ old('cardholder') }}">
                                            <!-- Errores cardholder -->
                                            @error('cardholder')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- NUMBER -->
                                        <label class="col-lg-2 col-form-label" for="cardNumber">Número*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" id="cardNumber" value="{{ old('card_number') }}" placeholder="XXXXXXXXXXXXXXXX">
                                            <!-- Errores card_number -->
                                            @error('card_number')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-lg-4">
                                        <!-- EXPIRATION DATE -->
                                        <label class="col-lg-2 col-form-label" for="expirationDate">Fecha de expiración*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" id="expirationDate" value="{{ old('expiration_date') }}" placeholder="XX/XXXX">
                                            <!-- Errores expiration_date -->
                                            @error('expiration_date')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- CVV -->
                                        <label class="col-lg-2 col-form-label" for="cvv">CVV*</label>
                                        <div class="col-lg-4">
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

                                    <button type="submit" class="btn btn-dark">
                                        Crear tarjeta de crédito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection