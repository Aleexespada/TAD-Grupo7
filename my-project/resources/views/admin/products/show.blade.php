@extends('admin.layouts.show')

@section('title', 'Producto ID - ' . $product->id . ' | Admin - Mr Penguin')

@section('section-title')
Producto ID - {{ $product->id }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products') }}" class="text-black">Productos</a></li>
    <li class="breadcrumb-item active">Producto ID - {{ $product->id }}</li>
</ol>
@endsection

@section('card-body')
<form id="showProductForm" class="row g-3">

    <div class="col-12">
        <h5>Información</h5>
    </div>

    <!-- NAME -->
    <div class="col-md-6">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" readonly>
    </div>

    <!-- PRICE -->
    <div class="col-md-3">
        <label for="price" class="form-label">Precio*</label>
        <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }} €" readonly>
    </div>

    <!-- DISCOUNT -->
    <div class="col-md-3">
        <label for="discount" class="form-label">Descuento</label>
        <input type="text" class="form-control" id="discount" name="discount" value="@if ($product->discount){{ $product->discount }} €@else -- @endif" readonly>
    </div>

    <!-- CREATED AT -->
    <div class="col-md-4">
        <label for="created_at" class="form-label">Creado</label>
        <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $product->created_at }}" readonly>
    </div>

    <!-- UPDATED AT -->
    <div class="col-md-4">
        <label for="updated_at" class="form-label">Actualizado</label>
        <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $product->updated_at }}" readonly>
    </div>

    <!-- STATUS -->
    <div class="col-md-4">
        <p class="form-label">Estado</p>
        @if ($product->status == 'disponible')
        <p class="badge text-bg-success">{{ $product->status }}</p>
        @elseif ($product->status == 'no disponible')
        <p class="badge text-bg-danger">{{ $product->status }}</p>
        @endif
    </div>

    <!-- CATEGORY -->
    <div class="col-md-6">
        <label for="category" class="form-label">Categorías</label>
        <input type="text" class="form-control" id="category" name="category" value="@foreach ($product->categories as $category){{ $category->name }}     @endforeach" readonly>
    </div>

    <!-- BRAND -->
    <div class="col-md-6">
        <label for="brand" class="form-label">Marca</label>
        <input type="text" class="form-control" id="brand" name="brand" value="{{ $product->brand->name }}" readonly>
    </div>

    @if ($product->images->count() > 0)
    <div class="col-12 mt-5">
        <h5>Imágenes</h5>
    </div>

    <!-- IMAGES -->
    <div class="col-12">
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4">
            @foreach ($product->images as $image)
            <div class="col">
                <div class="card text-center" style="height: 300px;">
                    <img src="{{ asset($image->url) }}" class="h-100 card-img-top" alt="" style="object-fit: contain;">
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="col-12 mt-5">
        <h5>Descripción</h5>
    </div>

    <!-- DESCRIPTION -->
    <div class="col-md-6">
        <label for="description" class="form-label">Descripción</label>
        <textarea type="text" class="form-control" id="description" name="description" readonly>{{ $product->description->description }}</textarea>
    </div>

    <!-- DETAILS -->
    <div class="col-md-6">
        <label for="details" class="form-label">Detalles</label>
        <textarea type="text" class="form-control" id="details" name="details" readonly>{{ $product->description->details }}</textarea>
    </div>

    <!-- COLOR -->
    <div class="col-md-2">
        <label for="color" class="form-label">Color</label>
        <input type="color" class="form-control form-control-color" id="color" name="color" value="{{ $product->description->color }}" disabled>
    </div>

    <div class="col-12 mt-5">
        <h5>Variantes</h5>
    </div>

    <!-- SIZE -->
    <div class="col-6">
        <label for="size" class="form-label">Talla:</label>
        <div id="sizesInputs">
            @foreach ($product->description->sizes as $size)
            <input type="text" class="form-control mt-1" id="size" name="size" value="{{ $size->size }}" readonly>
            @endforeach
        </div>
    </div>

    <!-- STOCK -->
    <div class="col-6">
        <label for="stock" class="form-label">Stock:</label>
        <div id="sizesInputs">
            @foreach ($product->description->sizes as $size)
            <input type="text" class="form-control mt-1" id="stock" name="stock" value="{{ $size->pivot->stock }}" readonly>
            @endforeach
        </div>
    </div>
</form>
@endsection