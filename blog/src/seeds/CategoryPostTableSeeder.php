<?php

use Illuminate\Database\Seeder;

use Lembarek\Blog\Models\Post;
use Lembarek\Blog\Models\Category;

class CategoryPostTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $posts = Post::all();
        $categories = Category::all();
        foreach($categories as $category){
            $subPosts = $posts->take(3);
            foreach($subPosts as $post){
                $post->addToCategory($category);
            }
        }
    }
}

