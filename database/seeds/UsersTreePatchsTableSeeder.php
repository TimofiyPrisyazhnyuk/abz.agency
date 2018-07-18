<?php

use App\User;
use App\UsersTreePatch;
use Illuminate\Database\Seeder;

class UsersTreePatchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $count_users = [
            'users_1' => 10,
            'users_to_1' => $users->where('position_id', 3),
            'increment_1' => count($users->where('position_id', 3)) / count($users->where('position_id', 2)),

            'users_2' => 100,
            'users_to_2' => $users->where('position_id', 4),
            'increment_2' => count($users->where('position_id', 4)) / count($users->where('position_id', 3)),

            'users_3' => 1000,
            'users_to_3' => $users->where('position_id', 5),
            'increment_3' => count($users->where('position_id', 5)) / count($users->where('position_id', 4)),
        ];
        foreach ($users as $key => $value) {
            switch ($value->position_id) {
                case 1:
                    foreach ($users->where('position_id', 2) as $item) {
                        UsersTreePatch::create([
                            'user_parent_id' => $value->id,
                            'user_child_id' => $item->id,
                        ]);
                    }
                    break;
                case 2:
                    for ($k = 11; $k < count($count_users['users_to_1']) + 12; $k++) {
                        if ($k > $count_users['users_1'] && $k <= ($count_users['users_1'] + $count_users['increment_1'])) {
                            UsersTreePatch::create([
                                'user_parent_id' => $value->id,
                                'user_child_id' => $count_users['users_to_1'][$k]->id
                            ]);
                        }
                    }
                    $count_users['users_1'] += $count_users['increment_1'];
                    break;
                case 3:
                    for ($k = 101; $k < count($count_users['users_to_2']) + 102; $k++) {
                        if ($k > $count_users['users_2'] && $k <= ($count_users['users_2'] + $count_users['increment_2'])) {
                            UsersTreePatch::create([
                                'user_parent_id' => $value->id,
                                'user_child_id' => $count_users['users_to_2'][$k]->id
                            ]);
                        }
                    }
                    $count_users['users_2'] += $count_users['increment_2'];
                    break;
                case 4:
                    for ($k = 1001; $k < count($count_users['users_to_3']) + 1002; $k++) {
                        if ($k > $count_users['users_3'] && $k <= ($count_users['users_3'] + $count_users['increment_3'])) {
                            UsersTreePatch::create([
                                'user_parent_id' => $value->id,
                                'user_child_id' => $count_users['users_to_3'][$k]->id
                            ]);
                        }
                    }
                    $count_users['users_3'] += $count_users['increment_3'];
                    break;
            }
        }
    }
}
