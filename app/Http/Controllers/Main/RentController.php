<?php

namespace App\Http\Controllers\Main;

use App\Enums\NotificationType;
use App\Events\SendNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\RentShippingRequest;
use App\Mail\SendItemWasRequestedMail;
use App\Models\Address;
use App\Models\Order;
use App\Models\Rent;
use App\Repository\Main\Order\CreateOrderRepository;
use App\Repository\Main\Order\CreateShippingRepository;
use App\Repository\Main\PaymentMethod\CreatePaymentMethodRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Payment;
use Stripe\StripeClient;

class RentController extends Controller
{
    private StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    public function shippingForm(Rent $rent, Request $request)
    {
        if (auth()->user()->id === $rent->product->lender_id || $rent->product->isBuyedProduct()) {
            return redirect()->route('main.home');
        }
        if (empty($request->start_date) || empty($request->end_date)) {
            return redirect()->route('main.product.detail', ['product' => $rent->product->id]);
        }

        $name='';
        $surname='';
        $address_id='';
        if ($request->session()->has('rent_shipping')){
            $name=isset($request->session()->get('rent_shipping')['name'])? $request->session()->get('rent_shipping')['name'] : '';
            $surname=isset($request->session()->get('rent_shipping')['surname'])? $request->session()->get('rent_shipping')['surname'] : '';
            $address_id=isset($request->session()->get('rent_shipping')['address_id']) ? $request->session()->get('rent_shipping')['address_id'] : '';
        }

        return view('main.pages.rent.shipping', [
            'start_date' => Carbon::parse($request->start_date)->format('d.m.Y'),
            'end_date' => Carbon::parse($request->end_date)->format('d.m.Y'),
            'product' => $rent->product,
            'rent' => $rent,
            'addresses' => auth()->user()->addresses,
            'countries' => config('countries'),
            'session_data_name'=>$name,
            'session_data_surname'=>$surname,
            'session_data_address_id'=>$address_id,
        ]);
    }

    public function shipping(Rent $rent, RentShippingRequest $request)
    {
        $session = $request->session();
        if ($session->has('rent_shipping')) {
            $session->forget('rent_shipping');
        }

        if ($request->get('address_id')) {
            $address_data = Address::find($request->get('address_id'));
            $address = [
                'address_id' => $address_data->id,
                'main_location' => $address_data->location,
                'additional_location' => $address_data->additional_location,
                'country' => $address_data->country,
                'city' => $address_data->city,
                'post_code' => $address_data->post_code,
                'phone' => $address_data->phone,
            ];
        } else {
            $address = [
                'main_location' => $request->get('main_location'),
                'additional_location' => $request->get('additional_location'),
                'country' => config('countries')[$request->get('country')],
                'city' => $request->get('city'),
                'post_code' => $request->get('post_code'),
                'phone' => $request->get('phone'),
                'address_id' => null,
            ];
        }


        $session->put('rent_shipping', [
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'address_id' => $request->get('address_id'),
            'address' => $address,
            'total_price' => $request->get('total_price'),
        ]);

        return $this->jsonSuccess('', [
            'url' => route('main.rent.payment-init', [
                'rent' => $rent,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ])
        ]);
    }

    public function paymentInit(Rent $rent, Request $request)
    {
        $session = $request->session();

        if (!$session->has('rent_shipping')) {
            return redirect()->route('main.product.detail', ['product' => $rent->product->id]);
        }

        $customer = auth()->user()->createOrGetStripeCustomer();

        $intent = $this->stripe->setupIntents->create(
            [
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
            ]
        );

        $paymentMethods = auth()->user()->localPaymentMethods;
        return view('main.pages.rent.payment',
            [
                'intent' => $intent,
                'public_key' => config('cashier.key'),
                'paymentMethods' => $paymentMethods,
                'rent' => $rent,
                'product' => $rent->product,
                'start_date' => Carbon::parse($request->get('start_date'))->format('d.m.Y'),
                'end_date' => Carbon::parse($request->get('end_date'))->format('d.m.Y'),
                'session' => $session->get('rent_shipping'),
                'back_url' => route('main.rent.shipping-form',
                    ['rent' => $rent,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                    ])
            ]);
    }

    public function paymentIntent(Rent $rent, Request $request)
    {
        try {

            $session = $request->session();
            if (!$session->has('rent_shipping')) {
                redirect()->route('main.product.detail', ['product' => $rent->product->id]);
            }


            if (!$request->payment_method_id) {
                (new CreatePaymentMethodRepository($request))->executeQuery();
            }


            $total_price = $rent->total_rent_price;
            /**
             * @var Payment $payment
             */
            $payment = auth()->user()->createPayment((int)($total_price * 100));
            $payment_intent = $payment->asStripePaymentIntent();


            $order = (new CreateOrderRepository($rent, $payment_intent->id, $request->start_date, $request->end_date))
                ->setModel(new Order())
                ->executeQuery();

            (new CreateShippingRepository($order, $session->get('rent_shipping')))
                ->executeQuery();
            $session->put('success', 'success');

            Mail::to($order->lender->email)
                ->send(new SendItemWasRequestedMail($order->product->title));

            $context = "Your item {$order->product->title} has been requested.";
            event(new SendNotificationEvent(
                model: $order,
                receiver_id: $order->lender_id,
                context: $context,
                type: NotificationType::PRODUCT_REQUESTED,
                url: route('main.profile.lender.order-detail', $order)
            ));
            return $this->jsonSuccess('payment intent', [
                'url' => route('main.rent.payment-success', [
                    'rent' => $rent
                ]),
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function paymentSuccess(Rent $rent, Request $request)
    {
        $session = $request->session();
        if (!$session->has('success')) {
            return redirect()->route('main.home');

        }
        $session->forget('rent_shipping');
        $session->forget('success');
        return view('main.pages.rent.success');
    }
}
