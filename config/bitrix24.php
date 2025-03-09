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
        'oauth_install_token' => env('BITRIX24_OAUTH_INSTALL_TOKEN', 'oauth/install'),
        'oauth_redirect_to_bitrix24' => env('BITRIX24_OAUTH_REDIRECT', 'oauth/login'),
        'event_webhook_middleware' => []
    ],
    'default_entity_class' => [
        // package
        // 'lead' => DTO\Rest\LeadEntity::class,
        // 'deal' => DTO\Rest\DealEntity::class,
        //'offer' => DTO\Rest\OfferEntity::class,
        //'contact' => DTO\Rest\ContactEntity::class,
        //'company' => DTO\Rest\CompanyEntity::class,

        // app
        //'lead' => \App\DTO\Bitrix24\LeadDTO::class,
        //'deal' => \App\DTO\Bitrix24\DealDto::class,
        //'offer' => \App\DTO\Bitrix24\OfferDTO::class,
        //'contact' => \App\DTO\Bitrix24\ContactDTO::class,
        //'company' => \App\DTO\Bitrix24\CompanyDTO::class,
    ],

    'generator' => [
        'namespace' => 'App\\DTO\\Bitrix24',
        'path' => app_path('DTO/Bitrix24'),
        'stub_path' => __DIR__ . '/../stubs/bitrix24-dto.stub',
        'type_mapping' => [

            // Base
            'string' => 'STRING',
            'date' => 'DATE',
            'integer' => 'INT',
            'float' => 'FLOAT',
            'char' => 'BOOLEAN',
            'double' => 'FLOAT',
            'bool' => 'BOOLEAN',
            'datetime' => 'DATE',
            'boolean' => 'BOOLEAN',

            // CRM
            'crm' => 'STRING',
            'crm_lead' => 'INT',
            'crm_quote' => 'INT',
            'crm_company' => 'INT',
            'crm_contact' => 'INT',
            'crm_status' => 'STRING',
            'crm_entity' => 'STRING',
            'crm_category' => 'STRING',
            'crm_currency' => 'STRING',
            'crm_multifield' => 'CRM_CONTACT_FIELD',

            // Other
            'user' => 'INT',
            'url' => 'STRING',
            'file' => 'ARRAY',
            'money' => 'STRING',
            'employee' => 'INT',
            'location' => 'DYNAMIC',
            'enumeration' => 'STRING',
            'resourcebooking' => 'DYNAMIC',

        ],
        'match_php_types' => [

            // Base
            'string' => 'string',
            'bool' => 'bool',
            'char' => 'bool',
            'integer' => 'int',
            'float' => 'float',
            'boolean' => 'bool',
            'double' => 'float',
            'date' => '\DateTimeInterface',
            'datetime' => '\DateTimeInterface',

            // CRM
            'crm' => 'string',
            'crm_lead' => 'int',
            'crm_quote' => 'int',
            'crm_company' => 'int',
            'crm_contact' => 'int',
            'crm_entity' => 'string',
            'crm_status' => 'string',
            'crm_category' => 'string',
            'crm_currency' => 'string',
            'crm_multifield' => 'Collection',

            // Other
            'user' => 'int',
            'url' => 'string',
            'file' => 'array',
            'employee' => 'int',
            'money' => 'string',
            'location' => 'mixed',
            'enumeration' => 'string',
            'resourcebooking' => 'mixed',
        ]
    ]
];
