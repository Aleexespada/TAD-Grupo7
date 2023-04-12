@extends('layouts.app')

@section('title', 'Olvidé mi contraseña - Mr Penguin')

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-12 col-md-9 col-lg-6 col-xl-4">
        <!-- Encabezado -->
        <h4 class="card-title mt-3 text-center">Resetear contraseña</h4>

        @if(session('status'))
        <div class="alert alert-success mt-3 text-center" role="alert">
            {{session('status')}}
        </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.request') }}">
            @csrf

            <div class="form-group input-group mt-4">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="emailResetPass" value="{{ old('email') }}" required autofocus placeholder="Correo Electrónico">
            </div>
            <!-- Errores email -->
            @error('email')
            <div class="invalid-feedback d-block" role="alert">
                {{ $message }}
            </div>
            @enderror

            <!-- BUTTON -->
            <button name="btnResetPass" type="submit" class="btn btn-dark mt-4 w-100">
                Enviar Email
            </button>
        </form>
    </div>
</div>
@endsection