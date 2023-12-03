<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody td {
            vertical-align: middle;
        }

        tfoot {
            font-weight: bold;
        }

        p.total {
            margin-top: 20px;
            font-size: 18px;
        }

        p.thank-you {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Xác nhận đơn hàng</h2>

    <p>Xin chào {{ $user->name }},</p>
    <p>Mã đơn hàng: {{ $order->code }}</p>
    @if($order->payment_method ==1)
    <p>Phương thức thanh toán: ATM</p>
    <p>Ngân Hàng: NCB</p>
    @else
    <p>Phương thức thanh toán: Trả tiền khi nhận hàng</p>
    @endif

    <p>Cảm ơn bạn đã đặt hàng của bạn. Đây là những thông tin chi tiết:</p>

    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Dung lượng</th>
                <th>Màu sắc</th>
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
                <td>{{ $detail->size_id != 0 ? $sizes->firstWhere('id', $detail->size_id)->name : '' }}</td>
                <td>{{ $detail->color_id != 0 ? $colors->firstWhere('id', $detail->color_id)->name : '' }}</td>
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
        <tfoot>
            <tr>
                <td colspan="5" class="total">Tổng giá:</td>
                <td>{{ $totalPrice }}</td>
            </tr>
        </tfoot>
    </table>

    <p class="thank-you">Cám ơn vì đã mua hàng.</p>

</body>

</html>
