<?php


namespace App\Repository\Admin\HelpCenter;

use App\Contract\Common\SelectDTOContract;
use App\DTO\Admin\HelpCenter\HelpCenterDTO;
use App\DTO\DTOInterface;
use App\Models\HelpCenter;
use App\Repository\AbstractRepository;

class SaveHelpCenterRepository extends AbstractRepository implements SelectDTOContract
{

    private DTOInterface $dto;

    public function executeQuery()
    {
        $dto = $this->getDTO();


        /**
         * @var $model HelpCenter
         */
        $model = $this->getModel();
        $model->setQuestion($dto->getQuestion())
            ->setAnswer($dto->getAnswer())
            ->setCategoryId($dto->getCategoryId())
            ->setMetaTitle($dto->getMetaTitle())
            ->setMetaDescription($dto->getMetaDescription())
            ->setMetaKeyword($dto->getMetaKeyword())
            ->setIsActive($dto->getIsActive())
            ->save();
    }

    /**
     * @return HelpCenterDTO
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
