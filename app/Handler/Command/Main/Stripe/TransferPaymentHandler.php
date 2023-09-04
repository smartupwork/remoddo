<?php

namespace App\Handler\Command\Main\Stripe;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\WithDrawDTO;
use App\Exceptions\StripeException;
use App\Handler\AbstractHandler;
use App\Repository\Main\User\UserBalanceRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;
use App\Models\StripeAccount;

class TransferPaymentHandler extends AbstractHandler implements SelectDTOContract
{
    private StripeClient $stripe;
    private DTOInterface $dto;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }


    public function setDTO(DTOInterface $dto)
    {
       $this->dto=$dto;
       return $this;
    }

    /**
     * @return WithDrawDTO
     */
    public function getDTO(): DTOInterface
    {
        return $this->dto;
    }


    public function handle()
    {
        try {
            DB::beginTransaction();
            $stripe_account=StripeAccount::find($this->getDTO()->getAccountId());

            (new UserBalanceRepository(-$this->getDTO()->getAmount()))->executeQuery();

            $this->stripe->transfers->create([
                "amount" => (int)$this->getDTO()->getAmount() * 100,
                "destination" => "{$stripe_account->account_id}",
                "currency" => config('cashier.currency'),
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new StripeException($exception->getMessage());
        }
    }

}
