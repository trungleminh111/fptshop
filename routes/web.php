<?php

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

Route::get('/', [App\Http\Controllers\HomePublicController::class, 'index']);
Route::get('/category/{id}', [App\Http\Controllers\HomePublicController::class, 'category']);
Route::get('/search', [App\Http\Controllers\HomePublicController::class, 'search'])->name('search');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addtocart'])->name('addtocart');
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updatecart'])->name('update_cart');
Route::post('/delete-cart', [App\Http\Controllers\CartController::class, 'deletecart'])->name('delete_cart');
