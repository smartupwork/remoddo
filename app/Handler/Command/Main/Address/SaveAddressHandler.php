<?php

namespace App\Handler\Command\Main\Address;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\Handler\AbstractHandler;
use App\Repository\Main\Address\SaveAddressRepository;

class SaveAddressHandler extends AbstractHandler implements SelectDTOContract
{

    private DTOInterface $dto;

    public function handle()
    {
        (new SaveAddressRepository)
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
