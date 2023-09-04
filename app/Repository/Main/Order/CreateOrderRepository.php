<?php


namespace App\Repository\Main\Order;

use App\Models\Order;
use App\Models\Rent;
use App\Repository\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class CreateOrderRepository extends AbstractRepository
{

    public function __construct(
        private Model $rent,
        private string $payment_intent,
        private string $start_date,
        private string $exp_date,
    )
    {
    }

    public function executeQuery()
    {
        $order = new Order();

        $order->setLenderId($this->rent->product->lender_id)
            ->setRenterId(auth()->user()->id)
            ->setRentId($this->rent->id)
            ->setProductId($this->rent->product->id)
            ->setPaymentIntent($this->payment_intent)
            ->setTotalPrice($this->rent->total_price)
            ->setDepositPrice($this->rent->deposit_price)
            ->setOriginalPrice($this->rent->total_rent_price)
            ->setStartDate($this->start_date)
            ->setExpDate($this->exp_date)
            ->save();
        return $order;
    }
}
