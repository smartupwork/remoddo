<?php

namespace App\Console\Commands;

use App\Enums\NotificationType;
use App\Enums\OrderStatus;
use App\Events\SendNotificationEvent;
use App\Models\Order;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Stripe\StripeClient;

class LateOrderNotification extends Command
{

    private StripeClient $stripe;

    public function __construct()
    {
        parent::__construct();
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'late:order-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification when is order return late';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = CarbonImmutable::now();

        $orders = Order::where('exp_date', '<=', $now->format('Y-m-d'))
            ->whereNotIn('status', [OrderStatus::CONFIRM_SHIPPED_BACK,OrderStatus::COMPLETED])
            ->where('status', OrderStatus::ACCEPTED)
            ->get();

        foreach ($orders as $order) {

            $price = $order->deposit_price;

            $payment = $order->renter->createPayment((int)($price * 100));

            if ($payment->isSucceeded()) {
                $payment_intent = $payment->asStripePaymentIntent();

                $this->stripe->paymentIntents->confirm($payment_intent->id,
                    ['payment_method' => 'pm_card_visa']
                );

                $lender = $order->lender;
                $lender->balance()->updateOrCreate([
                    'user_id' => $lender->id
                ], [
                        'amount' => $lender->user_balance + $price
                    ]
                );
            }

            $context = "Your order #{$order->id} can be on late dispatch fee. Please, send your order.";
            event(new SendNotificationEvent(
                model: $order,
                receiver_id: $order->renter_id,
                context: $context,
                type: NotificationType::LATE_DISPATCH,
                url: route('main.profile.lender.order-detail', $order)
            ));
        }

    }
}
