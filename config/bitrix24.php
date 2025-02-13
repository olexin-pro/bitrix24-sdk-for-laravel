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
        'oauth_install_token' => env('BITRIX24_OAUTH_INSTALL_TOKEN', 'api/bitrix24/handler'),
        'oauth_redirect_to_bitrix24' => env('BITRIX24_OAUTH_REDIRECT', 'oauth/authorize'),
        'event_webhook_middleware' => []
    ],
    'default_entity_class' => [
        'lead' => \OlexinPro\Bitrix24\Entities\DTO\Rest\LeadEntity::class
    ],
];
