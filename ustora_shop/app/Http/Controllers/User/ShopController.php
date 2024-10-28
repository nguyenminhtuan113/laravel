<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ImgProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(){
        $products = Product::paginate(5);
        return view('client.pages.shoppage',compact('products'));
    }
    public function productDetail($id)
    {
        // Lấy sản phẩm từ database theo ID
        $product = Product::with('category')->where('id', $id)->first();
        $images = ImgProduct::where('product_id', $id)->get();
        // Lấy tất cả các sản phẩm khác có cùng category_id, trừ sản phẩm hiện tại
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->get();
        //products
        $products = DB::table("products")->take(4)->get();
        // Hiển thị thông tin sản phẩm trên trang singleProduct
        return view('client.pages.productDetail', compact('product', 'images','relatedProducts','products'));
    }
    public function search(Request $request){

        $query = $request->input('query');
        $products = Product::where('name', 'like', '%'.$query.'%')
                            ->orWhere('description', 'like', '%'.$query.'%')->take(4)->get();
//        dd($products);
        return view('client.pages.search.search', compact('products'));
    }
}
