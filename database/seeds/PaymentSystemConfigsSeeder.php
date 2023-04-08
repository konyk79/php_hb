<?php

use App\Type;
use Illuminate\Database\Seeder;
use App\PaymentSystemConfig;

class PaymentSystemConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $types = array();
    public function run()
    {
        /**
         * https://www.sandbox.paypal.com/
         * hb-facilitator@outlook.com qwerty123
         * hb-buyer@outlook.com qwerty123
         */
        PaymentSystemConfig::create([
            'config' =>  '{ "mode": "sandbox", "sandbox": { "username": "hb-facilitator_api1.outlook.com", "password": "ZE3VFSNM63RJJRRL", "secret": "ATZljs7QP9ZQC1DdD0CDyq6K4xrxAo3FHFQ7LEQm-eppJTopEN7D6LfW", "certificate": "", "app_id": "" }, "live": { "username": "", "password": "", "secret": "", "certificate": "", "app_id": "" }, "payment_action": "Sale", "currency": "USD", "notify_url": "", "locale": "", "validate_ssl": true }',
            'payment_system_id' => 1,
        ]);
        PaymentSystemConfig::create([
            'config' =>  '{ "mode": "sandbox", "sandbox": { "key": "pk_test_RibNP9rAUucNFqJFd2tL0APj", "secret": "sk_test_z4FN8tWwfb8cTE8JBF9QbzEC" }, "live": { "key": "", "secret": "" }, "webhook_secret": "whsec_svhMp5R0b0ItHApjF7ojPzRC5vYIheAZ", "payment_action": "Sale", "currency": "USD", "notify_url": "", "locale": "", "validate_ssl": true }',
            'payment_system_id' => 2,
        ]);
    }
}
