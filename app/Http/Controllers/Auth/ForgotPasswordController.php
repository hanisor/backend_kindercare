<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;    
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $email = $request->input('email');

    // Try finding the user as a Caregiver
    $caregiver = \App\Models\Caregiver::where('email', $email)->first();
    \Log::info('Caregiver exists: ' . ($caregiver ? 'Yes' : 'No'));

    if ($caregiver) {
        $status = Password::broker('caregiver')->sendResetLink(['email' => $email]);
    } else {
        // If not a Caregiver, try finding the user as a Guardian
        $guardian = \App\Models\Guardian::where('email', $email)->first();
        \Log::info('Guardian exists: ' . ($guardian ? 'Yes' : 'No'));

        if ($guardian) {
            $status = Password::broker('guardian')->sendResetLink(['email' => $email]);
        } else {
            // No user found, return error response
            return response()->json(['message' => "We can't find a user with that email address."], 400);
        }
    }

    // Return the appropriate response based on the status
    if ($status == Password::RESET_LINK_SENT) {
        return response()->json(['message' => __($status)], 200);
    }

    return response()->json(['message' => __($status)], 400);
}


public function showResetForm(Request $request, $token = null)
{
    return view('auth.reset')->with([
        'token' => $token,
        'email' => $request->email
    ]);
}


public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => 'required|confirmed',
    ]);

    $email = $request->input('email');

    // Check if the email belongs to Caregiver or Guardian
    $caregiver = \App\Models\Caregiver::where('email', $email)->first();
    $guardian = \App\Models\Guardian::where('email', $email)->first();

    if ($caregiver) {
        $broker = Password::broker('caregiver');
    } elseif ($guardian) {
        $broker = Password::broker('guardian');
    } else {
        return response()->json(['message' => "We can't find a user with that email address."], 400);
    }

    $response = $broker->reset([
    'email' => $email,
    'password' => $request->password,
    'token' => $request->token,
], function ($user, $password) {
    $user->password = Hash::make($password);
    $user->save();
});

return $response === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully.'])
            : response()->json(['message' => 'Failed to reset password.'], 500);

}

}
?>