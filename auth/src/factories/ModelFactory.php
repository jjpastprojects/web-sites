<?php

use Illuminate\Database\Eloquent\Factory as EloquentFactory;

$factory = app(EloquentFactory::class);

$factory->define(Lembarek\Auth\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'password' => \Hash::make('password'),
        'remember_token' => str_random(10),
    ];
});
