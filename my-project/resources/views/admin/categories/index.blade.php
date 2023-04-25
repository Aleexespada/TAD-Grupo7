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
    <div class="col-md-8">
        <div class=" me-2 mb-2 d-inline-block">
            <a href="{{ route('dashboard.categories.create') }}" type="button" class="btn btn-dark btn-rounded mb-2 me-2">
                <i class="fa-solid fa-plus me-1"></i>
                Añadir nueva categoría
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dropdown text-md-end">
            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if ($order == 'id' && $direction == 'asc') <i class="fa-solid fa-arrow-down-1-9"></i> ID asc.
                @elseif ($order == 'id' && $direction == 'desc') <i class="fa-solid fa-arrow-down-9-1"></i> ID desc.
                @elseif ($order == 'name' && $direction == 'asc') <i class="fa-solid fa-arrow-down-a-z"></i> Nombre asc.
                @elseif ($order == 'name' && $direction == 'desc') <i class="fa-solid fa-arrow-down-z-a"></i> Nombre desc.
                @elseif ($order == 'created_at' && $direction == 'asc') <i class="fa-solid fa-arrow-down-short-wide"></i> Fecha creación asc.
                @elseif ($order == 'created_at' && $direction == 'desc') <i class="fa-solid fa-arrow-down-wide-short"></i> Fecha creación desc.
                @endif
            </button>
            <ul class="order-dropdown dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('dashboard.categories', ['id','asc']) }}">ID asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.categories', ['id','desc']) }}">ID desc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.categories', ['name','asc']) }}">Nombre asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.categories', ['name','desc']) }}">Nombre desc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.categories', ['created_at','asc']) }}">Fecha creación asc.</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.categories', ['created_at','desc']) }}">Fecha creación desc.</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped align-translate-middle">
        <thead class="table-light">
            <tr>
                <th class="align-middle">@if($order == 'id' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'id' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif ID</th>
                <th class="align-middle">@if($order == 'name' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'name' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif Nombre</th>
                <th class="align-middle">Número de productos</th>
                <th class="align-middle">@if($order == 'created_at' && $direction == 'asc') <i class="fa-solid fa-sort-up"></i> @elseif($order == 'created_at' && $direction == 'desc') <i class="fa-solid fa-sort-down"></i> @else <i class="fa-solid fa-sort"></i> @endif Fecha creación</th>
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
                        <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#modal-delete-category-{{ $category->id }}">
                            <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar categoría"></i>
                        </button>
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
<!-- MODALS PARA ELIMINAR CATEGORIAS  -->
@foreach ($categories as $category)
<div class="modal fade" id="modal-delete-category-{{ $category->id }}" tabindex="-1" aria-labelledby="modal-delete-category-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-delete-category-label">
                    Eliminar categoría</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar esta categoría?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('dashboard.categories.delete', $category->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection