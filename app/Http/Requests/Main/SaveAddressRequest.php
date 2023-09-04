<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class SaveAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'location' => 'required',
            'country' => 'required',
            'city' => 'required',
            'post_code' => 'required|string',
            'phone' => 'required|numeric',
            'is_main' => 'nullable',
            'additional_location' => 'nullable',
        ];

    }

}
