<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $products = $query->get();

        // Necesario para saber que categorías están seleccionadas en el filtro
        $filter_categories = collect($filter_categories);

        return view('products.index', compact('products', 'categories', 'filter_categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        if ($product->status !== 'disponible') {
            return redirect()->back();
        }

        return view('products.show', compact('product'));
    }
}
