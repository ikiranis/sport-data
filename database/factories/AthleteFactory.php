<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(App\Athlete::class, function (Faker $faker) {

    $fname = $faker->firstName;
    $lname = $faker->lastName;
    $slug = $fname . '-' . $lname;

    return [
        'id' => Str::uuid(),
        'slug' => $slug,
        'fname' => $fname,
        'lname' => $lname,
        'sport_id' => 0,
        'photo_id' => 0,
        'birthyear' => $faker->dateTimeBetween('-50 years', '-10 years')->format('Y'),
        'city' => $faker->city,
        'country' => $faker->country,
        'height' => random_int(120,220)
    ];
});

