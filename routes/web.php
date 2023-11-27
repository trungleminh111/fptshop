<?php
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
Route::get('/search', [App\Http\Controllers\HomePublicController::class, 'search'])->name('search');
Route::get('/cart', [App\Http\Controllers\HomePublicController::class, 'cart'])->name('cart');




Auth::routes(['verify' => true]);
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addtocart'])->name('addtocart');
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updatecart'])->name('update_cart');
Route::post('/delete-cart', [App\Http\Controllers\CartController::class, 'deletecart'])->name('delete_cart');
