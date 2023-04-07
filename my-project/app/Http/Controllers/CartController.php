<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\DiscountCoupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function deleteItemCart($id) {
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
