@extends('layouts.app')

@section('title', 'Bienvenido - Mr Penguin')

@vite(['resources/css/products.scss'])

@section('content')
<div class="row px-3">
    <div class="col-12 my-4">
        <button class="btn btn-dark-outline" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
            <i class="fa-solid fa-filter"></i> Filtros
        </button>
    </div>
    <div class="col-auto sticky-md-top h-100 mb-3" style="z-index: 1010 !important; top: 100px !important;">
        <div class="collapse collapse-horizontal" id="collapseFilters">
            <div class="card card-body" style="width: 300px;">
                <form action="{{ route('index') }}" method="GET">
                    <label class="form-label fw-bold">Categorías</label>
                    @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]" @if ($filter_categories != null && $filter_categories->contains($category->id)) checked @endif>
                        <label class="form-check-label" for="category-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                    <button name="" type="submit" class="btn btn-dark mt-4">
                        Aplicar filtro
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @foreach ($products as $product)
            <div class="col product">
                <a href="{{ route('products.show', $product->id) }}" class="link-dark text-decoration-none">
                    <div class="card text-center border-0">
                        @if ($product->images->count() > 0)
                        <img src="{{ asset($product->images->first()->url) }}" class="card-img-top" alt="Imagen de {{ $product->name }}" style="object-fit: contain; height: 500px;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name  }}</h5>
                            @if ($product->discount != 0)
                            <p class="card-text fs-4">
                                <span class="text-danger">
                                    {{ $product->discount }} €
                                </span>
                                <span class="text-decoration-line-through text-secondary">
                                    {{ $product->price }} €
                                </span>
                            </p>
                            @else
                            <p class="card-text fs-4">
                                <span>
                                    {{ $product->price }} €
                                </span>
                            </p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection