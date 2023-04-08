<?php

use App\Faq;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'ru' => [
                'question' => 'Я никогда раньше не занимался. Как понять, подходит ли это мне?',
                'answer' => 'Любой человек может извлечь пользу от практики Гармоничного Дыхания, также наши занятия подходят для всех желающих. Нет необходимости сразу подписываться на месячный курс, мы предлагаем два первых урока бесплатно и этого вполне достаточно, что-бы понять подходят ли Вам наши занятия. Со своей стороны, мы уверены, что Вам захочется продолжить.'
            ],
            'en' => [
                'question' => 'I’ve never done this before. How do I know it’s for me?',
                'answer' => 'Everyone can benefit from Harmonious Breathing, and everyone can participate in our classes. We offer you the first month for free to experience it for yourself and feel the immediate benefits. We’re confident you’ll want to continue.'
            ],
        ]);
        Faq::create([
            'ru' => [
                'question' => 'Нужны ли какие-то специальные аксессуары?',
                'answer' => 'Нет. Все что Вам нужно это — удобная одежда, достаточно пространства (около 4 м2), коврик для йоги и подушка. Для некоторых занятий нужен стул. Нет необходимости покупать специальную одежду. Поставьте рядом с собой воду, чтобы пить во время и после занятия.'
            ],
            'en' => [
                'question' => 'Do I need any special equipment?',
                'answer' => 'No. Wear some comfortable clothes, make sure you have enough floor space (about 4㎡), something to sit on – a yoga mat, cushion – and enjoy your class. Some sessions require you to sit on a chair. There’s no need to buy any specialized clothing. Have something to drink handy during and after your class.'
            ],
        ]);
        Faq::create([
            'ru' => [
                'question' => 'Когда я смогу почувствовать результат?',
                'answer' => 'Сразу же! Вы почувствуете эффект даже после одного занятия. Но вы будете замечать ещё большую разницу после каждого следующего.'
            ],
            'en' => [
                'question' => 'When will I feel the difference?',
                'answer' => 'Immediately! You will feel the benefits after just one class, but you’ll notice more and more difference as you continue with a series of classes.'
            ],
        ]);
    }
}
