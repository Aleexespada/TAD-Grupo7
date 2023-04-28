@extends('layouts.app')

@section('title', 'Contacto - Mr Penguin')

@vite(['resources/css/info.scss'])

@section('content')
<div class="info-container container">
    <div class="row justify-content-center pt-5">
        <div class="col-6">
            <h1 class="fw-bold mb-0 text-black text-center text-uppercase mb-5">Contacto</h1>

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

            <!-- Formulario -->
            <form method="POST" action="{{ route('info.contact-us') }}" id="contactForm">
                @csrf

                <!-- NAME -->
                <div class="form-group input-group mt-4">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="name" autocomplete="given-name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required autofocus placeholder="Nombre" />
                </div>
                <!-- Errores nombre -->
                @error('name')
                <div class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </div>
                @enderror

                <!-- EMAIL -->
                <div class="form-group input-group mt-4">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required placeholder="Correo electrónico" />
                </div>
                <!-- Errores email -->
                @error('email')
                <div class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </div>
                @enderror

                <!-- SUBJECT -->
                <div class="form-group input-group mt-4">
                    <span class="input-group-text"><i class="fa-solid fa-envelope-open-text"></i></span>
                    <input type="text" name="subject" autocomplete="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" value="{{ old('subject') }}" required placeholder="Asunto" />
                </div>
                <!-- Errores nombre -->
                @error('subject')
                <div class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </div>
                @enderror

                <!-- MENSAJE -->
                <div class="form-group input-group mt-4">
                    <label for="message" class="input-group-text"><i class="fa-solid fa-comment"></i></label>
                    <textarea type="text" class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Mensaje" style="height: 200px;">{{ old('message') }}</textarea>
                </div>
                <!-- Errores mensaje -->
                @error('message')
                <div class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </div>
                @enderror

                <!-- BUTTON -->
                <button name="btnContact" type="submit" class="btn btn-dark mt-4 w-100">
                    Contactar
                </button>
            </form>

        </div>
    </div>
</div>
@endsection