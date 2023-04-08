<?php

use App\Promo;
use Illuminate\Database\Seeder;

class PromosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public  $promos =array();
    public function run()
    {
        self::$promos['promoRegular1']= Promo::create([
            'code' => 'regcool',
            'discount' => -0.2,
            'ru' => ['name' => 'Для крутых -20%'],
            'en' => ['name' => 'For cool people -20%'],
        ])->id;
        self::$promos['promoCorporate1']= Promo::create([
            'code' => 'corcool',
            'discount' => -0.3,
            'ru' => ['name' => 'Для крутых -30%'],
            'en' => ['name' => 'For cool people -30%'],
        ])->id;
    }
}
