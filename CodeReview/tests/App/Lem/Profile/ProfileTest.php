<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase {

    use DatabaseTransactions;

    protected $task;

    public function setUp()
    {
        parent::setUp();

    }


    /**
    * @test
    */
    public function it_get_value()
    {
        factory('Lem\User\Models\User')->create(['id' => 7]);
        factory('Lem\Profile\Models\Variable')->create(['id' => 5]);
        factory('Lem\Profile\Models\UserValue')->create(['user_id'=>7, 'variable_id' => 5, 'values' => 'foo']);
        $value = Profile::getValue(7, 5);
        $this->assertEquals('foo', $value);
    }


    /**
    * @test
    */
    public function it_create_variable()
    {
        $columns = ['name' => 'foo', 'type' => 'integer', 'min' => 1, 'max' => 5];
        Profile::createVariable($columns);
        $this->seeInDatabase('variables',$columns);
    }


    /**
    * @test
    */
    public function it_create_enum()
    {
        factory('Lem\Profile\Models\Variable')->create(['id' => 44]);
        $columns = ['variable_id' => 44, 'values' => 'foo, bar, baz'];
        Profile::createEnum($columns);
        $this->seeInDatabase('enums', $columns);
    }


    /**
    * @test
    */
    public function it_get_variable_by_name()
    {
        $columns = ['name' => 'foo', 'type' => 'integer', 'min' => 1, 'max' => 5];
        Profile::createVariable($columns);
        $v = Profile::getVariableByName('foo')->toArray();
        $this->assertArraySubset($columns, $v);
    }


    /**
    * @test
    */
    public function it_add_variable_to_user()
    {
        factory('Lem\User\Models\User')->create(['id' => 32]);
        factory('Lem\Profile\Models\Variable')->create(['id' => 45]);
        Profile::addVariableToUser(32, 45);
        $this->seeInDatabase('user_variables', ['user_id' => 32, 'variable_id' => 45]);
    }


}
