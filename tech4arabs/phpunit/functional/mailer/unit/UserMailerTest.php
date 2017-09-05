<?php

use Lembarek\Mailer\UserMailer;

class UserMailerTest extends TestCase
{
    /**
    * @test
    */
    public function it_send_a_welcome_message()
    {
        $to = "joe@gmail.com";
        $userMailer = new UserMailer;
        $userMailer->welcome($to);
    }

}
