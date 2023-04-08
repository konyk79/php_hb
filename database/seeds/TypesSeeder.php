<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $types = array();
    public function run()
    {
        //regular, corporate, individual
        self::$types['regular']=Type::create([
            'code' =>  'regular',
            'ru' => ['name' => 'Регулярные'],
            'en' => ['name' => 'Regular']
        ])->id;
        self::$types['corporate']=Type::create([
            'code' =>  'corporate',
            'ru' => ['name' => 'Коорпоративные'],
            'en' => ['name' => 'Corporate']
        ])->id;
        self::$types['private']=Type::create([
            'code' =>  'private',
            'ru' => ['name' => 'Приватные'],
            'en' => ['name' => 'Privet']
        ])->id;
    }
}
