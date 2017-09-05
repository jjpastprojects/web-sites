<?php namespace App\Event;

\Event::listen('UserHasRegisted', function(){
    dd('listen to user has registed');
});
