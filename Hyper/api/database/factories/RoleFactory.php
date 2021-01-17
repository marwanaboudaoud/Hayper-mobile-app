<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Role::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'code_in_nmbrs' => $faker->randomDigit,
    ];
});
