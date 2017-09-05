<?php

namespace Lembarek\Api\Providers;

use Lembarek\Core\Providers\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('api', __DIR__.'/../');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
    }
}
