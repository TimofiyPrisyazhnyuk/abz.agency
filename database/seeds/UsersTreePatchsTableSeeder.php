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
//        factory(App\UsersTreePatch::class, 100)->create();
        $users = User::all();
        foreach ($users as $key => $value) {
            if ($value->position_id == 1) {
                foreach ($users->where('position_id', 2) as $item) {
                    UsersTreePatch::create([
                        'user_parent_id' => $value->id,
                        'user_child_id' => $item->id,
                    ]);
                }
            }
            $k = 11;
            $user_3 = 11;
            $users_to_3 = $users->where('position_id', 3);
            $increment = floor(count($users->where('position_id', 3)) / count($users->where('position_id', 3)));
            if ($value->position_id == 2) {
                for ($k < floor(count($users_to_3)); $k++;) {
                    if ($k < $user_3 + $increment) {
                        UsersTreePatch::create([
                            'user_parent_id' => $value->id,
                            'user_child_id' => $users_to_3[$k]->id
                        ]);
                    }
                }
                $user_3 += $increment;
            }
        }
    }
}
