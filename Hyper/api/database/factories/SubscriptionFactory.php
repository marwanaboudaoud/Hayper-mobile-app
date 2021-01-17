<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'gross_amount' => $faker->randomFloat(2, 0, 5000),
        'duration_in_months' => random_int(1, 5),
        'starting_date' => '2019-01-01',
        'reward' => $faker->randomFloat(2, 0, 5000),
        'is_bonus_calc' => $faker->boolean(),
        'bw_code' => $faker->postcode,
    ];
});
