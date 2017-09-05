<?php

class PostsTest extends TestCase {

    /**
    * @test
    * @dataProvider RoutesProvider
    */
    public function it_visit_Routes_post($page, $input)
    {
        $this->client->request('POST', route($page), $input);

    }

    public function RoutesProvider()
    {
        return [
                    ['account-sign-in-post',['email' => 'lem@gmail.com', 'password' => 'secret']],
                    ['contact_us',['subject' => 'subject', 'message' => 'this is the message and it have to be more then 20 carectere']],
            ];
    }

}
