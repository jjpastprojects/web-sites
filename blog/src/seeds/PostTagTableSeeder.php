<?php

use Illuminate\Database\Seeder;

use Lembarek\Blog\Models\Post;
use Lembarek\Blog\Models\Tag;
use Faker\Factory as Faker;

class PostTagTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = Faker::create();
        $posts = Post::all();
        $tags = Tag::all()->toArray();
        foreach($posts as $post){
            $ts = $faker->randomElements($tags, $faker->numberBetween(0, 8));
            foreach($ts as $tag){
                $post->assignTag($tag['id']);
            }
        }
    }
}
