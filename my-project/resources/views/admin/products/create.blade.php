@extends('admin.layouts.create')

<script defer src="{{ asset('js/addProductVariant.js') }}"></script>

@section('title', 'Crear producto | Admin - Mr Penguin')

@section('section-title')
Crear Nuevo Producto
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products') }}" class="text-black">Productos</a></li>
    <li class="breadcrumb-item active">Crear nuevo producto</li>
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
<form method="POST" action="{{ route('dashboard.products.create') }}" enctype="multipart/form-data" id="createProductForm" class="row g-3">
    @csrf

    <div class="col-12">
        <h5 class="info-section">Información</h5>
    </div>

    <!-- NAME -->
    <div class="col-md-6">
        <label for="name" class="form-label">Nombre*</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
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
        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
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
        <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount') }}">
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
                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]">
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
            <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
            <option value="disponible" {{ old('status') == 'disponible' ? 'selected' : '' }}>Disponible</option>
            <option value="no disponible" {{ old('status') == 'no disponible' ? 'selected' : '' }}>No disponible</option>
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
    </div>

    <!-- IMAGES -->
    <div class="col-md-6">
        <label for="image" class="form-label">Imagen o Imágenes</label>
        <input type="file" class="form-control" id="image" name="images[]" multiple>
    </div>

    <div class="col-12 mt-5">
        <h5 class="info-section">Descripción</h5>
    </div>

    <!-- DESCRIPTION -->
    <div class="col-md-6">
        <label for="description" class="form-label">Descripción*</label>
        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
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
        <textarea type="text" class="form-control @error('details') is-invalid @enderror" id="details" name="details">{{ old('details') }}</textarea>
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
        <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}">
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
            <select class="form-select @error('sizes.*') is-invalid @enderror" id="size" name="sizes[]">
                <option>--</option>
                @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ old('sizes.0') == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                @endforeach
            </select>
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
            <input type="text" class="form-control @error('stocks.*') is-invalid @enderror" id="stock" name="stocks[]" value="{{ old('stocks.0') }}">
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
    <div class="col-12 mt-5">
        <div class="row justify-content-end">
            <button name="btnClear" type="reset" class="col-12 col-md-4 col-xxl-2 btn btn-outline-dark py-3 px-5">
                Cancelar
            </button>
            <button name="btnRegister" type="submit" class="col-12 col-md-6 col-xxl-3 btn btn-dark py-3 px-5 mt-2 mt-md-0 ms-md-2 me-md-3">
                Crear producto
            </button>
        </div>
    </div>
</form>
@endsection