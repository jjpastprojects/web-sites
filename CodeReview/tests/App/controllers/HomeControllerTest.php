<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase {

    use DatabaseTransactions;

   /**
   * @test
   */
   public function it_request_the_home_page()
   {
       $this->actingAs(User::find(1));
       $this->visit('/');
   }


}

