<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        if ($product->status !== 'disponible') {
            return redirect()->back();
        }

        return view('products.show', compact('product'));
    }
}
