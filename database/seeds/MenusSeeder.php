<?php

use App\Item;
use App\Menu;
use App\Page;
use App\Subitem;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $menus=array();
    public function run()
    {
//main menu
        self::$menus['mainMenu'] = Menu::create([
            'name' => 'main',
            'view_id' => ViewsSeeder::$views['mainMenu'],
        ])->id;

        $main = Item::create([
            'name' => 'main',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 1,
            'href' => url('/'.Page::find(PagesSeeder::$pages['mainPage'])->getName()),
            'ru'=> ['title' => 'Главная'],
            'en'=> ['title' => 'Main'],
        ])->id;
        $news = Item::create([
            'name' => 'news',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 11,
            'href' => url('/'.Page::find(PagesSeeder::$pages['newsPage'])->getName()) ,
            'ru'=> ['title' => 'Новости'],
            'en'=> ['title' => 'News'],
        ])->id;
        $classes = Item::create([
            'name' => 'classes',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 21,
            'href' =>url('/'.Page::find(PagesSeeder::$pages['classesPage'])->getName()),
            'ru'=> ['title' => 'Занятия'],
            'en'=> ['title' => 'Classes'],
        ])->id;
        $benefits = Item::create([
            'name' => 'benefits',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 31,
            'href' =>url('/'.Page::find(PagesSeeder::$pages['benefitPage'])->getName()) ,
            'ru'=> ['title' => 'Польза'],
            'en'=> ['title' => 'The Benefits'],
        ])->id;
        $subscribes = Item::create([
            'name' => 'subscribes',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 41,
            'href' => url('/'.Page::find(PagesSeeder::$pages['subscribePage'])->getName()) ,
            'ru'=> ['title' => 'Подписки'],
            'en'=> ['title' => 'Subscriptions'],
        ])->id;
        $team = Item::create([
            'name' => 'team',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 51,
            'href' => url('/'.Page::find(PagesSeeder::$pages['teamPage'])->getName()) ,
            'ru'=> ['title' => 'Команда'],
            'en'=> ['title' => 'Team'],
        ])->id;
        $contacts = Item::create([
            'name' => 'contacts',
            'menu_id' => self::$menus['mainMenu'],
            'priority' => 61,
            'href' =>url('/'.Page::find(PagesSeeder::$pages['contactsPage'])->getName()) ,
            'ru'=> ['title' => 'Контакты'],
            'en'=> ['title' => 'Contacts'],
        ])->id;
        $regular = Subitem::create([
            'name' => 'regular-classes',
            'item_id' => $classes,
            'priority' => 1,
            'href' => '/dashboard/schedule/regular/0/0',
            'en'=> ['title' => 'Regular classes'],
            'ru'=> ['title' => 'Регулярные занятия'],
        ])->id;
        $corporate = Subitem::create([
            'name' => 'corporate-classes',
            'item_id' => $classes,
            'priority' => 11,
            'href' => '/dashboard/schedule/corporate/0/0',
            'en'=> ['title' => 'Corporate classes'],
            'ru'=> ['title' => 'Коорпоративные занятия'],
        ])->id;
        $private = Subitem::create([
            'name' => 'private',
            'item_id' => $classes,
            'priority' => 21,
            'href' => '/dashboard/schedule/private/0/0',
            'en'=> ['title' => 'Private classes'],
            'ru'=> ['title' => 'Частные занятия'],
        ])->id;
//footer main menu
        self::$menus['footerMenu'] = Menu::create([
            'name' => 'footer',
            'view_id' => ViewsSeeder::$views['footerMenu'],
        ])->id;

        $main = Item::create([
            'name' => 'main',
            'menu_id' => self::$menus['footerMenu'],
            'priority' => 1,
            'href' => url('/'.Page::find(PagesSeeder::$pages['mainPage'])->getName()),
            'ru'=> ['title' => 'Главная'],
            'en'=> ['title' => 'Main'],
        ])->id;
        $news = Item::create([
            'name' => 'search',
            'menu_id' => self::$menus['footerMenu'],
            'priority' => 11,
            'href' =>'#' ,
            'ru'=> ['title' => 'Поиск'],
            'en'=> ['title' => 'Search'],
        ])->id;
        $classes = Item::create([
            'name' => 'dashboard',
            'menu_id' => self::$menus['footerMenu'],
            'priority' => 21,
            'href' => url('dashboard/profile'),
            'ru'=> ['title' => 'Личный кабинет'],
            'en'=> ['title' => 'Profile'],
        ])->id;
        $benefits = Item::create([
            'name' => 'donation',
            'menu_id' => self::$menus['footerMenu'],
            'priority' => 31,
            'href' => '#',
            'ru'=> ['title' => 'Пожертвовать'],
            'en'=> ['title' => 'Donate'],
        ])->id;
    }
}
