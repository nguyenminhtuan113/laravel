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

        //        dd($request->all());
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
    public function removeAllCart(){
        \Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $address = Address::where('user_id', Auth::user()->id)->where('is_default',1)->first();
        return view('client.pages.checkout',compact('address'));
    }
    public function place_an_order(Request $request){
        $user_id = Auth::user()->id;
        $address = Address::where('user_id', $user_id)->where('is_default',true)->first();
        if (!$address) {
            $address = new Address();
            $request->validate([
               'name' => 'required|max:100',
               'phone' => 'required|numeric|digits:10',
               'address' => 'required',
               'city' => 'required',
                'locality' => 'required',
                'zip'=>'required|numeric|digits:6',
                'state'=>'required',
                'landmark'=>'required',
            ]);

            $address = new Address();
             $address->name=$request->name;
             $address->phone=$request->phone;
             $address->address=$request->address;
             $address->city=$request->city;
             $address->locality=$request->locality;
             $address->zip=$request->zip;
             $address->state=$request->state;
             $address->landmark=$request->landmark;
             $address->country='Vietnam';
             $address->user_id = $user_id;
             $address->is_default = true;
             $address->save();
        }
        $this->setAmountforCheckout();

        $order = new Order();
        $order->user_id=$user_id;
        $order->subtotal=\Session::get('checkout')['subtotal'];
        $order->total=\Session::get('checkout')['subtotal'];
        $order->name=$address->name;
        $order->phone=$address->phone;
        $order->address=$address->address;
        $order->city=$address->city;
        $order->state=$address->state;
        $order->zip=$address->zip;
        $order->country=$address->country;
        $order->landmark=$address->landmark;
        $order->save();

        foreach (\Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        if ($request->mode == 'cheque'){
            //
        }
        else if ($request->mode == 'paypal'){

        }else if ($request->mode == 'cod'){
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->status = 'pending';
            $transaction->mode = $request->mode;
            $transaction->save();
        }

        \Cart::instance('cart')->destroy();
        \Session::put('order_id', $order->id);
        return view('client.pages.order-confirmation', compact('order'));


    }
    public function setAmountforCheckout(){
        if (!\Cart::instance('cart')->content()->count()>0) {
            \Session::forget('checkout');
            return;
        }
        \Session::put('checkout', [
            'subtotal' => str_replace(',', '', \Cart::instance('cart')->subtotal()) ,
            'total' => str_replace(',', '', \Cart::instance('cart')->total()) ,
        ]);

    }

    public function order_confirmation(){
        if (\Session::has('order_id')){
            $order=Order::find(\Session::get('order_id'));
//            dd($order);
            return view('client.pages.order-confirmation', compact('order'));
        }
        return redirect()->route('cart');
    }

}
