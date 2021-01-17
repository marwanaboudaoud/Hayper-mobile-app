<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Address::class, function (Faker $faker) {
    return [
        'street' => $faker->text,
        'house_number' => 10,
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'is_active' => 1
    ];
});
