@extends('layouts.app')

@section('title', 'Bienvenido - Mr Penguin')

@section('content')
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 pt-5">
    @foreach ($products as $product)
    <div class="col">
        <a href="{{ route('products.show', $product->id) }}" class="link-dark text-decoration-none">
            <div class="card text-center">
                @if ($product->images->count() > 0)
                <img src="{{ asset($product->images->first()->url) }}" class="card-img-top" alt="Imagen de {{ $product->name }}" style="object-fit: contain;">
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
@endsection