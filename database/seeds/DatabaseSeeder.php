<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MainConfigSeeder::class);
        $this->call(SlidersSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(SchedulesSeeder::class);
        $this->call(PromosSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(ClassStatusesSeeder::class);
        $this->call(ClassLevelsSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(PaginationConfigSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TeachersSeeder::class);
    //    $this->call(LessonsSeeder::class);
        $this->call(GroupHasUsersSeeder::class);
        $this->call(ViewsSeeder::class);
        $this->call(UserHasRolesSeeder::class);
        $this->call(LayoutsSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(FootersSeeder::class);
        $this->call(HeadersSeeder::class);
        $this->call(ContentsSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PageHasNewsSeeder::class);
        $this->call(ReviewsSeeder::class);
        $this->call(PageHasReviewsSeeder::class);
        $this->call(SocialLinksSeeder::class);
        $this->call(FormsSeeder::class);
        $this->call(FaqsSeeder::class);
        $this->call(PaymentSystemsSeeder::class);
        $this->call(PaymentSystemConfigsSeeder::class);
        $this->call(UserSubStatusesSeeder::class);
   //     $this->call(SubscribesSeeder::class);
   //     $this->call(UserSubscribesSeeder::class);
   //     $this->call(UserSubHistoriesSeeder::class);
   //     $this->call(GroupHasSubscribesSeeder::class);
   //     $this->call(ClassesHistoriesSeeder::class);

    }
}
