<?php

namespace App\Http\Requests\Main;

use App\Rules\CheckUserBalanceRole;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
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
            'amount' => ['required_if:payment_method,part_amount',
                new CheckUserBalanceRole($this->request->get('payment_method'))],
            'account_id'=>['required','exists:stripe_accounts,id']
        ];
    }
}
