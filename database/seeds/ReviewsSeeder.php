<?php

use App\Review;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            //'country_id' => Country::where('code', 'FR')->first(FR)->id,
            'country_id' =>1,
            'name' => 'Anne & Max Zucker',
            'ru' => ['body' => '«Привет из Прованса, мы рады  рассказать вам, как мы с Маком счастливы работать с вами, практикуя девять дыханий и полное дыхание каждое утро.» '],
            'en' => ['body' => '«Hello from Provence to tell you how happy Max and I have been to work with you, practicing the nine breathings and complete breathing every morning.» ']
        ]);
        Review::create([
            'country_id' => 2,
            'name' => 'Edouard Markiewicz',
            'ru' => ['body' => '«Еще раз спасибо за эту великую сессию йоги дыхания. Сомнения растают, после того как попробуешь -  есть так много способов дышать. Сердечные поздравления.» '],
            'en' => ['body' => "«Thank you once again for this great yoga session of breathing. Who could doubt if he hasn't experienced it, there are so many ways to breathe. Cordial greetings.»"]
        ]);
        Review::create([
            //'country_id' => Country::where('code', 'SZ')->first(SZ)->id,
            'country_id' => 3,
            'name' => 'Christian Henry',
            'ru' => ['body' => '«Спасибо за это преобразование. Я чувствую ощущения и запахи, которые я потерял. Я чувствую, что я очистил себя от накопленных токсинов, которые мешали мне полностью наслаждаться настоящим.» '],
            'en' => ['body' => '«Thank you for this transformation. I feel sensations and smells I had lost. I feel I have purged myself of stored toxins that prevented me from fully enjoying the present.» ']
        ]);
        Review::create([
            'country_id' => 4,
            'name' => 'Solar Impulse Team.',
            'ru' => ['body' => '«Дорогая Патриция, ваши уроки Гармоничного Дыхания стали для меня откровением. Дыхательные упражнения помогли мне снова почувствовать себя сильным. Сегодня кто-то пришел ко мне, обнял меня и сказал, что ваша энергия изменилась, вы снова Элке. Спасибо вам, дорогая Патриция.» '],
            'en' => ['body' => '«Dear Patrizia your teaching sessions of Harmonious Breathing via skype to support the Solar Impulse team in Japan while waiting to fly to Hawaii were a revelation to me. The breathing exercises helped me to feel strong again. Today somebody came to me and embraced me and said your energy changed, you are back again Elke. Thank you very much dearest Patrizia to help in this adventure from far.» ']
        ]);
        Review::create([
            //'country_id' => Country::where('code', 'FR')->first(FR)->id,
            'country_id' => 5,
            'name' => 'Richard Koehler',
            'ru' => ['body' => '«Мне 65 лет, я практиковал йогу на протяжении десятилетий. После 3-месячных курсов я обнаружил что у меня появилось больше гибкости, позы стали более стабильны, мое дыхание стало более полным, тело и разум наполнились спокойствием и присутствием, которое распространяется на повседневную деятельность. Преподаватели очень компетентны.» '],
            'en' => ['body' => '«65 years old, I have practiced yoga for decades, this formula is really interesting. After 3 months of courses, I found more flexibility, more stable posture, more ample breathing, calmness and presence that extends into everyday activities. The teachers are very competent. There is no loss of time or traveling expenses.» ']
        ]);
        Review::create([
            //'country_id' => Country::where('code', 'IT')->first(IT)->id,
            'country_id' => 6,
            'name' => 'Chicca Maione',
            'ru' => ['body' => '«Я хочу поблагодарить вас, так как вы даете мне эту невероятную возможность тренироваться вместе с вами. Гармоничное дыхание - это прекрасный момент моей повседневной жизни, и я всегда с нетерпением жду возможности посетить класс.» '],
            'en' => ['body' => '«I want to thank you and you give to me, this incredible opportunity to practice together. Harmonious Breathing is such a good moment of my daily life and I am always looking forward to attend a class.» ']
        ]);
    }
}
