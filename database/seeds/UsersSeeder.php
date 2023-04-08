<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static  public  $users = array();
    public function run()
    {
        self::$users['admin'] = User::create([
            'type_id' => GroupsSeeder::$groups['administration'],
            'email' => "admin@test.com",
            'country_id'=> 2,
            'name' => "Admin",
            'last_name' => "Adminko",
            'password' => '123456', // "123456"
            'email_confirmed' => true,
            'phone' => '+380977775544',

        ])->id;
        self::$users['user1'] = User::create([
            'type_id' => GroupsSeeder::$groups['private'],
            'email' => "user@test.com",
            'country_id'=> 3,
            'name' => "Иван",
            'last_name' => "Иванов",
            'password' => '123456', // "123456"
            'email_confirmed' => true,
            'phone' => '+380971111111',

        ])->id;
        self::$users['user2'] = User::create([
            'type_id' => GroupsSeeder::$groups['corporate'],
            'email' => "user2@test.com",
            'country_id'=> 3,
            'name' => "Пятя",
            'last_name' => "Петров",
            'password' => '123456', // "123456"
            'email_confirmed' => true,
            'phone' => '+380971111111',
            'corporate_name' => 'Рога и копыта'
        ])->id;
        self::$users['user3'] = User::create([
            'type_id' => GroupsSeeder::$groups['private'],
            'email' => "user3@test.com",
            'country_id'=> 3,
            'name' => "Вася",
            'last_name' => "Васильев",
            'password' => '123456', // "123456"
            'email_confirmed' => true,
            'phone' => '+380971111122',
        ])->id;
        self::$users['teacher1'] = User::create([
            'type_id' => GroupsSeeder::$groups['administration'],
            'email' => "teacher1@test.com",
            'country_id'=> 3,
            'name' => "Учитель",
            'last_name' => "Учителев",
            'password' => '123456', // "123456"
            'email_confirmed' => true,
            'phone' => '+380971111111',
            'photo' => 'team-1.jpg',
            'about_me'=> 'Born and raised in Italy, Fabio Andrico is an internationally-recognized teacher of Yantra Yoga. He initially studied Hatha Yoga in India, and has been learning, practising and teaching since the late 1970s. He also teaches a simple technique for developing conscious and harmonious breathing, presented in the “Breathe” video.

Fabio regularly conducts courses, workshops and teacher training around the world, including courses for well-known Associations and Yoga Centres such as Kripalu, Esalen, Yoga Tree in the USA, and the Yoga Federation in Russia.

He has appeared in Yoga DVDs such as “The Eight Movements of Yantra Yoga” and “Breathe” as well as “Tibetan Yoga of Movement Levels 1 and 2”. He collaborated with Chögyal Namkhai Norbu on the book Yantra Yoga: the Tibetan Yoga of Movement, and is the author of Tibetan Yoga of Movement (The Art and Practice of Yantra Yoga), published in 2012 by North Atlantic Books and Shang Shung Publications.',
        ])->id;
        self::$users['teacher2'] = User::create([
            'type_id' => GroupsSeeder::$groups['administration'],
            'email' => "teacher2@test.com",
            'country_id'=> 3,
            'name' => "Учитель2",
            'last_name' => "Учителев2",
            'password' => '123456', // "123456"
            'email_confirmed' => true,
            'phone' => '+3809722222222',
            'photo' => 'team-2.jpg',
            'about_me'=> 'Born and raised in Italy, Fabio Andrico is an internationally-recognized teacher of Yantra Yoga. He initially studied Hatha Yoga in India, and has been learning, practising and teaching since the late 1970s. He also teaches a simple technique for developing conscious and harmonious breathing, presented in the “Breathe” video.

Fabio regularly conducts courses, workshops and teacher training around the world, including courses for well-known Associations and Yoga Centres such as Kripalu, Esalen, Yoga Tree in the USA, and the Yoga Federation in Russia.

He has appeared in Yoga DVDs such as “The Eight Movements of Yantra Yoga” and “Breathe” as well as “Tibetan Yoga of Movement Levels 1 and 2”. He collaborated with Chögyal Namkhai Norbu on the book Yantra Yoga: the Tibetan Yoga of Movement, and is the author of Tibetan Yoga of Movement (The Art and Practice of Yantra Yoga), published in 2012 by North Atlantic Books and Shang Shung Publications.',
        ])->id;
    }
}
