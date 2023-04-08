<?php

use App\Header;
use Illuminate\Database\Seeder;

class HeadersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static  public $headers=array();
    public function run()
    {
        self::$headers['topMenuHeader'] = Header::create([
            'name' => 'top_menu',
            'view_id' => ViewsSeeder::$views['topMenuHeader'],
        ])->id;
        //==========================
        DB::table('layout_has_headers')->insert(
            [
                'header_id'=> self::$headers['topMenuHeader'],
                'layout_id' => LayoutsSeeder::$layouts['publicLayout']
            ]
        );
        DB::table('layout_has_headers')->insert(
            [
                'header_id'=> self::$headers['topMenuHeader'],
                'layout_id' => LayoutsSeeder::$layouts['dashboardLayout']
            ]
        );
        //==========================
        //---------------------------------------------------------------------------
        self::$headers['mainHeader'] = Header::create([
            'name' => 'main',
            'menu_id' => MenusSeeder::$menus['mainMenu'],
            'view_id' => ViewsSeeder::$views['mainHeader'],
        ])->id;
        //==========================
        //---------------------------------------------------------------------------
        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['mainPage'],
                'header_id' => self::$headers['mainHeader']
            ]
        );
        //==========================
        self::$headers['publicHeader'] = Header::create([
            'name' => 'public',
            'menu_id' => MenusSeeder::$menus['mainMenu'],
            'view_id' => ViewsSeeder::$views['publicHeader'],
        ])->id;
        //==========================
        //---------------------------------------------------------------------------
        DB::table('layout_has_headers')->insert(
            [
                'header_id'=> self::$headers['publicHeader'],
                'layout_id' => LayoutsSeeder::$layouts['dashboardLayout']
            ]
        );
        //==========================
        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['newsPage'],
                'header_id' => self::$headers['publicHeader']
            ]
        );
        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['reviewsPage'],
                'header_id' => self::$headers['publicHeader']
            ]
        );
        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['oneNewsPage'],
                'header_id' => self::$headers['publicHeader']
            ]
        );
        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['benefitPage'],
                'header_id' => self::$headers['publicHeader']
            ]
        );
        DB::table('page_has_headers')->insert(
        [
            'page_id'=> PagesSeeder::$pages['classesPage'],
            'header_id' => self::$headers['publicHeader']
        ]
    );

        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['teamPage'],
                'header_id' => self::$headers['publicHeader']
            ]
        );
        DB::table('page_has_headers')->insert(
            [
                'page_id'=> PagesSeeder::$pages['contactsPage'],
                'header_id' => self::$headers['publicHeader']
            ]
        );

        //==========================
    }
}
