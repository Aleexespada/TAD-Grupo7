<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\CreditCard;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $cart_items = auth()->user()->cartItems;

            $total_cart = 0;
            foreach ($cart_items as $item) {
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

    public function buyProccess(Request $request)
    {
        $total_price_cart = $request->total_price_cart;
        session(['total_price_cart' => $total_price_cart]);

        return redirect()->route('cart.shipping');
    }

    // Carga la vista de seleccionar dirección
    public function shipping()
    {
        $total_price_cart = session('total_price_cart');
        $addresses = auth()->user()->addresses;

        return view('cart.shipping', compact(['total_price_cart', 'addresses']));
    }

    public function shippingSelect(Request $request)
    {
        // Comprobamos si obtenemos direccion, si no la creamos
        $shipping_address = $request->shipping_address;
        if (!$shipping_address) {
            $validatedData = $request->validate([
                'street' => 'required|string|max:255',
                'number' => 'required|string|max:10',
                'floor' => 'nullable|string|max:10',
                'postal_code' => 'required|string|max:10',
                'province' => 'required|string|max:255',
                'country' => 'required|string|max:255',
            ]);

            try {
                DB::beginTransaction();

                $address = Address::create([
                    'user_id' => auth()->user()->id,
                    'country' => $validatedData['country'],
                    'province' => $validatedData['province'],
                    'postal_code' => $validatedData['postal_code'],
                    'street' => $validatedData['street'],
                    'number' => $validatedData['number'],
                    'floor' => $validatedData['floor'],
                ]);

                DB::commit();

                $shipping_address = $address->id;
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Error al crear la dirección');
            }
        }
        session(['address' => $shipping_address]);

        return redirect()->route('cart.pay_method');
    }

    // Carga la vista de seleccionar método de pago
    public function payMethod()
    {
        $address_id = session('address');
        $address = Address::findOrFail($address_id);
        $total_price_cart = session('total_price_cart');
        $creditCards = auth()->user()->creditCards;

        return view('cart.payment', compact(['total_price_cart', 'address', 'creditCards']));
    }

    public function pay(Request $request)
    {
        // Comprobamos que hemos recibido un método de pago, sino, lo creamos
        $pay_method = $request->pay_method;
        if (!$pay_method) {
            $validatedData = $request->validate([
                'cardholder' => 'required|string|max:255',
                'card_number' => 'required|numeric|digits_between:13,19',
                'expiration_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{4}$/'],
                'cvv' => 'required|numeric|digits:3',
            ]);

            try {
                DB::beginTransaction();

                $parts = explode('/', $validatedData['expiration_date']);
                $month = $parts[0]; 
                $year = $parts[1]; 

                $credit_card = CreditCard::create([
                    'user_id' => auth()->user()->id,
                    'card_number' => Hash::make($validatedData['card_number']),
                    'cardholder_name' => $validatedData['cardholder'],
                    'cvv' => Hash::make($validatedData['cvv']),
                    'expiration_month' => $month,
                    'expiration_year' => $year,
                ]);

                DB::commit();

                $pay_method = $credit_card->id;
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Error al crear la tarjeta de crédito');
            }
        }

        // Obtenemos los datos necesarios
        $user = auth()->user();
        $address_id = session('address');
        $credit_card_id = $pay_method;
        $total_price_cart = session('total_price_cart');

        // Comienza transaccion
        try {
            DB::beginTransaction();

            // Creamos el pedido
            $order = new Order;
            $order->user_id = $user->id;
            $order->address_id = $address_id;
            $order->credit_card_id = $credit_card_id;
            $order->status = 'pendiente';
            // Comprobamos si se suman los gastos de envío
            if ($total_price_cart < 24.90) {
                $order->total_price = $total_price_cart + 2.90;
            } else {
                $order->total_price = $total_price_cart;
            }
            $order->order_date = now();
            $order->save(); // Se guarda el pedido

            // Obtenemos todos los items del carrito
            $cart_items = $user->cartItems;

            // Creamos la relacion de productos con pedido (tabla intermedia)
            foreach ($cart_items as $item) {
                $product = Product::findOrFail($item->product_id);
                $order->products()->attach($product, ['product_quantity' => $item->quantity, 'created_at' => now(), 'updated_at' => now()]);
                // Se actualiza el stock del producto
                $product->update([
                    'stock' => $product->stock - $item->quantity,
                ]);
            }

            // Se borra el carrito del usuario
            CartItem::where('user_id', $user->id)->delete();
            // Se borran los atributos de sesión que se establecieron
            session()->forget(['total_price_cart', 'address']);

            $order = Order::with('products')->find($order->id);
            Mail::to(auth()->user()->email)->send(new OrderMail($order));

            DB::commit();
            // Guardamos el pedido en sesión para poder acceder en la siguiente vista
            session(['order' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al realizar pedido');
        }

        // Redirección a la vista que confirma la compra
        return redirect()->route('cart.finish');
    }

    public function finish()
    {
        $order_id = session('order');
        $order = Order::findOrFail($order_id);

        return view('cart.finish', compact(['order']));
    }



    public function payment(Request $request)
    {
        $shipping_address = $request->shipping_address;
        if (!$shipping_address) {
            // dd($request);
            $validatedData = $request->validate([
                'street' => 'required|string|max:255',
                'number' => 'required|string|max:10',
                'floor' => 'nullable|string|max:10',
                'postal_code' => 'required|string|max:10',
                'province' => 'required|string|max:255',
                'country' => 'required|string|max:255',
            ]);

            // dd($validatedData);

            try {
                DB::beginTransaction();

                $shipping_address = Address::create([
                    'user_id' => auth()->user()->id,
                    'country' => $validatedData['country'],
                    'province' => $validatedData['province'],
                    'postal_code' => $validatedData['postal_code'],
                    'street' => $validatedData['street'],
                    'number' => $validatedData['number'],
                    'floor' => $validatedData['floor'],
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Error al crear la dirección');
            }
        }

        dd($shipping_address);

        $total_price_cart = $request->total_price_cart;
        $credit_cards = auth()->user()->creditCards;


        return view('cart.payment', compact(['total_price_cart', 'shipping_address', 'credit_cards']));
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
