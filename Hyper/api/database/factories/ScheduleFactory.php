<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Project;
use Faker\Generator as Faker;

$factory->define(\App\Schedule::class, function (Faker $faker) {
    $dt = $faker->dateTimeBetween('now', $endDate = '1 month');
    $date = $dt->format("Y-m-d"); // 1994-09-24

    return [
        'name' => $faker->word(),
        'address' => $faker->address,
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'date' => $date,
    ];
});
