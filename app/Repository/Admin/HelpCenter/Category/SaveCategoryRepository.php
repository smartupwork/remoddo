<?php


namespace App\Repository\Admin\HelpCenter\Category;

use App\Contract\Common\SelectDTOContract;
use App\DTO\Admin\HelpCenter\Category\CategoryDTO;
use App\DTO\DTOInterface;
use App\Models\HelpCenterCategory;
use App\Repository\AbstractRepository;

class SaveCategoryRepository extends AbstractRepository implements SelectDTOContract
{

    private DTOInterface $dto;

    public function executeQuery()
    {
        $dto = $this->getDTO();


        /**
         * @var $model HelpCenterCategory
         */
        $model = $this->getModel();
        $model->setTitle($dto->getTitle())
            ->setContent($dto->getContent())
            ->setIsActive($dto->getIsActive())
            ->save();
    }

    /**
     * @return CategoryDTO
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
