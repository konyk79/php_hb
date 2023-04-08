<?php

use App\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $links = array();
    public function run()
    {
        self::$links['facebookLinkAppFooter'] =SocialLink::create([
            'name' => 'facebook_link',
            'image' => url('img/icons/facebookf.png'),
            'socialized_id' => FootersSeeder::$footers['publicLayout'],
            'socialized_type' => \App\Footer::class,
            'href'=>'https://www.facebook.com/harmoniousbreathing/',
//            'ru' =>[
//            ] ,
//            'en' =>[
//            ]
        ])->id;
    }
}
