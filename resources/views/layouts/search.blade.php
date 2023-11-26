@include ('include/header')
<div class="productPhone container" style="margin: 16px auto;">
    <div class="row">
        <div class="col-12 pPhoneHeader">
            <h3 class="pPhone-title">Kết Quả Tìm Kiếm</h3>
            <!-- <a href="" class="pPhoneAll">Xem Tất Cả</a> -->
        </div>
        <div class="col-12 d-flex">
            <div class="row">
                @foreach($productss as $product)
                <div class="col-md-3 pPhone-item">
                    <div class="pPhone-image">
                        <a href="">
                            <img src="../uploads/{{$product->image}}" alt="" class="pPhone-img">
                        </a>
                        <span class="pPhone-tagHot">HOT</span>
                    </div>
                    <div class="pPhone-content">
                        <a href="" class="pPhone-nameProduct km-nameProduct">{{$product->name}}</a>
                        <div class="pPhone-price km-price">
                            <span class="pPhone-priceProduct km-priceProduct"> Giá {{number_format($product->price)}} đ</span>

                        </div>
                        <div class="" style="display: flex; justify-content: center;">
                            <button class="pPhone-btn km-btn">Add to Card</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include ('include/footer')