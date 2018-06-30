<?php

return [
    'passport' => [
        'login_endpoint' => env('PASSPORT_LOGIN_ENDPOINT'),
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
        'do_not_use' => env('DO_NOT_USE'),
        
    ],
    'sms' => [
        'sms_key' => env('SMS_KEY'),
        'sms_device_id' => env('SMS_DEVICE_ID')
    ]
];