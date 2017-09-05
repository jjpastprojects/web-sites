<?php

namespace Joe\Package1\Providers;

use Lembarek\Core\Providers\ServiceProvider;

class Package1ServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('package1', __DIR__.'/../');
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
