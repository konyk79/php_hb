<?php

use App\Footer;
use Illuminate\Database\Seeder;

class FootersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static  public  $footers=array();
    public function run()
    {
        self::$footers['publicLayout'] = Footer::create([
            'name' => 'pablic_layout',
            'menu_id' => MenusSeeder::$menus['footerMenu'],
            'view_id' => ViewsSeeder::$views['publicFooter'],
        ])->id;
        DB::table('layout_has_footers')->insert(
            [
                'layout_id'=> LayoutsSeeder::$layouts['publicLayout'],
                'footer_id' =>  self::$footers['publicLayout']

            ]

        );
        DB::table('layout_has_footers')->insert(
            [
                'layout_id'=> LayoutsSeeder::$layouts['dashboardLayout'],
                'footer_id' =>  self::$footers['publicLayout']

            ]

        );
        self::$footers['mainFooter'] = Footer::create([
        'name' => 'main',
        'view_id' => ViewsSeeder::$views['mainFooter'],
    ])->id;
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['mainPage'],
                'footer_id' => self::$footers['mainFooter']

            ]
        );
        self::$footers['contactFooter'] = Footer::create([
            'name' => 'contact_us',
            'view_id' => ViewsSeeder::$views['contactFooter'],
        ])->id;
        self::$footers['contactPhoneFooter'] = Footer::create([
            'name' => 'contact_us_phone',
            'view_id' => ViewsSeeder::$views['contactPhoneFooter'],
        ])->id;



    // relationships table
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['benefitPage'],
                'footer_id' => self::$footers['contactFooter']

            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['classesPage'],
                'footer_id' => self::$footers['contactFooter']

            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['subscribePage'],
                'footer_id' => self::$footers['contactFooter']

            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['teamPage'],
                'footer_id' => self::$footers['contactFooter']

            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['contactsPage'],
                'footer_id' => self::$footers['contactPhoneFooter']
            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['loginPage'],
                'footer_id' => self::$footers['contactFooter']
            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['profilePage'],
                'footer_id' => self::$footers['contactFooter']
            ]
        );
        DB::table('page_has_footers')->insert(
        [
            'page_id'=> PagesSeeder::$pages['mySubscribesPage'],
            'footer_id' => self::$footers['contactFooter']
        ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['myClassesPage'],
                'footer_id' => self::$footers['contactFooter']
            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['schedulePage'],
                'footer_id' => self::$footers['contactFooter']
            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['subscribeOrderPage'],
                'footer_id' => self::$footers['contactFooter']
            ]
        );
        DB::table('page_has_footers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['subscribePreviewPage'],
                'footer_id' => self::$footers['contactFooter']
            ]
        );
    }
}
