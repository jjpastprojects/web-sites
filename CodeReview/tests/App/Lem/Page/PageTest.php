<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTest extends TestCase {

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

    }


    /**
    * @test
    */
    public function it_calcule_and_save_score_for_specific_page_and_user()
    {
        Page::evalCode(1, 1);
    }


    /**
    * @test
    */
    public function it_eval_code_for_a_user()
    {
        Page::evalCodeForUser(1);
    }


    /**
    * @test
    */
    public function it_eval_code_for_a_page()
    {
        Page::evalCodeForPage(1);
    }


    /**
    * @test
    */
    public function it_save_a_score()
    {
        Page::saveScore(1, 1, 50);
        $this->seeInDatabase('user_page', ['user_id' => 1, 'page_id' => 1, 'score' => 50]);
    }


    /**
    * @test
    */
    public function it_get_all_pages_for_user()
    {
        $pages = Page::getAllPagesForUser(1);
        $this->assertArraySubset([0=>1, 1=>2], $pages);
    }


  /**
  * @test
  */
  public function it_convert_title_to_ulr()
  {
      $this->assertEquals('/page/'.'this is title', Page::titleToUrl('this is title'));
  }


    /**
    * @test
    */
    public function it_get_pages_where()
    {
        $p = ['title' => 'title', 'body' => 'body', 'code' => 'code'];
        factory('Lem\Page\Models\Page')->create($p);
        $page = Page::getPagesWhere($p)->first()->toArray();
        $this->assertArraySubset($p, $page);
    }


    /**
    * @test
    */
    public function it_decode_html_code()
    {
        $html = Page::decode('&lt;this is less');
        $this->assertEquals($html, '<this is less');
    }


    /**
    * @test
    */
    public function it_set_a_status()
    {
        Page::setStatus(1, 1, ['isReaded' => true, 'inTrash' => false]);
        $this->seeInDatabase('user_page', ['user_id' => 1, 'page_id' => 1, 'isReaded' =>true, 'inTrash' => false]);

        Page::setStatus(1, 1, ['isReaded' => false, 'inTrash' => true]);
        $this->seeInDatabase('user_page', ['user_id' => 1, 'page_id' => 1, 'isReaded' =>false, 'inTrash' => true]);

        Page::setStatus(1, 1, ['isSaved' => true]);
        $this->seeInDatabase('user_page', ['isSaved' => true]);
    }


    /**
    * @test
    */
    public function it_have_status()
    {
         $status = ['isReaded' => true, 'inTrash' => false];
          Page::setStatus(1, 1, $status);
          $this->assertTrue(Page::haveStatus(1, 1, $status));
    }


    /**
    * @test
    */
    public function it_is_readed_page()
    {
          $status = ['isReaded' => true, 'inTrash' => false];
          Page::setStatus(1, 1, $status);
          $this->assertTrue(Page::isReaded(1,1));

    }



}
