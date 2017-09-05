<?php

use Illuminate\Database\Seeder;
use Lembarek\Auth\Models\User;
use Lembarek\Role\Models\Role;

class RoleUserTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        User::whereUsername('admin')->first()->assignRole(Role::whereName('admin')->first());
        User::whereUsername('user')->first()->assignRole(Role::whereName('user')->first());
    }
}
