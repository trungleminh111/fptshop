<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return redirect()->back();
    }
}
