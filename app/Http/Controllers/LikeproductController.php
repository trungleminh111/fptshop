<?php

namespace App\Http\Controllers;

use App\Models\Likeproduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Encore\Admin\Grid\Filter\Like;

class LikeproductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('layouts.home');
    }
    public function likeProduct(Request $request) {
        $productId = $request->product_id;
        $userId = $request->user_id;
        $likeInt = Likeproduct::where('user_id',  $userId)
            ->where('product_id', $productId)
            ->first();

        $product = Product::find($productId);
        if (!$product) {
            dd($request->all());
            return redirect()->back()->with('error', 'Product not found');
        }

        if ($likeInt) {
            return redirect()->back()->with('success', 'sản phẩm đã tồn tại');
        }else {
            Likeproduct::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        }

        
        return redirect()->back()->with('success', 'Đã thêm vào sản phẩm yếu thích');
    }

    public function deleteLikeProduct(Request $request)
    {
        $likeprId = $request->like_id;
        $likeproduct = Likeproduct::find($likeprId);
        if (!$likeproduct) {
            session()->flash('error', 'Cart not found');
        }
        $likeproduct->delete();
        session()->flash('success', 'Delete successfully');
        return redirect()->back();
    }
}
