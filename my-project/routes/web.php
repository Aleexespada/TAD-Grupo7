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

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('index');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard')->middleware('auth', 'verified', 'admin');
// Categories
Route::get('/admin/categorias', [AdminCategoryController::class, 'index'])->name('dashboard.categories')->middleware('auth', 'verified', 'admin');
Route::get('/admin/categorias/crear', [AdminCategoryController::class, 'create'])->name('dashboard.categories.create')->middleware('auth', 'verified', 'admin');
Route::post('/admin/categorias/crear', [AdminCategoryController::class, 'store'])->name('dashboard.categories.create')->middleware('auth', 'verified', 'admin');
Route::get('/admin/categorias/{id}', [AdminCategoryController::class, 'show'])->name('dashboard.categories.show')->middleware('auth', 'verified', 'admin');
Route::get('/admin/categorias/editar/{id}', [AdminCategoryController::class, 'edit'])->name('dashboard.categories.edit')->middleware('auth', 'verified', 'admin');
Route::put('/admin/categorias/editar/{id}', [AdminCategoryController::class, 'update'])->name('dashboard.categories.edit')->middleware('auth', 'verified', 'admin');
Route::delete('/admin/categorias/eliminar/{id}', [AdminCategoryController::class, 'destroy'])->name('dashboard.categories.delete')->middleware('auth', 'verified', 'admin');
// Products
Route::get('/admin/productos', [AdminProductController::class, 'index'])->name('dashboard.products')->middleware('auth', 'verified', 'admin');
Route::get('/admin/productos/crear', [AdminProductController::class, 'create'])->name('dashboard.products.create')->middleware('auth', 'verified', 'admin');
Route::post('/admin/productos/crear', [AdminProductController::class, 'store'])->name('dashboard.products.create')->middleware('auth', 'verified', 'admin');
Route::get('/admin/productos/{id}', [AdminProductController::class, 'show'])->name('dashboard.products.show')->middleware('auth', 'verified', 'admin');
Route::get('/admin/productos/editar/{id}', [AdminProductController::class, 'edit'])->name('dashboard.products.edit')->middleware('auth', 'verified', 'admin');
Route::put('/admin/productos/editar/{id}', [AdminProductController::class, 'update'])->name('dashboard.products.edit')->middleware('auth', 'verified', 'admin');
Route::delete('/admin/productos/eliminar/{id}', [AdminProductController::class, 'destroy'])->name('dashboard.products.delete')->middleware('auth', 'verified', 'admin');
// Orders
Route::get('/admin/pedidos', [AdminOrderController::class, 'index'])->name('dashboard.orders')->middleware('auth', 'verified', 'admin');
Route::get('/admin/pedidos/{id}', [AdminOrderController::class, 'show'])->name('dashboard.orders.show')->middleware('auth', 'verified', 'admin');
Route::put('/admin/pedidos/estado/{id}', [AdminOrderController::class, 'changeStatus'])->name('dashboard.orders.changestatus')->middleware('auth', 'verified', 'admin');

/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/
Route::get('/productos', [ProductsController::class, 'index'])->name('products.index');
Route::get('/productos/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::post('/productos/valorar', [ProductsController::class, 'rate'])->name('products.rate');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::get('/cesta', [CartController::class, 'index'])->name('cart.index')->middleware('auth', 'verified');
Route::post('/cesta/comprar', [CartController::class, 'buyProccess'])->name('cart.buy_proccess')->middleware('auth', 'verified');
Route::get('/cesta/direccion', [CartController::class, 'shipping'])->name('cart.shipping')->middleware('auth', 'verified');
Route::post('/cesta/direccion/seleccionar', [CartController::class, 'shippingSelect'])->name('cart.shipping_select')->middleware('auth', 'verified');
Route::get('/cesta/pago', [CartController::class, 'payMethod'])->name('cart.pay_method')->middleware('auth', 'verified');
Route::post('/cesta/pago/finalizar', [CartController::class, 'pay'])->name('cart.pay')->middleware('auth', 'verified');
Route::get('/cesta/confirmacion', [CartController::class, 'finish'])->name('cart.finish')->middleware('auth', 'verified');
Route::post('/cesta/decrementar/{id}', [CartController::class, 'decreaseProduct'])->name('cart.decrease')->middleware('auth', 'verified');
Route::post('/cesta/incrementar/{id}', [CartController::class, 'increaseProduct'])->name('cart.increase')->middleware('auth', 'verified');
Route::post('/cesta', [CartController::class, 'createItemCart'])->name('cart.add')->middleware('auth', 'verified');
Route::delete('/cesta/eliminar/{id}', [CartController::class, 'deleteItemCart'])->name('cart.delete')->middleware('auth', 'verified');
Route::post('/cesta/discount', [CartController::class, 'applyDiscount'])->name('cart.apply_discount')->middleware('auth', 'verified');


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.profile')->middleware('auth', 'verified');
Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.profile.edit')->middleware('auth', 'verified');
Route::get('/perfil/editar-contrasena', [ProfileController::class, 'editPassword'])->name('profile.changepassword')->middleware('auth', 'verified');
// Credit Cards
Route::get('/perfil/tarjetas-bancarias', [ProfileController::class, 'indexCreditCards'])->name('profile.creditcards')->middleware('auth', 'verified');
Route::get('/perfil/tarjetas-bancarias/crear', [ProfileController::class, 'createCreditCard'])->name('profile.creditcards.create')->middleware('auth', 'verified');
Route::post('/perfil/tarjetas-bancarias/crear', [ProfileController::class, 'storeCreditCard'])->name('profile.creditcards.create')->middleware('auth', 'verified');
Route::delete('/perfil/tarjetas-bancarias/eliminar/{id}', [ProfileController::class, 'deleteCreditCard'])->name('profile.delete.credit_card')->middleware('auth', 'verified');
// Addresses
Route::get('/perfil/direcciones', [ProfileController::class, 'indexAddresses'])->name('profile.addresses')->middleware('auth', 'verified');
Route::get('/perfil/direcciones/crear', [ProfileController::class, 'createAddress'])->name('profile.addresses.create')->middleware('auth', 'verified');
Route::post('/perfil/direcciones/crear', [ProfileController::class, 'storeAddress'])->name('profile.addresses.create')->middleware('auth', 'verified');
Route::get('/perfil/direcciones/editar/{id}', [ProfileController::class, 'editAddress'])->name('profile.addresses.edit')->middleware('auth', 'verified');
Route::put('/perfil/direcciones/editar/{id}', [ProfileController::class, 'updateAddress'])->name('profile.addresses.edit')->middleware('auth', 'verified');
Route::delete('/perfil/direcciones/eliminar/{id}', [ProfileController::class, 'deleteAddress'])->name('profile.delete.address')->middleware('auth', 'verified');
// Reviews
Route::get('/perfil/valoraciones', [ProfileController::class, 'indexReviews'])->name('profile.reviews')->middleware('auth', 'verified');
// Orders
Route::get('/perfil/pedidos', [ProfileController::class, 'indexOrders'])->name('profile.orders')->middleware('auth', 'verified');
Route::get('/perfil/pedidos-cancelados', [ProfileController::class, 'indexCanceledOrders'])->name('profile.canceledorders')->middleware('auth', 'verified');
Route::put('/perfil/cancelar-pedido/{id}', [ProfileController::class, 'cancelOrder'])->name('profile.cancel.order')->middleware('auth', 'verified');


/*
|--------------------------------------------------------------------------
| WISHLIST OR FAVORITES
|--------------------------------------------------------------------------
*/
Route::get('/lista-deseos', [WishListController::class, 'index'])->name('favorites.wish-list')->middleware('auth');
Route::post('/lista-deseos/añadir', [WishListController::class, 'addItem'])->name('favorites.add')->middleware('auth');
Route::post('/lista-deseos/move/{id}', [WishListController::class, 'moveToCart'])->name('favorites.move')->middleware('auth');
Route::delete('/lista-deseos/remove/product-view/{id}', [WishListController::class, 'removeItemFromProductView'])->name('favorites.remove.fromProductView')->middleware('auth');
Route::delete('/lista-deseos/remove/wish-list-view/{id}', [WishListController::class, 'removeItemFromWishList'])->name('favorites.remove.fromWishListView')->middleware('auth');