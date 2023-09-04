<?php


namespace App\Repository\Main\Address;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\SaveAddressDTO;
use App\Models\Address;
use App\Repository\AbstractRepository;

class SaveAddressRepository extends AbstractRepository implements SelectDTOContract
{

    private DTOInterface $dto;

    public function executeQuery()
    {
        $dto = $this->getDTO();

        if ($dto->getIsMain()) {

            $address = Address::where('is_main', $dto->getIsMain())->first();

            if ($address) {
                $address->update([
                    'is_main' => !$dto->getIsMain()
                ]);
            }
        }

        /**
         * @var $model Address
         */
        $model = $this->getModel();
        $model->setName($dto->getName())
            ->setPhone($dto->getPhone())
            ->setLocation($dto->getLocation())
            ->setUserId($dto->getUserId())
            ->setIsMain($dto->getIsMain())
            ->setCountry($dto->getCountry())
            ->setCity($dto->getCity())
            ->setPostCode($dto->getPostCode())
            ->setAdditionalLocation($dto->getAdditionalLocation())
            ->save();
    }

    /**
     * @return SaveAddressDTO
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
