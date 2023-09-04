<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $id = $this->route('brand') ? $this->route('brand')->id : null;

        $image_required = 'required';
        if ($id) {
            $image_required = 'nullable';
        }

        return [
            'title' => 'required|unique:brands,title,' . $id,
            'image' => "$image_required|mimes:jpeg,png,jpg",
            'is_show' => 'nullable',
        ];
    }
}
