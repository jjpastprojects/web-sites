<?php

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Lembarek\Blog\Models\Category;

$factory = app(EloquentFactory::class);


$factory->define(Lembarek\Blog\Models\Post::class, function ($faker) {
    $category = count(Category::all())? Category::all()->random() :createCategory();
    return [
    'title' => $faker->sentence(mt_rand(3, 10)),
    'description' => $faker->sentence(1),
    'body' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
    'author' => $faker->name,
    'active' => true,
    'views'  => 0,
    'facebook_shares' => 0,
    'twitter_shares' => 0,
    'google_plus_shares' => 0,
    'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
    'category_id' => $category->id,
    ];
});

$factory->define(Lembarek\Blog\Models\Tag::class, function ($faker) {
    return [
    'name' => $faker->unique()->word(),
    'title' => $faker->unique()->sentence(),
    'subtitle' => $faker->unique()->sentence(),
    'page_image' => $faker->sentence(),
    'direction' => 1,
    'meta_description' => $faker->sentence(),
    ];
});

$factory->define(Lembarek\Blog\Models\Category::class, function ($faker) {
    return [
    'name' => $faker->unique()->word(),
    'description' => $faker->text(),
    'model' => $faker->word(),
    'parent' => 0,
    ];
});

