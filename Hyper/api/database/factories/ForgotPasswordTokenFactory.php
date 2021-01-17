<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ForgotPasswordToken::class, function (Faker $faker) {
    return [
        'token' => $faker->uuid,
        'user_id' => factory(\App\User::class),
        'is_used' => false
    ];
});
