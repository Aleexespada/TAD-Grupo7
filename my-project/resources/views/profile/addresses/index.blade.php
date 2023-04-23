@extends('layouts.app')

@section('title', 'Mis Direcciones - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LAS DIRECCIONES DEL USUARIO -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <h4 class="mb-4">Direcciones</h4>
                        <a href="{{ route('profile.addresses.create') }}" type="button" class="btn btn-dark btn-rounded mb-4">
                            <i class="fa-solid fa-plus me-1"></i>
                            Añadir nueva dirección
                        </a>
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
                        <ul class="list-group list-group-flush rounded-3">
                            @if (Auth::user()->addresses->count() > 0)
                            @foreach (Auth::user()->addresses as $address)
                            <li class="list-group-item p-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb-0"><b>País:</b> {{ $address->country }}</p>
                                        <p class="mb-0"><b>Provincia:</b> {{ $address->province }}</p>
                                        <p class="mb-0"><b>Código Postal:</b> {{ $address->postal_code }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0"><b>Dirección:</b> {{ $address->street }}, {{ $address->number }}</p>
                                        @if ($address->floor)
                                        <p class="mb-0"><b>Piso:</b> {{ $address->floor }}</p>
                                        @endif
                                    </div>

                                    <!-- BOTÓN PARA EDITAR DIRECCIÓN -->
                                    <a href="{{ route('profile.addresses.edit', $address->id) }}" class="btn ms-auto my-auto col-auto">
                                        <i class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editar dirección" data-bs-offset="0, 10"></i>
                                    </a>

                                    <!-- BOTÓN PARA ELIMINAR DIRECCIÓN -->
                                    <div class="btn my-auto col-auto" data-bs-toggle="modal" data-bs-target="#modal-delete-address-{{$address->id}}">
                                        <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar dirección" data-bs-offset="0, 10"></i>
                                    </div>

                                    <!-- MODAL PARA ELIMINAR DIRECCIÓN -->
                                    <div class="modal fade" id="modal-delete-address-{{$address->id}}" tabindex="-1" aria-labelledby="modal-delete-address-label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-delete-address-label">
                                                        Eliminar direcci&oacute;n</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea eliminar esta direcci&oacute;n?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form method="POST" action="{{ route('profile.delete.address', $address->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @else
                            No hay direcciones guardadas
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection