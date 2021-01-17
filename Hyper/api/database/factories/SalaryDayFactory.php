<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\SalaryDay::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'has_driven' => $faker->boolean(25),
        'is_manual' => $faker->boolean(20)
    ];
});
