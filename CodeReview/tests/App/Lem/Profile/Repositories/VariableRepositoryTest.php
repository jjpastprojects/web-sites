<?php

use Lem\Profile\Repositories\VariableRepository;
use Laracasts\TestDummy\Factory as TestDummy;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VariableRepositoryTest extends TestCase
{

    use DatabaseTransactions;

    protected $variableRepo;

    public function setUp()
    {
        parent::setUp();
        $this->variableRepo = new VariableRepository;
    }


    /**
    * @test
    */

    public function it_check_if_var_exists()
    {
        $this->assertTrue($this->variableRepo->variableExistsByName('sex'));
        $this->assertFalse($this->variableRepo->variableExistsByName('foo'));
    }


    /**
    * @test
    */

    public function it_get_variable_type_By_Name()
    {
        $type = $this->variableRepo->where('name' ,'=', 'sex')->first()->type;
        $this->assertEquals($type, 'enum');
    }


    /**
    * @test
    */

    public function it_get_id_by_name()
    {
        $id = $this->variableRepo->getVariableByName('sex')->id;
        $this->assertEquals($id, 1);
    }


    /**
    * @test
    */

    public function it_check_if_is_valide_value()
    {

        $this->assertTrue($this->variableRepo->isValideValue('sex', 'male'));
        $this->assertFalse($this->variableRepo->isValideValue('lang', 'foo'));
        $this->assertFalse($this->variableRepo->isValideValue('foo', 'arabe'));

    }


}
