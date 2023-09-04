<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function loginForm()
    {
        return view('admin.sections.auth.login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login.form');
    }

    protected function redirectTo()
    {
        return auth()->user()->checkRole('admin')
            ? route('admin.dashboard.index')
            : $this->redirectTo;
    }
}
