<?php

namespace Lembarek\UploadManager\Providers;

use Lembarek\Core\Providers\ServiceProvider;

class UploadManagerServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fullBoot('uploadManager', __DIR__.'/../');
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
