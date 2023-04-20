@extends('admin.layouts.show')

@section('title', 'Categoría ID - ' . $category->id . ' | Admin - Mr Penguin')

@section('section-title')
Categoría ID - {{ $category->id }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories') }}" class="text-black">Categorías</a></li>
    <li class="breadcrumb-item active">Categoría ID - {{ $category->id }}</li>
</ol>
@endsection

@section('card-body')
<form id="showCategoryForm" class="row g-3">

    <div class="col-12">
        <h5 class="info-section">Información</h5>
    </div>

    <!-- NAME -->
    <div class="col-md-6">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" readonly>
    </div>

    <!-- CREATED AT -->
    <div class="col-md-3">
        <label for="created_at" class="form-label">Creado</label>
        <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $category->created_at }}" readonly>
    </div>

    <!-- UPDATED AT -->
    <div class="col-md-3">
        <label for="updated_at" class="form-label">Actualizado</label>
        <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $category->updated_at }}" readonly>
    </div>

    <div class="col-12">
        <h5 class="info-section">Productos</h5>
    </div>

    @if ($category->products->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped align-translate-middle">
            <thead class="table-light">
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Nombre</th>
                    <th class="align-middle">Precio</th>
                    <th class="align-middle">Fecha creación</th>
                    <th class="align-middle">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    @if($product->discount)
                    <td><span class="text-danger">{{ $product->discount }} €</span> <span class="text-decoration-line-through">{{ $product->price }} €</span></td>
                    @else
                    <td>{{ $product->price }} €</td>
                    @endif
                    <td>{{ $product->created_at }}</td>
                    <td>
                        @if ($product->status == 'disponible')
                        <p class="badge text-bg-success">{{ $product->status }}</p>
                        @elseif ($product->status == 'no disponible')
                        <p class="badge text-bg-danger">{{ $product->status }}</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="col-12">
        <p>No hay productos para esta categoría</p>
    </div>
    @endif
</form>
@endsection