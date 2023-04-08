<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $roles=array();

    public function run()
    {

        self::$roles['admin'] = Role::create([
            'code' => 'admin',
            'ru' => ['name' => 'Администратор'],
            'en' => ['name' => 'Administrator']
        ])->id;
        self::$roles['user']=Role::create([
            'code' => 'user',
            'ru' => ['name' => 'Пользователь'],
            'en' => ['name' => 'User']
        ])->id;
         self::$roles['subscriber']=Role::create([
            'code' => 'subscriber',
            'ru' => ['name' => 'Клиент'],
            'en' => ['name' => 'Client']
        ])->id;
         self::$roles['teacher']=Role::create([
            'code' => 'teacher',
            'ru' => ['name' => 'Учитель'],
            'en' => ['name' => 'Teacher']
        ])->id;

        // $leaderRole->save();

    }
}
