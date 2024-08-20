<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $email = $request->only('email');

    $caregiver = \App\Models\Caregiver::where('email', $email)->first();

    if ($caregiver) {
        $status = Password::broker('caregiver')->sendResetLink($email);
    } else {
        $guardian = \App\Models\Guardian::where('email', $email)->first();
        if ($guardian) {
            $status = Password::broker('guardian')->sendResetLink($email);
        } else {
            return response()->json(['message' => "We can't find a user with that email address."], 400);
        }
    }

    if ($status == Password::RESET_LINK_SENT) {
        return response()->json(['message' => __($status)], 200);
    }

    return response()->json(['message' => __($status)], 400);
}

public function showResetForm($token)
{
    $email = request()->input('email'); // Get the email from the request

    return view('auth.passwords.reset', [
        'token' => $token,
        'email' => $email // Pass the email to the view
    ]);
}


public function reset(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'token' => 'required',
    ]);

    // Perform the password reset
    $response = Password::broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    return $response == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($response))
                : back()->withErrors(['email' => [__($response)]]);
}

}
?>