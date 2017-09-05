<?php

use Lem\Role\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleUserTableSeeder extends Seeder {
    protected $roles = [
        [1, 1, 1],
        [2, 2, 1],
        [3, 3, 1],
        [2, 3, 2],
    ];

    public function run()
    {

        foreach($this->roles as $role)
        {
            User::find($role[2])->roles()->attach($role[1]);
        }
    }
}
