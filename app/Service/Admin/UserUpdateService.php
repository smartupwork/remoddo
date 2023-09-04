<?php


namespace App\Service\Admin;

use App\DTO\Admin\User\UserUpdateDTO;
use App\DTO\DTOInterface;
use App\Repository\UserRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class UserUpdateService implements ServiceInterface
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserUpdateDTO
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $this->userRepository->updateInfoInAdmin($dto, $model);
    }
}
