<?php

use App\ClassStatus;
use Illuminate\Database\Seeder;

class ClassStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static $lassStatuses =array();
    public function run()
    {
        self::$lassStatuses['pending']=ClassStatus::create([
            'code' =>  'pending',
            'ru' => ['name' => 'В ожидании'],
            'en' => ['name' => 'Pending']
        ])->id;
        self::$lassStatuses['passing']=ClassStatus::create([
            'code' =>  'passing',
            'ru' => ['name' => 'Проходит'],
            'en' => ['name' => 'Passing']
        ])->id;
        self::$lassStatuses['completed']=ClassStatus::create([
            'code' =>  'completed',
            'ru' => ['name' => 'Состоялся'],
            'en' => ['name' => 'Completed']
        ])->id;
        self::$lassStatuses['not attend']=ClassStatus::create([
            'code' =>  'not_attend',
            'ru' => ['name' => 'Не состоялся'],
            'en' => ['name' => 'Did not attend']
        ])->id;
        self::$lassStatuses['booked']=ClassStatus::create([
            'code' =>  'booked',
            'ru' => ['name' => 'Заказан'],
            'en' => ['name' => 'booked']
        ])->id;
        self::$lassStatuses['approved']=ClassStatus::create([
            'code' =>  'approved',
            'ru' => ['name' => 'Подтвержден'],
            'en' => ['name' => 'Approved']
        ])->id;
        self::$lassStatuses['canceled']=ClassStatus::create([
            'code' =>  'canceled',
            'ru' => ['name' => 'Отменен'],
            'en' => ['name' => 'Canceled']
        ])->id;
        self::$lassStatuses['notbooked']=ClassStatus::create([
            'code' =>  'not_booked',
            'ru' => ['name' => 'Не заказан'],
            'en' => ['name' => 'Not booked']
        ])->id;
    }
}
