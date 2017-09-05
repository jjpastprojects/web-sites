<?php

namespace Lembarek\ShareFiles\Providers;


class ShareFilesServiceProvider extends ServiceProvider
{

    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        $this->fullBoot('shareFiles', __DIR__.'/../');
    }

    /**
    * Register any application services.
    *
    * This service provider is a great spot to register your various container
    * bindings with the application. As you can see, we are registering our
    * "Registrar" implementation here. You can add your own bindings too!
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(
            'Lembarek\ShareFiles\Repositories\FileRepositoryInterface',
            'Lembarek\ShareFiles\Repositories\FileRepository'
        );
    }
}
