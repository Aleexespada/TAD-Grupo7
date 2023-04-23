@extends('layouts.app')

@section('title', 'Editar información - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LOS DATOS DEL USUARIO -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <!-- TÍTULO SECCIÓN -->
                        <h4 class="col-12 mb-4">Editar información perfil</h4>

                        <!-- MIGA DE PAN -->
                        <div class="col-12">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('profile.profile') }}" class="text-black">Mi perfil</a></li>
                                <li class="breadcrumb-item active">Editar información</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <!-- MENSAJES -->
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

                            <!-- FORMULARIO -->
                            <form method="POST" action="{{ route('user-profile-information.update') }}" id="editUserInfoForm">
                                @method('PUT')
                                @csrf

                                <div class="row mb-lg-4">
                                    <!-- NAME -->
                                    <label class="col-lg-2 col-form-label" for="name">Nombre</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror" name="name" id="name" value="{{ Auth::user()->name }}">
                                        <!-- Errores name -->
                                        @error('name', 'updateProfileInformation')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- LAST NAME -->
                                    <label class="col-lg-2 col-form-label" for="last_name">Apellidos</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control @error('last_name', 'updateProfileInformation') is-invalid @enderror" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}">
                                        <!-- Errores last_name -->
                                        @error('last_name', 'updateProfileInformation')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-lg-4">
                                    <!-- EMAIL -->
                                    <label class="col-lg-2 col-form-label" for="email">Email</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror" name="email" id="email" value="{{ Auth::user()->email }}">
                                        <!-- Errores email -->
                                        @error('email', 'updateProfileInformation')
                                        <div class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark mt-3">
                                    Editar información
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection