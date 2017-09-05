<?php

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Lembarek\Core\Countries\Countries;

$factory = app(EloquentFactory::class);

$universities = ['biskra', 'aglger', 'esi',  'uxford', 'harfard'];
$faculties = ['math', 'biologie', 'phisiq'];
$filetypes= ['pdf', 'rar', 'zip'];
$semesters = [1, 2, 3];
$countries =  Countries::$CountriesLongNames;

$factory->define(Lembarek\ShareFiles\Models\File::class, function (Faker\Generator $faker) use($universities, $faculties, $filetypes, $countries, $semesters) {
    return [
    'name' => $faker->name,
    'slug' => str_slug($faker->name),
    'description' => $faker->text,
    'links' => 'http://www.files./com/'.$faker->name,
    'universities' => $faker->randomElement($universities),
    'faculty' => $faker->randomElement($faculties),
    'filetype' => $faker->randomElement($filetypes),
    'country' => $faker->randomElement($countries),
    'year' => $faker->numberBetween(1999, 2020),
    'semester' => $faker->randomElement($semesters),
    ];
});


