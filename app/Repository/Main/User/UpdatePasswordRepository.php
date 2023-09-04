<?php


namespace App\Repository\Main\User;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\UserUpdatePasswordDTO;
use App\Models\User;
use App\Repository\AbstractRepository;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRepository extends AbstractRepository implements SelectDTOContract
{

    private DTOInterface $dto;

    public function executeQuery()
    {
        $dto = $this->getDTO();
        /**
         * @var $model User
         */
        $model = $this->getModel();
        $model->setPassword(Hash::make($dto->getNewPassword()))->save();
    }

    /**
     * @return UserUpdatePasswordDTO
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
