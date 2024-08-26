<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Auth\Passwords\CustomPasswordBroker;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('custom', function ($app, $name, array $config) {
            return new CustomPasswordBroker(
                $app['auth.password.tokens'],
                $app['auth.password'],
                $app['config']['auth.passwords.' . $name]
            );
        });
    }
}
