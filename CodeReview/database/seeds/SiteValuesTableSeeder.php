<?php

use Lem\Site\Models\SiteValue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SiteValuesTableSeeder extends Seeder {

    protected $siteValues  = [
        [1, 3, '100' ],
    ];
    public function run()
    {

        foreach($this->siteValues as $siteValue)
        {
            SiteValue::create([
                'id' => $siteValue [0],
                'variable_id' => $siteValue[1],
                'value' => $siteValue[2],
            ]);
        }
    }

}
