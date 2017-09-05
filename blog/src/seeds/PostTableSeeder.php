<?php

use Illuminate\Database\Seeder;
use Lembarek\Blog\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(Post::class, 40)->create();
    }
}
