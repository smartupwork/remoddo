<?php


namespace App\Repository\Main\PaymentMethod;

use App\Repository\AbstractRepository;
use Exception;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class CreatePaymentMethodRepository extends AbstractRepository
{

    private StripeClient $stripe;
    private Request $request;

    public function __construct(Request $request)
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
        $this->request = $request;
    }

    public function executeQuery()
    {
        try {
            $paymentMethod = $this->stripe->paymentMethods->retrieve($this->request->payment_method);
            if ($paymentMethod) {

                $is_default = $this->request->is_default && $this->request->is_default == 'on';

                $this->stripe->paymentMethods->attach(
                    $this->request->payment_method,
                    ['customer' => $paymentMethod->customer]
                );
                if ($is_default) {


                    $this->stripe->customers->update(
                        $paymentMethod->customer,
                        ['invoice_settings' => [
                            'default_payment_method' => $this->request->payment_method
                        ]]
                    );

                    auth()->user()
                        ->localPaymentMethods()
                        ->where('default_method', $is_default)->update([
                            'default_method' => !$is_default
                        ]);
                }
                auth()->user()
                    ->localPaymentMethods()
                    ->updateOrCreate(['pm_id' => $this->request->payment_method], [
                        'pm_id' => $this->request->payment_method,
                        'brand' => $paymentMethod->card->brand,
                        'exp_month' => $paymentMethod->card->exp_month,
                        'exp_year' => $paymentMethod->card->exp_year,
                        'card_number' => $paymentMethod->card->last4,
                        'default_method' => $is_default
                    ]);

            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

    }
}
