@extends('layouts.app')

@section('title', $product->name . ' - Mr Penguin')

@vite(['resources/css/product.scss'])
<script defer src="{{ asset('js/quantityProduct.js') }}"></script>
<script defer src="{{ asset('js/productImageModal.js') }}"></script>

@section('content')
<div class="container">
    <div class="row product-container pt-5">
        <!-- LEFT COLUMN -->
        <div class="col-12 col-md-7 order-last order-md-first">
            <!-- IMAGES -->
            <div class="row row-cols-1 row-cols-md-2 g-2 d-none d-md-flex">
                @foreach($product->images as $image)
                <div class="col">
                    <figcaption class="product-img h-100" data-bs-toggle="modal" data-bs-target="#product-img-modal">
                        <img class="w-100" src="{{ asset($image->url) }}" alt="Imagen de {{ $product->name }}">
                    </figcaption>
                </div>
                @endforeach
            </div>

            <!-- SHIPPING TABLE -->
            <div class="row mt-5 px-5">
                <div class="col-12 product-shipping">
                    <table id="shipping-table">
                        <tr>
                            <td>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                    3-7 días laborales
                                </p>
                                <p>
                                    Envío estándar:
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#shipping-modal">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Condiciones envío gratuito" data-bs-offset="0, 8">gratuito*</span>
                                    </button>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                    </svg>
                                    derecho de devolución de 15 días
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                    </svg>
                                    intercambio posible
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#change-modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Información intercambio" data-bs-offset="0, 8">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </button>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- PRODUCT INFO -->
            <div class="row mt-5 px-3">
                <!-- DESCRIPTIONS -->
                <div class="accordion" id="accordionProductInfo">
                    <!-- DESCRIPTION -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsDescription" aria-expanded="false" aria-controls="panelsDescription">
                                Descripción del producto
                            </button>
                        </h2>
                        <div id="panelsDescription" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <p>{{ $product->description->description }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- DETAILS -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsDetails" aria-expanded="false" aria-controls="panelsDetails">
                                Detalles del producto
                            </button>
                        </h2>
                        <div id="panelsDetails" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <p>{{ $product->description->details }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- REVIEWS -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsReview" aria-expanded="true" aria-controls="panelsReview">
                                Opiniones
                            </button>
                        </h2>
                        <div id="panelsReview" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                @guest
                                <div>
                                    <p class="alert alert-dark w-100" role="alert">Debes iniciar sesión para poder dejar una opinión.</p>
                                </div>
                                @else
                                <!-- REVIEW FORM -->
                                <!-- TODO: Implementar formulario valoraciones -->
                                <!-- <form id="review-product-form" class="row justify-content-center" action="#" method="POST">
                                <div class="col-12 mb-2">
                                    <label class="form-label">Valoración</label>
                                    INPUT ESTRELLAS
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="emailInput" class="form-label">Confirmar Email</label>
                                    <input type="text" id="emailInput" class="form-control" name="email">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="commentTextArea" class="form-label">Comentario</label>
                                    <textarea id="commentTextArea" class="form-control" name="comment" cols="30" rows="5" style="resize: none;"></textarea>
                                </div>
                                <div class="col-12 mb-5">
                                    <button name="btnComment" type="submit" class="btn btn-outline-dark sendButton">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        Enviar
                                    </button>
                                    <button name="btnClear" type="reset" class="btn btn-dark clearButton">
                                        Limpiar
                                    </button>
                                </div>
                            </form> -->
                                @endguest

                                <!-- REVIEWS LIST -->
                                <div class="list-group">
                                    @if (count($product->reviews) > 0)
                                    @foreach ($product->reviews as $review)
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $review->user->name }} {{ $review->user->last_name }}</h5>
                                            <small>{{ $review->date }}</small>
                                        </div>
                                        <div class="ratings-star">
                                            Estrellas {{ $review->rating }}
                                        </div>
                                        <p class="mb-1">
                                            {{ $review->comment }}
                                        </p>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="list-group-item">
                                        <p class="m-0 p-3">No hay opiniones todavía. ¡Deja la primera!</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-12 col-md-5 order-first order-md-last right-column sticky-md-top h-100">
            <!-- IMAGE FOR SCREENS SMALLER THAN MD -->
            <div class="row mb-4 d-md-none">
                <figcaption class="text-center" style="height: 450px;">
                    <img class="w-auto h-100" src="{{ asset($product->images->first()->url ) }}" alt="Imagen de {{ $product->name }}">
                </figcaption>
            </div>

            <!-- PRODUCT NAME -->
            <div class="row border-bottom">
                <h2 id="product-name" class="col-12 product-name text-center text-md-start">{{ $product->name }}</h2>
            </div>

            <!-- PRODUCT PRICE -->
            <div class="row mt-3">
                <!-- PRODUCT PRICE -->
                <div class="col-12 product-price text-center text-md-start">
                    @if ($product->discount != 0)
                    <span id="product-discount-price">
                        {{ $product->discount }} €
                    </span>
                    <span id="product-price" style="text-decoration: line-through !important; color: gray; font-size: 22px;">
                        {{ $product->price }} €
                    </span>
                    <span id="product-iva-target">
                        IVA incluido
                    </span>
                    @else
                    <span id="product-price">
                        {{ $product->price }} €
                    </span>
                    <span id="product-iva-target">
                        IVA incluido
                    </span>
                    @endif
                </div>
            </div>

            <!-- RAITING AND SHARE -->
            <div class="row mt-4">
                <!-- PRODUCT STARS -->
                <!-- <div class="col-12 col-lg-8 product-stars text-center text-md-start"> -->
                <!-- TODO: Estrellas valoración media -->
                <!-- ESTRELLAS VALORACIONES -->
                <!-- </div> -->

                <!-- SOCIAL MEDIA -->
                <div class="col-12 col-lg-4 mt-3 mt-lg-0 product-social-media">
                    <div class="btn_wrap">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                            </svg>
                        </span>
                        <div class="icon-container">
                            <a id="twitter" href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=&via=" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a id="whatsapp" href="whatsapp://send?text={{ url()->current() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            <a id="telegram" href="https://telegram.me/share/url?url={{ url()->current() }}&text=" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a id="pinterest" href="https://www.pinterest.com/pin/create/button?url={{ url()->current() }}&media=&description=" target="_blank"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRODUCT BRAND -->
            <div class="row mt-4">
                <p class="col-6 col-md-3 col-lg-2 text-end text-md-start">Marca: </p>
                <p class="col-6 col-md-9 col-lg-10">{{ $product->brand->name }}</p>
            </div>

            <!-- PRODUCT COLOR -->
            @if ($product->description->color)
            <div class="row mt-2">
                <label for="productColor" class="form-label col-6 col-md-3 col-lg-2 col-form-label text-end text-md-start">Color: </label>
                <div class="col-6 col-md-9 col-lg-10">
                    <input type="color" class="form-control form-control-color" id="productColor" value="{{ $product->description->color }}" disabled>
                </div>
            </div>
            @endif

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <!-- PRODUCT SIZE -->
                <div class="row mt-3">
                    <label for="productSize" class="form-label col-6 col-md-3 col-lg-2 col-form-label text-end text-md-start">Talla: </label>
                    <div class="col-6 col-md-9 col-lg-10">
                        <select id="productSize" class="form-select w-50" name="size">
                            <option selected disabled>--</option>
                            @foreach ($product->description->sizes as $size)
                            <option value="{{ $size->size }}" @if($size->pivot->stock <= 0) disabled @endif>{{ $size->size }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <!-- QUANTITY -->
                <div class="row mt-5">
                    <div class="col-12 col-md-6 product-quantity">
                        <div class="row h-100">
                            <button id="quantity-minus" type="button" class="col-4 btn border-0 h-100">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input id="quantity-input" class="col-4 border-0 border-bottom text-center" type="text" value="1" name="quantity" min="1">
                            <button id="quantity-plus" type="button" class="col-4 btn border-0 h-100">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BUY AND FAVORITE BUTTONS -->
                <div class="row justify-content-between mt-5">
                    <div class="col-8 col-lg-8 product-buy-button">
                        <button type="submit" id="add-cart" class="btn btn-dark w-100">
                            Añadir a la cesta
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="col-4 col-lg-4 mt-lg-0 text-center text-lg-end product-favorite-button">
                        <button type="button" id="add-favorite" class="btn h-100 px-4" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Añadir favorito" data-bs-offset="0, 6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            @error('size')
            <div class="row">
                <div class="col-12 alert alert-warning alert-dismissible fade show px-5 mt-4">
                    <span class="m-0">Debes seleccionar una talla</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @enderror

            @if(session('message'))
            <div class="row">
                <div class="col-12 alert alert-success alert-dismissible fade show px-5 mt-4">
                    <span class="m-0">{{ session('message') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            @if(session('warning'))
            <div class="row">
                <div class="col-12 alert alert-warning alert-dismissible fade show px-5 mt-4">
                    <span class="m-0">{{ session('warning') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="row">
                <div class="col-12 alert alert-danger alert-dismissible fade show px-5 mt-4">
                    <span class="m-0">{{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="change-modal" tabindex="-1" aria-labelledby="change-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change-modal-label">Intercambio posible</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿No te convence? ¡A veces pasa! Si quieres deshacerte de un artículo y el período de devolución de 15 días ya ha pasado, puedes intercambiarlo por crédito.
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="shipping-modal" tabindex="-1" aria-labelledby="change-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change-modal-label">Envío estándar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    *Envío gratuito en gran parte de nuestra selección en pedidos a partir de 24,90 €. En compras de valor inferior se aplica una tarifa de envío de 2,90 €.
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- img modal -->
    <div id="product-img-modal" type="button" class="modal fade img-modal" tabindex="-1" aria-labelledby="img-modal-label" aria-hidden="true" data-bs-dismiss="modal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <figcaption>
                        <img id="product-img-modal-img" src="{{ asset('img/traje.png') }}" alt="Imagen {{ $product->name }}">
                    </figcaption>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection