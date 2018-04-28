<?php

use Faker\Generator as Faker;

$factory->define(App\Championship::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'name' => $faker->domainWord,
        'sport_id' => '',
        'rule_id' => ''
    ];
});
