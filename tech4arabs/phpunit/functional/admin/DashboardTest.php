<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class DashboardTest extends TestCase {

    use DatabaseTransactions, WithoutMiddleware;

    /**
    * @test
    */
    public function it_show_the_index_page()
    {
       $this->visit(route('admin::dashboard'));
    }

    /**
    * @test
    */
    public function it_show_the_users()
    {
        $this->visit(route('admin::dashboard', ['page' => 'users']));
    }

     /**
    * @test
    */
    public function it_show_the_users_2()
    {
        $this->visit(route('admin::dashboard', ['page' => 'users?page=2']));
    }

    /**
    * @test
    */
    public function it_show_the_posts_page()
    {
        $this->visit(route('admin::dashboard', ['pag' => 'posts']));
    }

}
