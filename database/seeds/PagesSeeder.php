<?php

use App\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $pages = array();

    public function run()
    {
        self::$pages['mainPage'] = Page::create([
            'name' => 'main',
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['mainView'],
            'ru' => ['title' => 'Гармоничное дыхание',
                'favicon_title' => 'Главная',
//                'body' => ''
            ],
            'en' => ['title' => 'Harmonious breathing',
                'favicon_title' => 'Main',
//                'body' => ''
            ]
        ])->id;
        self::$pages['newsPage'] = Page::create([
            'name' => 'news',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['newsPage'],
            'ru' => ['title' => 'Новости',
                'favicon_title' => 'Новости',
//                'body' => ''
            ],
            'en' => ['title' => 'News',
                'favicon_title' => 'News',
//                'body' => ''
            ]
        ])->id;
        self::$pages['reviewsPage'] = Page::create([
            'name' => 'reviews',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['reviewsPage'],
            'ru' => ['title' => 'Отзывы',
                'favicon_title' => 'Отзывы',
//                'body' => ''
            ],
            'en' => ['title' => 'Reviews',
                'favicon_title' => 'Reviews',
//                'body' => ''
            ]
        ])->id;
        self::$pages['oneNewsPage'] = Page::create([
            'name' => 'one_news',
            'parent_id' => self::$pages['newsPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['oneNewsPage'],
            'ru' => ['title' => 'Новость подробно',
                'favicon_title' => 'Новость подробно',
//                'body' => ''
            ],
            'en' => ['title' => 'News',
                'favicon_title' => 'News',
//                'body' => ''
            ]
        ])->id;
        self::$pages['benefitPage'] = Page::create([
            'name' => 'benefit',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['benefitPage'],
            'ru' => ['title' => 'ГАРМОНИЧНОЕ ДЫХАНИЕ',
                'favicon_title' => 'Польза',
//                'body' => ''
            ],
            'en' => ['title' => 'HARMONIOUS BREATHING',
                'favicon_title' => 'The Benefit',
//                'body' => ''
            ]
        ])->id;
        self::$pages['classesPage'] = Page::create([
            'name' => 'classes',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['classesPage'],
            'ru' => ['title' => 'ЧТО МЫ ПРЕДЛАГАЕМ',
                'favicon_title' => 'Занятия',
//                'body' => ''
            ],
            'en' => ['title' => 'WHAT WE OFFER',
                'favicon_title' => 'Classes',
//                'body' => ''
            ]
        ])->id;

        self::$pages['teamPage'] = Page::create([
            'name' => 'team',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['teamPage'],
            'ru' => ['title' => 'НАША ФИЛОСОФИЯ',
                'favicon_title' => 'Команда',
//                'body' => ''
            ],
            'en' => ['title' => 'OUR PHILOSOPHY',
                'favicon_title' => 'Team',
//                'body' => ''
            ]
        ])->id;
        self::$pages['contactsPage'] = Page::create([
            'name' => 'contacts',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['contactsPage'],
            'ru' => ['title' => 'Наши контакты',
                'favicon_title' => 'Контакты',
//                'body' => ''
            ],
            'en' => ['title' => 'Our Contacts',
                'favicon_title' => 'Contacts',
//                'body' => ''
            ]
        ])->id;
        self::$pages['loginPage'] = Page::create([
            'name' => 'login',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'view_id' => ViewsSeeder::$views['loginPage'],
            'ru' => ['title' => 'Вход',
                'favicon_title' => 'Вход',
//                'body' => ''
            ],
            'en' => ['title' => 'Sign In',
                'favicon_title' => 'Sign In',
//                'body' => ''
            ]
        ])->id;
        self::$pages['unconfirmedEmail'] = Page::create([
            'name' => 'unconfirmed-email',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['publicLayout'],
            'view_id' => ViewsSeeder::$views['unconfirmedEmailPage'],
            'ru' => ['title' => 'Ваша регистрация не завершена',
                'favicon_title' => 'Неподтвержденный e-mail',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Продолжить'
            ],
            'en' => ['title' => 'You registration has not completed',
                'favicon_title' => 'Unconfirmed e-mail',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Continue'
            ]
        ])->id;
        self::$pages['registeredPage'] = Page::create([
            'name' => 'registered',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'view_id' => ViewsSeeder::$views['registeredPage'],
            'ru' => ['title' => 'Спасибо за регистрацию',
                'favicon_title' => 'Спасибо за регистрацию',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Продолжить'
            ],
            'en' => ['title' => 'Thanks for registration',
                'favicon_title' => 'Thanks for registration',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Continue'
            ]
        ])->id;
        self::$pages['registerPage'] = Page::create([
            'name' => 'register',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'view_id' => ViewsSeeder::$views['registerPage'],
            'ru' => ['title' => 'Регистрация',
                'favicon_title' => 'Регистрация',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Продолжить'
            ],
            'en' => ['title' => 'Registration',
                'favicon_title' => 'Registration',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Continue'
            ]
        ])->id;

        //dasnboard pages ------------------------------------------------------
        self::$pages['profilePage'] = Page::create([
            'name' => 'dashboard/profile',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['profilePage'],
            'ru' => ['title' => 'Личный кабинет',
                'favicon_title' => 'Личный кабинет',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Продолжить'
            ],
            'en' => ['title' => 'Personal cabinet',
                'favicon_title' => 'Personal cabinet',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Continue'
            ]
        ])->id;
        self::$pages['mySubscribesPage'] = Page::create([
            'name' => 'dashboard/my-subscribes',
            'parent_id' => self::$pages['profilePage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['mySubscribesPage'],
            'ru' => ['title' => 'Мои подписки',
                'favicon_title' => 'Мои подписки',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Продолжить'
            ],
            'en' => ['title' => 'My subscribes',
                'favicon_title' => 'My subscribes',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Continue'
            ]
        ])->id;
        self::$pages['subscribePage'] = Page::create([
            'name' => 'dashboard/subscribes',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'view_id' => ViewsSeeder::$views['subscribePage'],
            'ru' => ['title' => 'ВЫБЕРИТЕ СВОЮ ПОДПИСКУ',
                'favicon_title' => 'Подписки',
//                'body' => ''
            ],
            'en' => ['title' => 'CHOOSE YOUR SUBSCRIPTION',
                'favicon_title' => 'Subscribes',
//                'body' => ''
            ]
        ])->id;
        self::$pages['myClassesPage'] = Page::create([
            'name' => 'dashboard/my-classes',
            'parent_id' => self::$pages['profilePage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['myClassesPage'],
            'ru' => ['title' => 'Мои занятия',
                'favicon_title' => 'Мои занятия',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Продолжить'
            ],
            'en' => ['title' => 'My classes',
                'favicon_title' => 'My classes',
//                'body' => 'Неподтвержденный e-mail',
//                'button_title' => 'Continue'
            ]
        ])->id;
        self::$pages['schedulePage'] = Page::create([
            'name' => 'dashboard/schedule',
            'parent_id' => self::$pages['classesPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['schedulePage'],
            'ru' => ['title' => 'Рассписание занятий',
                'favicon_title' => 'Рассписание занятий',
            ],
            'en' => ['title' => 'Schedule classes',
                'favicon_title' => 'Schedule classes',
            ]
        ])->id;
        self::$pages['subscribeOrderPage'] = Page::create([
            'name' => 'dashboard/subscribe-order',
            'parent_id' => self::$pages['subscribePage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['subscribeOrderPage'],
            'ru' => ['title' => 'Купить подписку',
                'favicon_title' => 'Купить подписку',
            ],
            'en' => ['title' => 'To subscribe',
                'favicon_title' => 'To subscribe',
            ]
        ])->id;
        self::$pages['subscribePreviewPage'] = Page::create([
            'name' => 'dashboard/subscribe-preview',
            'parent_id' => self::$pages['subscribePage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['subscribePreviewPage'],
            'ru' => ['title' => 'Купить подписку',
                'favicon_title' => 'Купить подписку',
            ],
            'en' => ['title' => 'To subscribe',
                'favicon_title' => 'To subscribe',
            ]
        ])->id;
        self::$pages['stripePaymentPage'] = Page::create([
            'name' => 'dashboard/payment/stripe',
            'parent_id' => self::$pages['mainPage'],
            'layout_id' => LayoutsSeeder::$layouts['dashboardLayout'],
            'is_need_authentificate' =>true,
            'view_id' => ViewsSeeder::$views['stripePaymentPage'],
            'ru' => ['title' => 'Оплата по Stripe',
                'favicon_title' => 'Оплата по Stripe',
            ],
            'en' => ['title' => 'Stripe payment',
                'favicon_title' => 'Stripe payment',
            ]
        ])->id;
    }
}
