<?php

use Lem\Role\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder {
    protected $pages = [
        [1, "owner"],
        [2, "admin"],
        [3, "worker"],
    ];

    public function run()
    {

        foreach($this->pages as $page)
        {

            Role::create([
                'id' => $page[0],
                'name' => $page[1],
            ]);
        }
    }
}
