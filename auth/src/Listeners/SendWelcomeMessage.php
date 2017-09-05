<?php

namespace Lembarek\Auth\Listeners;

use Lembarek\Auth\Events\UserHasCreated;
use Lembarek\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeMessage
{
    /**
    * Create the event listener.
    *
    * @return void
    */
    public function __construct(UserMailer $userMailer)
    {
        $this->userMailer = $userMailer;
    }

    /**
    * Handle the event.
    *
    * @param  TestEvent  $event
    * @return void
    */
    public function handle(UserHasCreated $event)
    {
        $this->userMailer->welcome($event->user->email);
    }
}
