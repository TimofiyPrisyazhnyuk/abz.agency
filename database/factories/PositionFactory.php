<?php

use Faker\Generator as Faker;


$factory->define(App\Position::class, function (Faker $faker) {
    static $increment = 1;
    return [
        'position_name' => 'Worker Level ' . $increment++,
    ];
});
