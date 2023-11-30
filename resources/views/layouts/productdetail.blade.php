@include('include/header')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="/">Trang chủ</a><a href="../category/{{ $product->category_id }}">Điện thoại</a><a href="">{{$product->description}}</a>
        </div>
        <div class="col-md-12">
            <div class="pdName">
                <h4>{{$product->name}}</h4>
            </div>
            <div class="pdRate">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <span>96 đánh giá</span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('../images/khung.webp')}}" alt="" style="height: 100px; width:100px">
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
</div>

@include('include/footer')