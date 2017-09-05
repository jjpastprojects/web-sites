<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * test the VariableController
 **/
class VariableControllerTest extends TestCase
{


     use DatabaseTransactions;

     /**
     * @test
     */
     public function it_create_a_new_variable()
     {
         $this->actingAs(User::find(1));
         $this->visit('variable/create')
             ->seePageIs('/variable/create')
             ->type('willaya', 'name')
             ->type('1', 'min')
             ->type('1', 'max')
             ->type('biskra, batna, alger','values')
             ->type('$users = User::all();foreach ($users as $user) {if(Profile::getValue($user->id, Profile::getVariableByName("country")->id) === "algerian")Profile::addVariableToUser($user->id, Profile::getVariableByName("willaya"));}Task::createTask(["whenCondition" => "change_variable", "code" =>\'if(Profile::getValue(#diazcurrent_user_id, Profile::getVariableByName("country")->id)==="algerian")Profile::addVariableToUser(#diazcurrent_user_id, Profile::getVariableByName("willaya"));\']);', 'code')
             ->press(trans('var.create.submit'))
             ->seePageIs('/variable/create');




     }



}
