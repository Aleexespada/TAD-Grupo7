@extends('layouts.app')

@section('title', 'Productos - Mr Penguin')

@vite(['resources/css/products.scss'])

@section('content')
<div class="row px-3">
    <div class="col-12 my-4">
        <button class="filter-button btn btn-dark-outline" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
            <i class="fa-solid fa-filter"></i> 
            <span class="text-uppercase">Filtros</span>
        </button>
    </div>
    <div class="col-auto sticky-md-top h-100 mb-3" style="z-index: 1010 !important; top: 100px !important;">
        <div class="collapse collapse-horizontal" id="collapseFilters">
            <div class="card card-body" style="width: 300px;">
                <form action="{{ route('products.index') }}" method="GET">
                    <label class="form-label fw-bold fs-5">Categorías</label>
                    @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]" @if ($filter_categories != null && $filter_categories->contains($category->id)) checked @endif>
                        <label class="form-check-label" for="category-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                    <button type="submit" class="apply-filter-button btn btn-dark text-uppercase mt-4">
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
                        <img src="{{ asset($product->images->first()->url) }}" class="card-img-top" alt="Imagen de {{ $product->name }}" style="object-fit: contain; height: 320px;">
                        @endif
                        <div class="card-body">
                            <span class="card-title">{{ $product->name  }}</span>
                            @if ($product->discount != 0)
                            <p class="card-text">
                                <span class="product-price text-danger">
                                    {{ $product->discount }} €
                                </span>
                                <span class="product-price text-decoration-line-through text-secondary">
                                    {{ $product->price }} €
                                </span>
                            </p>
                            @else
                            <p class="card-text">
                                <span class="product-price">
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
        <div class="row justify-content-center text-center">
            <div class="col-auto">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection