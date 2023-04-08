<?php

use App\PageHasReviews;
use Illuminate\Database\Seeder;

class PageHasReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageHasReviews::create([
            'page_id' => PagesSeeder::$pages['newsPage'],
            'paginate' => 8,
        ])->id;
    }
}
