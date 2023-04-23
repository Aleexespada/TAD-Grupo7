@extends('layouts.app')

@section('title', 'Cambiar contraseña - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LOS DATOS DEL USUARIO -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <!-- TÍTULO SECCIÓN -->
                        <h4 class="col-12 mb-4">Cambiar contraseña</h4>
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
                            <form method="POST" action="{{ route('user-password.update') }}" id="editPasswordForm">
                                @method('PUT')
                                @csrf
                                <div class="row mb-lg-4">
                                    <!-- ACTUAL PASSWORD -->
                                    <label class="col-lg-2 col-form-label" for="current_password">Contraseña actual</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" id="current_password" value="{{ old('current_password') }}">
                                        <!-- Errores actual password -->
                                        @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-lg-4">
                                    <!-- NEW PASSWORD -->
                                    <label class="col-lg-2 col-form-label" for="password">Contraseña</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
                                        <!-- Errores new password -->
                                        @error('password', 'updatePassword')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-lg-4">
                                    <!-- NEW PASSWORD -->
                                    <label class="col-lg-2 col-form-label" for="password_confirmation">Confirmar contraseña</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark mt-3">
                                    Cambiar contraseña
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection