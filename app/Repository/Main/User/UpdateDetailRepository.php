<?php


namespace App\Repository\Main\User;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\UserUpdateDetailDTO;
use App\Models\User;
use App\Repository\AbstractRepository;
use Illuminate\Support\Facades\Storage;

class UpdateDetailRepository extends AbstractRepository implements SelectDTOContract
{

    private DTOInterface $dto;

    public function executeQuery()
    {
        $dto = $this->getDTO();
        /**
         * @var $model User
         */
        $model = $this->getModel();
        $model->setEmail($dto->getEmail())->save();

        $fields = [
            'name' => $dto->getName(),
            'surname' => $dto->getSurname(),
        ];

        if ($dto->getAvatar()) {
            $disk = $model->info->getDiskName();
            Storage::disk($disk)->delete($dto->getAvatar());
            $fields['avatar'] = Storage::disk($disk)->put('', $dto->getAvatar());
        }

        $model->info()->update($fields);


    }

    /**
     * @return UserUpdateDetailDTO
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
