<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Categories::with('parent')->get();
        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::whereNull('parent_id')->with('children')->get();
        return view('admin.pages.category.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        try {
            toastr()->success('Thêm mới thành công!', ['timeOut' => 2000]);
            Categories::create($request->all());
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        $categories = Categories::whereNull('parent_id')->with('children')->get();
        return view('admin.pages.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Categories $category)
    {
        try {

            $category->update($request->all());
            toastr()->success('Cập nhật thành công!');

            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            toastr()->error('Cập nhật thất bại!', ['timeOut' => 1000]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
        try {
            toastr()->success('Xoá thành công!');

            $category->delete();
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            toastr()->error('Xoá thất bại!', ['timeOut' => 1000]);
            return back();
        }
    }
    public function trash()
    {
        $categories = Categories::onlyTrashed()->get();
        return view('admin.pages.category.trash', compact('categories'));
    }
    public function restore($id)
    {
        Categories::withTrashed()->where('id', $id)->restore();
        toastr()->success('Khôi phục thành công!', ['timeOut' => 1000]);
        return redirect()->route('category.trash');
    }
    public function forceDelete($id)
    {
        Categories::withTrashed()->where('id', $id)->forceDelete();
        toastr()->success('Xoá thành công!', ['timeOut' => 1000]);
        return redirect()->route('category.trash');
    }
}
