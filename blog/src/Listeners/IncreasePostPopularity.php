<?php

namespace Lembarek\Blog\Listeners;

use Lembarek\Blog\Events\PostHasViewed;
use Lembarek\Blog\Models\Popularity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lembarek\Blog\Repositories\PopularityRepositoryInterface;

class IncreasePostPopularity
{
    /**
    * Create the event listener.
    *
    * @return void
    */
    protected $popularityRepo;

    public function __construct(PopularityRepositoryInterface $popularityRepo)
    {
        $this->popularityRepo = $popularityRepo;
    }

    /**
    * Handle the event.
    *
    * @param  TestEvent  $event
    * @return void
    */
    public function handle()
    {

    }

    /**
     * increase popularity when post has viewed
     *
     * @param  PostHasViewed $event
     * @return integer
     */
    public function byView(PostHasViewed $event)
    {
        $this->popularityRepo->add($event->post->id, 1);

        return true;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events){
        $events->listen(
            PostHasViewed::class,
            'Lembarek\Blog\Listeners\IncreasePostPopularity@byView'
        );
    }
}
