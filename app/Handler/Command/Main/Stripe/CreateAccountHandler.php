<?php

namespace App\Handler\Command\Main\Stripe;

use App\Exceptions\StripeException;
use App\Handler\AbstractHandler;
use App\Repository\Main\Stripe\CheckExistingAccountRepository;
use App\Repository\Main\Stripe\CreateAccountRepository;
use Exception;
use Stripe\StripeClient;

class CreateAccountHandler extends AbstractHandler
{
    private StripeClient $stripe;
    private string $account_id;

    public function __construct(string $account_id)
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
        $this->account_id = $account_id;
    }

    public function handle()
    {
        try {
            $checkRepo = new CheckExistingAccountRepository($this->account_id);
            if ($checkRepo->executeQuery()) {
                throw new StripeException('Stripe Account already exists in database');
            }
            $account = $this->stripe->accounts->retrieve(
                $this->account_id, []
            );
            (new CreateAccountRepository($account))->executeQuery();
            return $account;
        } catch (Exception $exception) {
            throw new StripeException($exception->getMessage());
        }
    }

}
