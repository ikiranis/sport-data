<?php

use Faker\Generator as Faker;

$factory->define(App\Matchday::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'matchday' => $faker->randomDigit,
        'season_id' => ''
    ];
});
