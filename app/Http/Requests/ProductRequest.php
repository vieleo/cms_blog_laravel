<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            // 'category_id' => 'required',
            'quantity' => 'required|numeric',
            'price_old' => 'required|numeric|regex:/^\d{1,13}(\.\d{1,4})?$/',
            'price_new' => 'required|numeric|regex:/^\d{1,13}(\.\d{1,4})?$/',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'quantity.numeric' => 'Yêu cầu nhập dữ liệu kiểu số',
            'description.required' => 'Please enter a description',
        ];
    }
}
