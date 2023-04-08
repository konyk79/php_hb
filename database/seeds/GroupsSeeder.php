<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $groups=array();
    public function run()
    {
        self::$groups['private']=Group::create([
            'code' => 'private',
            'ru' => ['name' => 'Частные пользователи'],
            'en' => ['name' => 'Private clients']
        ])->id;
        self::$groups['corporate']=Group::create([
            'code' => 'corporate',
            'ru' => ['name' => 'Корпоротивные пользователи'],
            'en' => ['name' => 'Corporate clients']
        ])->id;
        self::$groups['administration']=Group::create([
            'code' => 'administration',
            'ru' => ['name' => 'Администрация'],
            'en' => ['name' => 'Administration']
        ])->id;
        self::$groups['employees']=Group::create([
            'code' => 'employees',
            'ru' => ['name' => 'Работники'],
            'en' => ['name' => 'Employees']
        ])->id;

    }


}
