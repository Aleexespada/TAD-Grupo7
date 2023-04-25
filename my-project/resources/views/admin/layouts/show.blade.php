@extends('admin.layouts.dashboard')

@section('content')
<div class="container-fluid px-5 py-3">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="section-title d-sm-flex align-items-center">
                <h4 class="mb-sm-0 font-size-18">
                    @yield('section-title')
                </h4>
            </div>
        </div>
        <div class="col-12 mt-3">
            @yield('breadcrumb')
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @yield('card-body')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection