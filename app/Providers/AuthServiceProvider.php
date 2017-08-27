<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Paulvl\JWTGuard\JWT\JWTManager;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->bind('jwt-manager', function()
        {
            return new JWTManager(
                config('jwt.secret_key'),
                config('jwt.jwt_token_duration'),
                config('jwt.enable_refresh_token'),
                config('jwt.refresh_token_duration')
            );
        });
    }
}
