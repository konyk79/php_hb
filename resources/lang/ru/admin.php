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
    //navigation:
    'attach_after_create' => 'Вы сможете связать все связанные сущности после создания записи',
    'copy' => 'Копировать',
    'terminate_subscription'=> 'Отменить подписку',
    'force_terminate_subscription' =>  'Принудительная отмена подписки',
    'navigation' =>[
        'users_subscriptions' => 'Подписки пользователей',
        'faqs' => 'Часто задаваемые вопросы',
        'reviews' => 'Отзывы',
        'countries' => 'Страны',
        'class_levels' => 'Уровень занятий',
        'class_statuses' => 'Статусы занятий',
        'schedules'=> 'Регионы графиков',
        'types'=> 'Типы',
        'promos' => 'Акции',
        'discounts' => 'Скидки',
        'groups' => 'Группы',
        'languages' => 'Языки',
        'teachers' => 'Учителя',
        'dashboard' => 'Панель управления',
        'main_config' => 'Общие настройки',
        'pages_contents' => 'Страницы и содержание',
        'pages' => 'Страницы',
        'layouts' => 'Лэйауты',
        'headers' => 'Заголовки страниц',
        'footers' => 'Футеры',
        'contents' => 'Блоки содержания',
        'views' => 'Отображения',
        'subscriptions' => 'Подписки',
        'business' => 'Бизнес логика',
        'permissions' => 'Доступа',
        'payment_systems' => 'Платежные системы',
        'users' => 'Пользователи',
        'roles' => 'Роли',
        'lessons' => 'Занятия',
        'menus' => 'Меню',
        'items' => 'Пункты меню',
        'subitems' => 'Подпункты меню',
        'modules' => 'Модули',
        'sliders' => 'Слайдеры',
        'news'=> 'Новости',
        'news_config' => 'Настройки новостей',
        'social_links' => 'Социальные сети',
        'forms' => 'Формы',
        'fields' => 'Поля',
    ],
    //******************************************************************************************
    //  Pages:
    'type' => 'Тип',
    'show'=>'отображать',
    'hide'=>'скрыть',
    'yes'=>'да',
    'no'=>'нет',
    'name'=>'Название (ключ)',
    'title'=>'Оглавление',
    'favicon_title'=>'Фавикон оглавление',
    'headers' => 'Заголовки',
    'contents' => 'Блоки содержимого',
    'layout' => 'Шаблон',
    'footers'=> 'Футеры',
    'visible' => 'Видимость',
    'view' => 'Отображение',
    'term' => 'Срок действия',
    'days' => 'дней(я)',
    'months' => 'месяцев(а)',
    'weeks' => 'недели(ь)',
    'minutes' => 'минут(а)',
    'hours' => 'часов(а)',
    'seconds' => 'секунд(а)',
    'expired_date' => 'Дата окончания',
    'groups' =>'Группы',
    'priority' => 'Позиция',
    'status'=> 'Статус',
    'menus'=> 'Меню',
    'href_type' => 'Тип ссылки',
    'href' => 'Ссылка',
    'code' => 'Код',
    //subscriptions
    'subscriptions' =>[
        'price'=> 'Цена $',
        'discount'=>'Скидка',
        'description' => 'Описание',
        'promos'=>'Промо акции',
        'term_text' => 'Срок тектом(прописью тот же срок что и в поле Срок выше)',
        'term' => 'Срок(пример: 3D - 3 дня, 1М - 1 месяц, 2W -недели)',
        'is_auto_prolangate'=> 'Авто платеж',
        'is_active' => 'Активная',
        'trial_term' => 'Тестовый период(пример: 3D - 3 дня)',
        'expires_for' => 'Действительная до',
        'num_classes' => 'Количество уроков'
    ],
    //lessons :
    'lessons' => [
        'teacher' => 'Учитель',
        'schedule' => 'График',
        'term' => 'Срок(пример: 1М - 1 минута)',
        'level'=> 'Уровень',
        'language'=> 'Язык',
        'start_time'=> 'Время начала (UTC)',
        'color'=> 'Цвет',
    ],
    //menu :
    'menu' => [
        'items' => 'Пункт меню',
        'href_type' => 'Тип ссылки (_blank в новом окне, _self в собственном)',
        'href' => 'Линк',
        'title' => 'Оглавление пункта меню',
        'item' => 'Родительский элемент',

    ],
    //forms :
    'form' => [
        'fields' => 'Поля формы',
        'model' => 'Сыязанная модель',
        'action' => 'Действие формы',
        'method' => 'Метод',
        'submit_title' => 'Заголовок принятия',
        'cancel_title' => 'Заголовок отмены',
        'error_text' => 'Текст ошибки',
        'success_text' => 'Текст успешного выполнения',
        'body_text' => 'Описание формы',
        'nullable' => 'Может быть пустым',
        'required' => 'Объязательное',
        'label' => 'Метка',
        'placeholder' => 'Заполнитель',
        'type' => 'Тип поля',
        'unique' => 'Уникальное',
        'form' => 'Форма',

    ],
    //content, news, sliders :
    'content' => [
        'video' => 'Видео (путь)',
        'image' => 'Картинка (путь)',
        'href_title' => 'Название ссылки',
        'body' => 'Содержание',
        'contentable' => 'Родительский элемент',
        'description' => 'Описание',
    ],
    //main
    'parent_page' => 'Родительская страница',

        //main config:
    'lesson_cancel_timeout'=>'Таймаут отмены до начала урока(пример: 3M - 3 минуты, 1H - час)',
    'lesson_before_start_timeout'=>'Таймаут подключения(начала) до начала урока(пример: 3M - 3 минуты, 1H - час)',
    'lesson_after_start_timeout'=>'Таймаут подключения(начала) после начала урока(пример: 3M - 3 минуты, 1H - час)',
    'slider_timeout'=>'Таймаут слайдера на главной страничке (пример: 3S - 3 секунды)',
    'user_subscribe_timeout'=>'Таймаут подписки(ожидания следуещего платежа, пример: 3D - 3дня)',
        //pages:

];
