<?php

use Faker\Generator as Faker;

$factory->define(App\Day::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
