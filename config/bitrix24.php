<?php

return [

    'domain' => env('BITRIX24_DOMAIN'),
    'domain_scheme' => 'https',

    'client_id' => env('BITRIX24_CLIENT_ID'),
    'client_secret' => env('BITRIX24_CLIENT_SECRET'),
    'redirect_uri' => env('BITRIX24_REDIRECT_URI'),

    'oauth_uri' => env('BITRIX24_OAUTH_URI', 'https://oauth.bitrix.info/oauth/token'),
    'auth_connector' => env('BITRIX24_AUTH_CONNECTOR', 'V8mDZ9Fh4SaEd4dRuZYYjyYRmFuYXpRD'),

    'events' => [
        'clear_on_load_offline_events' => true,
        'laravel_event_classes_cache_key' => 'laravel_event_classes',
    ],
    'routes' => [
        'event_webhook_path' => '/event/webhook',
        'event_webhook_middleware' => [

        ]
    ]
];
