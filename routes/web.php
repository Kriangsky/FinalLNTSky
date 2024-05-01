<?php

use App\Http\Controllers\Authentication;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
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
    return view('authentication');
});

Route::get('/home', [ItemController::class, 'show'])->name('show');

Route::post('/login-process', [AuthController::class, 'login'])->name('login');
Route::post('/register-process', [AuthController::class, 'register'])->name('register');
Route::post('/admin-process', [AuthController::class, 'admin'])->name('admin');
Route::post('/store', [ItemController::class, 'store'])->name('store');

Route::get('/admin-insert', [ItemController::class, 'viewInsert'])->name('viewInsert');
Route::get('/admin-index', [ItemController::class, 'index'])->name('view');

Route::get('/admin-update/{id}', [ItemController::class, 'showUpdateForm'])->name('update-form');
Route::put('/admin-update/{id}', [ItemController::class, 'update'])->name('update');

Route::get('/items/{id}/delete', [ItemController::class, 'deleteForm'])->name('delete-form');
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('delete');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cart/{user_id}', [CartController::class, 'showCart'])->name('cart');
Route::post('/add-carts', [CartController::class, 'add'])->name('add');
Route::delete('/cart/{cartId}', [CartController::class, 'delete'])->name('cart.delete');

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/receipt', [CartController::class, 'showReceipt'])->name('receipt');