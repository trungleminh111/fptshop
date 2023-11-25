<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;


class HomePublicController extends Controller
{
    public function index() {
        return view('layouts.home');
    }
}
