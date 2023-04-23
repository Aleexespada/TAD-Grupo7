@extends('layouts.app')

@section('title', 'Mis Valoraciones - Mr Penguin')

@vite(['resources/css/profile.scss'])

@section('content')
<section>
    <div class="container py-5">
        <!-- CARD CON LAS VALORACIONES DEL USUARIO -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <h4 class="mb-4">Mis valoraciones</h4>
                        @if (Auth::user()->reviews->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead class="">
                                    <tr>
                                        <th class="text-center d-none d-md-table-cell"></th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Valoración</th>
                                        <th class="text-center">Comentario</th>
                                        <th class="text-center">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Auth::user()->reviews()->orderBy('created_at', 'desc')->paginate(4) as $review)
                                    <tr class="align-middle">
                                        <td class="d-none d-md-table-cell">
                                            <img @if($review->product->images->count() > 0) src="{{ asset($review->product->images->first()->url) }}" @endif class="img-fluid rounded-3" alt="{{ $review->product->name }}" style="width: 100px;">
                                        </td>
                                        <td class=""><a href="{{ route('products.show', $review->product->id) }}" class="link-dark">{{ $review->product->name }}</a></td>
                                        <td class="text-center">
                                            <div class="ratings-star">
                                                <div class="col">
                                                    <div class="rate p-0">
                                                        <input type="radio" class="rate" @if ($review->rating ==5) checked @endif />
                                                        <label title="text">5 stars</label>
                                                        <input type="radio" class="rate" @if ($review->rating ==4) checked @endif />
                                                        <label title="text">4 stars</label>
                                                        <input type="radio" class="rate" @if ($review->rating ==3) checked @endif />
                                                        <label title="text">3 stars</label>
                                                        <input type="radio" class="rate" @if ($review->rating ==2) checked @endif />
                                                        <label title="text">2 stars</label>
                                                        <input type="radio" class="rate" @if ($review->rating ==1) checked @endif />
                                                        <label title="text">1 star</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $review->comment }}</td>
                                        <td class="text-center">{{ $review->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center text-center">
                            <div class="col-auto">
                                {{ Auth::user()->reviews()->paginate(4)->links() }}
                            </div>
                        </div>
                        @else
                        No has dejado ninguna valoración
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection