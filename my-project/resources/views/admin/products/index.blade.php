@extends('admin.layouts.index')

@section('title', 'Productos | Admin - Mr Penguin')

@section('section-title')
Productos
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <!-- <li class="breadcrumb-item"><a href="" class="text-black">Panel administrador</a></li> -->
    <li class="breadcrumb-item active">Productos</li>
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
<div class="row mb-2">
    <div class="col-sm-8">
        <div class=" me-2 mb-2 d-inline-block">
            <a href="{{ route('dashboard.products.create') }}" type="button" class="btn btn-dark btn-rounded mb-2 me-2">
                <i class="fa-solid fa-plus me-1"></i>
                Añadir nuevo producto
            </a>
        </div>
    </div>
    <div class="col-sm-4">
        <!-- TODO: Hacer barra búsqueda -->
        <!-- <div class="search-box text-sm-end">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Buscar...">
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
            </div>
        </div> -->
    </div>
</div>

<div class="table-responsive">
    <table class="table align-translate-middle">
        <thead class="table-light">
            <tr>
                <th class="align-middle">ID</th>
                <th class="align-middle">Nombre</th>
                <th class="align-middle">Precio</th>
                <th class="align-middle">Marca</th>
                <th class="align-middle">Fecha creación</th>
                <th class="align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                @if($product->discount)
                <td><span class="text-danger">{{ $product->discount }} €</span> <span class="text-decoration-line-through">{{ $product->price }} €</span></td>
                @else
                <td>{{ $product->price }} €</td>
                @endif
                <td>{{ $product->brand->name }}</td>
                <td>{{ $product->created_at }}</td>
                <td>
                    <div class="d-flex gap-3">
                        <a href="{{ route('dashboard.products.show', $product->id) }}" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver producto">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editar producto">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('dashboard.products.delete', $product->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar producto">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection