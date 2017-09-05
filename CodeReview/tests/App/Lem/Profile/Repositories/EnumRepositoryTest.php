<?php

use Lem\Profile\Repositories\EnumRepository;
use Laracasts\TestDummy\Factory as TestDummy;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnumRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $enumRepo;

    public function setUp()
    {
        parent::setUp();
        $this->enumRepo = new EnumRepository();
    }


    /**
    * @test
    */
    public function it_get_values_by_variable_id()
    {

        $variable = factory('Lem\Profile\Models\Variable')->create();
        $enum = factory('Lem\Profile\Models\Enum')->create(['variable_id' => $variable->id, 'values' => 'arabe,french,english']);

        $values = $this->enumRepo->getValuesByVariableId($enum['variable_id']);

        $this->assertEquals($values, explode(',', $enum['values']));

    }

}
