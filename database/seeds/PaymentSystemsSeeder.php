<?php

use App\PaymentSystem;
use Illuminate\Database\Seeder;

class PaymentSystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static $paymentSystems =array();
    public function run()
    {
        self::$paymentSystems['PayPal']= PaymentSystem::create([
            'ru'=>[
                'name'        => 'Пєй пал',
                'description' => 'Пєй пал',
            ],
            'en'=>[
                'name'        => 'Pay Pal',
                'description' => 'Pay Pal'
            ],

        ])->id;
        self::$paymentSystems['Stripe']= PaymentSystem::create([
            'ru'=>[
                'name' => 'Visa/MasterCard',
                'description' => 'Visa/MasterCard'
            ],
            'en'=>[
                'name' => 'Visa/MasterCard',
                'description' => 'Visa/MasterCard'
            ],

        ])->id;
    }
}
