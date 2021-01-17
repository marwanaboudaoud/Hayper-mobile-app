<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Partner::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'house_number' => rand(1, 999),
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
    ];
});
