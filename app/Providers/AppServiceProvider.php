<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

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
        view()->composer('*', function($view){
            $view -> with('categorys', Category::all()->sortBy('name'));
            $view -> with('products', Product::all());
            $view -> with('banners', Banner::all());
            $view -> with('users', User::all());
        });
    }
}
