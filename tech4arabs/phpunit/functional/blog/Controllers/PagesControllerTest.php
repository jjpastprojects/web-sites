<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Lembarek\Blog\Models\Page;


class PagesControllerTest extends TestCase {

    use DatabaseTransactions, WithoutMiddleware;


    /**
    * @test
    */
    public function it_show_all_pages()
    {
        $pages = factory(Page::class, 30)->create();
        $this->visit(route('blog::pages'));
    }


    /**
    * @test
    */
    public function it_show_a_page()
    {
        $page= factory(Page::class)->create();
        $this->visit("blog/$page->slug")
             ->see($page->title)
             ->see($page->body);
    }

}
