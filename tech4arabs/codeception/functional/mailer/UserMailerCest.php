<?php

use Lembarek\Mailer\UserMailer;

class UserMailerCest
{

    public function _before(FunctionalTester $I)
    {
    }


    public function _after(FunctionalTester $I)
    {
    }


    public function it_send_a_welcome_message(FunctionalTester $I)
    {
        $to = "joe@gmail.com";
        $userMailer = new UserMailer;
        $userMailer->welcome($to);
    }


}
