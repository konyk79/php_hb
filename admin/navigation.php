<?php

/**
 * @var \SleepingOwl\Admin\Contracts\Navigation\NavigationInterface $navigation
 * @see http://sleepingowladmin.ru/docs/menu_configuration
 */

use SleepingOwl\Admin\Navigation\Page;
//------------------for localization ----------  navigation menu ------------------
$setLocale ='';
if(isset($_COOKIE['locale_php'])) {
    $locale = $_COOKIE['locale_php'];
    setcookie ( 'locale_php', $locale,time()+3600*24*30, '/');
    App::setLocale($locale);
}
//------------------end ** for localization ----------  navigation menu ------------------
$navigation->setFromArray([
//    [
//        'title' => trans('admin.navigation.dashboard'),
//        'icon'  => 'fa fa-dashboard',
//        'url'   => url('/admin'),
//        'accessLogic' => function() {
//            return auth()->user()->isAdmin();
//        }
//    ],
    [
        'title' => trans('admin.navigation.main_config'),
        'icon'  => 'fa fa-dashboard',
        'pages'  => [
            (new Page(\App\MainConfig::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
            ->setTitle(trans('admin.navigation.main_config')),
            (new Page(\App\Language::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setTitle(trans('admin.navigation.languages')),
            (new Page(\App\Type::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setTitle(trans('admin.navigation.types')),
            (new Page(\App\Schedule::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setTitle(trans('admin.navigation.schedules')),
            (new Page(\App\ClassStatus::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setTitle(trans('admin.navigation.class_statuses')),
            (new Page(\App\ClassLevel::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setTitle(trans('admin.navigation.class_levels')),
            (new Page(\App\Country::class))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setTitle(trans('admin.navigation.countries'))



        ],
//                'id'=>'main_config',
//        'url'   => url('/admin/main_configs/1/edit'),
        'accessLogic' => function() {
            return auth()->user()->isAdmin();
        }
    ],
    [
        'title' =>  trans('admin.navigation.pages_contents'),
        'icon'  => 'fa fa-book',
        'url'   => url('/admin'),
        'pages' => [
            (new Page(\App\Layout::class))
                ->setTitle(trans('admin.navigation.layouts'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Page::class))
                ->setTitle(trans('admin.navigation.pages'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Header::class))
                ->setTitle(trans('admin.navigation.headers'))
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setAccessLogic(function() {
                    return auth()->user()->isAdmin();
                    }),
            (new Page(\App\Footer::class))
                ->setTitle(trans('admin.navigation.footers'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Content::class))
                ->setTitle(trans('admin.navigation.contents'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\View::class))
                ->setTitle(trans('admin.navigation.views'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Menu::class))
                ->setTitle(trans('admin.navigation.menus'))
                ->setId('navigation_menu')
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setUrl(url('/admin/menus'))
         ],
        'accessLogic' => function() {
            return auth()->user()->isAdmin();
        }
    ],
    [
        'title' => trans('admin.navigation.business'),
        'icon' => 'fa fa-group',
        'priority' =>'10000',
        'pages' => [
            (new Page(\App\Subscribe::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.subscriptions'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\UserHasSubscribe::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.users_subscriptions'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\Lesson::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.lessons'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\Group::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.groups'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\Discount::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.discounts'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\Promo::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.promos'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
        ]
    ],
    [
        'title' => trans('admin.navigation.modules'),
        'icon' => 'fa fa-group',
        'priority' =>'10000',
        'pages' => [
            (new Page(\App\Slider::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.sliders'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\SocialLink::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.social_links'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\News::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.news'))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\PageHasNews::class))
                ->setTitle(trans('admin.navigation.news_config'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Review::class))
                ->setTitle(trans('admin.navigation.reviews'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Faq::class))
                ->setTitle(trans('admin.navigation.faqs'))
                ->setIcon('fa fa-clone')
                ->setPriority(100),
            (new Page(\App\Form::class))
                ->setTitle(trans('admin.navigation.forms'))
                ->setId('navigation_form')
                ->setIcon('fa fa-clone')
                ->setPriority(100)
                ->setUrl(url('/admin/forms'))
//            [
//                'title' => trans('admin.navigation.news_config'),
//                'icon'  => 'fa fa-dashboard',
//        'pages'  => [(new Page(\App\PageHasNews::class))
//                ->setIcon('fa fa-clone')
//                ->setPriority(100),],
////                'url'   => url('/admin/page_has_news/1/edit'),
//                'accessLogic' => function() {
//                    return auth()->user()->isAdmin();
//                }
//            ]
        ]
    ],
    [
        'title' => trans('admin.navigation.permissions'),
        'icon' => 'fa fa-group',
        'priority' =>'10000',
        'id'=> 'permissions',
        'pages' => [
//            (new Page(\App\User::class))
//                ->setTitle(trans('admin.navigation.users'))
//                ->setIcon('fa fa-user')
//                ->setId('users')
//                ->setPriority(0),
//            (new Page(\App\User::class))
//                ->setTitle(trans('admin.navigation.employees'))
//                ->setIcon('fa fa-user')
//                ->setId('employees')
//                ->setPriority(0),
            (new Page(\App\Role::class))
                ->setTitle(trans('admin.navigation.roles'))
                ->setIcon('fa fa-group')
                ->setPriority(100),
            (new Page(\App\Teacher::class))
                ->setHtmlAttribute('class', 'table-responsive')
                ->setTitle(trans('admin.navigation.teachers'))
                ->setIcon('fa fa-user')
                ->setPriority(0),

        ]
    ],
    [
        'title' => trans('admin.navigation.payment_systems'),
        'icon' => 'fa fa-money',
        'priority' =>'12000',
        'pages' => [
            (new Page(\App\PaymentSystem::class))
                ->setIcon('fa fa-id-card-o')
                ->setPriority(10),
            (new Page(\App\PaymentSystemConfig::class))
                ->setIcon('fa fa-cog')
                ->setPriority(10),
            (new Page(\App\PaymentSystemNotification::class))
                ->setIcon('fa fa-envelope')
                ->setPriority(10),
            (new Page(\App\PaymentSystemTransaction::class))
                ->setIcon('fa fa-link')
                ->setPriority(17)
        ]
    ]

]);
$page = \AdminNavigation::getPages()->findById('navigation_menu');
$page->addPage(

    (new Page(\App\Menu::class))
        ->setTitle(trans('admin.navigation.menus'))
        ->setIcon('fa fa-clone')
        ->setPriority(10)
);
$page->addPage(
    (new Page(\App\Item::class))
        ->setTitle(trans('admin.navigation.items'))
        ->setIcon('fa fa-clone')
        ->setPriority(20)
);
$page->addPage(
    (new Page(\App\Subitem::class))
        ->setTitle(trans('admin.navigation.subitems'))
        ->setIcon('fa fa-clone')
        ->setPriority(30)
);

$page = \AdminNavigation::getPages()->findById('navigation_form');
$page->addPage(

    (new Page(\App\Form::class))
        ->setTitle(trans('admin.navigation.forms'))
        ->setIcon('fa fa-clone')
        ->setPriority(10)
);
$page->addPage(
    (new Page(\App\Field::class))
        ->setTitle(trans('admin.navigation.fields'))
        ->setIcon('fa fa-clone')
        ->setPriority(20)
);
//$page->addPage(
//    (new Page(\App\Subitem::class))
//        ->setTitle(trans('admin.navigation.subitems'))
//        ->setIcon('fa fa-clone')
//        ->setPriority(30)
//);

//dd($navigation);
