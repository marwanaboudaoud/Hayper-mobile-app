<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Salary::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'heading' => $faker->text(10),
        'description' => $faker->text(15),
        'user_id' => \App\User::all()->random()->first()->id,
        'is_closed' => $faker->boolean(30)
    ];
});
