<?php


namespace App\DTO\Main;

use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class WithDrawDTO implements DTOInterface
{
    private float $amount;
    private int $account_id;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return WithDrawDTO
     */
    public function setAmount(float $amount): WithDrawDTO
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->account_id;
    }

    /**
     * @param int $account_id
     * @return WithDrawDTO
     */
    public function setAccountId(int $account_id): WithDrawDTO
    {
        $this->account_id = $account_id;
        return $this;
    }






    public function make(FormRequest $request)
    {
        $amount=$request->get('payment_method')=='part_amount'
            ? $request->get('amount')
            : auth()->user()->user_balance;
        return $this->setAccountId($request->get('account_id'))
            ->setAmount($amount);
    }
}
