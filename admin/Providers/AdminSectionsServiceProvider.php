<?php

namespace Admin\Providers;

use Admin\Http\Sections\Contacts;
use Config;
use Illuminate\Routing\Router;
use SleepingOwl\Admin\Contracts\Navigation\NavigationInterface;
use SleepingOwl\Admin\Contracts\Template\MetaInterface;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Factories\FormElementFactory;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $widgets = [
        \Admin\Widgets\DashboardMap::class,
        \Admin\Widgets\NavigationNotifications::class,
        \Admin\Widgets\NavigationUserBlock::class,
    ];

    /**
     * @var array
     */
    protected $sections = [


        'App\Role'                  => 'Admin\Http\Sections\Roles',
        'App\User'                  => 'Admin\Http\Sections\Users',
        'App\Page'            => 'Admin\Http\Sections\Pages',
        'App\Header'            => 'Admin\Http\Sections\Headers',
        'App\PaymentSystem'            => 'Admin\Http\Sections\PaymentSystems',
        'App\PaymentSystemNotification'            => 'Admin\Http\Sections\PaymentSystemNotifications',
        'App\PaymentSystemConfig' => 'Admin\Http\Sections\PaymentSystemConfigs',
        'App\PaymentSystemTransaction' => 'Admin\Http\Sections\PaymentSystemTransactions',
        'App\MainConfig'             => 'Admin\Http\Sections\MainConfigs',
        'App\Subscribe'            => 'Admin\Http\Sections\Subscribes',
        'App\Lesson'            => 'Admin\Http\Sections\Lessons',
        'App\Footer'            => 'Admin\Http\Sections\Footers',
        'App\Content'           => 'Admin\Http\Sections\Contents',
        'App\Menu'           => 'Admin\Http\Sections\Menus',
        'App\Item'           => 'Admin\Http\Sections\Items',
        'App\Subitem'           => 'Admin\Http\Sections\Subitems',
        'App\Layout'           => 'Admin\Http\Sections\Layouts',
        'App\View'           => 'Admin\Http\Sections\Views',
        'App\Slider'           => 'Admin\Http\Sections\Sliders',
        'App\News'           => 'Admin\Http\Sections\SectionNews',
        'App\PageHasNews'           => 'Admin\Http\Sections\NewsConfigs',
        'App\SocialLink'           => 'Admin\Http\Sections\SocialLinks',
        'App\Form'           => 'Admin\Http\Sections\Forms',
        'App\Field'           => 'Admin\Http\Sections\Fields',
        'App\Teacher'           => 'Admin\Http\Sections\Teachers',
        'App\Language'           => 'Admin\Http\Sections\Languages',
        'App\Group'           => 'Admin\Http\Sections\Groups',
        'App\Promo'           => 'Admin\Http\Sections\Promos',
        'App\Discount'           => 'Admin\Http\Sections\Discounts',
        'App\Type'           => 'Admin\Http\Sections\Types',
        'App\Schedule'           => 'Admin\Http\Sections\Schedules',
        'App\ClassStatus'           => 'Admin\Http\Sections\ClassStatuss',
        'App\ClassLevel'           => 'Admin\Http\Sections\ClassLevels',
        'App\Country'           => 'Admin\Http\Sections\Countrys',
        'App\Review'           => 'Admin\Http\Sections\Reviews',
        'App\Faq'           => 'Admin\Http\Sections\Faqs',
        'App\UserHasSubscribe'           => 'Admin\Http\Sections\UserHasSubscribes',
//        'App\Model\DataTables\NewsEditableColumns' => 'Admin\Http\Sections\DataTables\EditableColumns',
//        'App\Model\DataTables\NewsRefreshAsync'    => 'Admin\Http\Sections\DataTables\RefreshAsync',
//        'App\Model\DataTables\NewsActions'         => 'Admin\Http\Sections\DataTables\Actions',
//        'App\Model\DataTables\CountryStopPageRefresh' => 'Admin\Http\Sections\DataTables\StopPageRefresh',

    ];

    public function register()
    {
        //$this->mergeConfigFrom(__DIR__.'/../../config/sleeping_owl.php', 'sleeping_owl');
    }
    /**
     * @param \SleepingOwl\Admin\Admin $admin
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
//        dump(base_path('admin/public/css'));
//        dd( public_path('packages/sleepingowl/default/css'));
       ($this->publishes([
           base_path('admin/public/css') => public_path('packages/sleepingowl/default/css'),
        ], 'admin-custom'));
        ($this->publishes([
            base_path('admin/public/js') => public_path('packages/sleepingowl/default/js'),
        ], 'admin-custom'));
        $this->loadViewsFrom(base_path("admin/resources/views"), 'admin');
        $this->registerPolicies('Admin\\Policies\\');

        $this->app->call([$this, 'registerRoutes']);
        $this->app->call([$this, 'registerNavigation']);

        parent::boot($admin);

//        $this->publishes([
//            __DIR__.'/../../config/sleeping_owl.php' => config_path('sleeping_owl.php'),
//        ], 'config');
//        Config::set(['sleeping_owl.middleware'=> ['web','admin']]);  // here because don`t work from config
        //register new form Element its very important be after parent constructor run
        $this->app->get('sleeping_owl.form.element')
            -> add('translatabletext', \Admin\Form\Element\TranslatableText::class)
            -> add('translatabletextarea', \Admin\Form\Element\TranslatableTextArea::class)
            -> add('multiselect', \Admin\Form\Element\MultiSelectCustom::class);

        $this->app->call([$this, 'registerViews']);
        $this->app->call([$this, 'registerMediaPackages']);
    }

    /**
     * @param NavigationInterface $navigation
     */
    public function registerNavigation(NavigationInterface $navigation)
    {
        require base_path('admin/navigation.php');
    }

    /**
     * @param WidgetsRegistryInterface $widgetsRegistry
     */
    public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
    {
        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }
    }

    /**
     * @param Router $router
     */
    public function registerRoutes(Router $router)
    {
        $router->group(['prefix' => config('sleeping_owl.url_prefix'), 'middleware' => config('sleeping_owl.middleware')], function ($router) {
            require base_path('admin/Http/routes.php');
        });
    }

    /**
     * @param MetaInterface $meta
     */
    public function registerMediaPackages(MetaInterface $meta)
    {
        $packages = $meta->assets()->packageManager();

        require base_path('admin/assets.php');
    }
}
