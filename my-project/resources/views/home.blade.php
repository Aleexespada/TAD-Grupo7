@extends('layouts.app')

@section('title', 'Bienvenido - Mr Penguin')

@vite(['resources/css/home.scss'])

@section('content')
<div class="row">
    <!-- CAROUSEL -->
    <div id="indexCarousel" class="carousel-height carousel slide carousel-fade p-0" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Deslizar 1"></button>
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="1" aria-label="Deslizar 2"></button>
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="2" aria-label="Deslizar 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/img1.jpg') }}" class="d-block w-100" alt="Imagen 1 Carousel: Hombre traje" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/img2.jpg') }}" class="d-block w-100" alt="Imagen 2 Carousel: Hombre traje" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/img3.jpg') }}" class="d-block w-100" alt="Imagen 3 Carousel: Hombre traje" />
            </div>

            <div class="message-container d-none d-md-block">
                <img src="{{ asset('img/logo.png') }}" class="" height="70" width="70" alt="Logo MrPenguin" />
                <h1 class="brand-name text-black">
                    MR PENGUIN
                </h1>
                <p class="text-black mt-4">Encuentra tu estilo único con nuestra colección de ropa, diseñada para realzar tu belleza y sofisticación en cada ocasión.</p>
                <a href="{{ route('products.index') }}" class="btn btn-light mt-4 py-3 px-5 text-uppercase">
                    Ver productos
                </a>
            </div>
        </div>
    </div>
</div>
@endsection