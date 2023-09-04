<?php

namespace App\Repository\Main\Stripe;

use App\Exceptions\StripeException;
use App\Repository\AbstractRepository;
use Exception;
use Stripe\Account;

class CreateAccountRepository extends AbstractRepository
{
    private Account $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function executeQuery()
    {
        try {
            auth()->user()->stripeAccount()->create([
                'account_id' => $this->account->id
            ]);
        } catch (Exception $exception) {
            throw new StripeException($exception->getMessage());
        }
    }
}
