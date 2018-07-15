<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    static $increment = 1;
    static $position;
    static $amount;

    $increment++;

    if ($increment == 2) {
        $position = 1;
        $amount = 200000;
    } elseif ($increment > 2 && $increment <= 12) {
        $position = 2;
        $amount = 100000;
    } elseif ($increment > 12 && $increment <= 100) {
        $position = 3;
        $amount = 60000;
    } elseif ($increment > 100 && $increment <= 10000) {
        $amount = 30000;
    } elseif ($increment > 10000 && $increment <= 50000) {
        $position = 5;
        $amount = 15000;
    };
    return [
        'surname' => $faker->firstName,
        'first_name' => $faker->lastName,
        'patronymic' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(123456), // secret
        'amount_of_wages' => $amount,
        'position_id' => $position,
        'remember_token' => str_random(16),
    ];

});
