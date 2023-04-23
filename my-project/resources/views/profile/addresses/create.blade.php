@extends('layouts.app')

@section('title', 'Crear dirección - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON FORMULARIO PARA CREAR DIRECCIÓN -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <div class="row">
                            <!-- TÍTULO SECCIÓN -->
                            <h4 class="col-12 mb-4">Crear dirección</h4>

                            <!-- MIGA DE PAN -->
                            <div class="col-12">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('profile.addresses') }}" class="text-black">Mis direcciones</a></li>
                                    <li class="breadcrumb-item active">Crear nueva dirección</li>
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
                                <form method="POST" action="{{ route('profile.addresses.create') }}" id="createAddressForm">
                                    @csrf
                                    @method('POST')

                                    <div class="row mb-lg-4">
                                        <!-- STREET -->
                                        <label class="col-lg-2 col-form-label" for="shippingStreet">Calle*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="shippingStreet" value="{{ old('street') }}">
                                            <!-- Errores street -->
                                            @error('street')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- NUMBER -->
                                        <label class="col-lg-2 col-form-label" for="shippingNumber">Número*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="shippingNumber" value="{{ old('number') }}">
                                            <!-- Errores number -->
                                            @error('number')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-lg-4">
                                        <!-- FLOOR -->
                                        <label class="col-lg-2 col-form-label" for="shippingFloor">Piso</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" id="shippingFloor" value="{{ old('floor') }}" placeholder="Piso, Apartamento, Bloque, etc">
                                            <!-- Errores floor -->
                                            @error('floor')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- POSTAL CODE -->
                                        <label class="col-lg-2 col-form-label" for="shippingPostalCode">Código Postal*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="shippingPostalCode" value="{{ old('postal_code') }}">
                                            <!-- Errores postal code -->
                                            @error('postal_code')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-lg-4">
                                        <!-- PROVINCE -->
                                        <label class="col-lg-2 col-form-label" for="shippingProvince">Provincia*</label>
                                        <div class="col-lg-4">
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
                                        <!-- COUNTRY -->
                                        <label class="col-lg-2 col-form-label" for="shippingCountry">País*</label>
                                        <div class="col-lg-4">
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

                                    <button type="submit" class="btn btn-dark">
                                        Crear dirección
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