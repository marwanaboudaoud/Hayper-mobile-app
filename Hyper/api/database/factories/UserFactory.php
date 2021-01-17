<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    $countries = \App\Country::all()->pluck('id')->toArray();
    $nationalities = \App\Nationality::all()->pluck('id')->toArray();

    return [
        'alias' => Str::random(4),
        'first_name' => $faker->firstName,
        'insertion' => Str::random(4),
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'has_drivers_license' => $faker->boolean(),
        'date_of_birth' => $faker->date(),
        'country_of_birth_id' => $faker->randomElement($countries),
        'nationality_id' => $faker->randomElement($nationalities),
        'marital_status_id' => 1,
        'gender_id' => 1,
        'iban' => $faker->iban(),
        'income_tax' => $faker->boolean,
        'api_token' => Str::random(20),
        'email' => $faker->unique()->email,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
        'is_active' => $faker->boolean(70),
    ];
});
