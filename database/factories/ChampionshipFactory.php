<?php

use Faker\Generator as Faker;

$factory->define(App\Championship::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord
    ];
});
