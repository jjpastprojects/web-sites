<?php

use Lembarek\Role\Models\Role;
use Lembarek\Role\Models\Permission;
use Lembarek\Role\Traits\Permissionable;
use PHPUnit_Framework_TestCase as ph;


class PermissionableCest
{
    public function _before(FunctionalTester $I)
    {
    }


    public function _after(FunctionalTester $I)
    {
    }


    public function it_assign_a_permissions(FunctionalTester $I)
    {
            $permission = factory(Permission::class)->create(['id' => 1]);
            $permission2 = factory(Permission::class)->create(['id' => 2]);

            $role = Role::find(1);

            $role->assignPermission($permission);
            $role->assignPermission($permission2);

            ph::assertEquals(2, count($role->permissions()->get()));

            //$I->seeInDatabase('permission_role', ['role_id' => 1, 'permission_id' => 2]);

    }


     public function it_has_a_permission(FunctionalTester $I)
     {
            $permission = factory(Permission::class)->create(['id' => 1, 'name' => 'edit blog']);
            $role = Role::find(1);

            $role->assignPermission($permission);

            ph::assertTrue($role->hasPermission('edit blog'));
     }
}
