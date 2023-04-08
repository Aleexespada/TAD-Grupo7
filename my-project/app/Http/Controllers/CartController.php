<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\DiscountCoupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $cart_items = auth()->user()->cartItems;

            $total_cart = 0;
            foreach($cart_items as $item) {
                $total_cart += $item->subtotal;
            }

            $discount_id = session('discount_id');
            if ($discount_id != null) {
                $discountCoupon = DiscountCoupon::find($discount_id);
                
                $discountCoupon->uses_limit--;
                $discountCoupon->save();

                $discount = $total_cart * ($discountCoupon->percentage / 100);
                $total_cart = $total_cart - $discount;
            }

            $errors = session('errors');
            if ($errors) {
                return view('cart.cart', compact(['cart_items', 'total_cart', 'errors']));
            }

            return view('cart.cart', compact(['cart_items', 'total_cart']));
        } else {
            return view('cart.cart');
        }   
    }

    public function decreaseProduct($id) 
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        $cart_item = CartItem::where('user_id', $user->id)->where('product_id', $id)->first();

        if ($cart_item) {
            if ($cart_item->quantity > 1) {
                $cart_item->quantity--;
                $cart_item->subtotal = $cart_item->quantity * $product->price;
                $cart_item->save();
            } else {
                $cart_item->delete();
            }
        }

        return redirect()->route('cart.index');
    }

    public function increaseProduct($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        $cart_item = CartItem::where('user_id', $user->id)->where('product_id', $id)->first();

        if ($cart_item) {
            $cart_item->quantity++;
            $cart_item->subtotal = $cart_item->quantity * $product->price;
            $cart_item->save();
        }

        return redirect()->route('cart.index');
    }

    public function createItemCart(Request $request)
    {
        // Validación
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();

        // Comprobar que el usuario tiene sesión iniciada
        if (!$user) {
            return back()->with('warning', 'Inicia sesión para añadir productos a la cesta');
        }

        // Obtención del producto
        $product = Product::findOrFail($request->product_id);

        // Si no hay stock suficiente del producto disponible
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'No hay stock suficiente del producto');
        }

        // Obtención de los productos del carro del usuario
        $cartItems = $user->cartItems;

        // Comprobación de si el producto está ya en la cesta
        $existingCartItem = $cartItems->firstWhere('product_id', $product->id);
        
        // Si existe el producto en la cesta y al añadir la nueva cantidad supera el stock
        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $request->quantity;

            if ($product->stock < $newQuantity) {
                return back()->with('error', 'No hay stock suficiente del producto');
            }
        }

        try {
            DB::beginTransaction();
            if ($existingCartItem) {
                // Si el producto ya está en el carrito, actualiza su cantidad   
                $existingCartItem->update([
                    'quantity' => $newQuantity,
                    'subtotal' => $newQuantity * $existingCartItem->unity_price,
                ]);
            } else {
                // Si el producto no está en el carrito, crea un nuevo elemento
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'unity_price' => $product->price,
                    'subtotal' => $product->price * $request->quantity,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al añadir el producto a la cesta');
        }

        return back()->with('message', 'Producto añadido a la cesta correctamente');
    }

    public function deleteItemCart($id)
    {
        $user = auth()->user();
        $cart_item = CartItem::where('user_id', $user->id)->where('product_id', $id)->first();
        
        if ($cart_item) {
            $cart_item->delete();
        }

        return redirect()->route('cart.index');
    }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string|max:255',   
        ]);

        $discount_name = $request->discount_code;

        $discountCoupon = DiscountCoupon::whereRaw('LOWER(code) = ?', strtolower($discount_name))->first();

        if ($discountCoupon && $discountCoupon->uses_limit > 0) {

            $user = User::find(auth()->user()->id);
            $discountCouponFound = $user->discountCoupons->where('id', $discountCoupon->id)->first();

            if ($discountCouponFound) {
                return redirect()->route('cart.index')->with('discount_id', $discountCoupon->id);

            } else {
                return redirect()->route('cart.index')->withErrors(['discount_code' => 'El código de descuento no está disponible.']);
            }
        } else {
            return redirect()->route('cart.index')->withErrors(['discount_code' => 'El código de descuento es inválido o ha alcanzado su límite de uso.']);;
        }
    }
    
}
