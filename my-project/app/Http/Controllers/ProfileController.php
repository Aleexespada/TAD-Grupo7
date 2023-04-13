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
    public function index()
    {
        if (auth()->user()) {
            $user = auth()->user();

            return view('profile.profile', compact(['user']));
        } else {
            return view('profile.profile');
        }
    }

    public function indexCreditCards()
    {
        return view('profile.credit-cards');
    }

    public function indexAddresses()
    {
        return view('profile.addresses');
    }

    public function indexOrders()
    {
        return view('profile.orders');
    }

    public function deleteAddress($address_id)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            $address = Address::where('user_id', $user_id)->where('id', $address_id);
            if ($address) $address->delete();

            return redirect()->route('profile.profile');
        } else {
            return view('profile.profile');
        }
    }

    public function deleteCreditCard($credit_card_id)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            $credit_cart = CreditCard::where('user_id', $user_id)->where('id', $credit_card_id);
            if ($credit_cart) $credit_cart->delete();

            return redirect()->route('profile.profile');
        } else {
            return view('profile.profile');
        }
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

        return back()->with('message', 'Pedido con ID: ' . $order_id . ' cancelado con exito');
    }
}
