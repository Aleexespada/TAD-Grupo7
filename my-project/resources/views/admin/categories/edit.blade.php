@extends('admin.layouts.edit')

@section('title', 'Editar categoría ID - ' . $category->id . ' | Admin - Mr Penguin')

@section('section-title')
Editar categoría ID - {{ $category->id }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories') }}" class="text-black">Categorías</a></li>
    <li class="breadcrumb-item active">Editar categoría ID - {{ $category->id }}</li>
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
<form method="POST" action="{{ route('dashboard.categories.edit', $category->id) }}" id="updateCategoryForm" class="row g-3">
    @method('PUT')
    @csrf
    <div class="col-12">
        <h5 class="info-section">Información</h5>
    </div>
    <!-- NAME -->
    <div class="col-md-6">
        <label for="name" class="form-label">Nombre*</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}">
        <!-- Errores name -->
        @error('name')
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- BUTTON -->
    <div class="col-12 mt-5 text-end">
        <button name="btnEdit" type="submit" class="btn btn-dark py-3 px-5">
            Editar categoría
        </button>
    </div>
</form>

@endsection