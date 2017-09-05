<?php

use Lem\Profile\Models\UserValue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserValuesTableSeeder extends Seeder {

    protected $userValues  = [
        [1, 1, 1, 'male' ],
    ];
    public function run()
    {

        foreach($this->userValues as $userValue)
        {
            UserValue::create([
                'id' => $userValue [0],
                'user_id' => $userValue[1],
                'variable_id' => $userValue[2],
                'values' => $userValue[3],
            ]);
        }
    }

}
