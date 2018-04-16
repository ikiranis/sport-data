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


$factory->define(App\Team::class, function (Faker $faker) {

        return [
            'id' => Str::uuid(),
            'slug' => '',
            'name' => $faker->company,
            'city' => $faker->city,
            'sport_id' => '',
            'division_id' => random_int(1, 4)
        ];

});

