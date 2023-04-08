<?php

use App\Content;
use Illuminate\Database\Seeder;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public $contents = array();

    public function run()
    {
        self::$contents['topMenuDashboard'] = Content::create([
            'name' => 'dashboard',
            'contentable_id' => HeadersSeeder::$headers['topMenuHeader'],
            'contentable_type' => \App\Header::class,
            'ru' => ['body' => "Личный кабинет"],
            'en' => ['body' => "Profile"]
        ])->id;
        self::$contents['topMenuSignIn'] = Content::create([
            'name' => 'sign_in_text',
            'contentable_id' => HeadersSeeder::$headers['topMenuHeader'],
            'contentable_type' => \App\Header::class,
            'ru' => ['body' => "Войти"],
            'en' => ['body' => "Sign in"]
        ])->id;
        self::$contents['topMenuSignUp'] = Content::create([
            'name' => 'sign_up_text',
            'contentable_id' => HeadersSeeder::$headers['topMenuHeader'],
            'contentable_type' => \App\Header::class,
            'ru' => ['body' => "Зарегистрироваться"],
            'en' => ['body' => "Sign Up"]
        ])->id;
        self::$contents['topMenuLogout'] = Content::create([
            'name' => 'logout_text',
            'contentable_id' => HeadersSeeder::$headers['topMenuHeader'],
            'contentable_type' => \App\Header::class,
            'ru' => ['body' => "Выход"],
            'en' => ['body' => "Logout"]
        ])->id;
        // main header
        self::$contents['mainHeaderBlock'] = Content::create([
            'name' => 'main_header',
            'image' => '/img/header_bg.jpg',
            'contentable_id' => HeadersSeeder::$headers['mainHeader'],
            'contentable_type' => \App\Header::class,
            'href' => url('/classes'),
            'ru' => [
                'href_title' => "Занятия",
                'body' => "Гармоничное дыхание обеспечивает лучшее общее сердечно-сосудистое здоровье и более эффективное потребление кислорода. ",
                'title' => 'Улучшает функцию сердца и дыхания.',
            ],
            'en' => [
                'href_title' => "Classes",
                'body' => "Improves heart and respiratory function. Harmonious Breathing brings better overall cardiovascular health and more efficient oxygen intake. ",
                'title' => 'Improves heart and respiratory function. ',
            ]
        ])->id;

        self::$contents['mainHeaderMobileBackground'] = Content::create([
            'name' => 'main_header_mobile_img',
            'image' => '/img/heade_responsive.jpg',
            'contentable_id' => HeadersSeeder::$headers['mainHeader'],
            'contentable_type' => \App\Header::class,

        ])->id;
        // headers  breadcrumb
        self::$contents['buttonJoinBreadcrumb'] = Content::create([
            'name' => 'button_join',
            'contentable_id' => LayoutsSeeder::$layouts['publicLayout'],
            'contentable_type' => \App\Layout::class,
            'href' => url('/dashboard/subscribes'),
            'ru' => ['href_title' => "Присоедениться"],
            'en' => ['href_title' => "Join to us"]
        ])->id;
        //  pages
        //main page
        self::$contents['mainBenefits'] =Content::create([
            'name' => 'main_page_benefits',
            'image' => '/img/polza.jpg',
            'contentable_id' => PagesSeeder::$pages['mainPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('benefit'),
            'ru' =>[
                'body'=>"Делает вашу жизнь более спокойной, здоровой и продуктивной.
Преимущества полного дыхания были раскрыты на протяжении веков, особенно в Восточной культуре.",
                'title'=> 'Польза',
                'href_title'=>'Читать далее'
            ] ,
            'en' =>[
                'body'=>"A calmer, healthier, more productive life.
The benefits of complete breathing have been understood for centuries, particularly in Eastern cultures.",
                'title'=> 'The Benefits',
                'href_title'=>'More'
            ]
        ])->id;

        self::$contents['mainTeam'] =Content::create([
            'name' => 'main_page_team',
            'image' => '/img/team.jpg',
            'contentable_id' => PagesSeeder::$pages['mainPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/team'),
            'ru' =>[
                'body'=>"Наши преподаватели имеют многолетний опыт преподавания йоги и методики Гармоничного Дыхания.",
                'title'=> 'Наша команда',
                'href_title'=>'Подробно'
            ] ,
            'en' =>[
                'body'=>"Our teachers have years of experience in teaching yoga and, more recently, the principles of Harmonious Breathing.",
                'title'=> 'The Team',
                'href_title'=>'More'
            ]
        ])->id;

        self::$contents['mainOffers'] =Content::create([
            'name' => 'main_page_offers',
            'image' => '/img/accept.jpg',
            'contentable_id' => PagesSeeder::$pages['mainPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('classes'),
            'ru' =>[
                'body'=>"Мы можем предложить наиболее подходящий курс согласно вашим потребностям. Мы предлагаем как индивидуальные занятия так и занятия в маленьких группах.",
                'title'=> 'Что мы предлагаем?',
                'href_title'=>'Подробно'
            ] ,
            'en' =>[
                'body'=>"We can provide just the right course for your needs. We work with individuals and small groups.",
                'title'=> 'WHAT WE OFFER',
                'href_title'=>'More'
            ]
        ])->id;
        self::$contents['mainCustom'] =Content::create([
            'name' => 'main_page_custom',
            'image' => '/img/polza.jpg',
            'contentable_id' => PagesSeeder::$pages['mainPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/contacts'),
            'ru' =>['body'=>"Узнайте больше, забронируйте занятие или можете просто обсудить желаемый результат. Мы поможем Вам найти идеальное решение.",
                'title'=> 'КОНТАКТЫ',
                'href_title'=>'Подробно'
            ] ,
            'en' =>['body'=>"Find out more, book a session or just have a chat about what you want to achieve. We’ll help you find the ideal solution",
                'title'=> 'CONTACT',
                'href_title'=>'More'
            ]
        ])->id;
        self::$contents['mainVideo'] =Content::create([
            'name' => 'main_video_block',
            'image' => url('/video/breathe-video-preloader.jpg'),
            'video' => url('/video/breathe.mp4'),
            'contentable_id' => PagesSeeder::$pages['mainPage'],
            'contentable_type' => \App\Page::class,
//            'href'=>'#',
            'ru' =>['body'=>"Просмотрите это краткое видео «Breathe» и получите представление о том, как Вы можете прийти к успокоению и концентрации, используя технику Гармоничного Дыхания. ",
                'title'=> 'Совершенная гармония дыхания',
                'href_title'=>'Ваш браузер не поддерживает <video> тег'
            ] ,
            'en' =>['body'=>"Watch the video for an insight into the calm and focus that can come from using our harmonious breathing techniques. ",
                'title'=> 'THE PERFECT HARMONY OF BREATHING',
                'href_title'=>'Your browser does not support the <video> tag'
            ]
        ])->id;

        // main_footer ---------------------
        self::$contents['reviewsButtonMainFooter'] =Content::create([
            'name' => 'reviews_link',
            'contentable_id' => FootersSeeder::$footers['mainFooter'],
            'contentable_type' => \App\Footer::class,
            'href'=>url('/reviews'),
            'ru' =>[
                'title'=> 'Что говорят о нас клиенты',
                'href_title'=>'Посмотреть все'
            ] ,
            'en' =>[
                'title'=> 'Clients about us',
                'href_title'=>'View all'
            ]
        ])->id;

        // app_footer ---------------------
        self::$contents['appFooterLogo'] =Content::create([
            'name' => 'app_footer_logo',
            'contentable_id' => FootersSeeder::$footers['publicLayout'],
            'contentable_type' => \App\Footer::class,
            'image' => url('/img/logo.png')
        ])->id;
        //benefits page
        self::$contents['benefitHarmoniousBreathe'] =Content::create([
            'name' => 'benefit_harmonious_breathe',
            'image' => url('/img/polza.png'),
            'contentable_id' => PagesSeeder::$pages['benefitPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=>"
            <p> 
            Дыхание – это жизнь. Гармония в дыхании, значит гармония в жизни.</p>
<p>Гармоничное Дыхание – это ключ к согласованию работы ума и тела. Оно успокаивает ум, уменьшает напряжение в теле, улучшает деятельность как тела, так и мозга .</p>
<p>Если вы устраните нарушения в дыхании, это благотворно повлияет на ваш ум. Когда дыхание гладкое, медленное и спокойное, тело расслабляется и ум также становится более спокойным и умиротворенным.</p>
<p>Контролируемое дыхание используется во многих методах релаксации и является ключевой точкой в мировоззрении йоги. Его связь со здоровьем и гармонией была известна в Восточных культурах на протяжении многих веков и в настоящее время является общепризнанным фактом.</p>
<p>Гармоничное Дыхание берет свое начало в Янтра Йоге. Это один из древнейших методов Йоги, который дошел до наших дней и датируется 8 веком нашей эры. Его отличительная черта – согласование движения и дыхания.</p>",
                'title'=> 'ГАРМОНИЧНОЕ ДЫХАНИЕ',
                'href_title'=>'Дыхание – это жизнь. Гармония в дыхании, значит гармония в жизни'
            ] ,
            'en' =>[
                'body'=>"
            <p> Breathing is life. Harmony in breathing is harmony in life.</p> 
<p>Harmonious Breathing is a key element in coordinating the functions of the mind and body. It calms the mind, reduces tension in the body, and improves both physiological and cerebral functions.</p> 
<p>If you eliminate the irregularities in your breathing, it has a beneficial effect on your mind. When breathing is smooth, continuous, slow and quiet, the body relaxes and the mind becomes calmer and more peaceful.</p>
<p>Controlled breathing is used in many relaxation methods, and is central to the ideals and goals of yoga. Its contribution to health and harmony has been known in Eastern cultures for many centuries, and is now widely recognized.</p>
<p>Harmonious Breathing takes its source in Yantra Yoga (one of the oldest methods of Yoga taught in the world, transcribed in the 8th century AD) and differs from other Yoga by the integration of movement and breathing.</p>",
                'title'=> 'Harmonious breathe',
                'href_title'=>'Breathe is a life'
            ]
        ])->id;
        self::$contents['benefitBenefit'] =Content::create([
            'name' => 'benefit_benefit',
            'image' => url('/img/polza-1.png'),
            'contentable_id' => PagesSeeder::$pages['benefitPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=>"
           <p>Делает вашу жизнь более спокойной, здоровой и продуктивной.</p>
<p>Преимущества полного дыхания были раскрыты на протяжении веков, особенно в Восточной культуре.</p>
<p>В последнее время ключевая роль правильного дыхания стала объектом более тщательного изучения и его благотворное влияние на физическое и эмоциональное здоровье стало широко признанным фактом.</p>
<p>Правильные техники дыхания повторяют дыхательные ритмы, которые присущи людям в расслабленном и удовлетворенном состоянии. Ум распознает эти сигналы и в результате становится более спокойным и умиротворенным.</p>
<p>Гармоничное дыхание задействует все части тела, вовлеченные в дыхательные процесс, от диафрагмы до мышц спины. Данная техника мягко прорабатывает эти мышцы, очищает лимфатическую систему и восстанавливает баланс кислорода и углекислого газа, поступающих через легкие.</p>
<p>Когда ум и тело находятся в более уравновешенном состоянии, Ваш сон становится более глубоким, вы лучше восстанавливаетесь и чувствуете себя более наполненным энергией. Ваша работоспособность, выносливость, и общее качество жизни повышаются. </p>",
                'title'=> 'ПОЛЬЗА',
                'href_title'=>'Делает вашу жизнь более спокойной, здоровой и продуктивной.'
            ] ,
            'en' =>[
                'body'=>"
           <p>A calmer, healthier, more productive life.
<p>The benefits of complete breathing have been understood for centuries, particularly in Eastern cultures.</p>
<p>More recently, the fundamental role of correct breathing techniques has been the subject of further study, and its many physical and emotional benefits are more widely appreciated than ever.</p>
<p>Correct breathing techniques replicate the breathing rhythms found when people are relaxed and contented, and the mind recognizes these cues and becomes calmer and more grounded as a result.</p>
<p>Harmonious breathing fully engages all the parts of the body involved in the breathing process, from the diaphragm to the back muscles. It gently exercises these muscles, flushes out the lymphatic system, and improves the balance of oxygen and carbon dioxide taken in by the lungs.</p>
<p>With body and mind in better balance, you sleep more deeply, are better rested and have more energy. The general feeling of wellbeing is complemented by the ability to work harder, and live better.</p>",
                'title'=> 'Benefit',
                'href_title'=>'Make you life more productively.'
            ]
        ])->id;
        self::$contents['benefitFaqs'] =Content::create([
            'name' => 'benefit_faqs',
            'image' => url('/img/polza-2.jpg'),
            'contentable_id' => PagesSeeder::$pages['benefitPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'title'=> 'Часто задаваемые вопросы',
            ] ,
            'en' =>[
                'title'=> "FAQ's",
            ]
        ])->id;
        // contact_us_footer ---------------------
        self::$contents['contactUsFooter'] =Content::create([
            'name' => 'contact_us',
            'contentable_id' => FootersSeeder::$footers['contactFooter'],
            'contentable_type' => \App\Footer::class,
            'href'=>url('/contacts'),
            'ru' =>[
                'title'=> 'Свяжитесь с нами и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Связаться с нами'
            ] ,
            'en' =>[
                'title'=> 'Contact us and start filling your body with harmonious breathing',
                'href_title'=>'Contact us'
            ]
        ])->id;
        // classes page--------------------->
        self::$contents['textClassesPage'] =Content::create([
            'name' => 'classes_text',
            'contentable_id' => PagesSeeder::$pages['classesPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=> 'Любой человек может получить пользу от практики Гармоничного Дыхания, но у каждого свои цели и потребности. Мы можем предложить наиболее подходящий курс согласно вашим потребностям. Мы предлагаем как индивидуальные занятия так и занятия в маленьких группах. Сессии длятся 45 минут (или короче, в зависимости от конкретной программы урока). Вы можете выбрать любое занятие в любое время согласно рассписанию, вне зависимости от вашего место нахождения. Как правило, занятия проводятся сидя на коврике для йоги, также это может быть подушка или даже стул в зависимости от вашего пожелания и выбранного урока. Подпишитесь сейчас и выбираете любое занятие в течении недели на ваше усмотрение и просто получайте удовольствие от практики. Вы сможете ощутить пользу от практики Гармоничного Дыхания уже после первого урока, но регулярные занятия, даже если это всего раз в неделю, принесут гораздо более ощутимые результаты.',
            ] ,
            'en' =>[
                'body'=> 'Everyone can benefit from Harmonious Breathing, but each person’s goals and needs are different. We can provide just the right course for your needs. We work with individuals and small groups. Sessions last 45mn or different shorter routines, and you can participate at anytime and anywhere. You sign up and select any weekly class of your choice to join, and simply enjoy. The benefits of harmonious breathing can be felt after just one session, but regular courses, even once a week will give you the greatest benefit.',
            ]
        ])->id;
        self::$contents['regularClassesPage'] =Content::create([
            'name' => 'regular_classes',
            'contentable_id' => PagesSeeder::$pages['classesPage'],
            'contentable_type' => \App\Page::class,
            'image'=> url('/img/training.jpg'),
            'href'=>url('/dashboard/schedule/regular/0/0'),
            'ru' =>[
                'title'=> 'Регулярные занятия',
                'body'=> '  Как правило, индивидуальные занятия йогой Киев привлекают тех людей, у которых лимит времени, либо такой график, который делает невозможным посещение занятий по обычному расписанию. Вторая категория – люди с проблемным здоровьем. Таким ученикам просто необходим индивидуальный подход, ведь тот набор упражнений, который дается группе, может во многом не просто не подходить, но и ухудшать состояние здоровья. В таких ситуациях необходимо особенно щепетильно подбирать упражнения и сочетать нагрузку и расслабление во время занятий. Есть и еще одна категория – те, кто стесняется ходить на групповые занятия. Причин их смущению может быть множество, мы не станем их разбирать. Стоит только заметить, что в таких случаях полезным будет также и проработка психологических зажимов и блоков',
                'href_title'=>'На занятия'
            ] ,
            'en' =>[
                'title'=> 'Regular classes',
                'body'=> ' //TODO ENG Как правило, индивидуальные занятия йогой Киев привлекают тех людей, у которых лимит времени, либо такой график, который делает невозможным посещение занятий по обычному расписанию. Вторая категория – люди с проблемным здоровьем. Таким ученикам просто необходим индивидуальный подход, ведь тот набор упражнений, который дается группе, может во многом не просто не подходить, но и ухудшать состояние здоровья. В таких ситуациях необходимо особенно щепетильно подбирать упражнения и сочетать нагрузку и расслабление во время занятий. Есть и еще одна категория – те, кто стесняется ходить на групповые занятия. Причин их смущению может быть множество, мы не станем их разбирать. Стоит только заметить, что в таких случаях полезным будет также и проработка психологических зажимов и блоков',
                'href_title'=>'To classes'
            ]
        ])->id;
        self::$contents['corporateClassesPage'] =Content::create([
            'name' => 'corporate_classes',
            'contentable_id' => PagesSeeder::$pages['classesPage'],
            'contentable_type' => \App\Page::class,
            'image'=> url('/img/training1.jpg'),
            'href'=>url('/dashboard/schedule/corporate/0/0'),
            'ru' =>[
                'title'=> 'Корпоративные Занятия',
                'body'=> '//TODO RUS Ihis is a class to suit most people, including all those within a middle range of ability.  Brief instruction is given on the anatomy of breathing, and how to breathe properly.  We are led through a range of exercises - all done with an awareness of how each movement we adopt affects the breathing. Some exercises are active and others are passive; none are difficult to perform. By the end of 45 minutes we clearly experience a greater opening, fluidity and stability of breathing, and a greater sense of well-being.',
                'href_title'=>'На занятие'
            ] ,
            'en' =>[
                'title'=> 'Corporate classes',
                'body'=> ' Ihis is a class to suit most people, including all those within a middle range of ability.  Brief instruction is given on the anatomy of breathing, and how to breathe properly.  We are led through a range of exercises - all done with an awareness of how each movement we adopt affects the breathing. Some exercises are active and others are passive; none are difficult to perform. By the end of 45 minutes we clearly experience a greater opening, fluidity and stability of breathing, and a greater sense of well-being.',
                'href_title'=>'To classes'
            ]
        ])->id;
        self::$contents['privateClassesPage'] =Content::create([
            'name' => 'private_classes',
            'contentable_id' => PagesSeeder::$pages['classesPage'],
            'contentable_type' => \App\Page::class,
            'image'=> url('/img/training2.jpg'),
            'href'=>url('/dashboard/schedule/private/0/0'),
            'ru' =>[
                'title'=> 'Частные Занятия',
                'body'=> '  Как правило, индивидуальные занятия йогой Киев привлекают тех людей, у которых лимит времени, либо такой график, который делает невозможным посещение занятий по обычному расписанию. Вторая категория – люди с проблемным здоровьем. Таким ученикам просто необходим индивидуальный подход, ведь тот набор упражнений, который дается группе, может во многом не просто не подходить, но и ухудшать состояние здоровья. В таких ситуациях необходимо особенно щепетильно подбирать упражнения и сочетать нагрузку и расслабление во время занятий. Есть и еще одна категория – те, кто стесняется ходить на групповые занятия. Причин их смущению может быть множество, мы не станем их разбирать. Стоит только заметить, что в таких случаях полезным будет также и проработка психологических зажимов и блоков',
                'href_title'=>'На занятие'
            ] ,
            'en' =>[
                'title'=> 'Private_classes',
                'body'=> '  All the routines use warming up, to enable the flexibility and stability of posture, which ultimately leads our main to our main focus, breathing.  This routine offers more challenge in this regard, and more detail in the subtle aspects of the vast field of breath exploration. Of the 45 minutes, 15 or 20 are dedicated to Rhythmic Breathing, a practice requiring the full application of the training of our breathing, and resulting in complete, harmonious breathing.',
                'href_title'=>'To classes'
            ]
        ])->id;
        // subscribe page--------------------->
        self::$contents['textSubscribePage'] =Content::create([
            'name' => 'subscribe_text',
            'contentable_id' => PagesSeeder::$pages['subscribePage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=> '  Как правило, индивидуальные занятия йогой Киев привлекают тех людей, у которых лимит времени, либо такой график, который делает невозможным посещение занятий по обычному расписанию. Вторая категория – люди с проблемным здоровьем. Таким ученикам просто необходим индивидуальный подход, ведь тот набор упражнений, который дается группе, может во многом не просто не подходить, но и ухудшать состояние здоровья. В таких ситуациях необходимо особенно щепетильно подбирать упражнения и сочетать нагрузку и расслабление во время занятий. Есть и еще одна категория – те, кто стесняется ходить на групповые занятия. Причин их смущению может быть множество, мы не станем их разбирать. Стоит только заметить, что в таких случаях полезным будет также и проработка психологических зажимов и блоков',
            ] ,
            'en' =>[
                'body'=> ' //TODO ENG Как правило, индивидуальные занятия йогой Киев привлекают тех людей, у которых лимит времени, либо такой график, который делает невозможным посещение занятий по обычному расписанию. Вторая категория – люди с проблемным здоровьем. Таким ученикам просто необходим индивидуальный подход, ведь тот набор упражнений, который дается группе, может во многом не просто не подходить, но и ухудшать состояние здоровья. В таких ситуациях необходимо особенно щепетильно подбирать упражнения и сочетать нагрузку и расслабление во время занятий. Есть и еще одна категория – те, кто стесняется ходить на групповые занятия. Причин их смущению может быть множество, мы не станем их разбирать. Стоит только заметить, что в таких случаях полезным будет также и проработка психологических зажимов и блоков',
            ]
        ])->id;
        self::$contents['regularSubscribePage'] =Content::create([
            'name' => 'regular_text',
            'contentable_id' => PagesSeeder::$pages['subscribePage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('#'),
            'ru' =>[
                'href_title'=> '  Регулярные занятия',
            ] ,
            'en' =>[
                'href_title'=> ' Regular classes',
            ]
        ])->id;
        self::$contents['corporateSubscribePage'] =Content::create([
            'name' => 'corporate_text',
            'contentable_id' => PagesSeeder::$pages['subscribePage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('#'),
            'ru' =>[
                'href_title'=> 'Коорпоративные занятия',
            ] ,
            'en' =>[
                'href_title'=> 'Corporate classes',
            ]
        ])->id;
        self::$contents['privateSubscribePage'] =Content::create([
            'name' => 'private_text',
            'contentable_id' => PagesSeeder::$pages['subscribePage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('#'),
            'ru' =>[
                'href_title'=> 'Частные занятия',
            ] ,
            'en' =>[
                'href_title'=> 'Private classes',
            ]
        ])->id;
        // team page--------------------->
        self::$contents['textTeamPage'] =Content::create([
            'name' => 'team_main_text',
            'contentable_id' => PagesSeeder::$pages['teamPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'title' => 'Ваша практика и понимание осознанного дыхания помогают гармонизировать ваши личную энергию',
                'body'=> '<p>Углубление вашей практики и понимание осознанного дыхания помогают гармонизировать вашу личную энергию.
Мы считаем, что практика, которую вы можете применять в любом месте, в любое время, является мощным инструментом для улучшения качества вашей повседневной жизни. Наша цель - предоставить нашим ученикам способ улучшить свою жизнь, которую могут достичь почти все, всего за 15 минут в день. 
Наша система своими корнями прочно связана с учением и знаниями древней тибетской традиции Янтра-йоги, одной из старейших записанных систем йоги в мире. Эти столетия, опыт и понимание дополняют наш подход к обучению.</p>',
            ] ,
            'en' =>[
                'title' => 'Your practice and understanding of conscious breathing helps to harmonize your personal energy',
                'body'=> '<p>Deepening your practice and understanding of conscious breathing helps to harmonies your personal energy.
We believe that a practice you can apply anywhere, at any time, is a powerful tool for improving the quality of your everyday life. Our goal is to provide our students with a way to improve their lives that can be achieved by almost everyone, in just 15 minutes a day. 
Our system is firmly rooted in the teachings and knowledge of the ancient Tibetan tradition of Yantra Yoga, one of the oldest recorded systems of yoga in the world. These centuries of experience and understanding inform our approach to teaching.</p>',
            ] ,
        ])->id;
        // team page--------------------->
        self::$contents['imageContactsPage'] =Content::create([
            'name' => 'contacts_image',
            'contentable_id' => PagesSeeder::$pages['contactsPage'],
            'contentable_type' => \App\Page::class,
            'image' => url('/img/contact-fon.jpg'),
        ])->id;
        // contactPhone footer--------------------->
        self::$contents['textContactPhoneFooter'] =Content::create([
            'name' => 'contact_phone_text',
            'contentable_id' => FootersSeeder::$footers['contactPhoneFooter'],
            'contentable_type' => \App\Footer::class,
            'ru' =>[
                'title' => 'Связаться с нами<br>
            Гармоничное Дыхание',
                'body'=> 'Телефон: +0041798523088',
            ] ,
            'en' =>[
                'title' => 'Contact us<br>
            Harmonious Breathing',
                'body'=> 'Tel: +0041798523088',
            ] ,
        ])->id;

        // login Page ---------------------
        self::$contents['contactUsLoginPage'] =Content::create([
            'name' => 'login_contact_us',
            'contentable_id' => PagesSeeder::$pages['loginPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/contacts'),
            'ru' =>[
                'title'=> 'Свяжитесь с нами и начните наполнять свое тело гармоничным дыханием ',
                'href_title'=>'Связаться с нами'
            ] ,
            'en' =>[
                'title'=> 'Contact us and start filling your body with harmonious breathing',
                'href_title'=>'Contact us'
            ]
        ])->id;
        self::$contents['emailPlaceholderLoginPage'] =Content::create([
            'name' => 'login_email_placeholder',
            'contentable_id' => PagesSeeder::$pages['loginPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=> 'Ваш e-mail',
            ] ,
            'en' =>[
                'body'=> 'Your e-mail',
            ]
        ])->id;
        self::$contents['passPlaceholderLoginPage'] =Content::create([
            'name' => 'login_pass_placeholder',
            'contentable_id' => PagesSeeder::$pages['loginPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=> 'Ваш пароль',
            ] ,
            'en' =>[
                'body'=> 'Your password',
            ]
        ])->id;
        self::$contents['rememberMePlaceholderLoginPage'] =Content::create([
            'name' => 'login_remember_me',
            'contentable_id' => PagesSeeder::$pages['loginPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=> 'Запомнить меня',
            ] ,
            'en' =>[
                'body'=> 'Remember me',
            ]
        ])->id;
        self::$contents['submitPlaceholderLoginPage'] =Content::create([
            'name' => 'login_submit',
            'contentable_id' => PagesSeeder::$pages['loginPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'body'=> 'Войти',
            ] ,
            'en' =>[
                'body'=> 'Sign In',
            ]
        ])->id;

//********************************* ***************************************************  **************

        //unconfirmed Email page
        self::$contents['unconfirmedEmail'] =Content::create([
            'name' => 'unconfirmed_mail',
            'contentable_id' => PagesSeeder::$pages['unconfirmedEmail'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/login'),
            'ru' => ['title' => 'Ваша регистрация не завершена',
                'body' => 'Неподтвержденный e-mail',
                'href_title' => 'Продолжить'
            ],
            'en' => ['title' => 'You registration has not completed',
                'body' => 'Неподтвержденный e-mail',
                'href_title' => 'Continue'
            ]
        ])->id;
        //registered page
        self::$contents['registeredPage'] =Content::create([
            'name' => 'registered',
            'contentable_id' => PagesSeeder::$pages['registeredPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/login'),
            'ru' => ['title' => 'Спасибо за регистрацию',
                'body' => 'Спасибо за регистрацию, для окончания регистрации перейдите по ссылке подтверждения, которая находится в отправленном вам письму',
                'href_title' => 'Продолжить'
            ],
            'en' => ['title' => 'Thanks for registration',
                'body' => 'Thanks for registration, folow the confirmation link in you email box',
                'href_title' => 'Continue'
            ]
        ])->id;
        self::$contents['contactUsRegistration'] =Content::create([
            'name' => 'contact_us_reg',
            'contentable_id' => PagesSeeder::$pages['registerPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/contacts'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Связаться с нами'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Contact us'
            ]
        ])->id;
        self::$contents['agreementRegistration'] =Content::create([
            'name' => 'agreement_reg',
            'contentable_id' => PagesSeeder::$pages['registerPage'],
            'contentable_type' => \App\Page::class,
            'ru' =>[
                'title'=> 'Условия соглашения',
                'body'=>'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.
Close
'
            ] ,
            'en' =>[
                'title'=> 'Agreement text',
                'body'=>'//TODO ENG Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.
Close
'
            ]
        ])->id;
//       profile page                    -------------------
        self::$contents['myDataProfilePage'] =Content::create([
            'name' => 'profile_my_data',
            'contentable_id' => PagesSeeder::$pages['profilePage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('#'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои данные'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Profile'
            ]
        ])->id;

        self::$contents['myClassesProfilePage'] =Content::create([
            'name' => 'profile_my_classes',
            'contentable_id' => PagesSeeder::$pages['profilePage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-classes'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои уроки'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'My classes'
            ]
        ])->id;

        self::$contents['mySubscribesProfilePage'] =Content::create([
            'name' => 'profile_my_subscribes',
            'contentable_id' => PagesSeeder::$pages['profilePage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-subscribes'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои подписки'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'My subscribes'
            ]
        ])->id;

//    ============  my classes page  ======================================  -------------------
        self::$contents['myDataClassesPage'] =Content::create([
            'name' => 'my_classes_my_data',
            'contentable_id' => PagesSeeder::$pages['myClassesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/profile'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои данные'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Profile'
            ]
        ])->id;

        self::$contents['myClassesClassesPage'] =Content::create([
            'name' => 'my_classes_my_classes',
            'contentable_id' => PagesSeeder::$pages['myClassesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('#'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои уроки'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'My classes'
            ]
        ])->id;

        self::$contents['mySubscribesClassesPage'] =Content::create([
            'name' => 'my_classes_my_subscribes',
            'contentable_id' => PagesSeeder::$pages['myClassesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-subscribes'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои подписки'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'My subscribes'
            ]
        ])->id;
        self::$contents['regularClassesPage'] =Content::create([
            'name' => 'my_classes_regular_classes',
            'contentable_id' => PagesSeeder::$pages['myClassesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-classes?type=regular'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Регулярные занятия'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Regular classes'
            ]
        ])->id;
        self::$contents['corporateClassesPage'] =Content::create([
            'name' => 'my_classes_corporate_classes',
            'contentable_id' => PagesSeeder::$pages['myClassesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-classes?type=corporate'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Коорпоративные занятия'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Corporate classes'
            ]
        ])->id;

        self::$contents['privateClassesPage'] =Content::create([
            'name' => 'my_classes_private_classes',
            'contentable_id' => PagesSeeder::$pages['myClassesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-classes?type=private'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Частные занятия'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Private classes'
            ]
        ])->id;
//    ============  my subscribes page  ======================================  -------------------
        self::$contents['myDataSubscribesPage'] =Content::create([
            'name' => 'my_subscribes_my_data',
            'contentable_id' => PagesSeeder::$pages['mySubscribesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/profile'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои данные'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'Profile'
            ]
        ])->id;

        self::$contents['myClassesSubscribesPage'] =Content::create([
            'name' => 'my_subscribes_my_classes',
            'contentable_id' => PagesSeeder::$pages['mySubscribesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('/dashboard/my-classes'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои уроки'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'My classes'
            ]
        ])->id;

        self::$contents['mySubscribesSubscribesPage'] =Content::create([
            'name' => 'my_subscribes_my_subscribes',
            'contentable_id' => PagesSeeder::$pages['mySubscribesPage'],
            'contentable_type' => \App\Page::class,
            'href'=>url('#'),
            'ru' =>[
//                'title'=> 'СВЯЖИТЕСЬ С НАМИ и начните наполнять свое тело гармоничным дыханием',
                'href_title'=>'Мои подписки'
            ] ,
            'en' =>[
//                'title'=> 'Contact with us  sssssssssssssssssssssssssssss',
                'href_title'=>'My subscribes'
            ]
        ])->id;

//schedule--------------------------------------------------
        self::$contents['regularClassesSchedule'] =Content::create([
            'name' => 'regular_classes_schedule_title',
            'contentable_id' => PagesSeeder::$pages['schedulePage'],
            'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
            'ru' =>[
                'title'=> 'Рассписание регулярных уроков',
            ] ,
            'en' =>[
                'title'=> 'Regular classes schedule',
            ]
        ])->id;
        self::$contents['corporateClassesSchedule'] =Content::create([
            'name' => 'corporate_classes_schedule_title',
            'contentable_id' => PagesSeeder::$pages['schedulePage'],
            'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
            'ru' =>[
                'title'=> 'Рассписание регулярных уроков',
            ] ,
            'en' =>[
                'title'=> 'Regular classes schedule',
            ]
        ])->id;
        self::$contents['privateClassesSchedulePage'] =Content::create([
            'name' => 'private_classes_schedule_title',
            'contentable_id' => PagesSeeder::$pages['schedulePage'],
            'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
            'ru' =>[
                'title'=> 'Рассписание регулярных уроков',
            ] ,
            'en' =>[
                'title'=> 'Regular classes schedule',
            ]
        ])->id;
        self::$contents['chooseScheduleTitleSchedulePage'] =Content::create([
            'name' => 'choose_schedule',
            'contentable_id' => PagesSeeder::$pages['schedulePage'],
            'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
            'ru' =>[
                'title'=> 'Выберите рассписание',
            ] ,
            'en' =>[
                'title'=> 'Сhoose schedule',
            ]
        ])->id;
        self::$contents['chooseTeacherTitleSchedulePage'] =Content::create([
            'name' => 'choose_teacher',
            'contentable_id' => PagesSeeder::$pages['schedulePage'],
            'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
            'ru' =>[
                'title'=> 'Выберите учителя',
            ] ,
            'en' =>[
                'title'=> 'Сhoose teacher',
            ]
        ])->id;
        self::$contents['warningTimezoneSchedulePage'] =Content::create([
            'name' => 'warning_timezone',
            'contentable_id' => PagesSeeder::$pages['schedulePage'],
            'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
            'ru' =>[
                'body'=> 'Проверьте правильность настройки часового пояса на своем компьютере, во избежание недоразумений при посещении уроков.',
            ] ,
            'en' =>[
                'body'=> 'Please check timezone settings. All classes time will be shown according you computer time settings!!',
            ]
        ])->id;        self::$contents['afterScheduleTextTitleSchedulePage'] =Content::create([
        'name' => 'after_schedule_text',
        'contentable_id' => PagesSeeder::$pages['schedulePage'],
        'contentable_type' => \App\Page::class,
//            'href'=>url('/dashboard/profile'),
        'ru' =>[
            'body'=> 'На урок попасть можно за 15 минут до начала, но не раньше учителя, последнее время подключение 15 минут после начала.
         ',
        ] ,
        'en' =>[
            'body'=> '   30 minutes of movement and active breathing invigorates the breathing cycle.
                The harmonious breathing method offers a wide variety of exercises to work the different aspects of
                breathing and in this routine we focus on the active ones.
                A stimulating practice, perfect for mornings, gives you the energy and clears your mind for the whole
                day.',
        ]
    ])->id;

    }
}
