@include('include/header')

<div class="productDetail">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/">Trang chủ</a>/<a href="../category/{{ $product->category_id }}">Điện thoại</a>/<a href="">{{$product->description}}</a>
            </div>
            <div class="col-md-12 d-flex justify-content-between pd-header">
                <div class="pdName">
                    <h4>{{$product->name}}</h4>
                </div>
                <div class="pdRate">
                    <i class="fa-solid fa-star star-icon"></i>
                    <i class="fa-solid fa-star star-icon"></i>
                    <i class="fa-solid fa-star star-icon"></i>
                    <i class="fa-solid fa-star star-icon"></i>
                    <i class="fa-solid fa-star star-icon"></i>
                    <span>96 đánh giá</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="km-image pd-image">
                            <a href="../product/{{ $product->id }}">
                                <img src="../uploads/{{$product->image}}" alt="" class="pd-image--img">
                                <img src="{{asset('../images/khung.webp')}}" alt="" class="km-borders">
                                <span class="pd-pricesale">Giảm 2.000.000 đ</span>
                            </a>
                        </div>
                        <div class="pd-configuration w-100">
                            <ul>
                                <li>6.7 inch, 19 inch, Dynamic AMOLED 2X, FHD+, 1080 x 2636 Pixels</li>
                                <li>12.0 MP + 12.0 MP</li>
                                <li>10.0 MP</li>
                                <li>Snapdragon 8+ Gen 1</li>
                                <li>128 GB</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 pd-price">
                            <h4 class="pd-price--text">11.990.000₫</h4>
                        </div>
                        <div class="mb-3 pd-capacity">
                            <a href="">
                                <div class="radio">
                                    <input type="radio" name="dl" id="">
                                    <label for="">128gb</label>
                                </div>
                                <span>11.990.000₫</span>
                            </a>
                            <a href="">
                                <div class="radio">
                                    <input type="radio" name="dl" id="">
                                    <label for="">256gb</label>
                                </div>
                                <span>15.990.000₫</span>
                            </a>
                        </div>
                        <div class="mb-3 pd-color">
                            <div class="pd-color-item">
                                <div class="pdcolor-img">
                                    <img src="../uploads/{{$product->image}}" alt="" class="w-100">
                                    <i class="fa-solid fa-check pd-icon--check"></i>
                                </div>
                                <span class="pdcolor-text">Tím</span>
                            </div>
                        </div>
                        <div class="mb-3 pd-banner w-100">
                            <img src="{{ asset('../images/bannerpd.png') }}" alt="" class="w-100">
                        </div>
                        <div class="mb-3 pd-oder">
                            <a href="">
                                <button>Mua Ngay</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('include/footer')