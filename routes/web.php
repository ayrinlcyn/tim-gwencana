<?php

use App\Http\Controllers\tokoController;
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