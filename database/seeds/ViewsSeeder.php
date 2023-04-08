<?php
use App\View;

use Illuminate\Database\Seeder;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $views=array();
    public function run()
    {
        self::$views['mainView'] = View::create([
            'name' => 'pages.main',
        ])->id;
        self::$views['mainFooter'] = View::create([
            'name' => 'footers.main',
        ])->id;
        self::$views['topMenuHeader'] = View::create([
            'name' => 'headers.top_menu',
        ])->id;
        self::$views['mainHeader'] = View::create([
            'name' => 'headers.main',
        ])->id;
        self::$views['publicLayout'] = View::create([
            'name' => 'layouts.app',
        ])->id;
        self::$views['dashboardLayout'] = View::create([
            'name' => 'layouts.dashboard',
        ])->id;
        self::$views['publicFooter'] = View::create([
            'name' => 'footers.app_footer',
        ])->id;
        self::$views['contactPhoneFooter'] = View::create([
            'name' => 'footers.contact_phone',
        ])->id;
        self::$views['mainMenu'] = View::create([
            'name' => 'menus.main',
        ])->id;
        self::$views['footerMenu'] = View::create([
            'name' => 'menus.footer',
        ])->id;
        self::$views['newsPage'] = View::create([
            'name' => 'pages.news',
        ])->id;
        self::$views['publicHeader'] = View::create([
            'name' => 'headers.public',
        ])->id;
        self::$views['reviewsPage'] = View::create([
            'name' => 'pages.reviews',
        ])->id;
        self::$views['oneNewsPage'] = View::create([
            'name' => 'pages.onenews',
        ])->id;
        self::$views['newsSubscribeForm'] = View::create([
            'name' => 'forms.news_subscribe',
        ])->id;
        self::$views['contactsForm'] = View::create([
            'name' => 'forms.contacts',
        ])->id;
        self::$views['benefitPage'] = View::create([
            'name' => 'pages.benefit',
        ])->id;
        self::$views['contactFooter'] = View::create([
            'name' => 'footers.contact',
        ])->id;
        self::$views['classesPage'] = View::create([
            'name' => 'pages.classes',
        ])->id;
        self::$views['subscribePage'] = View::create([
            'name' => 'pages.dashboard.subscribe',
        ])->id;
        self::$views['teamPage'] = View::create([
            'name' => 'pages.team',
        ])->id;
        self::$views['contactsPage'] = View::create([
            'name' => 'pages.contacts',
        ])->id;
        self::$views['loginPage'] = View::create([
            'name' => 'auth.login',
        ])->id;
        self::$views['unconfirmedEmailPage'] = View::create([
            'name' => 'auth.unconfirmed_email',
        ])->id;
        self::$views['registeredPage'] = View::create([
            'name' => 'auth.registered',
        ])->id;
        self::$views['registerPage'] = View::create([
            'name' => 'auth.register',
        ])->id;
        self::$views['registerForm'] = View::create([
            'name' => 'forms.register',
        ])->id;
        self::$views['profilePage'] = View::create([
            'name' => 'pages.dashboard.profile',
        ])->id;
        self::$views['profileForm'] = View::create([
            'name' => 'forms.profile',
        ])->id;
        self::$views['mySubscribesPage'] = View::create([
            'name' => 'pages.dashboard.my_subscribes',
        ])->id;
        self::$views['myClassesPage'] = View::create([
            'name' => 'pages.dashboard.my_classes',
        ])->id;
        self::$views['schedulePage'] = View::create([
            'name' => 'pages.dashboard.schedule',
        ])->id;
        self::$views['subscribeOrderPage'] = View::create([
            'name' => 'pages.dashboard.subscribe_order',
        ])->id;
        self::$views['subscribePreviewPage'] = View::create([
            'name' => 'pages.dashboard.subscribe_preview',
        ])->id;
        self::$views['stripePaymentPage'] = View::create([
            'name' => 'payment.paywithstripe',
        ])->id;
    }
}
