@extends('layouts.app')

@section('title', 'Confirmación Pedido - Mr Penguin')

@section('content')

<div class="row cart-container pt-5">
    <div class="col-12">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-12">
                        <div id="cart-content" class="p-5">
                            <div id="cart-header" class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black text-uppercase">Pedido completado con exito</h1>
                            </div>

                            <div class="pt-5">
                                <h6 class="mb-0">
                                    <a href="{{ route('index') }}" class="text-body">
                                        Volver a la tienda
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection