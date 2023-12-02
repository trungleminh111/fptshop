@include('include/header')

<div class="productDetail">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/">Trang chủ</a>/<a href="../category/{{ $product->category_id }}">Điện thoại</a>/<a
                    href="">{{$product->description}}</a>
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
                            <h4 class="pd-price--text" id="display-price">{{ $variants->min('price') }} ₫</h4>
                        </div>
                        <div class="mb-3 pd-capacity" id="size-radio-buttons">
                            @foreach ($variants->unique('size_id') as $variant)
                            <a href="">
                                <div class="radio">
                                    <input value="{{ $variant->size->id }}" type="radio" name="dl" id="" checked>
                                    <label for="">{{ $variant->size->name }}</label>
                                </div>
                            </a>
                            @endforeach

                        </div>
                        <div class="mb-3 pd-color row">
                            @foreach ($variants->unique('color_id') as $variant)

                            <div class="pd-color-item">
                                <label for="{{ $variant->color->id }}">
                                    <div class="pdcolor-img" id="color">
                                        <img for="" src="../uploads/{{$product->image}}" alt=""
                                            class="w-100">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input variant-checkbox d-none" type="radio"
                                                value="{{ $variant->color->id }}" name="color"
                                                id="{{ $variant->color->id }}">

                                        </div>
                                    </div>
                                    <span class="pdcolor-text">{{ $variant->color->name }}</span>
                                </label>
                            </div>

                            @endforeach
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
<script>
    const defaultSizeId = '{{ $variants->sortBy("price")->first()->size->id }}';
    $('input[name="dl"][value="' + defaultSizeId + '"]').prop('checked', true);
    const defaultColorId = '{{ $variants->sortBy("price")->first()->color->id }}';
</script>
<script>

    $('input[name="color"][value="' + defaultColorId + '"]').prop('checked', true);
    $(document).ready(function () {
        updatePrice()
        $('.pdcolor-img-img').click(function () {
        // Find the associated radio button
        const radio = $(this).closest('.pdcolor-item').find('input[type="radio"]');
        
        // Toggle the 'color-selected' class based on the radio button state
        $(this).closest('.pdcolor-img').toggleClass('color-selected', radio.prop('checked'));

        // Trigger click on the radio button
        radio.prop('checked', true);
        
        // Update the price
        updatePrice();
    });
        $('#size-radio-buttons input[type="radio"]').change(function () {
            updatePrice();
        });

        $('#size, #color').on('change', function () {
            updatePrice();
        });

        function updatePrice() {
            const sizeId = $('input[name="dl"]:checked').val();
            const colorId = $('input[name="color"]:checked').val();

            $.ajax({
                url: "{{ route('get_variant_price') }}",
                method: 'GET',
                data: {
                    size_id: sizeId,
                    color_id: colorId,
                },
                success: function (response) {
                    console.log(response.price);
                    $('#display-price').text(response.price + '' + 'đ');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });
</script>
<script>
    
</script>
@include('include/footer')