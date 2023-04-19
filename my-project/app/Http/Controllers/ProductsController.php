<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($id)
    {
        // Recuperar producto
        $product = Product::findOrFail($id);

        // Sobreentendemos que el usuario no tiene el producto en su lista de deseos
        $isFavorite = false;

        // Comprobar si hay un usuario logueado
        if(auth()->user()) {

            // Comprobar si el producto está en la lista de deseos del usuario
            if(auth()->user()->productsFavorites()->where('product_id', $product->id)->first()) {
                $isFavorite = true;
            }
        }

        if ($product->status !== 'disponible') {
            return redirect()->back();
        }

        return view('products.show', compact(['product', 'isFavorite']));
    }
}
