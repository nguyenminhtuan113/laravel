<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        //        dd(\Cart::instance('cart')->content());
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
        return view('client.pages.checkout');
    }
}
