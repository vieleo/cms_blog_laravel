<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
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
        $rule =  [
            'name' => [
                'required',
                'min:5',
            ],
            'description' => [
                'required',
            ]
        ];


    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.required' => 'Vui lòng điền mô tả',
        ];
    }

}
