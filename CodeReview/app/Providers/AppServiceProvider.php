<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

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
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);

                $this->app->bind(
                    '\Lem\Profile\Interfaces\VariableInterface',
                    '\Lem\Profile\Repositories\VariableRepository'
                );

                $this->app->bind(
                    '\Lem\Profile\Interfaces\EnumInterface',
                    '\Lem\Profile\Repositories\EnumRepository'
                );

                $this->app->bind(
                    '\Lem\Profile\Interfaces\UserValueInterface',
                    '\Lem\Profile\Repositories\UserValueRepository'
                );

                 $this->app->bind(
                    '\Lem\Profile\Interfaces\UserVariableInterface',
                    '\Lem\Profile\Repositories\UserVariableRepository'
                );


		$this->app->bind(
			'Lem\Profile\Interfaces\VariableInterface',
			'Lem\Profile\Repositories\VariableRepository'
		);


                $this->app->bind(
                    '\Lem\Site\Interfaces\SiteValueInterface',
                    '\Lem\Site\Repositories\SiteValueRepository'
                );


		$this->app->bind(
			'\Lem\TaskTask', function($app){
                            return new \Lem\Task\Task(
                                new \Lem\Task\Repositories\TaskRepository(new \Lem\Task\Models\Task())
                            );
                        }
		);



                $this->app->bind(
                    '\Lem\Profile\Profile', function($app){
                        return new \Lem\Profile\Profile();
                    });

                $this->app->bind(
                    '\Lem\Page\Page', function($app){
                        return new \Lem\Page\Page();
                    });

                $this->app->bind(
                    '\Lem\Code\Code', function($app){
                        return new \Lem\Code\Code();
                    });

                $this->app->bind(
                    '\Lem\User\User', function($app){
                        return new \Lem\User\User();
                    });

                $this->app->bind(
                    '\Lem\Site\Site', function($app){
                        return new \Lem\Site\Site();
                    });

                $this->app->bind(
                    '\Lem\Role\Role', function($app){
                        return new \Lem\Role\Role();
                    });

	}

}
