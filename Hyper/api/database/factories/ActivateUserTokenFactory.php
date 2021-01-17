<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ActivateUserToken::class, function (Faker $faker) {
    return [
        'token' => $faker->uuid,
        'is_used' => $faker->boolean(0),
        'user_id' => factory(\App\User::class)
    ];
});
