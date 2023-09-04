<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $model = $this->route('page');

        if ($model) {
            // update
            $rules = [
                'meta_title' => ['nullable', 'string', 'max:70'],
                'meta_description' => ['nullable', 'string', 'max:255'],
                'title' => ['required', 'string', 'max:70'],
            ];
            if ($model->status == 'static') {
                return $rules;
            }
            return $rules + [
                    'link' => ['required', 'string', 'max:255'],
                    'status' => ['required', 'in:draft,published'],
                    'content' => ['required', 'string']
                ];
        }

        //create
        return [
            'title' => ['required', 'string', 'max:70'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
            'content' => ['required', 'string']
        ];
    }
}
