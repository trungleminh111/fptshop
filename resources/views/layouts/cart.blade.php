@include('include/header')

<div class="cart-page container">
    <div class="col-md-12 cart-title">
        <h1 class="cart-title--h1">Giỏ hàng của bạn có {{$countcart}} sản phẩm !</h1>
    </div>
    <div class="row">
        <div class="col-md-8 cart-list">
            <table class="w-100 row tabble-cart">
                <thead>
                    <tr class="tabble-header row">
                        <th class="col-md-5"><span>Sản Phẩm</span></th>
                        <th class="col-md-3 text-center"><span>Số Lượng</span></th>
                        <th class="col-md-3 text-center"><span>Tổng Thanh Toán</span></th>
                        <th class="col-md-1"><span>Xoá</span></th>
                    </tr>
                </thead>
                <tbody style="height: 700px; overflow: overlay">
                @foreach($carts as $cart)
                @foreach($products as $product)
                @if($product->id == $cart->product_id)
                <tr class="item-cart row align-items-center">
                    <td class="col-md-5">
                        <div class="d-flex align-items-center">
                            <img src="../uploads/{{$product->image}}" alt="" class="cImg-product">
                            <div class="cName-product">{{$product->name}}</div>
                        </div>
                    </td>
                    <td class="col-md-3 d-flex justify-content-center">
                        <!-- Giảm Số Lượng Sản Phẩm -->
                        <form action="{{ route('reduce') }}" method="post">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <button class="btn-cart btn-reduce">-</button>
                        </form>

                        <!-- Số lượng sản phẩm hiện tại -->
                        <form action="" method="">
                            <input type="text" class="coutn-cart" value="{{$cart->quantity}}" readonly>
                        </form>

                        <!-- Tăng Số Lượng Sản Phẩm -->
                        <form action="{{ route('increase') }}" method="post">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <button type="submit" class="btn-cart btn-increase">+</button>
                        </form>
                    </td>
                    <td class="col-md-3">
                        <div class="cartPrice text-center" >
                            <span class="cPrice-product">{{number_format($product->price * $cart->quantity)}} đ</span>
                        </div>
                    </td>
                    <td class="col-md-1">
                        <form action="{{ route('delete_cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{$cart->id}}">
                            <button type="submit" class="btn-remove"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach
                </tbody>
            </table>
            @if($countcart == 0)
            <tr>
                <h1 class="cart-title--h1">Bạn chưa thêm sản phẩm nào</h1>
            </tr>
            @endif
        </div>
        <div class="col-md-4 cart-checkout">
            <h1 class="text-center mb-5">Thanh Toán</h1>
            <div class="count_product row mb-3">
                <div class="col-md-6">
                    <span><b>Tổng số sản phẩm</b></span>
                </div>
                <div class="col-md-6">
                    <span style="width:fit-content; font-size: 20px; font-weight: 700">{{$countcart}}</span>
                </div>
            </div>
            <div class="total row mb-3">
                <div class="col-md-6">
                    <span><b>Tổng số tiền cần thanh toán</b></span>
                </div>
                <div class="col-md-6">
                    @php 
                        $total = 0;
                    @endphp
                    @foreach($carts as $cart)
                        @foreach($products as $product)
                            @if($product->id == $cart->product_id)
                                @php 
                                    $total += $product->price * $cart->quantity;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <span style="width:fit-content; font-size: 20px; font-weight: 700">
                        {{number_format($total)}} VNĐ
                    </span>
                </div>
            </div>
            <div class="cart-payment row mb-4">
                <div class="col-md-12 mb-2">
                    <span><b>Chọn phương thức thanh toán</b></span>
                </div>
                <div class="col-md-6 d-flex align-item-center">
                    <input type="radio" name="payment" id="ttol">
                    <label for="ttol" class="cart-checkbox"><img src="{{'../images/vnpay.svg'}}" alt="" style="width:100%;"></label>
                </div>
                <div class="col-md-6 d-flex align-item-center">
                    <input type="radio" name="payment" id="tttt">
                    <label for="tttt" class="cart-checkbox">Thanh toán khi nhận hàng</label>
                </div>
            </div>
            <div class="cart-ship row mb-3">
                <div class="col-md-12 mb-2">
                    <span><b>Chọn phương thức nhận hàng</b></span>
                </div>
                <div class="col-md-6 d-flex align-item-center">
                    <input type="radio" name="ship" id="ghtk">
                    <label for="ghtk" class="cart-checkbox">Giao Hàng Tiết Kiệm</label>
                </div>
                <div class="col-md-6 d-flex align-item-center">
                    <input type="radio" name="ship" id="nhtt">
                    <label for="nhtt" class="cart-checkbox">Nhận Hàng Tại Cửa Hàng</label>
                </div>
            </div>
            <div class="cartInfoUser">
                <form action="#">
                    <label for="name" class="cart-infouser--text">Tên người nhận</label>
                    <input type="text" name="nameuser" id="name" class="form-control">
                    <label for="phone" class="cart-infouser--text">Số điện thoại</label>
                    <input type="text" name="nameuser" id="phone" class="form-control">
                    <label for="address" class="cart-infouser--text">Địa chỉ</label>
                    <input type="text" name="nameuser" id="address" class="form-control">
                </form>
            </div>
            <div class="payconfir">
                <button type="submit" class="btn btn-custom btn-pay">Xác nhận thanh toán</button>
            </div>
        </div>
    </div>
</div>


@include('include/footer')