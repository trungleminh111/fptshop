<!DOCTYPE html>
<html>

<head>
    <title>Xác nhận đơn hàng</title>
</head>

<body>

    <h2>Xác nhận đơn hàng</h2>

    <p>Xin chào {{ $user->name }},</p>
    <p>Mã đơn hàng: {{ $order->code }}</p>
    @if($order->payment_method ==1)
    <p>Phưng thức thanh toán: ATM</p>
    <p>Ngân Hàng: NCB</p>
    @else
    <p>Phưng thức thanh toán: Trả tiền khi nhận hàng</p>
    @endif

    <p>Cảm ơn bạn đã đặt hàng của bạn. Đây là những thông tin chi tiết:</p>

    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalPrice = 0;
            @endphp

            @foreach($orderDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->price }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>
                    @php
                    $itemTotal = $detail->price * $detail->quantity;
                    $totalPrice += $itemTotal;
                    @endphp
                    {{ $itemTotal }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>Tổng giá: {{ $totalPrice }}</p>

    <p>Cám ơn vì đã mua hàng.</p>


</body>

</html>