<?php

use Faker\Generator as Faker;

$factory->define(App\Season::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'name' => $faker->year,
        'championship_id' => ' '
    ];
});
