<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    $credentials = $request->only('email', 'password', 'token');

    $status = Password::broker('caregivers')->reset($credentials, function ($user, $password) {
        $user->password = bcrypt($password);
        $user->save();
    });

    if ($status == Password::PASSWORD_RESET) {
        return response()->json(['message' => __($status)], 200);
    }

    return response()->json(['message' => __($status)], 400);
}


    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}
