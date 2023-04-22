<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // Obtiene todas las categorías para mostrarlas en el filtro
        $categories = Category::all();

        // Obtiene todos los productos o los productos de las categorías seleccionadas en el filtro
        $query = Product::query();
        $filter_categories = null;
        if ($request->has('categories')) {
            $filter_categories = $request->categories;
            $query->whereHas('categories', function ($query) use ($filter_categories) {
                $query->whereIn('category_id', $filter_categories);
            });
        }
        $products = $query->paginate(6);

        // Necesario para saber que categorías están seleccionadas en el filtro
        $filter_categories = collect($filter_categories);

        return view('products.index', compact('products', 'categories', 'filter_categories'));
    }

    public function show($id)
    {
        // Recuperar producto
        $product = Product::findOrFail($id);

        // Sobreentendemos que el usuario no tiene el producto en su lista de deseos
        $isFavorite = false;

        // Comprobar si hay un usuario logueado
        if (auth()->user()) {

            // Comprobar si el producto está en la lista de deseos del usuario
            if (auth()->user()->productsFavorites()->where('product_id', $product->id)->first()) {
                $isFavorite = true;
            }
        }

        if ($product->status !== 'disponible') {
            return redirect()->back();
        }

        $averageRating = 0;
        if ($product->reviews->count() > 0) {
            $averageRating = round($product->reviews()->avg('rating'));
        }

        return view('products.show', compact(['product', 'isFavorite', 'averageRating']));
    }

    public function rate(Request $request)
    {
        $userEmail = Auth::user()->email;

        $request->validate([
            'product' => 'required|exists:products,id',
            'rating' => 'required|numeric|min:0|max:5',
            'email' => [
                'required',
                'email',
                Rule::in([$userEmail])
            ],
            'comment' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            Review::create([
                'user_id' => Auth()->user()->id,
                'product_id' => $request->product,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'date' => now(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al publicar valoración');
        }

        return back()->with('message', 'Valoración creada con exito');
    }
}
