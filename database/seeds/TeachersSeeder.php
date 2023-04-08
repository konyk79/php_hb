<?php

use App\Teacher;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $teachers = array();

    public function run()
    {
       self::$teachers['teacher1'] = Teacher::create([
           'user_id' => UsersSeeder::$users['teacher1'],
           'zoom_id' => 'info@harmoniousbreathing.com',//'bszNbtmlReeEpL4aHcPUqg'   //must be PRO
           'zoom_private_id'  => "barlogy@yahoo.com"
       ])->id;
        self::$teachers['teacher2'] = Teacher::create([
            'user_id' => UsersSeeder::$users['teacher2'],
            'zoom_id' => 'info@harmoniousbreathing.com',    //must be PRO
            'zoom_private_id'  => "barlogy@yahoo.com"
        ])->id;
    }
}
