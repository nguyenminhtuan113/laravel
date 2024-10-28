<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.dashboard');
        // return view('admin.pages.admin.index');
    }
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        if (Auth::check() && Auth::user()->role == 1) {

            return redirect()->route('admin');
        }
        return view('auth.adminLogin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postLogin(AdminRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1])) {
            toastr()->success('Đăng nhập thành công!', ['timeOut' => 1000]);
            return redirect()->route('admin');
        }
        toastr()->error('Đăng nhập thất bại! Kiểm tra lại tài khoản của bạn!', ['timeOut' => 2000]);
        return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        toastr()->success('Đăng xuất thành công!', ['timeOut' => 1000]);
        return redirect()->route('admin.login');
    }
}
