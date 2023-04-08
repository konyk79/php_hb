<?php

use App\MainConfig;
use Illuminate\Database\Seeder;

class MainConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MainConfig::create([
            'user_subscribe_timeout'=> '0D',
            'lesson_cancel_timeout'=> '30M',
            'lesson_before_start_timeout' => '15M',
            'lesson_after_start_timeout' => '10M',
            'slider_timeout' => '3S'
        ]);
    }
}
