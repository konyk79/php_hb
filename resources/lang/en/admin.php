<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'attach_after_create' => 'You can attach all related entities after creation',
    'copy' => 'Copy',
    'terminate_subscription'=> 'Terminate subscription',
    'force_terminate_subscription' =>  'Force terminate subscription',
    'navigation' =>[
        'users_subscriptions' => 'User\'s subscriptions',
        'faqs' => 'FAQ\'s',
        'reviews' => 'Reviews',
        'countries' => 'Countries',
        'class_levels' => 'Class levels',
        'class_statuses' => 'Class statuses',
        'schedules'=> 'Schedule\'s regions',
        'types'=> 'Types',
        'promos' => 'Promotions',
        'discounts' => 'Discounts',
        'groups' => 'Groups',
        'languages' => 'Languages',
        'teachers' => 'Teacers',
        'dashboard' => 'Dashboard',
        'main_config' => 'Main Configuration',
        'pages_contents' => 'Pages and contents',
        'pages' => 'Pages',
        'layouts' => 'Layouts',
        'headers' => 'Headers',
        'footers' => 'Footers',
        'contents' => 'Contents',
        'views' => 'Views',
        'subscriptions' => 'Subscriptions',
        'business' => 'Business options',
        'permissions' => 'Permissions',
        'payment_systems' => 'Payment systems',
        'users' => 'Users',
        'roles' => 'Roles',
        'lessons' => 'Lessons',
        'menus' => 'Menus',
        'items' => 'Menu items',
        'subitems' => 'Menu sub items',
        'modules' => 'Modules',
        'sliders' => 'Sliders',
        'news'=> 'News',
        'news_config' => 'News configuration',
        'social_links' => 'Social links',
        'forms' => 'Forms',
        'fields' => 'Fields',
    ],

    //******************************************************************************************
    //  Pages:
    'type' => 'Type',
    'show'=>'Show',
    'hide'=>'Hide',
    'yes'=>'yes',
    'no'=>'no',
    'name'=>'Name (key)',
    'title'=>'Title',
    'favicon_title'=>'Favicon title',
    'headers' => 'Headers',
    'contents' => 'Contents',
    'layout' => 'Layout',
    'footers'=> 'Footers',
    'visible' => 'Visible',
    'view' => 'View',
    'term' => 'Term',
    'days' => 'days',
    'months' => 'months',
    'weeks' => 'weeks',
    'minutes' => 'minutes',
    'hours' => 'hours',
    'seconds' => 'seconds',
    'expired_date' => 'Expired Date',
    'groups' =>'Groups',
    'priority' => 'Sort',
    'status'=> 'Status',
    'menus'=> 'Menus',
    'href_type' => 'Link type',
    'href' => 'Link',
    'code' => 'Code',
    //subscriptions
        'subscriptions' =>[
            'price'=> 'Price $',
            'discount'=>'Discount',
            'description' => 'Description',
            'promos'=>'Promos',
            'term_text' => 'Term text (text analog of Term field above this)',
            'term' => 'Term(exemple: 3D - 3 days, 1М - 1 month, 2W -weeks)',
            'is_auto_prolangate'=> 'Recurring',
            'is_active' => 'Active',
            'trial_term' => 'Trial term(exemple: 3D - 3 days)',
            'expires_for' => 'Expires For',
            'num_classes' => 'Number  of classes'

        ],
    //lessons :
    'lessons' => [
        'teacher' => 'Teacher',
        'schedule' => 'Schedule',
        'term' => 'Term(exemple: 1М - 1 minute)',
        'level'=> 'Level',
        'language'=> 'Language',
        'start_time'=> 'Start Time (UTC)',
        'color'=> 'Color',
    ],
    //menus :
    'menu' => [
        'items' => 'Menu items',
        'href_type' => 'Link type (_self, _blank)',
        'href' => 'Link',
        'title' => 'Menu item title',
        'subitems' => 'Вложенные элементы меню',
        'item' => 'Parent item',

    ],
    //forms :
    'form' => [
        'fields' => 'Form fields',
        'model' => 'Related model',
        'action' => 'Form action',
        'method' => 'Method',
        'submit_title' => 'Submit title',
        'cancel_title' => 'Cancel title',
        'error_text' => 'Error_text',
        'success_text' => 'Success text',
        'body_text' => 'Form description text',
        'nullable' => 'Is nullable',
        'required' => 'Is required',
        'label' => 'Label',
        'placeholder' => 'Placeholder',
        'type' => 'Field type',
        'unique' => 'Unique',
        'form' => 'Form',

    ],
    //content, news, sliders :
    'content' => [
        'video' => 'Video (path)',
        'image' => 'Image (path)',
        'href_title' => 'Link title',
        'body' => 'Body',
        'contentable' => 'Parent item',
        'description' => 'Description',
    ],
    //main
    'parent_page' => 'Parent page',

    //main config:
    'lesson_cancel_timeout'=>'enТаймаут отмены до начала урока(пример: 3M - 3 минуты, 1H - час)',
    'lesson_before_start_timeout'=>'enТаймаут подключения(начала) до начала урока(пример: 3M - 3 минуты, 1H - час)',
    'lesson_after_start_timeout'=>'enТаймаут подключения(начала) после начала урока(пример: 3M - 3 минуты, 1H - час)',
    'slider_timeout'=>'enТаймаут слайдера на главной страничке (пример: 3S - 3 секунды)',
    'user_subscribe_timeout'=>'enТаймаут подписки(ожидания следуещего платежа, пример: 3D - 3дня)',

];
