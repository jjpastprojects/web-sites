<?php

use Illuminate\Database\Seeder;
use Lembarek\Role\Models\Role;
use Lembarek\Core\Role\Role as R;
use Lembarek\Role\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $roles = R::$roles;
        foreach($roles as $role ){
            $r  = Role::create($role);
        }
    }
}
