<?php

$factory('App\User', [
    'name' => $faker->unique()->name,
    'email' => $faker->email,
    'password' => 'secret'
    ]);

$factory('Lem\Profile\Models\Variable',[
    'name' => $faker->unique()->word,
    'type' => $faker->randomElement(['date', 'integer', 'string', 'enum', 'boolean']),
    'min' => $faker->numberBetween(1,5),
    'max' => $faker->numberBetween(5,10)
    ]);

$factory('Lem\Profile\Models\Enum',[
    'variable_id' => $faker->unique()->numberBetween(1,50),
    'values' => $faker->word
        ]);

$factory('Lem\Profile\Models\UserVariable', [
    'user_id' => $faker->numberBetween(1,30),
    'variable_id' => $faker->numberBetween(1,50)
    ]);


$factory('Lem\Profile\Models\UserValue', [
    'user_id' => $faker->numberBetween(1,30),
    'variable_id' => $faker->numberBetween(1,50),
    'values' => $faker->word
    ]);

$factory('Lem\Profile\Models\Action', [
    'variable_id' => $faker->numberBetween(1,50),
    'condition_before' => $faker->text,
    'condition_after' => $faker->text,
    'action_before' => $faker->text,
    'action_after' => $faker->text,
]);
