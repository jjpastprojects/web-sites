<?php namespace Ccp\Providers;

use Illuminate\Support\ServiceProvider;

class CcpServiceProvider extends ServiceProvider {

    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        //
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
            'Ccp\Interfaces\BuyInterface',
            'Ccp\Repositories\BuyRepository'
        );

         $this->app->bind(
            'Ccp\Interfaces\SellInterface',
            'Ccp\Repositories\SellRepository'
        );

         $this->app->bind(
            'Ccp\Interfaces\ContactUsInterface',
            'Ccp\Repositories\ContactUsRepository'
        );

    }

}

