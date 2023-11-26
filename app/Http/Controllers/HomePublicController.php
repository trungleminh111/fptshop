<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;


class HomePublicController extends Controller
{
    public function index() {
        return view('layouts.home');
    }

    public function category($id) {
        $category = Category::find($id);
        return view('layouts.category', compact('category'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $productss = Product::where('name', 'like', '%'.$query.'%')->get();
        return view('layouts.search', compact('productss'));
    }
}
