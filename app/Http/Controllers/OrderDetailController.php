<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function deleteOrderDetail(Request $request)
    {
        $orderdetailId = $request->order_id;
        $orderdetail = OrderDetail::find($orderdetailId);
        if (!$orderdetail) {
            session()->flash('error', 'Cart not found');
        }
        $orderdetail->delete();
        session()->flash('success', 'Cảm Ơn đã mua hàng !');
        return redirect()->back();
    }
}
