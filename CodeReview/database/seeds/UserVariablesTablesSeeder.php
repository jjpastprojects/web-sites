<?php

use Lem\Profile\Models\UserVariable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserVariablesTableSeeder extends Seeder {

    protected $userVariables  = [
        [1, 1, 1],
        [2, 1, 2],
    ];

    public function run()
    {

        foreach($this->userVariables as $userVariable)
        {
            UserVariable::create([
                'id' => $userVariable[0],
                'user_id' => $userVariable[1],
                'variable_id' => $userVariable[2],
            ]);
        }
    }

}
