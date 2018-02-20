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
    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'birthday' => $faker->dateTimeBetween('-50 years', '-10 years'),
        'city' => $faker->city,
        'country' => $faker->country,
        'height' => random_int(120,220)
    ];
});

