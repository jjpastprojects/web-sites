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

$factory->define(Lembarek\Auth\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => \Hash::make('password'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Lembarek\Role\Models\Role::class, function ($faker) {
    return [
    'name' => $faker->word(),
    ];
});


$factory->define(Lembarek\Role\Models\Permission::class, function ($faker) {
    return [
    'name' => $faker->word(),
    ];
});


$universities = ['biskra', 'aglger', 'esi',  'uxford', 'harfard'];
$faculties = ['math', 'biologie', 'phisiq'];
$filetypes= ['pdf', 'rar', 'zip'];
$semesters = [1, 2, 3];
$countries = [
    "afghanistan",
    "albania",
    "algeria",
    "american samoa",
    "andorra",
    "angola",
    "anguilla",
    "antarctica",
    "antigua and barbuda",
    "argentina",
    "armenia",
    "aruba",
    "australia",
    "austria",
    "azerbaijan",
    "bahamas",
    "bahrain",
    "bangladesh",
    "barbados",
    "belarus",
    "belgium",
    "belize",
    "benin",
    "bermuda",
    "bhutan",
    "bolivia",
    "bosnia and herzegowina",
    "botswana",
    "bouvet island",
    "brazil",
    "british indian ocean territory",
    "brunei darussalam",
    "bulgaria",
    "burkina faso",
    "burundi",
    "cambodia",
    "cameroon",
    "canada",
    "cabo verde",
    "cayman islands",
    "central african republic",
    "chad",
    "chile",
    "china",
    "christmas island",
    "cocos islands",
    "colombia",
    "comoros",
    "congo",
    "congo, the democratic republic of the",
    "cook islands",
    "costa rica",
    "cote d'ivoire",
    "croatia",
    "cuba",
    "cyprus",
];



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
    'semester' => $faker->randomElement($semesters),
    ];
});


$factory->define(Lembarek\Profile\Models\Profile::class, function ($faker) {
    return [
    'user_id' =>  factory('Lembarek\Auth\Models\User')->create()->id,
    'country' => 'united states',
    'sex'     => 'male',
    'birth_date'    => '0000-00-00',
    ];
});


$factory->define(Lembarek\Blog\Models\Blog::class, function ($faker) {
    $title = $faker->text(30);
    return [
    'title' => $title,
    'body' => $faker->text,
    'slug' => str_slug($title),
    'author' => $faker->name,
    ];
});



