<?php

namespace App\Handler\Command\Admin\HelpCenter\Category;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\Handler\AbstractHandler;
use App\Repository\Admin\HelpCenter\Category\SaveCategoryRepository;

class SaveCategoryHandler extends AbstractHandler implements SelectDTOContract
{

    private DTOInterface $dto;

    public function handle()
    {
        (new SaveCategoryRepository)
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
