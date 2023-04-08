<?php

use Illuminate\Database\Seeder;
use App\GroupHasUsers;

class GroupHasUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //------------------
        GroupHasUsers::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'user_id' => UsersSeeder::$users['user1']
        ]);
        GroupHasUsers::create([
            'group_id' => GroupsSeeder::$groups['corporate'],
            'user_id' => UsersSeeder::$users['user2']
        ]);
        GroupHasUsers::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'user_id' => UsersSeeder::$users['user3']
        ]);
        GroupHasUsers::create([
            'group_id' => GroupsSeeder::$groups['administration'],
            'user_id' => UsersSeeder::$users['admin']
        ]);
        GroupHasUsers::create([
            'group_id' => GroupsSeeder::$groups['employees'],
            'user_id' => UsersSeeder::$users['teacher1']
        ]);
        GroupHasUsers::create([
            'group_id' => GroupsSeeder::$groups['employees'],
            'user_id' => UsersSeeder::$users['teacher2']
        ]);
    }
}
