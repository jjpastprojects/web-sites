<?php

namespace Lembarek\Package\Providers;

use Lembarek\Package\Commands\CreatePackage;
use Lembarek\Package\Package\Package;
use Lembarek\Package\Package\PackageInterface;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('package', __DIR__.'/../');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PackageInterface::class, Package::class);
        $this->commands(CreatePackage::class);
    }
}
