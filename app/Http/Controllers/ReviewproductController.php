<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviewproduct;
use Illuminate\Http\Request;

class ReviewproductController extends Controller
{
    public function comment(Request $request)
    {
        $data = $request->validate(
            [
                'star' => 'required',
                'comment' => 'required',
                'user_id' => 'required',
                'product_id' => 'required',
            ],
            [
                'star.required' => 'Vui lòng chọn sao đánh giá',
                'comment.required' => 'vui lòng nhập nội dung comment',
            ]
        );
        $comment = Reviewproduct::where('user_id',  $data['user_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        if ($comment) {
            return redirect()->back()->with('success', 'Bạn đã đánh giá sản phẩm này!');
        } else {
            Reviewproduct::create([
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'noidung' => $data['comment'],
                'sao' => $data['star'],
            ]);
        }
        return redirect()->back()->with('success', 'Đánh giá thành công');
    }

    public function deleteReviewComment(Request $request) {
        $commentId = $request->comment_id;
        $comment = Reviewproduct::find($commentId);
        if (!$comment) {
            session()->flash('error', 'Cart not found');
        }
        $comment->delete();
        session()->flash('success', 'Đã xoá đánh giá');
        return redirect()->back();
    }
}
