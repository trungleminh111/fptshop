<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('categorys', Category::all());
            $view->with('products', Product::all());
            $view->with('banners', Banner::all());
            // $view->with('users', User::all());
            $view->with('orderdetails', OrderDetail::all());
            $view->with('orders', Order::all());
            if (!Auth::user()) {
                $view->with('countcart', 0);
            } else {
                $view->with('countcart', Cart::where('user_id', Auth::user()->id)->count());
            }
            if (!Auth::user()) {
                
            } else {
                $view->with('carts', Cart::all()->where('user_id', Auth::user()->id));
                $view->with('auths', Auth::user());
            }
        });
    }
}
