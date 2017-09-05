<?php

 namespace Lembarek\Auth\Providers;

use Lembarek\Core\Providers\ServiceProvider;
use \Illuminate\Contracts\Events\Dispatcher as EventDispatcher;

class AuthServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(EventDispatcher $event)
    {
        $this->fullBoot('auth', __DIR__.'/../');
        $event->listen('Lembarek\Auth\Events\UserHasCreated', 'Lembarek\Auth\Listeners\SendWelcomeMessage');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Lembarek\Auth\Repositories\UserRepositoryInterface',
            'Lembarek\Auth\Repositories\UserRepository'
        );

        $this->app->bind(
            'Lembarek\Auth\Repositories\ResetPasswordRepositoryInterface',
            'Lembarek\Auth\Repositories\ResetPasswordRepository'
        );

    }
}
