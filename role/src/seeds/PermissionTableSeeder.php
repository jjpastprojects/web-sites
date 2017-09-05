<?php

use Illuminate\Database\Seeder;
use Lembarek\Role\Models\Permission;
use Lembarek\Core\Role\Role as R;

class PermissionTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $permissions = R::allPermissions();
        foreach ($permissions as $name => $display_name) {
            Permission::create(compact('name', 'display_name'));
        }

    }
}
