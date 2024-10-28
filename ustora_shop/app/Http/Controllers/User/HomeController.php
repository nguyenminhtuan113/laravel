<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        Latest Products
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('client.pages.home',compact('products'));
    }
    public function shop()
    {
        $products = Product::all();
        return view('client.pages.shoppage',compact('products'));
    }

}
