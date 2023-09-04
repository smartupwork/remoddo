<?php

namespace App\Http\Requests\Main;

use App\Models\Attribute;
use App\Rules\MaxRentPrice;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'category_id' => 'required',
            'category_id.*' => 'required|exists:categories,id',
            'brand_id' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'description' => 'required',
            'images' => "required|between:4,8",
            'images.*' => "mimes:jpeg,png,jpg",
            'is_main' => "nullable",
            'rents' => ['required', new MaxRentPrice()],
            'rents.*' => ['required', 'numeric', 'min:1'],
            'tags' => 'nullable'

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
        if ($this->has('images')) {
            $messages["images.between"] = "For Post Listing you need to add from 4 to 8 images of the item.
        You have added " . count($this->file('images')) . ".Please add quantity from required range!";

        }
        return $messages;
    }
}
