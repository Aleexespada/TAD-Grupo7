<?php

namespace App\Http\Controllers;

use App\Models\RecentlyAddedProduct;
use App\Models\TopProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topProducts = TopProduct::all();
        $recentlyAddedProducts = RecentlyAddedProduct::all();

        return view('home', compact('topProducts', 'recentlyAddedProducts'));
    }
}
