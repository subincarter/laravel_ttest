<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;

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
Route::get('/',[LoginController::class,'index']);

Route::post('login',[LoginController::class,'loginCustomer']);


Route::get('products',[HomeController::class,'index'])->name('products');
Route::get('cartList',[HomeController::class,'whislistPage'])->name('cartList');
Route::get('addToWishlist/{id}',[OrdersController::class,'index'])->name('save');
Route::get('removeProduct/{id}',[OrdersController::class,'removeProduct'])->name('remove');
Route::get('buyProduct/{id}',[OrdersController::class,'buyProduct'])->name('buyProduct');
