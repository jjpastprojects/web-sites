<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase {

    use DatabaseTransactions;

    protected $task;

    public function setUp()
    {
        parent::setUp();

    }


    /**
    * @test
    */
    public function it_execute_tasks_when_user_register()
    {

        $user = factory(Lem\User\Models\User::class)->make(['id' => 1]);
        $this->actingAs($user);
        $task = factory('Lem\Task\Models\Task')->create([
            'whenCondition' => 'register2',
            'code' =>  'if(\App\Facades\Profile::getValue(1, \App\Facades\Profile::getVariableByName("sex")->id) == "male")$v = \App\Facades\Profile::createVariable(["name" => "willaya", "type" =>"enum", "min" => 1, "max" => 1]); \App\Facades\Profile::createEnum(["variable_id"  => $v->id, "values" => "alger, biskra, batna"]);'
        ]);
        Task::execute('register2');
        $this->seeInDatabase('variables', ['name' => 'willaya', 'type' => 'enum', 'min' => '1', 'max' => '1']);
    }


    /**
    * @test
    */
    public function it_execute_tasks_in_specific_time()
    {
        $task = factory('Lem\Task\Models\Task')->create([
            'whenCondition' => '2015-02-24 19:48',
            'code' =>  'if(\App\Facades\Profile::getValue(1, \App\Facades\Profile::getVariableByName("sex")->id) == "male")$v = \App\Facades\Profile::createVariable(["name" => "willaya", "type" =>"enum", "min" => 1, "max" => 1]); \App\Facades\Profile::createEnum(["variable_id"  => $v->id, "values" => "alger, biskra, batna"]);'
        ]);
        Task::execute('2015-02-24 19:48');
        $this->seeInDatabase('variables', ['name' => 'willaya', 'type' => 'enum', 'min' => '1', 'max' => '1']);
    }


}
