<?php

namespace App\Console\Commands;

use App\Enums\NotificationType;
use App\Enums\OrderStatus;
use App\Events\SendNotificationEvent;
use App\Models\Order;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class SendBackOrderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-back:order-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now=CarbonImmutable::now();

        $date=$now->addDay()->format('Y-m-d');

        $orders=Order::where('exp_date',$date)
            ->whereNotIn('status',[OrderStatus::CONFIRM_SHIPPED_BACK,OrderStatus::COMPLETED])
            ->where('status',OrderStatus::ACCEPTED)
            ->get();

        foreach ($orders as $order){
            $context="Your order #{$order->id} is now on late dispatch fee 30% of rental price. Please, send your order.";
            event(new SendNotificationEvent(
                model:$order,
                receiver_id: $order->renter_id,
                context:$context,
                type: NotificationType::SEND_BACK,
                url:route('main.profile.lender.order-detail',$order)
            ));
        }
    }
}
