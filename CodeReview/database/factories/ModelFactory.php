<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Lem\User\Models\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Lem\Profile\Models\Variable::class, function ($faker) {
    return [
    'id' => $faker->unique()->numberBetween(1, 100),
    'name' => $faker->name,
    'type' => $faker->randomElement(['date', 'integer', 'string', 'enum', 'boolean']),
    'min' =>  $faker->numberBetween(1,5),
    'max' => $faker->numberBetween(5,10),
    ];
});


$factory->define(Lem\Profile\Models\Enum::class, function ($faker) {
    return [
    'variable_id' => $faker->numberBetween(1,300),
    'values' => $faker->name,
    ];
});


$factory->define(Lem\Profile\Models\UserVariable::class, function ($faker) {
    return [
    'id' => $faker->unique()->numberBetween(1, 100),
    'user_id' => $faker->numberBetween(1,100),
    'variable_id' => $faker->numberBetween(1,100),
    ];
});


$factory->define(Lem\Profile\Models\UserValue::class, function ($faker) {
    return [
    'id' => $faker->unique()->numberBetween(1, 100),
    'user_id' => $faker->numberBetween(1,100),
    'variable_id' => $faker->numberBetween(1,100),
    'values' => $faker->name,
    ];
});


$factory->define(Lem\Site\Models\SiteValue::class, function ($faker) {
    return [
    'id' => $faker->unique()->numberBetween(1, 100),
    'variable_id' => $faker->numberBetween(1,100),
    'value' => $faker->name,
    ];
});


$factory->define(Lem\Task\Models\Task::class, function ($faker) {
    return [
    'id' => $faker->numberBetween(1, 100),
    'whenCondition' => $faker->randomElement(['register', 'login', 'logout']),
    'code' => $faker->text(),
    ];
});


$factory->define(Lem\Page\Models\Page::class, function ($faker) {
    return [
    'id' => $faker->numberBetween(1, 100),
    'title' => $faker->text(),
    'body' => $faker->text(),
    'code' => $faker->text(),
    ];
});


