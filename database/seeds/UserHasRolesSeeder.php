<?php

use App\UserHasRole;
use Illuminate\Database\Seeder;

class UserHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           UserHasRole::create([
            'user_id' => UsersSeeder::$users['admin'],
            'role_id' => RolesSeeder::$roles['admin'],
        ]);
        UserHasRole::create([
            'user_id' => UsersSeeder::$users['user1'],
            'role_id' => RolesSeeder::$roles['user'],
        ]);
        UserHasRole::create([
            'user_id' => UsersSeeder::$users['user2'],
            'role_id' => RolesSeeder::$roles['user'],
        ]);
        UserHasRole::create([
            'user_id' => UsersSeeder::$users['teacher1'],
            'role_id' => RolesSeeder::$roles['teacher'],
        ]);
        UserHasRole::create([
            'user_id' => UsersSeeder::$users['teacher2'],
            'role_id' => RolesSeeder::$roles['teacher'],
        ]);
        UserHasRole::create([
            'user_id' => UsersSeeder::$users['teacher2'],
            'role_id' => RolesSeeder::$roles['admin'],
        ]);
        UserHasRole::create([
            'user_id' => UsersSeeder::$users['user3'],
            'role_id' => RolesSeeder::$roles['user'],
        ]);
    }
}
