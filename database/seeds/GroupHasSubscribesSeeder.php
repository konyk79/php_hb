<?php

use Illuminate\Database\Seeder;
use App\GroupHasSubscribes;
use App\GroupHasPromos;

class GroupHasSubscribesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupHasSubscribes::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'subscribe_id' => SubscribesSeeder::$subscribes['subscrubise1']
        ]);
        GroupHasSubscribes::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'subscribe_id' => SubscribesSeeder::$subscribes['subscrubise2']
        ]);
        GroupHasSubscribes::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'subscribe_id' => SubscribesSeeder::$subscribes['subscrubise3']
        ]);
        GroupHasSubscribes::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'subscribe_id' => SubscribesSeeder::$subscribes['subscrubiseIndividual1']
        ]);
        GroupHasSubscribes::create([
            'group_id' => GroupsSeeder::$groups['corporate'],
            'subscribe_id' => SubscribesSeeder::$subscribes['subscrubiseCorporate1']
        ]);
        GroupHasSubscribes::create([
            'group_id' => GroupsSeeder::$groups['corporate'],
            'subscribe_id' => SubscribesSeeder::$subscribes['subscrubiseCorporate2']
        ]);
        GroupHasPromos::create([
            'group_id' => GroupsSeeder::$groups['private'],
            'promo_id' => PromosSeeder::$promos['promoRegular1']
        ]);
        GroupHasPromos::create([
            'group_id' => GroupsSeeder::$groups['corporate'],
            'promo_id' => PromosSeeder::$promos['promoCorporate1']
        ]);
    }
}
