@extends('admin.layouts.create')

@section('title', 'Crear categoría | Admin - Mr Penguin')

@section('section-title')
Crear Nuevo Categoría
@endsection

@section('breadcrumb')
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black">Panel administrador</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories') }}" class="text-black">Categorías</a></li>
    <li class="breadcrumb-item active">Crear nueva categoría</li>
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
<form method="POST" action="{{ route('dashboard.categories.create') }}" id="createCategoryForm" class="row g-3">
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

    <!-- BUTTON -->
    <div class="col-12 mt-5">
        <div class="row justify-content-end">
            <button name="btnClear" type="reset" class="col-12 col-md-4 col-xxl-2 btn btn-outline-dark py-3 px-5">
                Cancelar
            </button>
            <button name="btnRegister" type="submit" class="col-12 col-md-6 col-xxl-3 btn btn-dark py-3 px-5 mt-2 mt-md-0 ms-md-2 me-md-3">
                Crear categoría
            </button>
        </div>
    </div>
</form>
@endsection