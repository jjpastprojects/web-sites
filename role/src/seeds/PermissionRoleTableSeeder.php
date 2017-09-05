<?php

use Illuminate\Database\Seeder;
use Lembarek\Core\Role\Role as R;
use Lembarek\Role\Models\Permission;
use Lembarek\Role\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $rolesWithPermissions = R::rolesWithPermissions();

        foreach($rolesWithPermissions as $roleName => $permissions){
            $role = Role::whereName($roleName)->first();
            foreach($permissions as $permissionName){
                $permission = Permission::whereName($permissionName)->first();
                $role->assignPermission($permission);
            }
        }
    }
}
