<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Security\Main\ForgotPasswordRequest;
use App\Http\Requests\Security\Main\ResetPasswordRequest;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{

    public function showForgetPasswordForm()
    {
        return view('main.pages.security.forgetPassword');
    }


    public function submitForgetPasswordForm(ForgotPasswordRequest $request)
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('mail.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }


    public function showResetPasswordForm($token)
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $token
            ])->first();
        $email=$updatePassword->email;
        return view('main.pages.security.forgetPasswordLink',compact('email','token'));
    }

    public function submitResetPasswordForm(ResetPasswordRequest $request){
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }

}
