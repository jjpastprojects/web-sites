<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileControllerTest extends TestCase {

     use DatabaseTransactions;

     /**
     * @test
     */
     public function it_show_all_variable_for_user()
     {
         $this->actingAs(User::find(1));
         $this->visit('/profile');
     }


    /**
    * @test
    */
    public function it_show_variable()
    {
        DB::table('user_variables')->delete();
        factory('Lem\Profile\Models\Variable')->create(['id' => 45, 'name' => 'foo' ,'type' => 'integer', 'min' => 1, 'max' => 1]);
        factory('Lem\Profile\Models\UserVariable')->create(['user_id' => 1, 'variable_id' =>45]);
        $this->actingAs(User::find(1));
        $this->visit('/profile');
    }


    /**
    * @test
    */
    public function it_save_variable_value()
    {
        DB::table('user_variables')->delete();
        factory('Lem\Profile\Models\Variable')->create(['id' => 45, 'name' => 'foo' ,'type' => 'integer', 'min' => 1, 'max' => 1]);
        factory('Lem\Profile\Models\UserVariable')->create(['user_id' => 1, 'variable_id' =>45]);

        $this->withoutMiddleware();
        $this->actingAs(User::find(1));
        $this->post('/profile/store',['name' => 'foo', 'type' => 'integer', 'min' => 1, 'max' => 1, '0' => 15]);
        $this->seeInDatabase('user_values', ['user_id' => 1, 'variable_id' => 45, 'values' => 15]);
    }


    /**
    * @test
    */
    public function it_show_page_to_update_a_variable()
    {
        $this->actingAs(User::find(1));
        $this->visit('/profile/update/1')
             ->seePageIs('/profile/update/1');
    }


    /**
    * @test
    */
    public function it_put_information_to_update_variable()
    {
        $this->actingAs(User::find(1));
        $this->withoutMiddleware();
        $this->put('/profile/update');
    }


    /**
    * @test
    */
    public function it_delete_a_variable()
    {
        $this->actingAs(User::find(1))
             ->withoutMiddleware()
             ->delete('/profile/delete/1');
    }


    /**
    * @test
    */
    public function it_get_show_all_undefined_variables()
    {
        $this->actingAs(\User::find(1))
             ->visit('/profile/undefinedVariables');
    }


}
