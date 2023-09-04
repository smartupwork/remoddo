<?php

namespace App\Http\Controllers\Main;

use App\DTO\Security\LoginDTO;
use App\DTO\Security\RegistrationDTO;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Security\Main\LoginRequest;
use App\Http\Requests\Security\Main\RegistrationRequest;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Service\Security\LoginService;
use App\Service\Security\RegistrationService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SecurityController extends Controller
{
    public function registrationForm()
    {
        return view('main.pages.security.registration');
    }

    public function registration(RegistrationRequest $request, RegistrationService $registrationService)
    {
        $dto = (new RegistrationDTO())->make($request);

        $registrationService->handle($dto);

        return redirect()->route('main.security.login.form');
    }

    public function loginForm()
    {
        return view('main.pages.security.login');
    }

    public function login(LoginRequest $request, LoginService $loginService)
    {
        $dto = (new LoginDTO())->make($request);
        return $loginService->handle($dto);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('main.home');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallBack()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if (!$finduser) {
                $newUser = User::create([
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'time_zone'=>get_local_time()
                ]);

                $newUser->info()->create([
                    'name' => $user->user['given_name'],
                    'surname' => $user->user['family_name'],
                    'avatar' => $user->avatar
                ]);

                $roles = Role::whereIn('name', [UserType::LENDER, UserType::RENTER])->get();
                foreach ($roles as $role) {
                    $newUser->roles()->attach($role->id);
                }

                $finduser = $newUser;
            }

            Auth::login($finduser);

            return redirect()->route('main.profile.lender.overview');

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }


    }
}
