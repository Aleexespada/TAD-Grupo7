@extends('admin.layouts.dashboard')

@vite(['public/js/charts/ordersPerDayChart.js', 'public/js/charts/ordersPerCategoryChart.js'])

@section('title', 'Admin - Mr Penguin')

@section('content')
<div class="container-fluid px-5 py-3">
    <div class="row">
        <!-- Pedidos en los ultimos 10 días -->
        <div class="col-6">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="section-title d-sm-flex align-items-center">
                        <h4 class="mb-sm-0 font-size-18">
                            Pedidos en los últimos 10 días
                        </h4>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-3">
                                <span>
                                    {{ $last_10_days_total }} €
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Total ingresos últimos 10 días" data-bs-offset="0, 8">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </h5>
                            <div class="mt-3">
                                <canvas id="ordersPerDayChart" data-chart-data="{{ json_encode($orders_per_day_data) }}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pedidos por categoría -->
        <div class="col-6">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="section-title d-sm-flex align-items-center">
                        <h4 class="mb-sm-0 font-size-18">
                            Pedidos por categoría
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-3">
                                <span>
                                    {{ $total_orders }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Número total de pedidos" data-bs-offset="0, 8">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </h5>
                            <div class="mt-3 flex justify-content-center">       
                                <canvas id="ordersPerCategoryChart" height="200" data-chart-data="{{ json_encode($orders_per_category) }}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total ingresos mes -->
        <div class="col-3">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="section-title d-sm-flex align-items-center">
                        <h4 class="mb-sm-0 font-size-18">
                            Ingresos Mes
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-3">
                                <span>
                                    {{ $total_price_month }} €
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Número total de ingresos este mes" data-bs-offset="0, 8">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total pedidos mes -->
        <div class="col-3">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="section-title d-sm-flex align-items-center">
                        <h4 class="mb-sm-0 font-size-18">
                            Pedidos Mes
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-3">
                                <span>
                                    {{ $total_orders_month }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Número total de pedidos este mes" data-bs-offset="0, 8">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total ingresos -->
        <div class="col-3">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="section-title d-sm-flex align-items-center">
                        <h4 class="mb-sm-0 font-size-18">
                            Ingresos Totales
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-3">
                                <span>
                                    {{ $total_prices }} €
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Número total de ingresos" data-bs-offset="0, 8">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total pedidos -->
        <div class="col-3">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="section-title d-sm-flex align-items-center">
                        <h4 class="mb-sm-0 font-size-18">
                            Pedidos Totales
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-3">
                                <span>
                                    {{ $total_orders }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Número total de pedidos" data-bs-offset="0, 8">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection