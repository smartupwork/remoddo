<?php

namespace App\Handler\Command\Main\Rent;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\UpdateOrderStatusDTO;
use App\Enums\OrderStatus;
use App\Handler\AbstractHandler;
use App\Models\Order;
use App\Repository\Main\Order\UpdateStatusOrderRepository;
use App\Repository\Main\User\UserBalanceRepository;
use Exception;
use Stripe\StripeClient;

class CreatePaymentHandler extends AbstractHandler implements SelectDTOContract
{

    private DTOInterface $dto;

    public function handle()
    {
        $status = $this->getDTO()->getStatus();


        /**
         * @var Order $order
         */
        $order = $this->getModel();
        try {
            $stripe = new StripeClient(config('cashier.secret'));
            if ($status == OrderStatus::ACCEPTED) {
                $stripe->paymentIntents->confirm($order->getPaymentIntent(),
                    ['payment_method' => 'pm_card_visa']
                );
                (new UserBalanceRepository($order->getOriginalPrice()))->executeQuery();
            } else {
                $stripe->paymentIntents->cancel($order->getPaymentIntent());
            }
            (new UpdateStatusOrderRepository($status))->setModel($order)->executeQuery();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @return UpdateOrderStatusDTO
     */
    public function getDTO(): DTOInterface
    {
        return $this->dto;
    }

    public function setDTO(DTOInterface $dto)
    {
        $this->dto = $dto;
        return $this;
    }
}
