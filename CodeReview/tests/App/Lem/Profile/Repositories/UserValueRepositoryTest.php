<?php

use Lem\Profile\Repositories\UserValueRepository;
use Laracasts\TestDummy\Factory as TestDummy;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserValueRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    protected $userValueRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userValueRepo = new UserValueRepository();
    }


    /**
    * @test
    */
    public function it_check_if_user_has_value()
    {
        $user = factory('Lem\User\Models\User')->create();
        $variable = factory('Lem\Profile\Models\Variable')->create();
        $userValue = factory('Lem\Profile\Models\UserValue')->create(['user_id' => $user->id, 'variable_id' => $variable->id]);
        $this->assertFalse($this->userValueRepo->exists($userValue['value_id'], $userValue['user_id'], $userValue['values']));
        $this->assertFalse($this->userValueRepo->exists(1, 4, 'foo'));
    }

}
