<?php

namespace App\Http\Controllers\Main\Profile;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Repository\Main\PaymentMethod\CreatePaymentMethodRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class PaymentController extends Controller
{

    private StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    public function index(Request $request)
    {
        $paymentMethods = auth()->user()->localPaymentMethods;
        $customer = auth()->user()->createOrGetStripeCustomer();

        $intent = $this->stripe->setupIntents->create(
            [
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
            ]
        );
        return view('main.pages.profile.user.payment-method.index', [
            'intent' => $intent,
            'public_key' => config('cashier.key'),
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function store(Request $request)
    {

        try {
            (new CreatePaymentMethodRepository($request))->executeQuery();

            return $this->jsonSuccess('', [
                'url' => route('main.profile.user.payment-method.index')
            ]);
        } catch (Exception $exception) {
            Log::channel('stripe_account')->error($exception->getMessage());
            return $this->jsonError('Something is wrong');
        }
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        try{
            $this->stripe->paymentMethods->retrieve($paymentMethod->pm_id)->detach();
            $paymentMethod->delete();
            return $this->jsonSuccess('Successfully deleted');
        }catch (Exception $exception){
            Log::channel('stripe_account')->error($exception->getMessage());
            return $this->jsonError('Something is wrong');
        }
    }
}
