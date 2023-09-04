<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class RentShippingRequest extends FormRequest
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
            'surname' => 'required',
            'total_price' => 'required',
            'address_id' => 'sometimes|required',
            'main_location' => 'sometimes|required',
            'additional_location' => 'nullable',
            'country' => 'sometimes|required',
            'city' => 'sometimes|required',
            'post_code' => 'sometimes|required',
            'phone' => 'sometimes|required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'main_location.required' => 'ADDRESS LINE 1 field is required'
        ];
    }
}
