<?php


namespace App\Service\Security;


use App\DTO\DTOInterface;
use App\DTO\Security\LoginDTO;
use App\Enums\UserType;
use App\Repository\UserRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoginService implements ServiceInterface
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginDTO $dto
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        if (!$this->checkAuth($dto)) {
            return redirect()->route('main.security.login')->withErrors([
                'invalid_auth' => 'Email or password is invalid'
            ]);
        }

        $user = Auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route("admin.dashboard.index");
        }
        elseif ($user->checkRole(UserType::SUPPORTAGENT))
        {
            return redirect()->route('support.chatsProblems');
        }
        else {
            return redirect()->route('main.profile.lender.overview');
        }
    }

    private function checkAuth(DTOInterface $dto): bool
    {
        return Auth::attempt(['email' => $dto->getEmail(), 'password' => $dto->getPassword()]);
    }
}
