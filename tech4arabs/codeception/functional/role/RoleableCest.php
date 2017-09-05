<?php

use Lembarek\Auth\Models\User;
use Lembarek\Role\Models\Role;
use Lembarek\Role\Traits\Roleable;
use PHPUnit_Framework_TestCase as ph;


class RoleableCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function it_assign_a_roles(FunctionalTester $I)
    {
            $role = factory(Role::class)->create();
            $role2 = factory(Role::class)->create();

            $user = factory(User::class)->create();

            $user->assignRole($role);
            $user->assignRole($role2);

            ph::assertEquals(2, count($user->roles()->get()));

            $I->seeRecord('role_user', ['user_id' => $user->id, 'role_id' => $role->id]);
            $I->seeRecord('role_user', ['user_id' => $user->id, 'role_id' => $role2->id]);

    }

     public function it_has_a_role(FunctionalTester $I)
     {
            $role = factory(Role::class)->create(['name' => 'manager']);
            $user = factory(User::class)->create();

            $user->assignRole($role);

            ph::assertTrue($user->hasRole('manager'));
     }
}
