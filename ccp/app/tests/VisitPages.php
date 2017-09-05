<?php

class VisitPagesTest extends TestCase {

    /**
    * @test
    * @dataProvider RoutesProvider
    */
    public function it_visit_Routes($page)
    {
        $this->client->request('GET', route($page));

        $this->assertTrue($this->client->getResponse()->isOk());

    }

    public function RoutesProvider()
    {
        return [
                ['home'],
                ['terms'],
                ['about_me'],
                ['faq'],
                ['contact_me'],
                ['account-sign-in'],
                ['account-create'],
                ['admin'],
                ['info'],
                ['acp.buys'],
                ['buy'],
                ['sell'],
            ];
    }

}
