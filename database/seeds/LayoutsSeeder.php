<?php

use App\Layout;
use Illuminate\Database\Seeder;

class LayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static  public $layouts = array();
    public function run()
    {
        self::$layouts['publicLayout'] = Layout::create([
            'name' => 'public',
            'view_id' => ViewsSeeder::$views['publicLayout'],
        ])->id;
        self::$layouts['dashboardLayout'] = Layout::create([
            'name' => 'dashboard',
            'view_id' => ViewsSeeder::$views['dashboardLayout'],
        ])->id;
    }
}
