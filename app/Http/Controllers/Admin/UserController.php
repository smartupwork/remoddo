<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\User\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use App\Service\Admin\UserUpdateService;

class UserController extends Controller
{
    private UserUpdateService $service;

    public function __construct(UserUpdateService $service)
    {
        $this->service = $service;
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $dto = (new UserUpdateDTO())->make($request);
        $this->service->handle($dto, $user);
    }

    public function updateStatus(User $user)
    {
        $userInfo = $user->info;
        $userInfo->update([
            'is_blocked' => !$userInfo->is_blocked
        ]);
        return $this->jsonSuccess('', [
            'is_blocked' => $userInfo->is_blocked
        ]);
    }
}
