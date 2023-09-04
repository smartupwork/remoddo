<?php


namespace App\Service\Security;


use App\DTO\DTOInterface;
use App\DTO\Security\RegistrationDTO;
use App\Repository\UserRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class RegistrationService implements ServiceInterface
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegistrationDTO $dto
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $this->userRepository->save($dto);
    }
}
