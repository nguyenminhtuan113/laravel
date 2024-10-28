<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không hợp lệ!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
//            'password.confirmed' => ':attribute không khớp với xác nhận.',
            'password.min'=>'Mật khẩu phải có 8 kí tự trở lên!',
            'password.regex'=>'Mật khẩu bao gồm chữ hoa và chữ thường!'
        ];
    }
}
