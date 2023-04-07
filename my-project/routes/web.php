<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
})->name('index');

// Products
Route::get('/productos/{id}', [ProductsController::class, 'show'])->name('products.show');

// Cart
Route::get('/cesta', [CartController::class, 'index'])->name('cart.index');
Route::get('/cesta/decrementar/{id}', [CartController::class, 'decreaseProduct'])->name('cart.decrease');
Route::get('/cesta/incrementar/{id}', [CartController::class, 'increaseProduct'])->name('cart.increase');
Route::delete('/cesta/eliminar/{id}', [CartController::class, 'deleteItemCart'])->name('cart.delete');
Route::post('/cesta/discount', [CartController::class, 'applyDiscount'])->name('cart.apply_discount');
