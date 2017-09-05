<?php

use Illuminate\Database\Eloquent\Factory as EloquentFactory;

$factory = app(EloquentFactory::class);

$factory->define(Lembarek\Role\Models\Role::class, function ($faker) {
    return [
    'name' => $faker->unique()->word(),
    ];
});


$factory->define(Lembarek\Role\Models\Permission::class, function ($faker) {
    return [
    'name' => $faker->unique()->word(),
    'display_name' => $faker->unique()->word(),
    ];
});

