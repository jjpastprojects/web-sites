<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
       factory(Lembarek\ShareFiles\Models\File::class , 100)->create();
    }
}
