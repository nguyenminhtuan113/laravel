<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $carts = \Cart::instance('cart')->content();
        $products = DB::table("products")->take(4)->get();
        $interestProduct = DB::table("products")->take(2)->get();

        return view('client.pages.cart', compact('carts', 'products', 'interestProduct'));
    }
    public function addCart(Request $request)
    {

        \Cart::instance('cart')->add(
            [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'qty' => $request->qty,
                'weight' => 0,
                'options' => [
                    'img' => $request->img,
                ]
            ]
        )->associate('App\Models\Product');
        //                dd(\Cart::instance('cart')->content());
        toastr()->success('Thêm sản phẩm thành công!', ['timeOut' => 2000]);
        return redirect()->back();
    }
    public function increase_cart_quantity($rowId)
    {
        $product = \Cart::instance('cart')->get($rowId);
        //        dd($product);
        $qty = $product->qty + 1;
        \Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }
    public function decrease_cart_quantity($rowId)
    {
        $product = \Cart::instance('cart')->get($rowId);
        if ($product->qty > 1) {
            $qty = $product->qty - 1;
            \Cart::instance('cart')->update($rowId, $qty);
        } else {
            \Cart::instance('cart')->remove($rowId);
        }
        return redirect()->back();
    }

    public function removeItemCart($rowId)
    {
        \Cart::instance('cart')->remove($rowId);
        toastr()->success('Xoá sản phẩm thành công!', ['timeOut' => 2000]);
        return redirect()->back();
    }
    public function removeAllCart()
    {
        \Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $address = Address::where('user_id', Auth::user()->id)->where('is_default', 1)->first();

        return view('client.pages.checkout', compact('address'));
    }
    public function place_an_order(Request $request)
    {
        $user_id = Auth::user()->id;
        $address = Address::where('user_id', $user_id)->where('is_default', true)->first();
        if (!$address) {
            $request->validate([
                'name' => 'required|max:100',
                'phone' => 'required|numeric|digits:10',
                'address' => 'required',
                'city' => 'required',
                'locality' => 'required',
                'zip' => 'required|numeric|digits:6',
                'state' => 'required',
                'landmark' => 'required',
            ]);

            $address = new Address();
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->locality = $request->locality;
            $address->zip = $request->zip;
            $address->state = $request->state;
            $address->landmark = $request->landmark;
            $address->country = 'Vietnam';
            $address->user_id = $user_id;
            $address->is_default = true;
            $address->save();
        }
        $this->setAmountforCheckout();

        $order = new Order();
        $order->user_id = $user_id;
        $order->subtotal = \Session::get('checkout')['subtotal'];
        $order->total = \Session::get('checkout')['subtotal'];
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->address = $address->address;
        $order->city = $address->city;
        $order->state = $address->state;
        $order->zip = $address->zip;
        $order->country = $address->country;
        $order->landmark = $address->landmark;
        $order->save();

        foreach (\Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        if ($request->mode == 'cheque') {
            //
        } else if ($request->mode == 'paypal') {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->status = 'pending';
            $transaction->mode = $request->mode;
            $transaction->save();

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_TmnCode = "AMV1YPGX"; //Mã website tại VNPAY
            $vnp_HashSecret = "3VLCEAWNJQ00DQYCPNCT696JA8U9LYGZ"; //Chuỗi bí mật

            $vnp_TxnRef = '10000'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này
            // sang VNPAY
            $vnp_OrderInfo = "Thanh toan hoa don";
            $vnp_OrderType = "Ustora shop";
            $vnp_Amount = \Session::get('checkout')['subtotal'] * 100;
            $vnp_Locale = 'VN';
            $vnp_BankCode = 'NCB';
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
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo

        } else if ($request->mode == 'cod') {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->status = 'pending';
            $transaction->mode = $request->mode;
            $transaction->save();
            \Cart::instance('cart')->destroy();
            \Session::put('order_id', $order->id);
            return view('client.pages.order-confirmation', compact('order'));
        }

        \Cart::instance('cart')->destroy();
        \Session::put('order_id', $order->id);
        // return view('client.pages.order-confirmation', compact('order'));
    }
    public function setAmountforCheckout()
    {
        if (!\Cart::instance('cart')->content()->count() > 0) {
            \Session::forget('checkout');
            return;
        }
        \Session::put('checkout', [
            'subtotal' => str_replace(',', '', \Cart::instance('cart')->subtotal()),
            'total' => str_replace(',', '', \Cart::instance('cart')->total()),
        ]);
    }

    public function order_confirmation()
    {
        if (\Session::has('order_id')) {
            $order = Order::find(\Session::get('order_id'));
            //            dd($order);
            return view('client.pages.order-confirmation', compact('order'));
        }
        return redirect()->route('cart');
    }
}
