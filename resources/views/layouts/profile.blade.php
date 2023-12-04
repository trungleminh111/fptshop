@include('include/header')
<div class="container light-style flex-grow-1 container-p-y">
    <div class="card overflow-hidden">
        <h4 class="font-weight-bold py-3 mb-4 wellcomeHtphone text-center display-5">
            Account settings
        </h4>
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-3 pt-0">
                <div class="list-group list-group-flush account-settings-links">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general"><i class="fa-regular fa-user"></i>Thông tin cá nhân <span id="triangle-right"></span></a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password"><i class="fa-solid fa-user-lock"></i>Thay đổi mật khẩu <span id="triangle-right"></span></a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info"><i class="fa-solid fa-truck-fast"></i>Đơn hàng của bạn <span id="triangle-right"></span></a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-like"><i class="fa-solid fa-heart" style="color: #ff0000;"></i>Sản phẩm yêu thích <span id="triangle-right"></span></a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">
                        <hr class="border-light m-0">
                        <form action="{{ route('upinfo') }}" method="post">
                            @csrf
                            <div class="card-body">
                                @guest
                                @if (Route::has('login')) @endif
                                @else
                                <div class="form-group">
                                    <label class="form-label">Tên</label>
                                    <input type="text" class="form-control mb-1" name="name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control mb-1" value="{{ Auth::user()->phone }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                                </div>
                            </div>
                            <div class="text-right mt-3" style="float: right;">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <a href="/"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="account-change-password">
                        <form action="{{ route('uppassword') }}" method="post">
                            @csrf
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Mật khẩu hiện tại</label>
                                    <input type="password" name="passwordold" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mật khẩu mới</label>
                                    <input type="password" name="passwordnew" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="passwordnew2" class="form-control">
                                </div>
                            </div>
                            <div class="text-right mt-3" style="float: right;">
                                <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="account-info">
                        <div class="card-body pb-2">
                            <table>
                                <thead>
                                    @if(is_null($orderdetails))
                                    <h5>Bạn chưa thích sản phẩm nào</h5>
                                    @else
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th class="text-center">Giá</th>
                                        <th>Số lượng</th>
                                        <th class="text-center">Thành tiền</th>
                                    </tr>
                                    @endif
                                </thead>
                                <tbody>
                                    @php
                                    $totalPrice = 0;
                                    @endphp
                                    @foreach($orderdetails as $detail)
                                    @foreach($orders as $orderdetail)
                                    @if($orderdetail->user_id == Auth::user()->id && $detail->order_id == $orderdetail->id)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td class="text-end">{{ number_format($detail->price) }} VNĐ</td>
                                        <td class="text-center">{{ $detail->quantity }}</td>
                                        <td>
                                            @php
                                            $itemTotal = $detail->price * $detail->quantity;
                                            $totalPrice += $itemTotal;
                                            @endphp
                                            {{ number_format($itemTotal) }} VNĐ
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <p style="    font-size: 25px;font-weight: 600;margin: 50px 0;">Tổng giá: {{ number_format($totalPrice) }} VNĐ</p>
                        </div>
                        <div class="text-right mt-3" style="float: right;">
                            <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="account-like">
                        <div class="card-body pb-2">
                            <table>
                                <thead>
                                    @if(is_null($likeproducts))
                                    <h5>Bạn chưa thích sản phẩm nào</h5>
                                    @else
                                    <tr>
                                        <th class="p-2">Tên sản phẩm</th>
                                        <th class="text-center p-2">Ảnh</th>
                                        <th class="p-2">Mua hàng</th>
                                        <th class="p-2">Xoá</th>
                                    </tr>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach($likeproducts as $detail)
                                    @foreach($products as $product)
                                    @if($product->id == $detail->product_id && $detail->user_id == Auth::user()->id)
                                    <tr>
                                        <td class="text-center p-2">{{ $product->name }}</td>
                                        <td class="text-center p-2">
                                            <img src="../uploads/{{$product->image}}" alt="" style="width: 100px;height:100px">
                                        </td>
                                        <td class="text-center p-2">
                                            <a href="../product/{{ $product->id }}"><button class="km-btn">Mua ngay</button></a>
                                        </td>
                                        <td class="text-center p-2">
                                            <form action="{{route('delete_productlike')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="like_id" value="{{$detail->id}}">
                                                <button type="submit" class="btn-remove"><i class="fa-solid fa-xmark"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>


@include('include/footer')