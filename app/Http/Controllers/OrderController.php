<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\VnPay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function check(Request $request)
    {

        $data = $request->validate(
            [
                'payment' => 'required|max:225',
                'total' => 'required',
                'user_id' => 'required',
                'address' => 'required',
                'ship' => 'required',
            ],
            [
                'payment.required' => 'Vui lòng chọn phương thức thanh toán',
                'address.required' => 'vui lòng nhập địa chỉ giao hàng',
                'ship.required' => 'vui lòng nhập chọn phương thức nhận hàng',
            ]
        );


        $userCheckverify = User::find($data['user_id']);
        if (!$userCheckverify->email_verified_at) {
            return redirect('/email/verify')->with('error','Vui lòng xác thực email');
        }else{
            if ($data['payment'] == 'ttol' && $data['total']) {
                $this->vnpay_payment($data['total']);
            }
            if ($data['payment'] == 'tttt' && $data['total'] && $data['address'] && $data['user_id']) {
                $this->payment_delivery($data['user_id'], $data['address']);
                return redirect()->back()->with('success', 'Bạn đã đặt hàng vui lòng kiểm tra email');
            }
        }


    }

    public function payment_delivery($user_id, $address)
    {
        $randomCode = Str::random(11);
        $order = new Order();
        $order->code = $randomCode;
        $order->user_id = $user_id;
        $order->status = 1;
        $order->payment_method = 0;
        $order->address = $address;
        $order->save();

        $cart = Cart::all()->where('user_id', $user_id);
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }

        $user = Auth::user();

        $data = [
            'order' => $order,
            'user' => $user,
            'orderDetails' => OrderDetail::where('order_id', $order->id)->with('Product')->get()
        ];

        $this->sendMail($data, $user);

        return redirect()->back();
    }
    public function vnpay_payment($total)
    {
        $randomCode = Str::random(11);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/thank-you";
        $vnp_TmnCode = "7T5SVDS7"; //Mã website tại VNPAY 
        $vnp_HashSecret = "NEKEWWZRESQUQFCGJIPPUZHPMVOWARPB"; //Chuỗi bí mật

        $vnp_TxnRef = $randomCode; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "HTPHONE";
        $vnp_Amount = $total * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {

            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);

        }
    }



    public function thankyou()
    {
        $cart = Cart::all()->where('user_id', Auth::user()->id);
        $order = new Order();
        $order->code = $_GET['vnp_TxnRef'];
        $order->user_id = Auth::user()->id;
        $order->status = 1;
        $order->payment_method = 1;
        $order->address = Auth::user()->address;
        $order->save();

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }
        $vnpay = new VnPay();
        $vnpay->vnp_Amount = $_GET['vnp_Amount']/100;
        $vnpay->vnp_BankCode = $_GET['vnp_BankCode'];
        $vnpay->vnp_CardType = $_GET['vnp_CardType'];
        $vnpay->vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnpay->vnp_PayDate = $_GET['vnp_PayDate'];
        $vnpay->vnp_ResponseCode = $_GET['vnp_ResponseCode'];
        $vnpay->vnp_TmnCode = $_GET['vnp_TmnCode'];
        $vnpay->vnp_TransactionStatus = $_GET['vnp_TransactionStatus'];
        $vnpay->vnp_TxnRef = $_GET['vnp_TxnRef'];
        $vnpay->vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnpay->vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnpay->vnp_TransactionNo = $_GET['vnp_TransactionNo'];

        $vnpay->order_id = $order->id;
        $vnpay->save();

        $user = Auth::user();

        $data = [
            'order' => $order,
            'user' => $user,
            'orderDetails' => OrderDetail::where('order_id', $order->id)->with('Product')->get()
        ];
        $this->sendMail($data, $user);

        return redirect('/cart')->with('success', 'Bạn đã đặt hàng vui lòng kiểm tra email');
    }

    public function sendMail($data, $user)
    {
        Mail::send('emails.order_confirmation', $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Xác nhận đơn hàng');
        });
    }
}
