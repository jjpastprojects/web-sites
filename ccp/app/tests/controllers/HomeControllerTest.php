<?php

class HomeControllerTest extends TestCase {

    /**
    * @test
    */
    public function it_go_to_home()
    {
        $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
    * @test
    */
    public function it_go_terms_page()
    {
        $this->client->request('GET', '/terms');
        $this->assertTrue($this->client->getResponse()->isOk());
    }


}
