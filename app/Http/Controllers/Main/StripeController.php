<?php

namespace App\Http\Controllers\Main;

use App\DTO\Main\WithDrawDTO;
use App\Handler\Command\Main\Stripe\CreateAccountHandler;
use App\Handler\Command\Main\Stripe\TransferPaymentHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\WithdrawRequest;
use App\Models\StripeAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripeController extends Controller
{
    private StripeClient $stripe;
    private HandlerService $handlerService;
    private WithDrawDTO $dto;

    public function __construct(HandlerService $handlerService, WithDrawDTO $dto)
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
        $this->handlerService = $handlerService;
        $this->dto = $dto;
    }

    public function connect()
    {
        try {
            $stripe_account = auth()->user()->stripeAccount;
            if (!$stripe_account) {
                $account = $this->stripe->accounts->create(['type' => 'express']);

                $accountLinks = $this->stripe->accountLinks->create(
                    [
                        'account' => $account->id,
                        'refresh_url' => 'https://remodo.webstaginghub.com',
                        'return_url' => route('main.stripe.redirect', ['account_id' => $account->id]),
                        'type' => 'account_onboarding',
                    ]
                );
                return redirect()->to($accountLinks->url);
            }
        } catch (Exception $exception) {
            Log::channel('stripe_account')->error($exception->getMessage());
            return redirect()->route('main.profile.lender.finance');
        }
    }

    public function redirect(Request $request)
    {
        try {
            $account_handler = $this->handlerService
                ->setHandler(new CreateAccountHandler($request->get('account_id')))
                ->getHandler();
             $account_handler->setModel(new StripeAccount())->handle();
            return redirect()->route('main.profile.lender.finance');
        } catch (Exception $exception) {
            Log::channel('stripe_account')->error($exception->getMessage());
            return redirect()->route('main.profile.lender.finance');
        }
    }

    public function withdraw(WithdrawRequest $request)
    {
        try {
            $dto = $this->dto->make($request);
            $payment_handler = $this->handlerService
                ->setHandler(new TransferPaymentHandler())
                ->getHandler();
            $payment_handler->setDTO($dto)->handle();
            return $this->jsonSuccess('');
        } catch (Exception $exception) {
            Log::channel('stripe_account')->error($exception->getMessage());
            return $this->jsonError($exception->getMessage());
        }
    }
}
