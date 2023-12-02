<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;


class HomePublicController extends Controller
{
    public function index()
    {
        return view('layouts.home');
    }

    public function category($id)
    {
        $category = Category::find($id);
        return view('layouts.category', compact('category'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $variants = ProductVariant::where('product_id', $product->id)->get();

        return view('layouts.productdetail', compact('product', 'variants'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $productss = Product::where('name', 'like', '%' . $query . '%')->get();
        return view('layouts.search', compact('productss'));
    }
    public function getVariantPrice(Request $request)
    {
        $sizeId = $request->input('size_id');
        $colorId = $request->input('color_id');

        $variant = ProductVariant::where('size_id', $sizeId)
            ->where('color_id', $colorId)
            ->first();

        return response()->json(['price' => number_format($variant->price)]);
    }
}
