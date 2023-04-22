<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishListController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard')->middleware('auth', 'admin');
Route::get('/admin/categorias', [AdminCategoryController::class, 'index'])->name('dashboard.categories')->middleware('auth', 'admin');
Route::get('/admin/categorias/crear', [AdminCategoryController::class, 'create'])->name('dashboard.categories.create')->middleware('auth', 'admin');
Route::post('/admin/categorias/crear', [AdminCategoryController::class, 'store'])->name('dashboard.categories.create')->middleware('auth', 'admin');
Route::get('/admin/categorias/{id}', [AdminCategoryController::class, 'show'])->name('dashboard.categories.show')->middleware('auth', 'admin');
Route::get('/admin/categorias/edit/{id}', [AdminCategoryController::class, 'edit'])->name('dashboard.categories.edit')->middleware('auth', 'admin');
Route::put('/admin/categorias/edit/{id}', [AdminCategoryController::class, 'update'])->name('dashboard.categories.edit')->middleware('auth', 'admin');
Route::delete('/admin/categorias/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('dashboard.categories.delete')->middleware('auth', 'admin');
Route::get('/admin/productos', [AdminProductController::class, 'index'])->name('dashboard.products')->middleware('auth', 'admin');
Route::get('/admin/productos/crear', [AdminProductController::class, 'create'])->name('dashboard.products.create')->middleware('auth', 'admin');
Route::post('/admin/productos/crear', [AdminProductController::class, 'store'])->name('dashboard.products.create')->middleware('auth', 'admin');
Route::get('/admin/productos/{id}', [AdminProductController::class, 'show'])->name('dashboard.products.show')->middleware('auth', 'admin');
Route::get('/admin/productos/edit/{id}', [AdminProductController::class, 'edit'])->name('dashboard.products.edit')->middleware('auth', 'admin');
Route::put('/admin/productos/edit/{id}', [AdminProductController::class, 'update'])->name('dashboard.products.edit')->middleware('auth', 'admin');
Route::delete('/admin/productos/delete/{id}', [AdminProductController::class, 'destroy'])->name('dashboard.products.delete')->middleware('auth', 'admin');
Route::get('/admin/pedidos', [AdminOrderController::class, 'index'])->name('dashboard.orders')->middleware('auth', 'admin');
Route::get('/admin/pedidos/{id}', [AdminOrderController::class, 'show'])->name('dashboard.orders.show')->middleware('auth', 'admin');
Route::put('/admin/pedidos/estado/{id}', [AdminOrderController::class, 'changeStatus'])->name('dashboard.orders.changestatus')->middleware('auth', 'admin');

// Products
Route::get('/productos', [ProductsController::class, 'index'])->name('products.index');
Route::get('/productos/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::post('/productos/valorar', [ProductsController::class, 'rate'])->name('products.rate');

// Cart
Route::get('/cesta', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cesta/comprar', [CartController::class, 'buyProccess'])->name('cart.buy_proccess')->middleware('auth');
Route::get('/cesta/direccion', [CartController::class, 'shipping'])->name('cart.shipping')->middleware('auth');
Route::post('/cesta/direccion/seleccionar', [CartController::class, 'shippingSelect'])->name('cart.shipping_select')->middleware('auth');
Route::get('/cesta/pago', [CartController::class, 'payMethod'])->name('cart.pay_method')->middleware('auth');
Route::post('/cesta/pago/finalizar', [CartController::class, 'pay'])->name('cart.pay')->middleware('auth');
Route::get('/cesta/confirmacion', [CartController::class, 'finish'])->name('cart.finish')->middleware('auth');
Route::post('/cesta/decrementar/{id}', [CartController::class, 'decreaseProduct'])->name('cart.decrease')->middleware('auth');
Route::post('/cesta/incrementar/{id}', [CartController::class, 'increaseProduct'])->name('cart.increase')->middleware('auth');
Route::post('/cesta', [CartController::class, 'createItemCart'])->name('cart.add')->middleware('auth');
Route::delete('/cesta/eliminar/{id}', [CartController::class, 'deleteItemCart'])->name('cart.delete')->middleware('auth');
Route::post('/cesta/discount', [CartController::class, 'applyDiscount'])->name('cart.apply_discount')->middleware('auth');


// Profile
Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.profile')->middleware('auth');
Route::get('/perfil/tarjetas-bancarias', [ProfileController::class, 'indexCreditCards'])->name('profile.creditcards')->middleware('auth');
Route::get('/perfil/direcciones', [ProfileController::class, 'indexAddresses'])->name('profile.addresses')->middleware('auth');
Route::get('/perfil/valoraciones', [ProfileController::class, 'indexReviews'])->name('profile.reviews')->middleware('auth');
Route::get('/perfil/pedidos', [ProfileController::class, 'indexOrders'])->name('profile.orders')->middleware('auth');
Route::put('/perfil/cancelar-pedido/{id}', [ProfileController::class, 'cancelOrder'])->name('profile.cancel.order')->middleware('auth');
Route::delete('/perfil/eliminar-direccion/{id}', [ProfileController::class, 'deleteAddress'])->name('profile.delete.address')->middleware('auth');
Route::delete('/perfil/eliminar-tarjeta-credito/{id}', [ProfileController::class, 'deleteCreditCard'])->name('profile.delete.credit_card')->middleware('auth');


// WishList or Favorites
Route::get('/lista-deseos', [WishListController::class, 'index'])->name('favorites.wish-list')->middleware('auth');
Route::post('/lista-deseos/añadir', [WishListController::class, 'addItem'])->name('favorites.add')->middleware('auth');
Route::post('/lista-deseos/move/{id}', [WishListController::class, 'moveToCart'])->name('favorites.move')->middleware('auth');
Route::delete('/lista-deseos/remove/product-view/{id}', [WishListController::class, 'removeItemFromProductView'])->name('favorites.remove.fromProductView')->middleware('auth');
Route::delete('/lista-deseos/remove/wish-list-view/{id}', [WishListController::class, 'removeItemFromWishList'])->name('favorites.remove.fromWishListView')->middleware('auth');