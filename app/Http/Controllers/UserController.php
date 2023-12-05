<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('layouts.profile');
    }

    public function upInfoProfile(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
            ]
        );
        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $data['name'],
            'address' => $data['address']
        ]);
        return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công !');
    }

    public function upPassProfile(Request $request) {
        $data = $request->validate(
            [
                'passwordold' => 'required',
                'passwordnew' => 'required',
                'passwordnew2' => 'required',
            ],
            [
                'passwordold.required' => 'Vui lòng nhập mật khẩu cũ',
                'passwordnew.required' => 'Vui lòng nhập mật khẩu mới',
                'passwordnew2.required' => 'Vui lòng nhập lại mật khẩu mới',
            ]
        );

        $user = User::find(Auth::user()->id);


        if (Hash::check($data['passwordold'],$user->password)) {
            if ($data['passwordnew'] != $data['passwordnew2']) {
                return redirect()->back()->with('error', 'Mật khẩu mới không giống nhau');
            }else{
                $user->update([
                    'password' => $data['passwordnew'],
                ]);
                return redirect()->back()->with('success', 'Bạn đã thay đổi mật khẩu thành công');
            }
        }else {
            return redirect()->back()->with('error', 'Mật khẩu không đúng !');
        }
    }
}
