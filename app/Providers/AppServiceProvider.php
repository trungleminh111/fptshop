<?php

namespace App\Providers;

use App\Models\Reviewproduct;
use App\Models\Cart;
use App\Models\Color;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Support\ServiceProvider;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Likeproduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;

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
            $view->with('likeproducts', Likeproduct::all());
            $view->with('reviewproducs', Reviewproduct::all());
            $view->with('productAttr', ProductVariant::all());
            $view->with('banners', Banner::all());
            $view->with('users', User::all());
            $view->with('orderdetails', OrderDetail::all());
            $view->with('orders', Order::all());
            $view->with('sizes', Size::all());
            $view->with('colors', Color::all());
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
            $review = DB::table('reviewproducts')
            ->select('product_id', DB::raw('COUNT(product_id) as total_quantity'))
            ->groupBy('product_id')
            ->get();
            $view->with('reviews', $review);
            
            $likeproduct = DB::table('likeproducts')
            ->select('product_id')
            ->where('user_id', Auth::user()->id)
            ->get();
            $view->with('likeproductss', $likeproduct);
            
        });
    }
}
