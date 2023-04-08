<?php

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.

    'sandbox' => [
        'key'    => env('STRIPE_KEY', 'pk_test_RibNP9rAUucNFqJFd2tL0APj'),
        'secret'      => env('STRIPE_SECRET', 'sk_test_z4FN8tWwfb8cTE8JBF9QbzEC'),
    ],
    'live' => [
        'key'    => env('STRIPE_KEY', ''),
        'secret'      => env('STRIPE_SECRET', ''),
    ],

    'webhook_secret' => 'whsec_svhMp5R0b0ItHApjF7ojPzRC5vYIheAZ',

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
