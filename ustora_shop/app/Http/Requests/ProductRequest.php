<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount' => 'numeric|min:0'

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'price.required' => 'Vui lòng nhập giá sản phẩm!',
            'price.numeric' => 'Giá sản phẩm phải là số!',
            'price.min' => 'Giá sản phẩm phải lớn hơn 0!',
            'category_id' => 'Vui lòng chọn danh mục sản phẩm!',
            'discount.min' => 'Không nhận giá trị âm!'
        ];
    }
}
