<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserMailerTest extends TestCase {

    use DatabaseTransactions;

    /**
    * @test
    */
    public function it_send_mail_to_user()
    {
        UserMailer::welcome();
    }

}
