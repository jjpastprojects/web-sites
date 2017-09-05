<?php

namespace Lembarek\Role\Providers;

use Lembarek\Core\Providers\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('role', __DIR__.'/../');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Lembarek\Role\Repositories\RoleRepositoryInterface',
            'Lembarek\Role\Repositories\RoleRepository'
        );

    }
}
