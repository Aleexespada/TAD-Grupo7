@extends('layouts.app')

@section('title', 'Verificar email - Mr Penguin')

@section('content')
<div class="row justify-content-center mt-5">

    <div class="col-12 col-md-9 col-lg-6 col-xl-4">
        <!-- Encabezado -->
        <h4 class="card-title mt-3 text-center">Verificar email</h4>

        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
        @endif

        <p class="text-center">Debes verificar tu dirección de correo electrónico. Por favor, comprueba tu email para el enlace de verificación</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <!-- BUTTON -->
            <button name="btnResendEmail" type="submit" class="btn btn-dark mt-4 w-100">
                Volver a enviar email
            </button>
        </form>
    </div>
</div>
@endsection