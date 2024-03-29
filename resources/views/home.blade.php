@include('include/header')
<div class="sale-bfday">
    <div class="container">
        <div class="row">
            @foreach($banners as $banner)
            @if ($banner->type == 2)
            <img src="../uploads/{{$banner->image}}" alt="" class="owl-lazy col-md-12">
            @endif
            @endforeach
        </div>
    </div>
</div>
<div class="banner-box container">
    <div class="row h-100">
        <div class="col-md-8 h-100">
            <div id="carouselExampleIndicators" class="carousel slide h-100" style="padding: 5px;">
                <div class="carousel-inner p-0">
                    @php
                    $index = 0;
                    @endphp
                    @foreach($banners as $banner)
                    @if($banner->type == 0)
                    @php
                    $index++;
                    @endphp
                    <div class="carousel-item @if ($index == 1) {{ 'active' }} @endif">
                        <img src="../uploads/{{$banner->image}}" class="d-block w-100" alt="...">
                    </div>
                    @endif
                    @endforeach
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="btn-control carousel-control-prev" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left fa-2xl" style="color: #ff0000;"></i></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="btn-control carousel-control-next" aria-hidden="true"><i class="fa-solid fa-circle-chevron-right fa-2xl" style="color: #ff0000;"></i></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="carousel-indicators">
                    @php
                    $data = 0;
                    $index = 0;
                    @endphp
                    @foreach($banners as $banner)
                    @if($banner->type == 0)
                    @php
                    $index++;
                    @endphp
                    <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$data}}" class="banner-content @if ($index == 1) {{ 'active' }} @endif" aria-current="true" aria-label="Slide 1"><b>{{$banner->name}}</b>
                    </span>
                    @php
                    $data++;
                    @endphp
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 row p-0">
            @foreach($banners as $banner)
            @if($banner->type == 1)
            <div class="col-12" style="padding: 5px;">
                <a href=""><img src="../uploads/{{$banner->image}}" alt="" class="h-100 w-100"></a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@foreach($banners as $banner)
@if($banner->type == 3)
<div class="sale-gamming">
    <div class="container">
        <div class="row">
            <a href="" class="col-12">
                <img src="../uploads/{{$banner->image}}" alt="" class="h-100 w-100">
            </a>
        </div>
    </div>
</div>
@endif
@endforeach

<div class="km-hot container">
    <div class="row">
        <div class="col-12 km-header">
            <span class="km-iconTitle"><i class="fa-solid fa-fire"></i></span>
            <h1 class="km-title">Khuyến Mại Hot</h1>
        </div>
        <div class="col-12">
            <div class="owl-carousel owl-theme">
                @foreach($products as $product)
                @if($product->status == 1)
                <div class="item">
                    <div class="km-image">
                        <a href="../product/{{ $product->id }}">
                            <img src="../uploads/{{$product->image}}" alt="" class="km-img">
                            <img src="{{asset('../images/khung.webp')}}" alt="" class="km-borders">
                        </a>
                    </div>
                    <div class="km-content">
                        <a href="../product/{{ $product->id }}" class="km-nameProduct">{{$product->name}}</a>
                        <div class="km-price">
                            <span class="km-priceProduct"> Giá Sale {{number_format($product->price)}} đ</span>
                            <span class="km-priceProductOld"> Giá Gốc 40.000.000 đ</span>
                            <div class="pRate">
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                
                            </div>
                        </div>
                        <div class="box-likexem">
                                <a href="../product/{{ $product->id }}"><button type="submit" class="km-btn">Xem chi tiết</button></a>
                                <form action="{{ route('like_product') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="km-btn"><i class="fa-regular fa-heart"></i></button>
                                </form>
                            </div>
                        <div class="payment">
                            <img src="{{asset('../images/paykredivo.webp')}}" id="payment-kredivo">
                            <img src="{{asset('../images/payzalo.webp')}}" id="payment-zalo">
                            <img src="{{asset('../images/payvn.webp')}}" id="payment-vn">
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@foreach($categorys as $category)
@foreach($banners as $banner)
@if($banner->type == 4)
<div class="sale-ip15" style="margin: 16px 0;">
    <div class="container">
        <div class="row">
            <div class="col-12"><img src="../uploads/{{$banner->image}}" alt="" class="h-100 w-100"></div>
        </div>
    </div>
</div>
@endif
@endforeach
<div class="productPhone container" style="margin: 16px auto;">
    <div class="row">
        <div class="col-12 pPhoneHeader">
            <h3 class="pPhone-title">{{$category->name}}</h3>
            <a href="../category/{{$category->id}}" class="pPhoneAll">Xem Tất Cả</a>
        </div>
        <div class="col-12 d-flex">
            <div class="row justify-content-around">
                @php
                $maxP = 1;
                @endphp
                @foreach($products as $product)
                @if ($product->category_id == $category->id && $maxP <= 8) 
                <div class="col-md-3 pPhone-item">
                    <div class="pPhone-image">
                        <a href="../product/{{ $product->id }}">
                            <img src="../uploads/{{$product->image}}" alt="" class="pPhone-img">
                            <img src="{{asset('../images/khung.webp')}}" alt="" class="km-borders">
                        </a>
                    </div>
                    <div class="pPhone-content">
                        <a href="../product/{{ $product->id }}" class="pPhone-nameProduct km-nameProduct">{{$product->name}}</a>
                        <div class="pPhone-price km-price">
                            <span class="pPhone-priceProduct km-priceProduct"> Giá {{number_format($product->price)}} đ</span>
                            <div class="pRate">
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                            </div>
                        </div>
                        <div class="box-likexem">
                                <a href="../product/{{ $product->id }}"><button type="submit" class="km-btn">Xem chi tiết</button></a>
                            </div>
                        <div class="payment">
                            <img src="{{asset('../images/paykredivo.webp')}}" id="payment-kredivo">
                            <img src="{{asset('../images/payzalo.webp')}}" id="payment-zalo">
                            <img src="{{asset('../images/payvn.webp')}}" id="payment-vn">
                        </div>
                    </div>
            </div>
            @php
            $maxP++;
            @endphp
            @endif
            @endforeach
        </div>
    </div>
</div>
</div>
@endforeach
@include('include/footer')