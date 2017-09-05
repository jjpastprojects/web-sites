<?php

use Illuminate\Database\Seeder;
use Lembarek\Auth\Models\User;

class RoleUserTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $roles_users = [
             [2, 1],
        ];

        foreach ($roles_users as $role_user) {
            User::find($role_user[0])->assignRole($role_user[1]);
        }
    }
}
