@include('include/header')

<div class="productDetail">
    <div class="container">
        <form id="add-to-cart-form" action="{{ route('addtocart') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="quantity" value="1">
            @foreach($productAttr->unique('product_id') as $item)
            @if($item->product_id == $product->id)
            @php
            $minPriceVariant = $item->where('product_id', $product->id)->min('price');
            $minPriceVariantSizeId = $item->where('price', $minPriceVariant)->first()->size_id;
            $minPriceVariantColorId = $item->where('price', $minPriceVariant)->first()->color_id;
            @endphp

            <input type="hidden" id="sizeIdInput" name="size_id" value="{{ $minPriceVariantSizeId }}">
            <input type="hidden" id="colorIdInput" name="color_id" value="{{ $minPriceVariantColorId }}">
            @endif
            @endforeach
            <!-- Header page -->
            <div class="row">
                <div class="col-md-12">
                    <a href="/">Trang chủ</a>/<a href="../category/{{ $product->category_id }}">Điện thoại</a>/<a href="">{{$product->description}}</a>
                </div>
                <div class="col-md-12 d-flex justify-content-between pd-header">
                    <div class="pdName">
                        <h4>{{$product->name}}</h4>
                    </div>
                    <div class="pdRate">
                        <span>
                            @foreach($reviews as $review)
                            @if($review->product_id == $product->id)
                            {{$review->total_quantity}} Đánh Giá 
                            @else
                                Chưa có đánh giá nào!
                            @endif 
                            @php break @endphp
                            @endforeach </span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- ảnh sản phẩm -->
                            <div class="km-image pd-image">
                                <div id="carouselExample" class="carousel slide h-100">
                                    <div class="carousel-inner h-100">
                                        <div class="carousel-item h-100 active">
                                            <img src="../uploads/{{$product->image}}" class="d-block w-100 h-100 pd-image--img" alt="...">
                                        </div>
                                        @foreach ($variants->unique('color_id') as $variant)
                                        @if($variant->product_id == $product->id)
                                        <div class="carousel-item h-100">
                                            <img src="../uploads/{{$variant->image}}" class="d-block w-100 h-100 pd-image--img" alt="...">
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                        <span class="carousel-control carousel-control-prev-icon" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                        <span class="carousel-control carousel-control-next-icon" aria-hidden="true"><i class="fa-solid fa-circle-chevron-right"></i></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <a href="../product/{{ $product->id }}" class="d-flex justify-content-center" style="top: 0;">
                                    <img src="{{asset('../images/khung.webp')}}" alt="" class="km-borders">
                                    <span class="pd-pricesale">Giảm 2.000.000 đ</span>
                                </a>
                            </div>
                            <!-- cấu hình sản phẩm -->
                            <div class="pd-configuration w-100">
                                <ul>
                                    <li><i class="fa-solid fa-mobile"></i>6.7 inch, 19 inch, Dynamic AMOLED 2X, FHD+,
                                        1080 x 2636 Pixels</li>
                                    <li><i class="fa-solid fa-camera"></i>12.0 MP + 12.0 MP</li>
                                    <li><i class="fa-solid fa-camera-rotate"></i>10.0 MP</li>
                                    <li><i class="fa-solid fa-microchip"></i>Snapdragon 8+ Gen 1</li>
                                    <li><i class="fa-solid fa-hard-drive"></i>128 GB</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- giá bán sản phẩm -->
                            <div class="mb-3 pd-price">
                                <span class="pd-price--text">Giá bản tiêu chuẩn</span>
                                @if($variants->first())
                                <h4 class="pd-price--number" id="display-price">{{ $variants->min('price') }} ₫</h4>
                                @else
                                <h4 class="pd-price--number">{{ number_format($product->price) }} ₫</h4>
                                @endif
                            </div>
                            <!-- dung lượng sản phẩm -->
                            <div class="mb-3 pd-capacity" id="size-radio-buttons">
                                @foreach ($variants->unique('size_id') as $variant)
                                <div class="radio">
                                    <div>
                                        <input value="{{ $variant->size->id }}" type="radio" name="dl" id="size" @if($variant->size->id == $minPriceVariantSizeId) checked @endif>
                                        <label for="size">{{ $variant->size->name }}</label>
                                    </div>
                                    <label for="{{ $variant->color->id }}">{{ number_format($variant->price) }}đ</label>
                                </div>
                                @endforeach
                            </div>
                            <!-- các màu sản phẩm -->
                            <div class="mb-3 pd-color row nav nav-pills">
                                @foreach ($variants->unique('color_id') as $variant)
                                <div class="pd-color-item nav-item" id="color-radio-buttons">
                                    <label for="{{ $variant->color->id }}">
                                        <div class="pdcolor-img" id="color">
                                            <div class="check-color nav-link" data-bs-toggle="pill" id="color{{ $variant->color->id }}">
                                                <img for="" src="../uploads/{{$variant->image}}" alt="" class="w-100">
                                                <span class="pdcolor-text">{{ $variant->color->name}}</span>
                                                <i class="fa-solid fa-check pd-icon--check" id="icon-check{{ $variant->color->id }}"></i>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input variant-checkbox d-none" type="radio" value="{{ $variant->color->id }}" name="color" id="{{ $variant->color->id }}" @if($variant->color->id ==
                                                $minPriceVariantColorId) checked @endif>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <!-- Ưu đãi bảo hành -->
                            <div class="pd-endow">
                                <h1 class="pd-endow--title">Ưu đãi đặc biệt</h1>
                                <span><i class="fa-solid fa-gift"></i>Đặc quyền bảo hành 2 năm</span>
                            </div>
                            <div class="mb-3 pd-banner w-100">
                                <img src="{{ asset('../images/bannerpd.png') }}" alt="" class="w-100">
                            </div>
                            <div class="mb-3 pd-oder">
                                <a href="">
                                    <button type="submit" class="btn-addtocart">Thêm vào giỏ hàng</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-12 review-product">
            <div class="col-12 mb-5">
                <h2 class="comment-title">Đánh Giá Sản Phẩm</h2>
                @guest
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="link-topheader" style="border: 1px solid ; color: #000;">
                    <span><i class="fa-solid fa-circle-user"></i></span>
                    <span>Đăng nhập để đánh giá</span>
                </a>
                @endif
                @else
                <form action="{{ route('comment-product') }}" method="post" class="d-flex align-items-center">
                    @csrf
                    <div class="star-check">
                        <div class="1star">
                            <input type="radio" name="star" value="1" id="1star">
                            <label for="1star"><i class="fa-solid fa-star star-icon"></i></label>
                        </div>
                        <div class="2star">
                            <input type="radio" name="star" value="2" id="2star">
                            <label for="2star">
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                            </label>
                        </div>
                        <div class="3star">
                            <input type="radio" name="star" value="3" id="3star">
                            <label for="3star">
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                            </label>
                        </div>
                        <div class="4star">
                            <input type="radio" name="star" value="4" id="4star">
                            <label for="4star">
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                            </label>
                        </div>
                        <div class="5star">
                            <input type="radio" name="star" value="5" id="5star">
                            <label for="5star">
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                                <i class="fa-solid fa-star star-icon"></i>
                            </label>
                        </div>
                    </div>
                    <input type="tel" name="comment" id="" style="width: 100%; height: 80px;">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-review">Gửi</button>
                </form>

                @endguest
            </div>
            <h5 class="col-12">Các đánh giá về sản phẩm</h5>
            @foreach($reviewproducs as $reviewproduc)
            @if($reviewproduc->product_id == $product->id)
            <div class="col-12 comment">
                <div class="comment-imageUser">
                    <img src="{{ asset('../images/user.png') }}" alt="">
                </div>
                <div class="comment-box">
                    @foreach($users as $user)
                    @if($reviewproduc->user_id == $user->id)
                    <h5 class="nameUser">{{$user->name}}</h5>
                    @endif
                    @endforeach
                    <div class="">
                        @for($i = 1 ; $i <= $reviewproduc->sao; $i++)
                            <i class="fa-solid fa-star star-icon"></i>
                            @endfor
                    </div>
                    <span class="comment-content">
                        {{$reviewproduc->noidung}}
                    </span>
                    @guest
                    @if(Route::has('login'))

                    @endif
                    @else
                    @if($reviewproduc->user_id == Auth::user()->id)
                    <form action="{{ route('delete_review') }}" method="post">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{$reviewproduc->id}}">
                        <button type="submit" class="btn-deletecomment">Xoá</button>
                    </form>
                    @endif
                    @endguest
                </div>
            </div>

            @endif
            @endforeach
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        function setDefaultValues() {
            const defaultSizeId = $('input[name="size_id"]').val();
            const defaultColorId = $('input[name="color_id"]').val();
            $(`input[name="dl"][value="${defaultSizeId}"]`).prop('checked', true);
            $(`input[name="color"][value="${defaultColorId}"]`).prop('checked', true);
            $('#size-radio-buttons input[type="radio"]').change();
            $('#color-radio-buttons input[type="radio"]').change();
        }

        $('.pdcolor-img-img').click(function() {
            const radio = $(this).closest('.pdcolor-item').find('input[type="radio"][name="color"]');

            $(this).closest('.pdcolor-img').toggleClass('color-selected', radio.prop('checked'));

            radio.prop('checked', true);
            updatePrice();
        });
        $('#size-radio-buttons input[type="radio"]').change(function() {
            const size = $('input[name="dl"]:checked').val()
            $('#sizeIdInput').val(size);
        });
        $('#color-radio-buttons input[type="radio"]').change(function() {
            const color = $('input[name="color"]:checked').val()
            $('#colorIdInput').val(color);
        });

        $('#size, #color').on('change', function() {
            updatePrice();
        });

        function updatePrice() {
            const sizeId = $('input[name="dl"]:checked').val();
            const colorId = $('input[name="color"]:checked').val();

            $.ajax({
                url: "{{ route('get_variant_price') }}",
                method: 'GET',
                data: {
                    product_id: {{$product->id}},
                    size_id: sizeId,
                    color_id: colorId,
                },
                success: function(response) {
                    $('#display-price').text(response.price + '₫');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        setDefaultValues();
    });
</script>
@include('include/footer')