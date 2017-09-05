<?php

use Illuminate\Database\Seeder;

use Lembarek\Blog\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(Tag::class, 80)->create();
    }
}
