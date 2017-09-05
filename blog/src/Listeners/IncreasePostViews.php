<?php

namespace Lembarek\Blog\Listeners;

use Lembarek\Blog\Events\PostHasViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncreasePostViews
{
    /**
    * Create the event listener.
    *
    * @return void
    */
    public function __construct()
    {
    }

    /**
    * Handle the event.
    *
    * @param  TestEvent  $event
    * @return void
    */
    public function handle(PostHasViewed $event)
    {
        $event->post->views++;
        $event->post->save();
        return $event->post;
    }
}
