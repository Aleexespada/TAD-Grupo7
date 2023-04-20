@extends('admin.layouts.index')

@section('title', 'Categorías | Admin - Mr Penguin')

@section('section-title')
Categorías
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item active">Categorías</li>
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
            <a href="{{ route('dashboard.categories.create') }}" type="button" class="btn btn-dark btn-rounded mb-2 me-2">
                <i class="fa-solid fa-plus me-1"></i>
                Añadir nueva categoría
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
    <table class="table table-striped align-translate-middle">
        <thead class="table-light">
            <tr>
                <th class="align-middle">ID</th>
                <th class="align-middle">Nombre</th>
                <th class="align-middle">Número de productos</th>
                <th class="align-middle">Fecha creación</th>
                <th class="align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products->count() }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <div class="d-flex gap-3">
                        <a href="{{ route('dashboard.categories.show', $category->id) }}" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ver categoría">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editar categoría">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('dashboard.categories.delete', $category->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar categoría">
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
<div class="row justify-content-center text-center">
    <div class="col-auto">
        {{ $categories->links() }}
    </div>
</div>
@endsection