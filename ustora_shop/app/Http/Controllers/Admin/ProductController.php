<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Categories;
use App\Models\ImgProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.pages.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd(request()->all());
        //upload img
        $fileName = $request->photo->getClientOriginalName();
        $request->photo->storeAs('public/images', $fileName);
        $request->merge(['img' => $fileName]);
        try {
            $product = Product::create($request->all());
            if ($product && $request->hasFile('photos')) {
                foreach ($request->photos as $key => $value) {
                    $fileName = $value->getClientOriginalName();
                    $value->storeAs('public/images', $fileName);
                    ImgProduct::create([
                        'product_id' => $product->id,
                        'img' => $fileName
                    ]);
                }
            }

            toastr()->success('Tạo sản phẩm thành công!');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {;
            return  $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Categories::all();
        // Lấy thông tin sản phẩm cùng với quan hệ ảnh (imgProduct)
        $product->load('imgProduct');
        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // dd($request->all());
        try {
            $product->update($request->all());
            toastr()->success('Cập nhật thành công!');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            toastr()->error('Cập nhật thất bại!', ['timeOut' => 1000]);
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            toastr()->success('Xoá thành công!');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            toastr()->error('Xoá thất bại!', ['timeOut' => 1000]);
            return $th->getMessage();
        }
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        // dd($products);
        return view('admin.pages.product.trash', compact('products'));
    }
    public function restore($id)
    {
        Product::withTrashed()->where('id', $id)->restore();
        toastr()->success('Khôi phục thành công!', ['timeOut' => 1000]);
        return redirect()->route('product.trash');
    }
    public function forceDelete($id)
    {
        Product::withTrashed()->where('id', $id)->forceDelete();
        toastr()->success('Xoá thành công!', ['timeOut' => 1000]);
        return redirect()->route('product.trash');
    }
}
