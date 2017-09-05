<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * test the AdminController
 **/
class AdminControllerTest extends TestCase
{

     //use WithoutMiddleware;
     use DatabaseTransactions;

     /**
     * @test
     */
     public function it_get_all_roles()
     {
         $this->actingAs(User::find(1));
         User::getRoles();
     }


     /**
     * @test
     */
     public function it_get_all_user()
     {
         $this->actingAs(User::find(1));
         $this->visit('/admin/users')
             ->see(trans('admin.all_users'));
     }


     /**
     * @test
     */
     public function it_redirect_user_back_home_if_he_is_not_admin()
     {
         $this->actingAs(User::find(2));
         $this->visit('/admin/users')
              ->seePageIs('/home');
     }


}
