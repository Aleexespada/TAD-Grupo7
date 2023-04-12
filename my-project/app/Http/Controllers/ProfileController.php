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
            $orders = $user->orders;
            $addresses = $user->addresses;
            $credit_cards = $user->creditCards;

            return view('profile.profile', compact(['user', 'orders', 'addresses', 'credit_cards']));
        } else {
            return view('profile.profile');
        }
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

    public function deleteOrder($order_id)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            $order = Order::where('user_id', $user_id)->where('id', $order_id);
            if ($order) $order->delete();

            return redirect()->route('profile.profile');

        } else {
            return view('profile.profile');
        }
    }
}
