<?php

return [
    'admin_notifications' => [
        'subscription_terminated_text' => 'ruYour subscription :sub_name was terminated by administrator',
        'subscription_terminated_subject' => 'ruNotification from '.config('app.url').' site'
    ],
    'common_heading' => 'Приветствуем!',
    'common_heading_salutation' => 'Приветствуем, :name!',

    'common_registration_info' => 'Ваши регистрационные данные:',
    'common_account' => 'Аккаунт:',
    'common_email' => 'Логин:',
    'common_password' => 'Пароль:',
    'common_automation_email_info' => 'Пожалуйста, не отвечайте на это письмо, так как оно сформировано автоматически.',
    'common_confidential_info' => 'Эта информация является конфиденциальной. Мы не разглашаем ваши регистрационные данные третьим лицам.',
    'common_signature' => 'Harmonious Breathing',

    // beautymail_email_confirmation.blade.php
    'beautymail_email_confirmation_subject' => 'Harmonious Breathing - Подтверждение электронного адреса',
    'beautymail_email_confirmation_explanation' => 'Вы получили это письмо, так как Вам необходимо подтвердить электронную почту.',
    'beautymail_email_confirm_button' => 'Подтвердить e-mail',
    'beautymail_email_confirm_text' => 'Если кнопка выше не работает пожалуйста воспользуйтесь сcылкой для подтверждения электронной почты нажав на неё или скопировав её в аресную строку браузера:',

    // beautymail_eventticket.blade.php
    'beautymail_eventticket_subject' => 'Harmonious Breathing - Регистрация на событии :event_name',
    'beautymail_eventticket_thank_you' => 'Мы благодарим Вас за то, что Вы зарегистрировались на ":event_name".',
    'beautymail_eventticket_qr_text' => 'Для ускорения регистрации предоставьте следующую информацию на столике регистрации:',
    'beautymail_eventticket_ticket' => 'Билет:',
    'beautymail_eventticket_ticket_after_text' => 'Вы можете распечатайть эту страницу либо воспользоваться специальной кнопкой на сайте и предоставить эту информацию администратору регистрации прямо с телефона.',

    // beautymail_firstpassword.blade.php
    'beautymail_firstpassword_subject' => 'Harmonious Breathing - Регистрация на сайте',
    'beautymail_firstpassword_thank_you' => 'Мы благодарим Вас за то, что Вы зарегистрировались на сайте Harmonious Breathing.',
    'beautymail_firstpassword_change_password_text' => 'Вы можете сменить Ваш пароль в Личном Кабинете в разделе "Сменить пароль".',

    // beautymail_passwordrestore.blade.php
    'beautymail_passwordrestore_subject' => 'Harmonious Breathing - запрос восстановления пароля',
    'beautymail_passwordrestore_explanation' => 'Вы получили это письмо, так как кто-то воспользовались опцией восстановления пароля на нашем сайте для Вашего аккаунта. Для того, чтобы установить новый пароль нажмите на кнопку.',
    'beautymail_passwordrestore_in_case_of_error_text' => 'Если Вы получили это письмо по ошибке, пожалуйста, игнорируйте его.',
    'beautymail_passwordrestore_button_not_working_text' => 'Если ваш браузер не перенаправляет Вас на наш сайт автоматически, пожалуйста, скопируйте ссылку восстановления пароля в адресную строку Вашего браузера и нажмите Enter.',
    'beautymail_passwordrestore_button_not_working_link_text' => 'Ссылка восстановления пароля:',

];
