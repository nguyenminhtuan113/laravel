<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $items = \Cart::instance('wishlist')->content();
        return view('client.pages.wishlist', compact('items'));
    }
    public function addWishlist(Request $request)
    {

        \Cart::instance('wishlist')->add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 0,
            'options' => [
                'img' => $request->img,
            ]

        ])->associate('App\Models\Product');

        toastr()->success('Thêm sản phẩm yêu thích thành công!', ['timeOut' => 2000]);
        return redirect()->back();
    }
    public function removeItemWishlist($rowId)
    {
        \Cart::instance('wishlist')->remove($rowId);
        toastr()->success('Xoá sản phẩm yêu thích thành công!', ['timeOut' => 2000]);
        return redirect()->back();
    }
    public function removeAll()
    {
        \Cart::instance('wishlist')->destroy();
        toastr()->success('Xoá sản phẩm yêu thích thành công!', ['timeOut' => 2000]);
        return redirect()->back();
    }
    public function moveToCart($rowId)
    {
        $item = \Cart::instance('wishlist')->get($rowId);
        //        dd($item);
        \Cart::instance('wishlist')->remove($rowId);
        \Cart::instance('cart')->add([
            'id' => $item->id,
            'name' => $item->name,
            'qty' => $item->qty,
            'price' => $item->price,
            'weight' => 0,
            'options' => [
                'img' => $item->img,
            ]
        ])->associate('App\Models\Product');
        return redirect()->back();
    }
}
