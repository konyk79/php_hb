<?php

use App\UserSubStatus;
use Illuminate\Database\Seeder;

class UserSubStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static $statuses = array();
    public function run()
    {
        self::$statuses['waiting_for_payment']=UserSubStatus::create([
            'code' =>  'waiting_for_payment',
            'ru' => ['name' => 'В ожидании оплаты'],
            'en' => ['name' => 'Waiting for payment']
        ])->id;
        self::$statuses['active']=UserSubStatus::create([
            'code' =>  'active',
            'ru' => ['name' => 'Активная'],
            'en' => ['name' => 'Active']
        ])->id;
        self::$statuses['trial_term']=UserSubStatus::create([
            'code' =>  'trial_term',
            'ru' => ['name' => 'Тестовый период'],
            'en' => ['name' => 'Trial_term']
        ])->id;
        self::$statuses['terminating']=UserSubStatus::create([
            'code' =>  'terminating',
            'ru' => ['name' => 'Завершается'],
            'en' => ['name' => 'Terminating']
        ])->id;
        self::$statuses['terminated']=UserSubStatus::create([
            'code' =>  'terminated',
            'ru' => ['name' => 'Отменена'],
            'en' => ['name' => 'Terminated']
        ])->id;
    }
}
