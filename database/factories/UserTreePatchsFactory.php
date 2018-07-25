<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(\App\UsersTreePatch::class, function (Faker $faker) {
    $users = User::all();

//    $position_1 = $users->where('position_id', 1)->first();
//    $position_2 = $users->where('position_id', 2);
//    $position_3 = $users->where('position_id', 3);
//    $position_4 = $users->where('position_id', 4);
//    $position_5 = $users->where('position_id', 5);
    foreach ($users as $key => $value) {
        if ($value->position_id == 1) {

            foreach ($users->where('position_id', 2) as $item) {
                return [
                    'user_parent_id' => $value->id,
                    'user_child_id' => $item->id,
                ];
            }
        }
        if ($value->position_id == 2) {
            $user_3 = 0;
            $increment = count($users->where('position_id', 3)) / count($users->where('position_id', 3));
            $plusIncrement = 0;
            dd($value);
            for ($user_3 < count($users->where('position_id', 3)); $user_3++;) {
                if ($user_3 < $plusIncrement) {
                    return [
                        'user_parent_id' => $value->id,
                        'user_child_id' => $user_3->id,
                    ];
                }
            }
            $plusIncrement += $increment;


        }
    }
});
