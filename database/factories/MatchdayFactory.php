<?php

use Faker\Generator as Faker;

$factory->define(App\Matchday::class, function (Faker $faker) {
    return [
        'matchday' => $faker->randomDigit
    ];
});
