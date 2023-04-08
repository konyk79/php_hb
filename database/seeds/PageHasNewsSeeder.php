<?php

use App\PageHasNews;
use Illuminate\Database\Seeder;

class PageHasNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       PageHasNews::create([
            'page_id' => PagesSeeder::$pages['newsPage'],
            'paginate' => 6,
            'ru' => [
                'more_button_text' => 'Подробно'
            ],
            'en' => [
               'more_button_text' => 'More'
            ]
        ]);
    }
}
