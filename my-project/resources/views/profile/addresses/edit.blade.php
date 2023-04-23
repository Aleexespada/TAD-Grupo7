@extends('layouts.app')

@section('title', 'Editar dirección - Mr Penguin')

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
                            <h4 class="col-12 mb-4">Editar dirección</h4>

                            <!-- MIGA DE PAN -->
                            <div class="col-12">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('profile.addresses') }}" class="text-black">Mis direcciones</a></li>
                                    <li class="breadcrumb-item active">Editar dirección</li>
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
                                <form method="POST" action="{{ route('profile.addresses.edit', $address->id) }}" id="createAddressForm">
                                    @method('PUT')
                                    @csrf

                                    <div class="row mb-lg-4">
                                        <!-- STREET -->
                                        <label class="col-lg-2 col-form-label" for="street">Calle*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="street" value="{{ $address->street }}">
                                            <!-- Errores street -->
                                            @error('street')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- NUMBER -->
                                        <label class="col-lg-2 col-form-label" for="number">Número*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number" value="{{ $address->number }}">
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
                                        <label class="col-lg-2 col-form-label" for="floor">Piso</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" id="floor" value="{{ $address->floor }}" placeholder="Piso, Apartamento, Bloque, etc">
                                            <!-- Errores floor -->
                                            @error('floor')
                                            <div class="invalid-feedback d-block" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- POSTAL CODE -->
                                        <label class="col-lg-2 col-form-label" for="postal_code">Código Postal*</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" value="{{ $address->postal_code }}">
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
                                        <label class="col-lg-2 col-form-label" for="province">Provincia*</label>
                                        <div class="col-lg-4">
                                            <select class="form-select @error('province') is-invalid @enderror" id="province" name="province" aria-label="Seleccionar provincia">
                                                <option selected disabled>--</option>
                                                @foreach (config('provinces') as $province)
                                                <option value="{{ $province }}" {{ $address->province == $province ? 'selected' : '' }}>{{ $province }}</option>
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
                                        <label class="col-lg-2 col-form-label" for="country">País*</label>
                                        <div class="col-lg-4">
                                            <select class="form-select @error('country') is-invalid @enderror" id="country" name="country" aria-label="Seleccionar país">
                                                <option selected disabled>--</option>
                                                @foreach (config('countries') as $country)
                                                <option value="{{ $country }}" {{ $address->country == $country ? 'selected' : '' }}>{{ $country }}</option>
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
                                        Editar dirección
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