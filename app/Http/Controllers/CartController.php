<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('layouts.cart');
    }

    public function addtocart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $size_id = $request->size_id;
        $color_id = $request->color_id;
        $cartEntry = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->first();
        $product = Product::find($productId);
        if (!$product) {
            dd($request->all());
            return redirect()->back()->with('error', 'Product not found');
        }
        if ($cartEntry) {
            if($size_id == $cartEntry->size_id && $color_id == $cartEntry->color_id){
               
                $cartEntry->update([
                    'quantity' => $cartEntry->quantity + $quantity
                ]);
            }
            else{
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'size_id' => $size_id,
                    'color_id' =>$color_id,
                ]);
            }
           
        } else {
            if ($size_id && $color_id) {
                
                    Cart::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'size_id' =>$size_id,
                        'color_id' => $color_id,
                    ]);
                
            } else {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'size_id' => 0,
                    'color_id' => 0,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }

    public function updatecart(Request $request)
    {
        $cartId = $request->cart_id;
        $quantity = $request->quantity;
        $cart = Cart::find($cartId);
        if (!$cart) {
            session()->flash('error', 'Cart not found');
        }
        if ($cart->user_id != Auth::user()->id) {
            session()->flash('error', 'You are not buying');
        }
        $cart->update([
            'quantity' => $quantity,
        ]);
        session()->flash('success', 'Cập nhật giỏ hàng thành công!');
    }

    public function deletecart(Request $request)
    {
        $cartId = $request->cart_id;
        $cart = Cart::find($cartId);
        if (!$cart) {
            // sử dụng ajax
            session()->flash('error', 'Cart not found');
        }
        $cart->delete();
        // sử dụng ajax
        session()->flash('success', 'Xoá thành công');
        return redirect()->back();
    }
    public function reduce(Request $request)
    {
        $productId = $request->id;
        $quantity = $request->quantity;
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->first();
        if (isset($cart) && $quantity > 1) {
            $cart->update([
                'quantity' => $cart->quantity - 1
            ]);
        } else {
            $cart->delete();
        }
        return redirect()->back();
    }
    public function increase(Request $request)
    {
        $productId = $request->id;
        $quantity = $request->quantity;
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->first();
        if (isset($cart)) {
            $cart->update([
                'quantity' => $cart->quantity + $quantity
            ]);
        }
        return redirect()->back();
    }

}
