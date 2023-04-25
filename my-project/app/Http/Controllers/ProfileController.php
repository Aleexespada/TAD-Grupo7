<?php

namespace App\Http\Controllers;

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

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.info.show');
    }

    public function edit() 
    {        
        return view('profile.info.edit');
    }

    public function editPassword() 
    {        
        return view('profile.info.edit-password');
    }

    /**
     * TARJETAS DE CRÉDITO
     */
    public function indexCreditCards()
    {
        return view('profile.credit-cards.index');
    }

    public function createCreditCard()
    {
        return view('profile.credit-cards.create');
    }

    public function storeCreditCard(Request $request)
    {
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

            CreditCard::create([
                'user_id' => auth()->user()->id,
                'card_number' => Hash::make($validatedData['card_number']),
                'card_number_two_last_digits' => str_repeat("*", strlen($validatedData['card_number']) - 2) . substr($validatedData['card_number'], -2),
                'cardholder_name' => $validatedData['cardholder'],
                'cvv' => Hash::make($validatedData['cvv']),
                'expiration_month' => $month,
                'expiration_year' => $year,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear la tarjeta de crédito');
        }

        return back()->with('message', 'Tarjeta de crédito creada con éxito');
    }

    public function deleteCreditCard($credit_card_id)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            $credit_cart = CreditCard::where('user_id', $user_id)->where('id', $credit_card_id);
            if ($credit_cart) $credit_cart->delete();

            return back()->with('message', 'Tarjeta bancaria eliminada con éxito');
        } else {
            return back();
        }
    }

    /**
     * DIRECCIONES
     */
    public function indexAddresses()
    {
        return view('profile.addresses.index');
    }

    public function createAddress()
    {
        return view('profile.addresses.create');
    }

    public function storeAddress(Request $request)
    {
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

            Address::create([
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

        return back()->with('message', 'Dirección creada con éxito');
    }

    public function editAddress($id)
    {
        if (!auth()->user()->addresses->contains('id', $id)) {
            return back();
        }

        $address = Address::findOrFail($id);

        return view('profile.addresses.edit', compact('address'));
    }

    public function updateAddress(Request $request, $id)
    {
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

            Address::where('id', $id)->update([
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
            return back()->with('error', 'Error al editar la dirección');
        }

        return back()->with('message', 'Dirección actualizada con éxito');
    }

    public function deleteAddress($address_id)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            $address = Address::where('user_id', $user_id)->where('id', $address_id);
            if ($address) $address->delete();

            return back()->with('message', 'Dirección eliminada con éxito');
        } else {
            return back();
        }
    }

    /**
     * PEDIDOS
     */
    public function indexOrders()
    {
        return view('profile.orders.index');
    }

    public function indexCanceledOrders()
    {
        return view('profile.orders.index-canceled-orders');
    }

    public function cancelOrder($order_id)
    {
        try {
            DB::beginTransaction();

            Order::where('id', $order_id)->update([
                'status' => 'cancelado'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al cambiar estado del pedido');
        }

        return back()->with('message', 'Pedido con ID: ' . $order_id . ' cancelado con éxito. Disponible en la sección pedidos cancelados');
    }

    /**
     * VALORACIONES
     */
    public function indexReviews()
    {
        return view('profile.reviews.index');
    }
}
