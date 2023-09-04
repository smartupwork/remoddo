<?php


namespace App\Repository\Main\Order;

use App\Repository\AbstractRepository;

class UpdateStatusOrderRepository extends AbstractRepository
{

    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function executeQuery()
    {
        $order = $this->getModel();

        $order->update([
            'status' => $this->status
        ]);
    }
}
