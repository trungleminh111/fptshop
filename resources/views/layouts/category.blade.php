@include('include/header')

<div class="productPhone container" style="margin: 16px auto;">
    <div class="row">
        <div class="col-12 pPhoneHeader">
            <h3 class=" km-title">{{$category->name}}</h3>
            <!-- <a href="" class="pPhoneAll">Xem Tất Cả</a> -->
        </div>
        <div class="col-12 d-flex">
            <div class="row justify-content-around">
                @foreach($products as $product)
                @if ($product->category_id == $category->id)
                <div class="col-md-3 pPhone-item">
                    <div class="pPhone-image">
                        <a href="../product/{{ $product->id }}">
                            <img src="../uploads/{{$product->image}}" alt="" class="pPhone-img">
                        </a>
                        <img src="{{asset('../images/khung.webp')}}" alt="" class="km-borders">
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
                                <span>96 đánh giá</span>
                            </div>
                        </div>
                        <form action="{{ route('addtocart') }}" method="post">
                            <div class="" style="display: flex; justify-content: center;">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <button type="submit" class="pPhone-btn km-btn">Add to Card</button>
                            </div>
                        </form>
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

@include('include/footer')