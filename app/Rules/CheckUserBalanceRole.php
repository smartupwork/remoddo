<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckUserBalanceRole implements Rule
{
    private string $payment_method;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $payment_method)
    {
        //
        $this->payment_method = $payment_method;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->payment_method=='part_amount'){
            return auth()->user()->user_balance>$value && $value>0;
        }elseif($this->payment_method=='available'){
            return $value==0;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The amount value is invalid';
    }
}
