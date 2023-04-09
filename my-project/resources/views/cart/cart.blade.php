@extends('layouts.app')

@section('title', 'Mi cesta - Mr Penguin')

@section('content')
<div class="row cart-container pt-5">
    <div class="col-12">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- LEFT COLUMN -->
                    <div class="col-lg-8">
                        <div id="cart-content" class="p-5">
                            <div id="cart-header" class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black text-uppercase">Mi cesta</h1>
                                <h6 class="mb-0 text-muted num-articles">@isset($cart_items) {{ count($cart_items) }} @else 0 @endif artículos</h6>
                            </div>

                            <!-- ERRORS -->
                            @if ($errors->any() > 0)
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <hr class="my-4">

                            <!-- ITEM STRUCTURE -->
                            @guest
                            <p>Inicia sesión para comenzar a comprar.</p>
                            @else
                            @isset($cart_items)
                            @if (count($cart_items) > 0)
                            @foreach($cart_items as $item)

                            <div class="item row mb-4 d-flex justify-content-between align-items-center">
                                <!-- IMAGE -->
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img @if($item->product->images->count() > 0) src="{{ asset('img/' . $item->product->images->first()->url) }}" @endif class="img-fluid rounded-3" alt="{{ $item->product->name }}">
                                </div>
                                <!-- NAME -->
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <h6 class="text-muted">
                                        <a href="{{ route('products.show', $item->product->id) }}" class="link-dark">{{ $item->product->name }}</a>
                                    </h6>
                                </div>
                                <!-- QUANTITY -->
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <form action="{{ route('cart.decrease', $item->product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-black px-2"><i class="fa fa-minus"></i></button>
                                    </form>
                                    <input value="{{ $item->quantity }}" type="text" class="form-control form-control-sm text-center" readonly>
                                    <form action="{{ route('cart.increase', $item->product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-black px-2"><i class="fa fa-plus"></i></button>
                                    </form>
                                </div>
                                <!-- PRICE -->
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 item-price">
                                    <h6 class="mb-0">
                                        {{ $item->unity_price }} €
                                    </h6>
                                </div>
                                <!-- DELETE -->
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <form action="{{ route('cart.delete', $item->product->id) }}" method="POST" class="text-muted" style="cursor: pointer;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-black px-2"><i class="fa fa-times"></i></button>
                                    </form>
                                </div>
                            </div>

                            <hr class="my-4">

                            @endforeach
                            @else
                            <p>No tiene artículos en la cesta.</p>
                            @endif
                            @else
                            <p>No se ha obtenido carrito.</p>
                            @endisset
                            @endguest

                            <div class="pt-5">
                                <h6 class="mb-0">
                                    <a href="{{ route('index') }}" class="text-body">
                                        Volver a la tienda
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <!-- END LEFT COLUMN -->

                    <!-- RIGHT COLUMN -->
                    @guest
                    @else
                    <div class="col-right col-lg-4 bg-grey">

                        <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Resumen</h3>
                            <hr class="my-4">

                            <!-- TOTAL ITEMS -->
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-uppercase num-articles">{{ count($cart_items) }} artículos</h5>
                            </div>

                            @if (count($cart_items) > 0)
                            <!-- SHIPMENT -->
                            <h5 class="text-uppercase mb-3">Envío</h5>
                            <div class="mb-4 pb-2">
                                @if ($total_cart > 24.90) Gratis @else 2.90 € | Te faltan {{ 24.90 - $total_cart }} € para envío gratis @endif
                            </div>

                            <!-- DISCOUNT CODE -->
                            <h5 class="text-uppercase mb-3">Código de descuento</h5>
                            <div class="mb-5">
                                <form action="{{ route('cart.apply_discount') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <label class="form-label" for="discount-code">Ingresa tu código</label>
                                    <input type="text" id="discount-code" name="discount_code" class="form-control form-control-lg" />

                                    <button type="submit" class="btn btn-outline-dark mt-2 w-100">Aplicar</button>
                                </form>
                            </div>

                            <hr class="my-4">

                            <!-- TOTAL PRICE -->
                            <div class="d-flex justify-content-between mb-5">
                                <h5 class="text-uppercase">Precio total</h5>
                                <h5 class="total-price-final">@if ($total_cart > 24.90) {{ $total_cart }} @else {{ $total_cart + 2.90 }} @endif €</h5>
                            </div>

                            <form action="{{ route('cart.buy_proccess') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="total_price_cart" value="{{ $total_cart }}">

                                <button type="submit" class="btn btn-dark btn-block btn-lg w-100" data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#payment-modal">
                                    Comprar
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endguest
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>

    </div>
@endsection