<?php


namespace App\Contract\Common;

use App\DTO\DTOInterface;

interface SelectDTOContract
{
    public function setDTO(DTOInterface $dto);

    public function getDTO(): DTOInterface;
}
