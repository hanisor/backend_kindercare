<?php

namespace App\Auth\Passwords;

use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerContract;

class CustomPasswordBroker extends PasswordBroker implements PasswordBrokerContract
{
    public function getUser(array $credentials)
    {
        // Search for the user in the caregivers table first
        $user = \DB::table('caregivers')
            ->where('email', $credentials['email'])
            ->first();

        // If not found in caregivers, search in guardians
        if (!$user) {
            $user = \DB::table('guardians')
                ->where('email', $credentials['email'])
                ->first();
        }

        return $user;
    }
}
