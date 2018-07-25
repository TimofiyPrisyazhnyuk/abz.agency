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
    static $increment = [
        'increment' => 1,
        'position' => 1,
        'amount' => 200000,
    ];
    $increment['increment']++;

    if ($increment['increment'] > 2 && $increment['increment'] <= 12) {
        $increment['position'] = 2;
        $increment['amount'] = 100000;
    } elseif ($increment['increment'] > 12 && $increment['increment'] <= 102) {
        $increment['position'] = 3;
        $increment['amount'] = 60000;
    } elseif ($increment['increment'] > 102 && $increment['increment'] <= 1002) {
        $increment['position'] = 4;
        $increment['amount'] = 30000;
    } elseif ($increment['increment'] > 1002 && $increment['increment'] <= 50002) {
        $increment['position'] = 5;
        $increment['amount'] = 15000;
    };
    return [
        'surname' => $faker->firstName,
        'first_name' => $faker->lastName,
        'patronymic' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(123456), // secret
        'amount_of_wages' => $increment['amount'] + $increment['increment'],
        'date_engagement' => date('Y-m-d'),
        'position_id' => $increment['position'],
        'remember_token' => str_random(16),
    ];

});
