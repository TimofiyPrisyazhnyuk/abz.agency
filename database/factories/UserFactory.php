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
    return [
        'surname' => $faker->name,
        'first_name' => $faker->name,
        'patronymic' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(123456), // secret
        'amount_of_wages' => 100000 - ($increment * 2),
        'position_id' => random_int(1, 4),
        'remember_token' => str_random(10),
    ];
});
