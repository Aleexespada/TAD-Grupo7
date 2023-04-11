@extends('admin.layouts.index')

@section('title', 'Productos - Mr Penguin')

@section('section-title')
Productos
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item active">Productos</li>
</ol>
@endsection

@section('card-body')
<div class="row mb-2">
    <div class="col-sm-8">
        <div class=" me-2 mb-2 d-inline-block">
            <button type="button" class="btn btn-dark btn-rounded mb-2 me-2">
                <i class="fa-solid fa-plus me-1"></i>
                Añadir nuevo producto
            </button>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="search-box text-sm-end">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Buscar...">
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
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
                        <a href="" class="btn">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="" class="btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn">
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