@extends('layouts.app')

@section('title', 'Bienvenido - Mr Penguin')

@vite(['resources/css/home.scss'])

@section('content')
<!-- CAROUSEL -->
<div class="row">
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
                <h1 class="brand-name">
                    MR PENGUIN
                </h1>
                <p class="text-black mt-4 fw-bold">Encuentra tu estilo único con nuestra colección de ropa, diseñada para realzar tu belleza y sofisticación en cada ocasión.</p>
                <a href="{{ route('products.index') }}" class="btn btn-light mt-4 py-3 px-5 text-uppercase">
                    Ver productos
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-evenly mt-5 px-2 mx-3">
    <div class="col-5">
        <h3 class="products-carousel-title text-center text-uppercase">Productos más vendidos</h3>
        <div id="carouselTopProducts" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($topProducts as $product)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <img src="{{ asset($product->image_url) }}" class="d-block w-100" alt="Imagen de {{ $product->name }}" style="height: 600px; object-fit: contain;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="bg-dark py-2">{{ $product->name }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTopProducts" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left text-black"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselTopProducts" data-bs-slide="next">
                <i class="fa-solid fa-angle-right text-black"></i>
            </button>
        </div>
    </div>
    <div class="col-5">
        <h3 class="products-carousel-title text-center text-uppercase">Productos nuevos</h3>
        <div id="carouselRecentlyAddedProducts" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($recentlyAddedProducts as $product)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <img src="{{ asset($product->image_url) }}" class="d-block w-100" alt="Imagen de {{ $product->name }}" style="height: 600px; object-fit: contain;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="bg-dark py-2">{{ $product->name }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselRecentlyAddedProducts" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left text-black"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselRecentlyAddedProducts" data-bs-slide="next">
                <i class="fa-solid fa-angle-right text-black"></i>
            </button>
        </div>
    </div>
</div>
@endsection