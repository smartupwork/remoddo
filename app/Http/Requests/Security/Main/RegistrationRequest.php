<?php

namespace App\Http\Requests\Security\Main;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
       $email_validation_rules='required|email|unique:users,email';

       if ($this->support){
           $email_validation_rules='required|email|unique:users,email,'.$this->support->id;
       }

        return [
            'email' => $email_validation_rules,
            'password' => 'required|confirmed',
            'name' => 'required',
            'surname' => 'required',
            'avatar' => 'nullable|mimes:jpeg,png,jpg'
        ];
    }
}
