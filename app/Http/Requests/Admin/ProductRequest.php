<?php

namespace App\Http\Requests\Admin;

use App\Models\Attribute;
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
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $rules = [
            'title' => 'required',
            'period_day' => 'required|min:1|numeric',
            'price' => 'required|min:1|numeric',
            'brand_confirmation' => 'required',
            'category_id' => 'required',
            'category_id.*' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'address' => 'required',
            'description' => 'required',
            'images' => "nullable",
            'images.*' => "mimes:jpeg,png,jpg",
        ];

        $attributes = Attribute::select('is_required', 'name', 'id')->where('is_show', true)->get();

        foreach ($attributes as $attribute) {
            $required = '';
            $multiple = '';


            if ($attribute->is_required) {
                $required = 'required';
            }

            if ($attribute->is_multiple) {
                $multiple = '.*';
            }

            $rules["attribute.$attribute->id.$attribute->name$multiple"] = $required;
        }
        return $rules;
    }


    public function messages()
    {
        $attributes = Attribute::select('name', 'id', 'title', 'is_multiple')
            ->where('is_required', true)->where('is_show', true)->get();

        $messages = [];
        $multiple = '';

        foreach ($attributes as $attribute) {

            if ($attribute->is_multiple) {
                $multiple = '.*';
            }
            $messages["attribute.$attribute->id.$attribute->name$multiple"] = "$attribute->title is required";
        }
        return $messages;
    }
}
