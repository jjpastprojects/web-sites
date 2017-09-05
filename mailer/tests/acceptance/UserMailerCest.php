<?php

use Lembarek\Mailer\UserMailer;

class UserMailerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function it_send_a_welcome_message(AcceptanceTester $I)
    {
        $to = "joe@gmail.com";
        $userMailer = new UserMailer;
        $userMailer->welcome($to);
    }

}
