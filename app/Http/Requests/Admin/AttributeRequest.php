<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
        $id = $this->route('attribute') ? $this->route('attribute')->id : null;
        return [
            'name' => 'required|unique:attributes,name,' . $id,
            'title' => 'required',
            'is_required' => 'nullable',
            'is_show' => 'nullable',
            'is_multiple' => 'nullable',
            'show_in_products_table' => 'nullable',
        ];
    }
}
