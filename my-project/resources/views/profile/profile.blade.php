@extends('layouts.app')

@section('title', 'Mi perfil - Mr Penguin')

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LOS DATOS DEL USUARIO -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nombre</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Apellidos</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->last_name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection