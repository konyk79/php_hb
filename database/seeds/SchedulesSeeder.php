<?php

use App\Schedule;
use Illuminate\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $scedules = array();
    public function run()
    {
        self::$scedules['Europe']=Schedule::create([
            'code' =>  'europe',
            'ru' => [
                'name' => 'Европа'
            ],
            'en' => [
                'name' => 'Europe'
            ]
        ])->id;
        self::$scedules['Asia']=Schedule::create([
            'code' =>  'europe',
            'ru' => [
                'name' => 'Азия'
            ],
            'en' => [
                'name' => 'Asia'
            ]
        ])->id;
        self::$scedules['USA']=Schedule::create([
            'code' =>  'usa',
            'ru' => [
                'name' => 'США'
            ],
            'en' => [
                'name' => 'USA'
            ]
        ])->id;
        //
    }
}
