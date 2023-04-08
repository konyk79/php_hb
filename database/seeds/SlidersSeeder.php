<?php

use App\Slider;
use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'code'=> 'slider1',
            'href' => url('/classes'),
            'en' => [
                'title'=>'IMPROVES HEART AND RESPIRATORY FUNCTION',
                'text'=>'Improves heart and respiratory function. Harmonious Breathing brings better overall cardiovascular health and more efficient oxygen intake.
Classes',
                'href_text' =>'Classes',
            ],
            'ru' => [
                'title'=>'УЛУЧШАЕТ ФУНКЦИЮ СЕРДЦА И ДЫХАНИЯ.',
                'text'=>'Гармоничное дыхание обеспечивает лучшее общее сердечно-сосудистое здоровье и более эффективное потребление кислорода.
Занятия
',
                'href_text' =>'Занятия',
            ]

        ]);
        Slider::create([
            'code'=> 'slider2',
            'href' => url('/contacts'),
            'en' => [
                'title'=>'OurContacts',
                'text'=>'You can find our contacts here',
                'href_text' =>'Contacts',
                ],
            'ru' => [
                'title'=>'Наши контакты',
                'text'=>'Наши контакты тут можете вы найти',
                'href_text' =>'Контакты',
            ]

        ]);
    }
}
