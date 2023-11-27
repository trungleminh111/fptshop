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
        return view('cart');
    }
    public function addtocart(Request $request)
    {

        $productId = $request->id;
        $quantity = $request->quantity;
        $cartEntry = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->first();
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        if ($cartEntry) {
            $cartEntry->update([
                'quantity' => $cartEntry->quantity + $quantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function updatecart(Request $request)
    {
        $cartId = $request->cart_id;
        $quantity = $request->quantity;
        $cart = Cart::find($cartId);
        if (!$cart) {
            // sử dụng ajax (ajax demo ở footer.blade.php)
            session()->flash('error', 'Cart not found');
        }
        if ($cart->user_id != Auth::user()->id) {
            // sử dụng ajax 
            session()->flash('error', 'You are not buying');
        }
        $cart->update([
            'quantity' => $quantity,
        ]);
        session()->flash('success', 'Cart updated successfully');
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
        session()->flash('success', 'Delete successfully');

    }
}
