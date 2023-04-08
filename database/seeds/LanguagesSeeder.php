<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'code' => 'en',
            'ru' => [
                'name' => 'Английский',
                'switcher_name' => 'Анг'
            ],
            'en' => [
                'name' => 'English',
                'switcher_name' => 'Eng'
            ]
        ]);
        Language::create([
            'code' => 'ru',
            'ru' => [
                'name' => 'Русский',
                'switcher_name' => 'Рус'
            ],
            'en' => [
                'name' => 'Russian',
                'switcher_name' => 'Rus'
            ]
        ]);
        Language::create([
            'code' => 'ua',
            'ru' => [
                'name' => 'Украинский',
                'switcher_name' => 'Укр'
            ],
            'en' => [
                'name' => 'Ukrainian',
                'switcher_name' => 'Ukr'
            ],
            'ua' => [
                'name' => 'Українська',
                'switcher_name' => 'Укр'
            ]
        ]);
    }
}
