<?php

namespace App\Handler\Command\Main\User;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\Handler\AbstractHandler;
use App\Repository\Main\User\UpdateDetailRepository;

class UpdateDetailHandler extends AbstractHandler implements SelectDTOContract
{

    private DTOInterface $dto;

    public function handle()
    {
        (new UpdateDetailRepository)
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
