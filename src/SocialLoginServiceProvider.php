<?php

namespace KyleMass\SocialLogin;

use Illuminate\Support\ServiceProvider;

class SocialLoginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/database/migrations' => base_path('database/migrations'),
            __DIR__.'/models/' => base_path('app'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('KyleMass\SocialLogin\SocialLoginController');
    }
}
