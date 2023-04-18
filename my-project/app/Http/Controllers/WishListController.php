<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    /** Carga la lista de deseos del usuario */
    public function index()
    {
        if (auth()->user()) {
            $productosFavoritos = auth()->user()->productsFavorites;

            return view('favorites.wish-list', compact(['productosFavoritos']));
        } else {
            return view('favorites.wish-list');
        }
    }

    /** Añade un nuevo producto a la lista de deseos del usuario */
    public function addItem(Request $request)
    {
        $user = auth()->user();

        // Comprobar que el usuario tiene sesión iniciada
        if (!$user) {
            return back()->with('warning', 'Inicia sesión para añadir productos a la cesta');
        }

        // Obtención del producto
        $product = Product::findOrFail($request->product_id);

        // Obtención de los productos favoritos
        $favoritesItems = $user->productsFavorites();

        // Comprobación de si el producto está ya en la lista de deseos
        $existingFavoriteItem = $favoritesItems->where('product_id', $product->id)->first();

        if(!$existingFavoriteItem) {
            try {
                DB::beginTransaction();

                // Actualizar la relación del usuario con los productos favoritos
                $user->productsFavorites()->attach($product);
    
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Error al añadir el producto a la lista de favoritos');
            }
        }

        return back()->with('message', 'Producto añadido a la lista de deseos correctamente');
    }

    /** Mueve un producto desde la lista de deseos a la cesta del usuario */
    public function moveToCart($product_id, Request $request) 
    {
        $this->remoteItem($product_id);

        // Instanciar el controlador CartController
        $cartController = new CartController();

        // Crear una instancia de Request
        $cartRequest = new Request();
        $cartRequest->merge([
            'product_id' => $product_id,
            'size' => $request->size,
            'quantity' => 1
        ]);

    // Llamar a la función createItemCart del controlador CartController con la instancia de Request creada
    $cartController->createItemCart($cartRequest);

        // LLamar a la función CartController.createItemCart
        return redirect()->route('favorites.wish-list');
    }

    /** Elimina un producto de la lista de deseos del usuario desde la vista de la lista de deseos */
    public function removeItemFromWishList($product_id) 
    {
        if (auth()->user()) {
            $this->remoteItem($product_id);

            return redirect()->route('favorites.wish-list');
        } else {
            return view('favorites.wish-list');
        }
    }

    /** Elimina un producto de la lista de deseos del usuario desde la vista del producto */
    public function removeItemFromProductView($product_id) 
    {
        if (auth()->user()) {
            $this->remoteItem($product_id);

            return redirect()->route('favorites.wish-list');
        } else {
            return view('favorites.wish-list');
        }
    }

    /** Elimina un producto de la lista de deseos del usuario */
    private function remoteItem($product_id)
    {
        try {
            DB::beginTransaction();

            // Obtención del producto
            $product = Product::findOrFail($product_id);

            // Eliminar producto favorito
            auth()->user()->productsFavorites()->detach($product);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al eliminar el producto a la lista de favoritos');
        }
    }
}
