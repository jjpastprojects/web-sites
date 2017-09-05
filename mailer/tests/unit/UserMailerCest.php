<?php

use Lembarek\Mailer\UserMailer;

class UserMailerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

   public function it_send_a_welcome_message(UnitTester $I)
    {
        $to = "joe@gmail.com";
        $userMailer = new UserMailer;
        $userMailer->welcome($to);
    }

}
