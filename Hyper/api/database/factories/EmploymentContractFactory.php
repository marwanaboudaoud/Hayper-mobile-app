<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(\App\EmploymentContract::class, function (Faker $faker) {
    $user = factory(\App\User::class)->create();
    return [
        'start_date' => new Carbon('2020-01-19'),
        'end_date' => new Carbon('2020-01-19'),
        'trial_per_day' => 20,
        'user_id' => $user->id,
        'document_number' => sha1(rand(1, 100) * 10),
    ];
});
