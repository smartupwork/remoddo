<?php

namespace App\Handler\Command\Main\Chat;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\Handler\AbstractHandler;
use App\Models\Order;
use App\Repository\Main\Chat\SaveChatRepository;

class SaveChatHandler extends AbstractHandler implements SelectDTOContract
{

    private Order $order;
    private DTOInterface $dto;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        return (new SaveChatRepository($this->order))
            ->setDTO($this->getDTO())
            ->setModel($this->getModel())
            ->executeQuery();
    }

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
