<?php

use App\ClassLevel;
use Illuminate\Database\Seeder;

class ClassLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $classlevels =array();
    public function run()
    {
       self::$classlevels['beginner']=ClassLevel::create([
           'code' =>  'beginner',
           'ru' => ['name' => 'Начальный уровень'],
           'en' => ['name' => 'Beginner']
       ])->id;
        self::$classlevels['middle']=ClassLevel::create([
            'code' =>  'middle',
            'ru' => ['name' => 'Средний уровень'],
            'en' => ['name' => 'Middle']
        ])->id;
        self::$classlevels['advance']=ClassLevel::create([
            'code' =>  'advance',
            'ru' => ['name' => 'Продвинутый уровень'],
            'en' => ['name' => 'Advance']
        ])->id;
    }
}
