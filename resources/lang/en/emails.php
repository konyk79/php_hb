<?php

return [
    'admin_notifications' => [
      'subscription_terminated_text' => 'Your subscription :sub_name was terminated by administrator',
         'subscription_terminated_subject' => 'Notification from '.config('app.url').' site'
    ],
    'common_heading' => 'Hello!',
    'common_heading_salutation' => 'Hello, :name!',

    'common_registration_info' => 'Your registration data:',
    'common_account' => 'Acoount:',
    'common_email' => 'Login:',
    'common_password' => 'Password:',
    'common_automation_email_info' => 'Please do not reply to this email because it was generated automatically.',
    'common_confidential_info' => 'This information is confidential. We do not disclose your registration information to third parties.',
    'common_signature' => 'Harmonious Breathing, 2018',

    // beautymail_email_confirmation.blade.php
    'beautymail_email_confirmation_subject' => 'Harmonious Breathing - email confirmation',
    'beautymail_email_confirmation_explanation' => 'You received this email, because you need to confirm your email.',
    'beautymail_email_confirm_button' => 'Confirm e-mail',
    'beautymail_email_confirm_text' => 'If the button above does not work please use following link to confirm your email by clicking on it or by copying it to the address bar of your browser:',

    // beautymail_eventticket.blade.php
    'beautymail_eventticket_subject' => 'Harmonious Breathing - Event registration :event_name',
    'beautymail_eventticket_thank_you' => 'We thank you for registering for ":event_name".',
    'beautymail_eventticket_qr_text' => 'To speed up registration, please provide the following information on the registration table:',
    'beautymail_eventticket_ticket' => 'Ticket:',
    'beautymail_eventticket_ticket_after_text' => 'You can print this page or use a special button on the site and provide this information to the registration administrator directly from the phone.',

    // beautymail_firstpassword.blade.php
    'beautymail_firstpassword_subject' => 'Harmonious Breathing - registration on the site',
    'beautymail_firstpassword_thank_you' => 'We thank you for registering on the Harmonious Breathing website.',
    'beautymail_firstpassword_change_password_text' => 'You can change your password in the Personal Area in the "Change Password" section.',

    // beautymail_passwordrestore.blade.php
    'beautymail_passwordrestore_subject' => 'Harmonious Breathing - Password recovery request',
    'beautymail_passwordrestore_explanation' => 'You received this email, because someone used the password recovery option on our site for your account. To set a new password, click the button.',
    'beautymail_passwordrestore_in_case_of_error_text' => 'If you received this email due to error, please ignore it.',
    'beautymail_passwordrestore_button_not_working_text' => 'If your browser does not automatically redirect you to our site, please copy the link to the address bar of your browser and press Enter.',
    'beautymail_passwordrestore_button_not_working_link_text' => 'Password recovery link:',

];
