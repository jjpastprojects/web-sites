<?php

use Lem\Profile\Models\Variable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class VariablesTableSeeder extends Seeder {

    protected $variables = [
        ['1', 'sex', 'enum', '1', '1'],
        ['2', 'country', 'enum', '1', '1'],
        ['3', 'users_number', 'number', '1', '1000'],
    ];

    public function run()
    {
        foreach($this->variables as $variable)
        {
            Variable::create([
                'id' => $variable[0],
                'name' => $variable[1],
                'type' => $variable[2],
                'min' => $variable[3],
                'max' => $variable[4],
            ]);
        }
    }
}
