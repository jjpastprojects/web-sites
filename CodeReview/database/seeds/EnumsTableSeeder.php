<?php

use Lem\Profile\Models\Enum;
use Lem\Profile\Models\Variable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EnumsTableSeeder extends Seeder {
    protected $enums = [
        [1, 1, 'male, female'],
        [2, 2, 'algerian, french, USA'],
    ];

    public function run()
    {

                foreach($this->enums as $enum)
        {
            Enum::create([
                'id' => $enum[0],
                'variable_id' => $enum[1],
                'values' => $enum[2],
            ]);
        }
    }
}
