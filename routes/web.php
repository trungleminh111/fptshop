<?php
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


Route::get('/', [App\Http\Controllers\HomePublicController::class, 'index']);
Route::get('/category/{id}', [App\Http\Controllers\HomePublicController::class, 'category']);
Route::get('/product/{id}', [App\Http\Controllers\HomePublicController::class, 'product']);
Route::get('/get-variant-price', [App\Http\Controllers\HomePublicController::class,'getVariantPrice'])->name('get_variant_price');

Route::get('/search', [App\Http\Controllers\HomePublicController::class, 'search'])->name('search');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addtocart'])->name('addtocart');
Route::post('/reduce-quantity', [App\Http\Controllers\CartController::class, 'reduce'])->name('reduce');
Route::post('/increase-quantity', [App\Http\Controllers\CartController::class, 'increase'])->name('increase');
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updatecart'])->name('update_cart');
Route::post('/delete-cart', [App\Http\Controllers\CartController::class, 'deletecart'])->name('delete_cart');

Route::post('/check-out',[OrderController::class,'check'])->name('checkout');
Route::get('/thank-you',[OrderController::class,'thankyou'])->name('thankyou');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile']);
Route::post('/up-info-profile', [App\Http\Controllers\UserController::class, 'upInfoProfile'])->name('upinfo');
Route::post('/up-pass-profile', [App\Http\Controllers\UserController::class, 'upPassProfile'])->name('uppassword');