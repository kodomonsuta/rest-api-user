<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ActionApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'app.action.api.user.login',
            \App\Actions\Api\User\Login\Handler::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
