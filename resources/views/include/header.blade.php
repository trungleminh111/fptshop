<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTPhone</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('OwlCarousel/dist/assets/owl.theme.default.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body
    style="background-image: url(&quot;https://images.fpt.shop/unsafe/fit-in/filters:quality(95):fill(transparent)/fptshop.com.vn/Uploads/Originals/2023/11/20/638361139780215625_desk-header-bg.png&quot;); background-color: rgb(178, 5, 0);">

    <header class="ht-header">
        <div class="topHeader">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="topHeader-logo col-md-2">
                        <a href="/"><img src="{{asset('images/Logo.png')}}" alt=""
                                class="topHeader-logo--img col-md-12"></a>
                    </div>
                    <form action="{{ route('search') }}" method="GET" class="col-md-5">
                        <div class="box-search">
                            <input type="text" class="search-header col-md-10" name="search"
                                placeholder="Nhập tên điện thoại, máy tính, phụ kiện... cần tìm">
                            <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                    <div class="col-md">
                        <a href="" class="link-topheader">
                            <span><i class="fa-solid fa-file-lines"></i></span>
                            <span>Tin Tức</span>
                        </a>
                    </div>
                    <div class="col-md">
                        <a href="" class="link-topheader cart">
                            <span><i class="fa-solid fa-cart-shopping"></i> {{$countcart}}</span>
                            <span>Giỏ Hàng</span>
                        </a>
                    </div>
                    <div class="col-md">
                        <a href="" class="link-topheader">
                            <span><i class="fa-solid fa-circle-user"></i></span>
                            <span>Tài Khoản Của Tôi</span>
                        </a>
                    </div>
                    <div class="col-md">
                        <ul>
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                </div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            @endguest
                        </ul>
                    </div>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                    </ul>
                </div>
            </div>
        </div>
        <div class="botHeader">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <ul class="menuCategory d-flex h-100">
                        @foreach($categorys as $category)
                        <a href="../category/{{ $category->id }}" class="botHeader-category-link col-md h-100">
                            <li class="botHeader-menuCategory--li col-md h-100">
                                <img src="../uploads/{{$category->image}}" alt="" class="category-image h-100"
                                    style="filter: invert(1);">
                                <span class="">{{$category->name}}</span>
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </header>