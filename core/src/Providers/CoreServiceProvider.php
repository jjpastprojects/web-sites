<?php

 namespace Lembarek\Core\Providers;

use Lembarek\Core\Providers\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('core', __DIR__.'/../');


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
