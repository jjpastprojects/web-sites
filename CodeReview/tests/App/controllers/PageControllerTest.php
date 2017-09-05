<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * test the PageController
 **/
class PageControllerTest extends TestCase
{

     use WithoutMiddleware;
     use DatabaseTransactions;

    /**
    * @test
    */
    public function it_get_all_pages()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $this->visit('/pages');
    }


    /**
    * @test
    */
    public function it_go_to_simple_page()
    {
        $this->actingAs(User::find(1));
        $pages = User::pages(1,['title']);
        foreach ($pages as $page) {
            $this->visit(Page::titleToUrl($page['title']));
        }
    }


    /**
    * @test
    */
    public function it_save_a_page()
    {
        $this->actingAs(User::find(1));
        $pages = User::pages(1,['title']);
        foreach($pages as $page){
            $this->post('/page/save/', ['title' => $page['title']]);
        }

    }


    /**
    * @test
    */
    public function it_delete_a_page()
    {
        $this->actingAs(User::find(1));
        $pages = User::pages(1, ['title']);
        foreach($pages as $page){
            $this->post('/page/delete/', ['title' => $page['title']]);
        }

    }



}
