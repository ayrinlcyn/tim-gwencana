<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\tokoController; // Tambahkan kontroler lain jika diperlukan
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('toko', tokoController::class);
Route::get('toko', [tokoController::class, 'index'])->name('toko.index');
Route::get('toko/create', [tokoController::class, 'create'])->name('toko.create');
Route::post('toko', [tokoController::class, 'store'])->name('toko.store');
Route::get('/action', [tokoController::class, 'actionView'])->name('toko.action');
Route::put('toko/{id}', [tokoController::class, 'update'])->name('toko.update');



Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::post('tambah.ke.keranjang/{id}', [CartController::class, 'addToCart'])->name('tambah.ke.keranjang');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');

Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/update-quantity', [CartController::class, 'updateCartQuantity'])->name('cart.updateQuantity');
Route::get('/keranjang', [CartController::class, 'viewCart'])->name('keranjang.view');
Route::post('/toko/{id}/addToCart', [CartController::class, 'addToCartFromToko'])->name('tambah.ke.keranjang.toko');
Route::get('/cart/remove-item/{id}', [CartController::class, 'removeItem'])->name('cart.removeItem');
Route::delete('/cart/remove-item/{id}', [CartController::class, 'removeItem'])->name('cart.removeItem');
