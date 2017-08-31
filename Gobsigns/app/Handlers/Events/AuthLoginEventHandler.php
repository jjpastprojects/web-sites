<?php

namespace App\Handlers\Events;

use App\Events;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class AuthLoginEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(User $user, $remember)
    {
        \Auth::user()->last_login = \Auth::user()->last_login_now;
        \Auth::user()->last_login_ip = \Auth::user()->last_login_ip_now;
        \Auth::user()->last_login_now = new \DateTime;
        \Auth::user()->last_login_ip_now = \Request::getClientIp();
        \Auth::user()->save();
    }
}
