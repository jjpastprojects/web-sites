<?php

namespace Lembarek\Blog\Providers;

use Lembarek\Core\Providers\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use \Illuminate\Contracts\Events\Dispatcher as EventDispatcher;

class BlogServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Gate $gate, EventDispatcher $event)
    {
        $event->subscribe('Lembarek\Blog\Listeners\IncreasePostPopularity');
        $event->listen('Lembarek\Blog\Events\PostHasViewed', 'Lembarek\Blog\Listeners\IncreasePostViews');
        $this->fullBoot('blog', __DIR__.'/../');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(
             'Lembarek\Blog\Repositories\BlogRepositoryInterface',
             'Lembarek\Blog\Repositories\BlogRepository'
         );

         $this->app->bind(
             'Lembarek\Blog\Repositories\TagRepositoryInterface',
             'Lembarek\Blog\Repositories\TagRepository'
         );

         $this->app->bind(
             'Lembarek\Blog\Repositories\PostRepositoryInterface',
             'Lembarek\Blog\Repositories\PostRepository'
         );

        $this->app->bind(
            'Lembarek\Blog\Repositories\CategoryRepositoryInterface',
            'Lembarek\Blog\Repositories\CategoryRepository'
        );

        $this->app->bind(
            'Lembarek\Blog\Repositories\PopularityRepositoryInterface',
            'Lembarek\Blog\Repositories\PopularityRepository'
        );

    }
}
