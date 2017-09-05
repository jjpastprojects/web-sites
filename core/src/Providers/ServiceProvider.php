<?php

 namespace Lembarek\Core\Providers;

use Illuminate\Support\ServiceProvider as MainServiceProvider;

abstract class ServiceProvider extends MainServiceProvider
{
    /**
    * it replace most thing that you can in boot in provider for packages
    *
    * @param  string  $dir
    * @return void
    */
    public function fullBoot($package, $dir)
    {
        $this->mapRoutes($dir);


       if (file_exists($dir.'/views')) {
            $this->loadViewsFrom($dir.'/views', $package);
        }

        if (file_exists($dir.'/migrations')) {
            $this->publishes([
                $dir.'/migrations' => base_path('database/migrations/')
            ], 'migrations');
        }

        if (file_exists($dir.'/seeds')) {
            $this->publishes([
                $dir.'/seeds' => base_path('database/seeds/')
            ], 'seeds');
        }

        if (file_exists($dir."config/$package.php")) {
                $this->mergeConfigFrom(
                    $dir."config/$package.php",
                    $package
             );

                $this->publishes([
                     $dir.'/config' => base_path('config')
                    ], 'config');
        }

        if (file_exists($dir.'/lang')) {

            $this->publishes([
                $dir.'/lang' => resource_path()."/lang/vendor/$package",
            ]);

            $this->loadTranslationsFrom(
                $dir."/lang",
                $package
             );
        }


        if (file_exists($dir.'/assets')) {
            $this->publishes([
                $dir.'/assets' => base_path('resources/assets'),
            ], 'assets');
        }


        if(file_exists($dir.'/factories/ModelFactory.php')){
            require($dir.'/factories/ModelFactory.php');
        }

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function mapRoutes($dir)
    {
      $dir = $dir.'routes';

      if (file_exists($dir)) {
        $files = glob($dir . '/*.php');
        foreach($files as $file){
          if(file_exists($file))
            require($file);
        }
      }

    }

}
