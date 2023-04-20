@extends('layouts.app')

@section('title', 'Mis Tarjetas de crédito - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LAS TARJETAS DE CRÉDITO DEL USUARIO -->
        <div class="col-md-12">
            <div class="card mb-4 mb-md-0">
                <div class="card-body">
                    <h4 class="mb-4">Tarjetas de Crédito</h4>
                    <ul class="list-group list-group-flush rounded-3">
                        @if (Auth::user()->creditCards->count() > 0)
                        @foreach (Auth::user()->creditCards as $credit_card)
                        <li class="list-group-item p-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0"><b>Número:</b> {{ $credit_card->card_number }}</p>
                                    <p class="mb-0"><b>Titular:</b> {{ $credit_card->cardholder_name }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-0"><b>CVV:</b> {{ $credit_card->cvv }}</p>
                                    <p class="mb-0"><b>Fecha caducidad:</b> {{ $credit_card->expiration_month }} / {{ $credit_card->expiration_year }}</p>
                                </div>

                                <!-- BOTÓN PARA ELIMINAR TARJETA DE CRÉDITO -->
                                <!-- TODO: Modificar eliminación tarjeta crédito -->
                                <!-- <div class="btn ms-auto my-auto col-auto" data-bs-toggle="modal" data-bs-target="#modal-delete-credit-card-{{$credit_card->id}}">
                                <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar tarjeta" data-bs-offset="0, 10"></i>
                                </div> -->

                                <!-- MODAL PARA ELIMINAR TARJETA DE CRÉDITO  -->
                                <!-- <div class="modal fade" id="modal-delete-credit-card-{{$credit_card->id}}" tabindex="-1" aria-labelledby="modal-delete-credit-card-label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modal-delete-credit-card-label">
                                                    Eliminar tarjeta de crédito cr&eacute;dito</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Desea eliminar esta tarjeta de cr&eacute;dito?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form method="POST" action="{{ route('profile.delete.credit_card', $credit_card->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </li>
                        @endforeach
                        @else
                        No hay tarjetas guardadas
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection