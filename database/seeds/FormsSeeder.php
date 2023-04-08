<?php

use App\Field;
use App\Form;
use App\Formable;
use Illuminate\Database\Seeder;

class FormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $forms=array();
    public function run()
    {
        // news subscribe form
        self::$forms['newsSubscribeForm'] =Form::create([
            'name' => 'news_subscribe',
            'view_id'=> ViewsSeeder::$views['newsSubscribeForm'],
            'action' => url('/news/subscribe'),
            'model' => App\NewsSubscribe::class,
            'ru' => [
                'title'=> 'Будьте в курсе наших новостей',
                'error_text'=> 'Вы уже подписанны на данную рассылку',
                'success_text'=> 'Вы успешно подписанны на рассылку'
            ],
            'en' => [
                'title'=> 'Keep abreast of the our news',
                'error_text'=> 'You have subscribed already',
                'success_text'=> 'Success!!!'

            ]
        ])->id;
        Field::create([
            'name' => 'email',
            'form_id'=> self::$forms['newsSubscribeForm'],
            'type' => 'string',
            'required'=> true,
            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Ваш e-mail'
            ],
            'en' => [
                'placeholder'=> 'Your e-mail'
            ]
        ]);
        Formable::create([
            'form_id' => self::$forms['newsSubscribeForm'],
            'formable_id' => PagesSeeder::$pages['newsPage'],
            'formable_type' =>  App\Page::class
        ]);
        //--------------------end news subscribe form
        // contacts form
        self::$forms['contactsForm'] =Form::create([
            'name' => 'contacts_form',
            'view_id'=> ViewsSeeder::$views['contactsForm'],
            'action' => url('/contacts'),
//            'model' => App\NewsSubscribe::class,
            'ru' => [
                'title'=> 'Контакты',
                'error_text'=> 'Возникла проблемма при отправке сообщения',
                'success_text'=> 'Ваше сообщение успешно отправленно'
            ],
            'en' => [
                'title'=> 'Contacts',
                'error_text'=> 'Your message sending failed',
                'success_text'=> 'Your message has sent successfully'

            ]
        ])->id;
        Field::create([
            'name' => 'name',
            'form_id'=> self::$forms['contactsForm'],
            'type' => 'string',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Ваше имя'
            ],
            'en' => [
                'placeholder'=> 'Your Name'
            ]
        ]);
        Field::create([
            'name' => 'email',
            'form_id'=> self::$forms['contactsForm'],
            'type' => 'string',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Ваш e-mail'
            ],
            'en' => [
                'placeholder'=> 'Your e-mail'
            ]
        ]);
        Field::create([
            'name' => 'subject',
            'form_id'=> self::$forms['contactsForm'],
            'type' => 'string',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Тема сообщения'
            ],
            'en' => [
                'placeholder'=> 'Subject'
            ]
        ]);
        Field::create([
            'name' => 'body',
            'form_id'=> self::$forms['contactsForm'],
            'type' => 'text',
            'element'=> 'textarea',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Ваше сообщение'
            ],
            'en' => [
                'placeholder'=> 'Your message'
            ]
        ]);
        Formable::create([
            'form_id' => self::$forms['contactsForm'],
            'formable_id' => PagesSeeder::$pages['contactsPage'],
            'formable_type' =>  App\Page::class
        ]);
        //--------------------end news subscribe form

        // register form    ==========================================
        self::$forms['registerForm'] =Form::create([
            'name' => 'register_form',
            'view_id'=> ViewsSeeder::$views['registerForm'],
            'action' => url('/register'),
            'model' => App\User::class,
            'ru' => [
                'title'=> 'Регистрация',
                'error_text'=> 'Пароль или логин не совпадают.',
                'submit_title'=> 'Зарегистрироваться',
//                'success_text'=> 'Ваше сообщение успешно отправленно'
            ],
            'en' => [
                'title'=> 'Contacts',
                'error_text'=> 'These credentials do not match our records.',
                'submit_title'=> 'Sign Up',
//                'success_text'=> 'Your message has sent successfully'

            ]
        ])->id;
        Field::create([
            'name' => 'name',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> true,
            'priority' =>8,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Имя'
            ],
            'en' => [
                'placeholder'=> 'Name'
            ]
        ]);
        Field::create([
            'name' => 'last_name',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Фамилия'
            ],
            'en' => [
                'placeholder'=> 'Last Name'
            ]
        ]);
        Field::create([
            'name' => 'email',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'E-mail'
            ],
            'en' => [
                'placeholder'=> 'E-mail'
            ]
        ]);
        Field::create([
            'name' => 'phone',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Телефон'
            ],
            'en' => [
                'placeholder'=> 'Phone'
            ]
        ]);
        Field::create([
            'name' => 'country_id',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'integer',
            'element' => 'own',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Страна'
            ],
            'en' => [
                'placeholder'=> 'Country'
            ]
        ]);
        Field::create([
            'name' => 'password',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'password',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Пароль'
            ],
            'en' => [
                'placeholder'=> 'Password'
            ]
        ]);
        Field::create([
            'name' => 'password_confirmation',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'none',
            'element' => 'password',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Повторите пароль'
            ],
            'en' => [
                'placeholder'=> 'Repeat Password'
            ]
        ]);
        Field::create([
            'name' => 'type_id',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'integer',
            'element' => 'own',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Тип регистрации'
            ],
            'en' => [
                'placeholder'=> 'Registration Type'
            ]
        ]);
        Field::create([
            'name' => 'corporate_name',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Название Организации'
            ],
            'en' => [
                'placeholder'=> 'Corporate Name'
            ]
        ]);
        Field::create([
            'name' => 'corporate_web',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
//            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Веб сайт организации'
            ],
            'en' => [
                'placeholder'=> 'Corporate Web'
            ]
        ]);
//        Field::create([
//            'name' => 'remember_me',
//            'form_id'=> self::$forms['registerForm'],
//            'type' => 'none',
//            'element' => 'checkbox',
//            //'required'=> true,
////            'unique'=> true,
//            'ru' => [
//                'placeholder'=> 'Запомнить меня'
//            ],
//            'en' => [
//                'placeholder'=> 'Remember me'
//            ]
//        ]);
        Field::create([
            'name' => 'middle_name',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> false,
            'priority' =>9,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Отчество'
            ],
            'en' => [
                'placeholder'=> 'Middle Name'
            ]
        ]);
        Field::create([
            'name' => 'confirmed',
            'form_id'=> self::$forms['registerForm'],
            'type' => 'none',
            'element' => 'checkbox',
            'required'=> true,
            'priority' =>100,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Принимаю соглашение'
            ],
            'en' => [
                'placeholder'=> 'Accept policies'
            ]
        ]);
        Formable::create([
            'form_id' => self::$forms['registerForm'],
            'formable_id' => PagesSeeder::$pages['registerPage'],
            'formable_type' =>  App\Page::class
        ]);
        //--------------------end register form
        // profile form    ==========================================
        self::$forms['profileForm'] =Form::create([
            'name' => 'profile_form',
            'view_id'=> ViewsSeeder::$views['profileForm'],
            'action' => url('/dashboard/profile'),
            'model' => App\User::class,
            'ru' => [
                'title'=> 'Профайл',
                'error_text'=> 'Пароль или логин не совпадают.',
                'submit_title'=> 'Обновить инфо',

//                'success_text'=> 'Ваше сообщение успешно отправленно'
            ],
            'en' => [

                'title'=> 'Profile',
                'error_text'=> 'These credentials do not match our records.',
                'submit_title'=> 'Save data',
//                'success_text'=> 'Your message has sent successfully'

            ]
        ])->id;
        Field::create([
            'name' => 'name',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
//            'required'=> true,
            'priority' =>2,
            'readonly' =>true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Имя',
                'label' => 'Имя',
            ],
            'en' => [
                'placeholder'=> 'Name',
                'label' => 'Name',
            ]
        ]);
        Field::create([
            'name' => 'last_name',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
//            'required'=> true,
            'priority' =>3,
            'readonly' =>true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Фамилия',
                'label' => 'Фамилия',
            ],
            'en' => [
                'placeholder'=> 'Last Name',
                'label' => 'Last Name',
            ]
        ]);
        Field::create([
            'name' => 'email',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
//            'required'=> true,
            'priority' =>4,
            'readonly' =>true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'E-mail',
                'label' => 'E-mail',
            ],
            'en' => [
                'placeholder'=> 'E-mail',
                'label' => 'E-mail',
            ]
        ]);
        Field::create([
            'name' => 'phone',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
//            'required'=> false,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Телефон',
                'label' => 'Телефон',
            ],
            'en' => [
                'placeholder'=> 'Phone',
                'label' => 'Phone',
            ]
        ]);
        Field::create([
            'name' => 'country_id',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'integer',
            'element' => 'own',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Страна',
                'label' => 'Страна',
            ],
            'en' => [
                'placeholder'=> 'Country',
                'label' => 'Country',
            ]
        ]);
        Field::create([
            'name' => 'password',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'password',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Пароль',
                'label' => 'Пароль',
            ],
            'en' => [
                'placeholder'=> 'Password',
                'label' => 'Password',
            ]
        ]);
        Field::create([
            'name' => 'password_confirmation',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'none',
            'element' => 'password',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Повторите пароль',
                'label' => 'Повторите пароль',
            ],
            'en' => [
                'placeholder'=> 'Repeat Password',
                'label' => 'Repeat Password',
            ]
        ]);
        Field::create([
            'name' => 'type_id',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'integer',
            'element' => 'own',
            'readonly' =>true,
//            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Тип регистрации',
                'label' => 'Тип регистрации',
            ],
            'en' => [
                'placeholder'=> 'Registration Type',
                'label' => 'Registration Type',
            ]
        ]);
        Field::create([
            'name' => 'corporate_name',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Название Организации',
                'label' => 'Название Организации',
            ],
            'en' => [
                'placeholder'=> 'Corporate Name',
                'label' => 'Corporate Name',
            ]
        ]);
        Field::create([
            'name' => 'corporate_web',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
//            'required'=> true,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Веб сайт организации',
                'label' => 'Веб сайт организации',
            ],
            'en' => [
                'placeholder'=> 'Corporate Web',
                'label' => 'Corporate Web',
            ]
        ]);
//        Field::create([
//            'name' => 'remember_me',
//            'form_id'=> self::$forms['registerForm'],
//            'type' => 'none',
//            'element' => 'checkbox',
//            //'required'=> true,
////            'unique'=> true,
//            'ru' => [
//                'placeholder'=> 'Запомнить меня'
//            ],
//            'en' => [
//                'placeholder'=> 'Remember me'
//            ]
//        ]);
        Field::create([
            'name' => 'middle_name',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'string',
            'element' => 'text',
            'required'=> false,
            'priority' =>9,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Отчество',
                'label' => 'Отчество',
            ],
            'en' => [
                'placeholder'=> 'Middle Name',
                'label' => 'Middle Name',
            ]
        ]);
        Field::create([
            'name' => 'about_me',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'text',
            'element' => 'textarea',
            'required'=> true,
            'priority' =>100,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Обо мне',
                'label' => 'Обо мне',
            ],
            'en' => [
                'placeholder'=> 'About me',
                'label' => 'About me',
            ]
        ]);
        Field::create([
            'name' => 'photo',
            'form_id'=> self::$forms['profileForm'],
            'type' => 'text',
            'element' => 'own',
            'required'=> false,
            'priority' =>1,
//            'unique'=> true,
            'ru' => [
                'placeholder'=> 'Фото',
//                'label' => 'Download Фото',
            ],
            'en' => [
                'placeholder'=> 'Photo',
//                'label' => 'Download photo',
            ]
        ]);
        Formable::create([
            'form_id' => self::$forms['profileForm'],
            'formable_id' => PagesSeeder::$pages['profilePage'],
            'formable_type' =>  App\Page::class
        ]);
        //--------------------end register form
    }
}
