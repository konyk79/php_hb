<?php

use App\Subscribe;
use Illuminate\Database\Seeder;

class SubscribesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static  public $subscribes = array();
    public function run()
    {
        self::$subscribes['subscrubise1'] = Subscribe::create([
            'code'=>'for_beginner',
            'discount_id' => 1,
            'price' => 1 ,
//            'visible' => false,
            'priority' => 20,
            'term' => '2D',
            'is_auto_prolangate'=> false,
//            'is_active',
            'expires_for' => null,
            'num_classes' => 2,
            'trial_term' => '1D',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' => [
                'term_text' =>'два дня',
                'name' => 'Подписка для новичков 2',
                'description'=>'Вы можете открыть для себя мир гармонтчного дыхания за чисто символическую цену,этот пакет не имеет автопролонгации,и дает возможность посетить два урока в неделю 4 за две недели'
        ],
            'en' => [
                'term_text' =>'two days',
                'name' => 'Beginner\'s Subscribe 2',
                'description'=>'// ENG Вы можете открыть для себя мир гармонтчного дыхания за чисто символическую цену,этот пакет не имеет автопролонгации,и дает возможность посетить два урока в неделю 4 за две недели'
    ]
        ])->id;
        self::$subscribes['subscrubise2'] = Subscribe::create([
            'code'=>'for_middle2',
            'discount_id' => 2,
            'price' => 0.99,
//            'visible' => false,
            'priority' => 20,
            'term' => '1D',
            'is_auto_prolangate'=> true,
//            'is_active',
            'expires_for' => null,
            'num_classes' => 3,
            'trial_term' => '0D',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' => [
                'term_text' =>'день',
                'name' => 'Подписка для среднего уровня 1',
                'description'=>'Вы можете закрепить для себя мир гармонтчного дыхания ,этот пакет  имеет автопролонгации,и дает возможность посетить два урока в неделю 8 за месяц'
            ],
            'en' => [
                'term_text' =>'day',
                'name' => 'Middle level Subscribe 1',
                'description'=>'//TO DO ENG Вы можете закрепить для себя мир гармонтчного дыхания ,этот пакет  имеет автопролонгации,и дает возможность посетить два урока в неделю 8 за месяц'
            ]
        ])->id;
        self::$subscribes['subscrubise3'] = Subscribe::create([
            'code'=>'for_middle3',
            'discount_id' => 1,
            'price' => 15,
//            'visible' => false,
            'priority' => 20,
            'term' => '2D',
            'is_auto_prolangate'=> true,
//            'is_active',
            'expires_for' => null,
            'num_classes' => 2,
            'trial_term' => '1D',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' => [
                'term_text' =>'2 дня',
                'name' => 'Подписка для крутого уровня 2',
                'description'=>'Вы можете изощрятся в  дыхании ,этот пакет  имеет автопролонгации,и дает возможность посетить два урока в неделю 8 за месяц'
            ],
            'en' => [
                'term_text' =>'two days',
                'name' => 'Cool level Subscribe 2',
                'description'=>'//TO DO ENGВы можете изощрятся в  дыхании ,этот пакет  имеет автопролонгации,и дает возможность посетить два урока в неделю 8 за месяц'
            ]
        ])->id;
        self::$subscribes['subscrubiseIndividual1'] = Subscribe::create([
            'code'=>'for_middle_individ',
            'discount_id' => 2,
            'price' => 1.5,
//            'visible' => false,
            'priority' => 20,
            'term' => '1D',
            'is_auto_prolangate'=> true,
//            'is_active',
            'expires_for' => null,
            'num_classes' => 1,
            'trial_term' => '1D',
            'type_id' => TypesSeeder::$types['private'],
            'ru' => [
                'term_text' =>'день',
                'name' => 'Подписка для одиноких волков 1',
                'description'=>'Вы можете работать в своем темпе, имеет автопродление 8 занятий в месяц'
            ],
            'en' => [
                'term_text' =>'day',
                'name' => 'Subscribe for along wolf 1',
                'description'=>'//TO DO ENG Вы можете работать в своем темпе, имеет автопродление 8 занятий в месяц'
            ]
        ])->id;

        self::$subscribes['subscrubiseCorporate1'] = Subscribe::create([
            'code'=>'corporate_for_beginner',
            'discount_id' => 3,
            'price' => 1,
//            'visible' => false,
            'priority' => 20,
            'term' => '2D',
            'is_auto_prolangate'=> false,
//            'is_active',
            'expires_for' => null,
            'num_classes' => 4,
            'trial_term' => '1D',
            'type_id' => TypesSeeder::$types['corporate'],
            'ru' => [
                'term_text' =>'два дня',
                'name' => 'Коорпоративная подписка для новичков 2',
                'description'=>'Вы можете открыть для своих сотрудников  мир гармонтчного дыхания за чисто символическую цену,этот пакет не имеет автопролонгации,и дает возможность посетить два урока в неделю 4 за две недели'
            ],
            'en' => [
                'term_text' =>'two days',
                'name' => 'Corporate beginner\'s Subscribe 2',
                'description'=>'// ENG Вы можете открыть для своих сотрудников  мир гармонтчного дыхания за чисто символическую цену,этот пакет не имеет автопролонгации,и дает возможность посетить два урока в неделю 4 за две недели'
            ]
        ])->id;
        self::$subscribes['subscrubiseCorporate2'] = Subscribe::create([
            'code'=>'corporate_for_beginner',
            'discount_id' => 3,
            'price' => 1,
//            'visible' => false,
            'priority' => 20,
            'term' => '2D',
            'is_auto_prolangate'=> false,
//            'is_active',
            'expires_for' => null,
            'num_classes' => 4,
            'trial_term' => '0D',
            'type_id' => TypesSeeder::$types['corporate'],
            'ru' => [
                'term_text' =>'два дня',
                'name' => 'Коорпоративная подписка для новичков 2',
                'description'=>'Вы можете открыть для своих сотрудников  мир гармонтчного дыхания за чисто символическую цену,этот пакет не имеет автопролонгации,и дает возможность посетить два урока в неделю 4 за две недели'
            ],
            'en' => [
                'term_text' =>'two days',
                'name' => 'Corporate beginner\'s Subscribe 2',
                'description'=>'// ENG Вы можете открыть для своих сотрудников  мир гармонтчного дыхания за чисто символическую цену,этот пакет не имеет автопролонгации,и дает возможность посетить два урока в неделю 4 за две недели'
            ]
        ])->id;
//-----------------------

    }





}
