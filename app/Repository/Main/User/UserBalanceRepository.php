<?php


namespace App\Repository\Main\User;

use App\Repository\AbstractRepository;
use Exception;

class UserBalanceRepository extends AbstractRepository
{

    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function executeQuery()
    {
        $user = auth()->user();
        $user_balance = $user->user_balance;
        if ($this->amount < 0 && abs($this->amount) > $user_balance) {
            throw new Exception('Balance cannot be reduced');
        }


        $user->balance()->updateOrCreate([
            'user_id' => $user->id
        ], [
                'amount' => $user_balance + $this->amount
            ]
        );

    }
}
