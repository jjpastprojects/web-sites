<?php

namespace {{Vendor}}\{{Name}}\Providers;

use Lembarek\Core\Providers\ServiceProvider;

class {{Name}}ServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('{{name}}', __DIR__.'/../');
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
