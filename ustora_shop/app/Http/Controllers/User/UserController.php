<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        if (Auth::check() && Auth::user()->role = 0) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function postLogin(Request $request)
    {
        try {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 0])) {
                toastr()->success('Đăng nhập thành công!', ['timeOut' => 1000]);
                return redirect()->route('home');
            } else {
                toastr()->error('Hãy kiểm tra lại tài khoản!', ['timeOut' => 1000]);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function postRegister(UserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        try {
            User::create($request->all());
            toastr()->success('Tạo tài khoản thành công!', ['timeOut' => 1000]);
        } catch (\Throwable $th) {
            toastr()->error('Tạo tài khoản không thành công. Kiểm tra lại!', ['timeOut' => 1000]);
            return $th->getMessage();
        }
        return redirect()->route('login');
    }
    public function logout(){
        Auth::logout();
        toastr()->success('Bạn đã đăng xuất thành công!', ['timeOut' => 1000]);
        return redirect()->route('home');
    }
}
