<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\SalaryRow::class, function (Faker $faker) {
    return [
        'description' => $faker->text(70),
        'underline_description' => ($faker->boolean()) ? $faker->text(25) : null,
        'amount' => random_int(1, 15),
        'is_bonus' => $faker->boolean(35),
        'price' => $faker->randomFloat(2, -25, 100),
    ];
});
