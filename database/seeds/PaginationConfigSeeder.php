<?php

use App\PagConf;
use Illuminate\Database\Seeder;

class PaginationConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PagConf::create([
            'ru' => [
                'next' => 'Следующие',
                'previous' => 'Предыдущие'
            ],
            'en' => [
                'next' => 'next',
                'previous' => 'previous'
            ]
        ]);
    }
}
