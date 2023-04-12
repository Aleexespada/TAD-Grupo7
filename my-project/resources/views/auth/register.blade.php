@extends('layouts.app')

@section('title', 'Registro - Mr Penguin')

<script defer src="{{ asset('js/showPassword.js') }}"></script>    

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-12 col-md-9 col-lg-6 col-xl-4">
        <!-- Encabezado -->
        <h4 class="card-title mt-3 text-center">Crear cuenta</h4>

        <!-- Texto -->
        <p class="text-center">Únete a nosotros con una cuenta gratis</p>

        <!-- Formulario -->
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- NAME -->
            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="name" autocomplete="given-name" class="form-control @error('name') is-invalid @enderror" id="nameRegister" value="{{ old('name') }}" required autofocus placeholder="Nombre" />
            </div>
            <!-- Errores nombre -->
            @error('name')
            <div class="invalid-feedback d-block" role="alert">
                {{ $message }}
            </div>
            @enderror

            <!-- LAST NAME -->
            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="last_name" autocomplete="family-name" class="form-control @error('last_name') is-invalid @enderror" id="lastNameRegister" value="{{ old('last_name') }}" required placeholder="Apellidos" />
            </div>
            <!-- Errores apellidos -->
            @error('last_name')
            <div class="invalid-feedback d-block" role="alert">
                {{ $message }}
            </div>
            @enderror

            <!-- EMAIL -->
            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="emailRegister" value="{{ old('email') }}" required placeholder="Correo electrónico" />
            </div>
            <!-- Errores email -->
            @error('email')
            <div class="invalid-feedback d-block" role="alert">
                {{ $message }}
            </div>
            @enderror

            <!-- PASSWORD -->
            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" id="passwordRegister" required placeholder="Contraseña" />
                <span class="input-group-text">
                    <span class="hideShowPass" onclick="showPassword(event, 'passwordRegister')">
                        <span class="fa fa-eye-slash"></span>
                    </span>
                </span>
            </div>
            <!-- Errores contraseña -->
            @error('password')
            <div class="invalid-feedback d-block" role="alert">
                {{ $message }}
            </div>
            @enderror

            <!-- REPEAT PASSWORD -->
            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control" id="passwordConfirmRegister" required placeholder="Repetir contraseña" />
                <span class="input-group-text">
                    <span class="hideShowPass" onclick="showPassword(event, 'passwordConfirmRegister')">
                        <span class="fa fa-eye-slash"></span>
                    </span>
                </span>
            </div>

            <!-- BUTTON -->
            <button name="btnRegister" type="submit" class="btn btn-dark mt-4 w-100">
                Crear cuenta
            </button>
        </form>

        <!-- Ir a iniciar sesion -->
        <p class="text-center mt-5">
            ¿Tienes cuenta?
        </p>
        <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">Iniciar sesión</a>
    </div>
</div>
@endsection