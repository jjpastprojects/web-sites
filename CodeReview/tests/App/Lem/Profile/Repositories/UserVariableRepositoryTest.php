<?php

use Lem\Profile\Repositories\UserVariableRepository;
use Laracasts\TestDummy\Factory as TestDummy;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserVariableRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $userVariableRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userVariableRepo = new UserVariableRepository();
    }


    /**
    * @test
    */
    public function it_user_has_variable()
    {
        $user = factory('Lem\User\Models\User')->create();
        $variable = factory('Lem\Profile\Models\Variable')->create();
        $userVariable = factory('Lem\Profile\Models\UserVariable')->create(['user_id' => $user->id, 'variable_id' => $variable->id]);
        $this->assertTrue($this->userVariableRepo->exists($userVariable['variable_id'], $userVariable['user_id'] ));
    }

}
