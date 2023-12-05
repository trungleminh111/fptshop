@include ('include/header')
<div class="productPhone container" style="margin: 16px auto;">
    <div class="row">
        <div class="col-12 pPhoneHeader">
            <h3 class="pPhone-title km-title">Kết Quả Tìm Kiếm</h3>
        </div>
        <div class="col-12 d-flex">
            <div class="row">
                @foreach($productss as $product)
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
                                <form action="{{ route('like_product') }}" method="post">
                                @csrf
                                @guest
                                @if (Route::has('login'))
                                <!-- <button type="submit" class="km-btn"><i class="fa-regular fa-heart"></i></button> -->
                                @endif
                                @else
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="km-btn"><i class="fa-solid fa-heart"></i></button>
                                @endguest
                            </form>
                            </div>
                        <div class="payment">
                            <img src="{{asset('../images/paykredivo.webp')}}" id="payment-kredivo">
                            <img src="{{asset('../images/payzalo.webp')}}" id="payment-zalo">
                            <img src="{{asset('../images/payvn.webp')}}" id="payment-vn">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include ('include/footer')