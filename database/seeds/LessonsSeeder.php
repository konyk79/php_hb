<?php

use App\Lesson;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static $classes = array();
    public function run()
    {
//        print_r((new DateTime())->format('Y-m-d H:i:s'));
        self::$classes['class1']=Lesson::create([
            'class_status_id'=> ClassStatusesSeeder::$lassStatuses['pending'],
//            'time_out' => '30M',
            'teacher_id' => 1,
            'schedule_id' => SchedulesSeeder::$scedules['Europe'],
            'term' => '30M',
            'start_time' => (DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-27 13:00:00'))->format('Y-m-d H:i:s'),
            'language_id' => 1,
            'class_level_id' =>1,
            'color' => '#e3fcf6',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' =>  [
                'name' => 'Урок1',
                'description' => 'Урок для начинающих на пол часикас',
                'term_text'=>'30 минут'
                ],
            'en' =>  [
                'name' => 'Lesson1',
                'description' => 'Lesson for beginner only 30 minutes',
                'term_text'=>'30 minutes'
            ],
        ])->id;
        self::$classes['class2']=Lesson::create([
            'class_status_id'=> ClassStatusesSeeder::$lassStatuses['pending'],
//            'time_out' => '30M',
            'teacher_id' => 2,
            'schedule_id' => SchedulesSeeder::$scedules['Europe'],
            'term' => '1H',
            'start_time' => (DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-28 07:00:00'))->format('Y-m-d H:i:s'),
            'language_id' => 1,
            'class_level_id' =>2,
            'color' => '#e3fcf6',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' =>  [
                'name' => 'Урок2',
                'description' => 'Урок для знающих, на  часик',
                'term_text'=>'час'
            ],
            'en' =>  [
                'name' => 'Lesson2',
                'description' => 'Lesson for middle 1 hour',
                'term_text'=>'hour'
            ],
        ])->id;
        self::$classes['class3']=Lesson::create([
            'class_status_id'=> ClassStatusesSeeder::$lassStatuses['pending'],
//            'time_out' => '30M',
            'teacher_id' => 1,
            'schedule_id' => SchedulesSeeder::$scedules['Europe'],
            'term' => '1H',
            'start_time' => (DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-29 15:00:00'))->format('Y-m-d H:i:s'),
            'language_id' => 1,
            'class_level_id' =>1,
            'color' => '#e3fcf6',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' =>  [
                'name' => 'Урок3',
                'description' => 'Урок для начинающих на часик',
                'term_text'=>'час'
            ],
            'en' =>  [
                'name' => 'Lesson3',
                'description' => 'Lesson for beginner only hour',
                'term_text'=>'hour'
            ],
        ])->id;
        self::$classes['class4']=Lesson::create([
            'class_status_id'=> ClassStatusesSeeder::$lassStatuses['pending'],
//            'time_out' => '30M',
            'teacher_id' => 1,
            'schedule_id' => SchedulesSeeder::$scedules['Europe'],
            'term' => '1H',
            'start_time' => (DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-31 15:00:00'))->format('Y-m-d H:i:s'),
            'language_id' => 1,
            'class_level_id' =>1,
            'color' => '#e3fcf6',
            'type_id' => TypesSeeder::$types['regular'],
            'ru' =>  [
                'name' => 'Урок4',
                'description' => 'Урок для начинающих на час',
                'term_text'=>'час'
            ],
            'en' =>  [
                'name' => 'Lesson4',
                'description' => 'Lesson for beginner hour',
                'term_text'=>'hour'
            ],
        ])->id;
        self::$classes['private_class1']=Lesson::create([
            'class_status_id'=> ClassStatusesSeeder::$lassStatuses['pending'],
//            'time_out' => '30M',
            'teacher_id' => 1,
            'schedule_id' => SchedulesSeeder::$scedules['Europe'],
            'term' => '30M',
            'start_time' => (DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-30 15:00:00'))->format('Y-m-d H:i:s'),
            'language_id' => 1,
            'class_level_id' =>1,
            'color' => '#fed9f8',
            'type_id' => TypesSeeder::$types['private'],
            'ru' =>  [
                'name' => 'Частный Урок 1',
                'description' => 'Частный Урок для начинающих на пол часикас',
                'term_text'=>'30 минут'
            ],
            'en' =>  [
                'name' => 'Private Lesson 1',
                'description' => 'Private Lesson for beginner only 30 minutes',
                'term_text'=>'30 minutes'
            ],
        ])->id;
        self::$classes['corporate_class1']=Lesson::create([
            'class_status_id'=> ClassStatusesSeeder::$lassStatuses['pending'],
//            'time_out' => '30M',
            'teacher_id' => 1,
            'schedule_id' => SchedulesSeeder::$scedules['USA'],
            'term' => '30M',
            'start_time' => (DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-28 12:30:00'))->format('Y-m-d H:i:s'),
            'language_id' => 1,
            'class_level_id' =>1,
            'color' => '#05fff6',
            'type_id' => TypesSeeder::$types['corporate'],
            'ru' =>  [
                'name' => 'Коорпоративный Урок 1',
                'description' => 'Коорпоративный  Урок для начинающих на пол часикас',
                'term_text'=>'30 минут'
            ],
            'en' =>  [
                'name' => 'Corporate Lesson1',
                'description' => 'Corporate  Lesson for beginner only 30 minutes',
                'term_text'=>'30 minutes'
            ],
        ])->id;
    }
}
