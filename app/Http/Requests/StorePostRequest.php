<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'quantity' => 'required|alpha_num',
            'price_old' => 'required|alpha_num',
            'price_new' => 'required|alpha_num',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'description.required' => 'Please enter a description',
        ];
    }
}
