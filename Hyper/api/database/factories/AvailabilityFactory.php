<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Availability::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'is_present' => $faker->boolean
    ];
});
