@extends('layouts.app')

<script defer src="{{ asset('js/showPassword.js') }}"></script>    

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-12 col-md-9 col-lg-6 col-xl-4">
        <!-- Encabezado -->
        <h4 class="card-title mt-3 text-center">Resetear contraseña</h4>

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{$request->route('token')}}">

            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="emailResetPass" value="{{ $request->email }}" required autofocus placeholder="Correo Electrónico">
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
                <input type="password" name="password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" id="passwordResetPass" required placeholder="Contraseña" />
                <span class="input-group-text">
                    <span class="hideShowPass" onclick="showPassword(event, 'passwordResetPass')">
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
                <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control" id="passwordConfirmResetPass" required placeholder="Repetir contraseña" />
                <span class="input-group-text">
                    <span class="hideShowPass" onclick="showPassword(event, 'passwordConfirmResetPass')">
                        <span class="fa fa-eye-slash"></span>
                    </span>
                </span>
            </div>

            <!-- BUTTON -->
            <button name="btnResetPass" type="submit" class="btn btn-dark mt-4 w-100">
                Resetear
            </button>
        </form>
    </div>
</div>
@endsection