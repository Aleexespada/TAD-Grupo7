@extends('layouts.app')

@section('title', 'Mi lista de deseos - Mr Penguin')

@vite(['resources/css/wish-list.scss'])

@section('content')
<div class="container">
    <div class="row list-container pt-5">
        <div class="col-12">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- LEFT COLUMN -->
                        <div class="col-xl-12">
                            <div id="list-content" class="p-5">
                                <div id="list-header" class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black text-uppercase">Mi lista de deseos</h1>
                                    <h6 class="mb-0 text-muted num-articles">@isset($productosFavoritos) {{ count($productosFavoritos) }} @else 0 @endif artículos</h6>
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

                                <!-- ITEM STRUCTURE -->
                                @guest
                                <p>Inicia sesión para comenzar a guardar productos en tu lista de deseos.</p>
                                @else
                                @isset($productosFavoritos)
                                @if (count($productosFavoritos) > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm align-middle">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center d-none d-md-table-cell"></th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- LISTADO DE PRODUCTOS EN LA LISTA DE DESEOS -->
                                            @foreach ($productosFavoritos as $product)
                                            <tr class="align-middle">
                                                <!-- IMAGEN -->
                                                <td class="d-none d-md-table-cell">
                                                    <img @if($product->images->count() > 0) src="{{ asset($product->images->first()->url) }}" @endif class="img-fluid rounded-3" alt="{{ $product->name }}" style="width: 100px;">
                                                </td>
                                                <!-- NOMBRE -->
                                                <td class=""><a href="{{ route('products.show', $product->id) }}" class="link-dark">{{ $product->name }}</a></td>
                                                <!-- PRECIO -->
                                                <td class="text-center">
                                                    @if ($product->discount != 0)
                                                    <span id="product-discount-price">
                                                        {{ $product->discount }} €
                                                    </span>
                                                    <span id="product-price" style="text-decoration: line-through !important; color: gray; font-size: 22px;">
                                                        {{ $product->price }} €
                                                    </span>
                                                    @else
                                                    <span id="product-price">
                                                        {{ $product->price }} €
                                                    </span>
                                                    @endif
                                                </td>
                                                <!-- ESTADO -->
                                                <td class="text-center">{{ $product->status }}</td>
                                                <!-- BOTON PARA AÑADIR A LA CESTA -->
                                                <td>
                                                    <button type="submit" class="btn btn-link text-black px-2" data-bs-target="#sizeModal" data-bs-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16"   data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Añadir a la cesta">
                                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                    </button>

                                                    <!--<form action="{{ route('favorites.move', $product->id) }}" method="POST" class="text-muted" style="cursor: pointer;">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-link text-black px-2" data-bs-toggle="modal" data-bs-target="#sizeModal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                            </svg>
                                                        </button>
                                                    </form>-->

                                                    <!-- MODAL PARA ESCOGER LA TALLA -->
                                                    <div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
                                                        <form action="{{ route('favorites.move', $product->id) }}" method="POST" class="text-muted" style="cursor: pointer;">
                                                            @csrf
                                                            @method('POST')    
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h2 class="modal-title fs-5" id="sizeModalLabel">Escoge tu talla antes de añadirlo a la cesta</h2>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
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
                                                                        <button type="submit" id="add-cart" class="btn btn-dark w-100 mt-5">
                                                                            Añadir a la cesta
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <!-- BOTON PARA ELIMINAR DE LA LISTA DE DESEOS -->
                                                <td>
                                                    <form action="{{ route('favorites.remove.fromWishListView', $product->id) }}" method="POST" class="text-muted" style="cursor: pointer; margin: 0;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-black px-2"><i class="fa fa-times"  data-bs-target="#sizeModal" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar de la lista"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p>No tiene artículos en la lista de deseos.</p>
                                @endif
                                @else
                                <p>No se ha obtenido lista de deseos.</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection