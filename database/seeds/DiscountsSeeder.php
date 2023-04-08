<?php

use App\Discount;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $discounts=array();
    public function run()
    {
        self::$discounts['discount1']=Discount::create([
            'code' => 'discount1',
            'discount' => '-0.1',
            'en'=>[
                'name' => 'New Year Discount -10%'
            ],
            'ru'=>[
                'name' => 'Новогодняя скидка -10%'
            ],
        ])->id;
        self::$discounts['discount2']=Discount::create([
            'code' => 'discount2',
            'discount' => '-0.15',
            'en'=>[
                'name' => 'New Year Discount -15%'
            ],
            'ru'=>[
                'name' => 'Новогодняя скидка -15%'
            ],
        ])->id;
    }
}
