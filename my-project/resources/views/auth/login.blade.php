@extends('layouts.app')

@section('title', 'Iniciar sesión - Mr Penguin')

<script defer src="{{ asset('js/showPassword.js') }}"></script>

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-12 col-md-9 col-lg-6 col-xl-4">
        <!-- Encabezado -->
        <h4 class="card-title text-center mb-5">Iniciar sesión</h4>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- EMAIL -->
            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="emailLogin" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico" />
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
                <input type="password" name="password" autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" id="passwordLogin" required placeholder="Contraseña" />
                <!-- Mostrar / ocultar -->
                <span class="input-group-text">
                    <span id="login_show_password" class="hideShowPass" onclick="showPassword(event, 'passwordLogin')">
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

            <!-- REMEMBER ME -->
            <div class="form-group input-group mt-4">
                <input type="checkbox" name="remember" class="form-check-input me-3" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Recuerdame
                </label>
            </div>

            <!-- BUTTON -->
            <button name="btnLogin" type="submit" class="btn btn-dark mt-4 w-100">
                Iniciar sesión
            </button>
        </form>

        <!-- Contraseña olvidada -->
        @if (Route::has('password.request'))
        <p class="text-center mt-3">
            <a class="btn btn-link text-black" href="{{ route('password.request') }}">
                He olvidado mi contraseña
            </a>
        </p>
        @endif

        <!-- Ir a registro -->
        <p class="text-center mt-5">
            ¿No tienes cuenta?
        </p>
        <a href="{{ route('register') }}" class="btn btn-outline-dark w-100">Crear cuenta</a>
    </div>
</div>
@endsection