@extends('admin.layouts.edit')

<script defer src="{{ asset('js/addProductVariant.js') }}"></script>

@section('title', 'Editar producto ID - ' . $product->id . ' | Admin - Mr Penguin')

@section('section-title')
Editar producto ID - {{ $product->id }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products') }}" class="text-black">Productos</a></li>
    <li class="breadcrumb-item active">Editar producto ID - {{ $product->id }}</li>
</ol>
@endsection

@section('card-body')
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
<form method="POST" action="{{ route('dashboard.products.edit', $product->id) }}" enctype="multipart/form-data" id="updateProductForm" class="row g-3">
    @method('PUT')
    @csrf

    <div class="col-12">
        <h5 class="info-section">Información</h5>
    </div>

    <!-- NAME -->
    <div class="col-md-6">
        <label for="name" class="form-label">Nombre*</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}">
        <!-- Errores name -->
        @error('name')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- PRICE -->
    <div class="col-md-3">
        <label for="price" class="form-label">Precio*</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product->price }}">
        <!-- Errores price -->
        @error('price')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- DISCOUNT -->
    <div class="col-md-3">
        <label for="discount" class="form-label">Descuento</label>
        <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ $product->discount }}">
        <!-- Errores discount -->
        @error('discount')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- CATEGORY -->
    <div class="col-md-4">
        <label class="form-label">Categorías*</label>
        <div class="border rounded-3 p-2" style="height: 85px; overflow-y: scroll;">
            @foreach ($categories as $category)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]" @if ($product->categories->contains($category->id)) checked @endif>
                <label class="form-check-label" for="category-{{ $category->id }}">
                    {{ $category->name }}
                </label>
            </div>
            @endforeach
        </div>
        <!-- Errores categories -->
        @error('categories')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- BRAND -->
    <div class="col-md-4">
        <label for="brand" class="form-label">Marca*</label>
        <select class="form-select @error('brand') is-invalid @enderror" id="brand" name="brand">
            <option selected disabled>--</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" {{ $product->brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
            @endforeach
        </select>
        <!-- Errores brand -->
        @error('brand')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- STATUS -->
    <div class="col-md-4">
        <label for="status" class="form-label">Estado*</label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
            <option selected disabled>--</option>
            <option value="disponible" {{ $product->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
            <option value="no disponible" {{ $product->status == 'no disponible' ? 'selected' : '' }}>No disponible</option>
        </select>
        <!-- Errores status -->
        @error('status')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    
    <div class="col-12 mt-5">
        <h5 class="info-section">Imágenes</h5>
        <p>Puedes eliminar imagenes del producto, o añadir imagenes, las imagenes que añadas se unirán a las existentes.</p>
    </div>

    <div class="col-md-6">
        <label for="image" class="form-label">Imagen o Imágenes</label>
        <input type="file" class="form-control" id="image" name="images[]" multiple>
    </div>

    @if ($product->images->count() > 0)
    <!-- IMAGES -->
    <div class="col-12">
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4">
            @foreach ($product->images as $image)
            <div class="col mb-2">
                <div class="card text-center" style="height: 300px;">
                    <img src="{{ asset($image->url) }}" class="h-100 card-img-top" alt="" style="object-fit: contain;">

                    <!-- BOTÓN PARA CANCELAR PEDIDO -->
                    <div class="btn" data-bs-toggle="modal" data-bs-target="#modal-delete-image-{{ $image->id }}">
                        <i class="fa-solid fa-xmark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar imagen" data-bs-offset="0, 10"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="col-12 mt-5">
        <h5 class="info-section">Descripción</h5>
    </div>

    <!-- DESCRIPTION -->
    <div class="col-md-6">
        <label for="description" class="form-label">Descripción*</label>
        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $product->description->description }}</textarea>
        <!-- Errores description -->
        @error('description')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- DETAILS -->
    <div class="col-md-6">
        <label for="details" class="form-label">Detalles*</label>
        <textarea type="text" class="form-control @error('details') is-invalid @enderror" id="details" name="details">{{ $product->description->details }}</textarea>
        <!-- Errores details -->
        @error('details')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- COLOR -->
    <div class="col-md-2">
        <label for="color" class="form-label">Color*</label>
        <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ $product->description->color }}">
        <!-- Errores color -->
        @error('color')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-12 mt-5">
        <h5 class="info-section">Variantes</h5>
        <p>Se debe añadir al menos una variante del producto.</p>
    </div>

    <!-- VARIANTS -->
    <!-- SIZE -->
    <div class="col-6">
        <label for="size" class="form-label">Talla:</label>
        <div id="sizesInputs">
            @foreach ($product->description->sizes as $product_size)
            <select class="mt-1 form-select @error('sizes.*') is-invalid @enderror" id="size" name="sizes[]">
                <option>--</option>
                @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ $product_size->id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                @endforeach
            </select>
            @endforeach
        </div>
        @error('sizes.*')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>
    <!-- STOCK -->
    <div class="col-6">
        <label for="stock" class="form-label">Stock:</label>
        <div id="stocksInputs">
            @foreach ($product->description->sizes as $size)
            <input type="text" class="mt-1 form-control @error('stocks.*') is-invalid @enderror" id="stock" name="stocks[]" value="{{ $size->pivot->stock }}">
            @endforeach
        </div>
        @error('stocks.*')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-dark w-100" id="addVariant">Añadir</button>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-light border w-100" id="removeVariant">Quitar</button>
    </div>

    <!-- BUTTON -->
    <div class="col-12 mt-5 text-end">
        <button name="btnEdit" type="submit" class="btn btn-dark py-3 px-5">
            Editar producto
        </button>
    </div>
</form>

@if ($product->images->count() > 0)
@foreach ($product->images as $image)
<!-- MODAL PARA CANCELAR PEDIDO  -->
<div class="modal fade" id="modal-delete-image-{{ $image->id }}" tabindex="-1" aria-labelledby="modal-delete-image-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-delete-image-label">
                    Eliminar imagen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar esta imagen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('dashboard.products.image.delete', $image->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection