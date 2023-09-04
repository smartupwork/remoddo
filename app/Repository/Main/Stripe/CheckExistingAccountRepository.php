<?php


namespace App\Repository\Main\Stripe;

use App\Models\StripeAccount;
use App\Repository\AbstractRepository;

class CheckExistingAccountRepository extends AbstractRepository
{
    private string $account_id;

    public function __construct(string $account_id)
    {
        $this->account_id = $account_id;
    }

    public function executeQuery()
    {
        return StripeAccount::where('account_id', $this->account_id)->exists();
    }
}
