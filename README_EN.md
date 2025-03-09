# Bitrix24 SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/olexin-pro/bitrix24-sdk-for-laravel.svg?style=flat-square)](https://packagist.org/packages/olexin-pro/bitrix24-sdk-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/olexin-pro/bitrix24-sdk-for-laravel.svg?style=flat-square)](https://packagist.org/packages/olexin-pro/bitrix24-sdk-for-laravel)

## Table of Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [HTTP Client](#http-client)
    - [DTO Generation](#dto-generation)
    - [Working with REST API](#working-with-rest-api)
    - [Event Handling](#event-handling)
- [License](#license)
- [Contribution](#contribution)

## Introduction

This package provides a simple way to integrate Bitrix24 API with Laravel applications. It includes tools to authorize,
handle events, and interact with various Bitrix24 services.

### Key Features

- Convenient OAuth authorization and token management
- DTO class generation based on Bitrix24 entity fields
- Typed access to REST API with IDE autocompletion
- Offline event handling through Laravel Events
- Conversion of Bitrix24 data types to standard PHP types

## Requirements

- PHP 8.2 or higher
- Laravel 10.0 or higher
- Access to Bitrix24 with a registered application

## Installation

To install the package, use Composer:

```bash
composer require olexin-pro/bitrix24-sdk-for-laravel
```

## Configuration

After installation, publish the configuration file:

```bash
php artisan vendor:publish --provider="OlexinPro\Bitrix24\Bitrix24ServiceProvider" --tag="config"
```

### Example of the configuration:

```php
// config/bitrix24.php

return [
    'domain' => env('BITRIX24_DOMAIN', 'https://portal.bitrix24.kz'),
    'client_id' => env('BITRIX24_CLIENT_ID'),
    'client_secret' => env('BITRIX24_CLIENT_SECRET'),
    'redirect_uri' => env('BITRIX24_REDIRECT_URI'),
];
```

### Make sure to add these values to your .env file:

```dotenv
BITRIX24_DOMAIN=https://portal.bitrix24.kz
BITRIX24_CLIENT_ID=your-client-id
BITRIX24_CLIENT_SECRET=your-client-secret
BITRIX24_REDIRECT_URI=your-redirect-uri
```

## Usage

### HTTP Client

The package adds a `bitrix24()` macro to Laravel's HTTP facade for convenient API interaction:

```php
$resp = \Http::bitrix24()->get('/user.current')->json();
dump($resp); // User from which OAuth authorization occurred
/*
// Result:
array [▼
  "ID" => "1"
  "XML_ID" => "123321"
  "ACTIVE" => true
  "NAME" => "User Name"
  "LAST_NAME" => "Last name"
  "SECOND_NAME" => "Second name"
  "EMAIL" => "user@email.kz"
  "LAST_LOGIN" => "2025-02-05T15:36:07+03:00"
  "DATE_REGISTER" => "1977-12-14T03:00:00+03:00"
  "TIME_ZONE" => "Asia/Aqtau"
  "IS_ONLINE" => "N"
  "TIME_ZONE_OFFSET" => "7200"
  "TIMESTAMP_X" => "10.09.2024 16:18:42"
  "LAST_ACTIVITY_DATE" => "2025-02-05 15:36:17"
  "PERSONAL_GENDER" => "M"
  "PERSONAL_WWW" => "http://www.website.kz"
  "PERSONAL_BIRTHDAY" => "1977-09-01T03:00:00+04:00"
  "PERSONAL_PHOTO" => "https://cdn-ru.bitrix24.kz/bid/main/---/hash/hash"
  "PERSONAL_MOBILE" => "+77770000000"
  "PERSONAL_CITY" => "City"
  "WORK_PHONE" => "+7 777 000 00 00"
  "WORK_POSITION" => "Position"
  "UF_EMPLOYMENT_DATE" => ""
]
*/

// Example of adding a new lead
$resp = \Http::bitrix24()->post('/crm.lead.add', [
    'fields' => [
        "TITLE" => "IP Titov",
        "NAME" => "Gleb",
        "SECOND_NAME" => "Egorovich",
        "LAST_NAME" => "Titov",
        "STATUS_ID" => "NEW",
        "OPENED" => "Y",
        "ASSIGNED_BY_ID" => 1,
        "CURRENCY_ID" => "KZT", // RUB, USD
        "OPPORTUNITY" => 12500,
        "PHONE" => [
            ["VALUE" => "555888", "VALUE_TYPE" => "WORK"]
        ],
        "WEB" => [
            ["VALUE" => "www.mysite.com", "VALUE_TYPE" => "WORK"]
        ],
        "params" => ["REGISTER_SONET_EVENT" => "Y"]
    ]
])->json();

// result:
/*
array:[
    "result" => 3465,
    "time" => [
        "start" => 1705764932.998683,
        "finish" => 1705764937.173995,
        "duration" => 4.1753120422363281,
        "processing" => 3.3076529502868652,
        "date_start" => "2024-01-20T18:35:32+03:00",
        "date_finish" => "2024-01-20T18:35:37+03:00",
        "operating_reset_at" => 1705765533,
        "operating" => 3.3076241016387939
    ]
]
*/
```

### DTO Generation

The package allows you to automatically generate Data Transfer Objects (DTOs) based on Bitrix24 entity fields:

```bash
php artisan bitrix24:dto deal --with-products --force
```

This will create a DTO class:

```php
<?php

declare(strict_types=1);

namespace App\DTO\Bitrix24; // can be changed in config

// imports: use ...

final class DealDTO extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, false)]
    public int $id;
    
    // Standard fields....
    
    #[Bitrix24Field('UF_CRM_66B9CF21B5F8B', Bitrix24TypeEnum::ARRAY, false)]
    public ?array $ufCrm66b9cf21b5f8b;
    
    // users fields....
    
    /**
     * @var Collection<\OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity>|null
     */
    #[Bitrix24Field(self::PRODUCT_ROWS_KEY, CrmProductRowConverter::class)]
    public ?Collection $products;
}
```

#### Using the DTO generation command

```bash
php bitrix24:dto [options] [--] <entity> [<class-name>]
```

Arguments:

| **Name**   | **Description**           |
|------------|---------------------------|
| entity     | The Bitrix24 entity name  |
| class-name | The name of the DTO class |

Options:

| **Name**        | **Description**                                    |
|-----------------|----------------------------------------------------|
| --force         | Force the operation to run when DTO already exists |
| --with-products | Add products field to DTO                          |

#### Customizing Type Converters

You can modify existing DTO converters or write your own if needed:

```php
use DateTimeInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24Field;

#[Bitrix24Field('DATE_CREATE', Bitrix24TypeEnum::DATE)]
public ?DateTimeInterface $createdAt;

// Bitrix24TypeEnum::DATE will convert the value to a Carbon object
```

In the `Bitrix24Field` attribute, the first parameter is the field name from Bitrix24 data. The second parameter can be
your own converter that implements the `\OlexinPro\Bitrix24\Entities\DTO\Converters\Bitrix24TypeConverterInterface`
interface:

```php
<?php

declare(strict_types=1);

namespace App\DTO\Converters;

final class MyBooleanConverter implements Bitrix24TypeConverterInterface
{
    private const array TRUE_ITEMS = [
        'Y', '1', 'true', 'on', 1, true,
    ];
    
    public function convert($value): bool
    {
        return in_array($value, self::TRUE_ITEMS, true);
    }
}

#[Bitrix24Field('ACTIVE', \App\DTO\Converters\MyBooleanConverter::class)]
public bool $active;
```

The third parameter indicates whether the field is required. If set to `true`, an exception will be thrown if data for
this field is missing.

#### Supported entities for DTO generation

- ✓ Contacts
- ✓ Companies
- ✓ Leads
- ✓ Deals
- ✓ Offers
- Smart Processes (in development)
- Requisites (in development)
- Tasks (in development)
- Company Structure (in development)
- Products (in development)
- Product Offers (in development)

### Working with REST API

For working with Bitrix24 REST API, the package provides a convenient `Bitrix24Rest` facade. Detailed information about
API methods can be found in the [official documentation](https://apidocs.bitrix24.ru/).

```php
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

// Getting a lead by ID (crm.lead.get)
Bitrix24Rest::crm()->lead()->get(123);
```

The method call structure corresponds to the structure of Bitrix24 REST API methods:

```php
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

// corresponds to: crm.lead.get
Bitrix24Rest::crm()->lead()->get(123);

// corresponds to: crm.lead.list
Bitrix24Rest::crm()->lead()->list();

// corresponds to: crm.lead.productrows.get
Bitrix24Rest::crm()->lead()->productRowsGet(123);
```

The facade supports IDE autocompletion, which simplifies working with the API.

#### Extended Entity Methods

Some entities have additional methods that return typed objects:

```php
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

// Getting a deal as a typed entity
$deal = Bitrix24Rest::crm()->deal()->getAsEntity(123);
// Result:
// OlexinPro\Bitrix24\Entities\DTO\Rest\DealEntity {#300 ▼
//   #data: array:113 [▶]
//   +id: 123
//   +products: null
//   // other fields...
// }

// Getting a deal with products
$dealWithProducts = Bitrix24Rest::crm()->deal()->getAsEntityWithProducts(123);
// Result:
// OlexinPro\Bitrix24\Entities\DTO\Rest\DealEntity {#300 ▼
//   #data: array:113 [▶]
//   +id: 123
//   +products: Illuminate\Support\Collection{#403 ▼
//     #items: array:4 [▼
//       0 => OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity{#404 ▶}
//       1 => OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity{#434 ▶}
//       // etc.
//     ]
//   }
//   // other fields...
// }
```

All `AsEntity` methods return DTOs from the package by default, but you can replace them with your own generated ones.
To do this, change the settings in the configuration file:

```php
return [
    // ...
    'default_entity_class' => [
        'user' => \OlexinPro\Bitrix24\Entities\DTO\Rest\UserEntity::class,
        'lead' => \OlexinPro\Bitrix24\Entities\DTO\Rest\LeadEntity::class,
        'deal' => \OlexinPro\Bitrix24\Entities\DTO\Rest\DealEntity::class,
        'offer' => \OlexinPro\Bitrix24\Entities\DTO\Rest\OfferEntity::class,
        'contact' => \OlexinPro\Bitrix24\Entities\DTO\Rest\ContactEntity::class,
        'company' => \OlexinPro\Bitrix24\Entities\DTO\Rest\CompanyEntity::class,
    ],
    // ...
];
```

### Event Handling

To work with offline events from Bitrix24, the package provides a special command:

```bash
php artisan bitrix24:load-offline-events
```

You can schedule the loading of offline events, for example, every hour:

```php
Schedule::command('bitrix24:load-offline-events')->hourly();
```

When the command is executed, all offline events from Bitrix24 will be loaded, and the corresponding Laravel events will
be triggered.

#### Matching Bitrix24 Events to Laravel Events

| **Bitrix24 Event**     | **Laravel Event**   |
|------------------------|---------------------|
| CATALOG.PRODUCT.ON.ADD | CatalogProductOnAdd |
| ONCRMLEADADD           | OnCrmLeadAdd        |
| ONCRMDYNAMICITEMADD    | OnCrmDynamicItemAdd |
| ONCRMTYPEDELETE        | OnCrmTypeDelete     |

In the triggered Laravel events, a `Bitrix24Event` object is passed to the constructor. All event handler classes must
implement the `Bitrix24EventInterface` or extend the abstract class `BaseBitrix24Event`:

```php
namespace App\Events;

use OlexinPro\Bitrix24\Entities\Bitrix24Event;
use OlexinPro\Bitrix24\Contracts\Bitrix24EventInterface;
// other imports...

class OnCrmLeadDelete implements Bitrix24EventInterface
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public Bitrix24Event $bitrixEvent
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getBitrixEventDTO(): Bitrix24Event
    {
        return $this->bitrixEvent;
    }
}

// OR

use OlexinPro\Bitrix24\Laravel\Events\BaseBitrix24Event;

class OnCrmLeadDelete extends BaseBitrix24Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
```

## License

This package is licensed under the MIT License. For more information, see the [LICENSE](LICENSE) file.

## Contribution

If you find a bug or want to improve the package, feel free to open an issue or a pull request. All contributions are
welcome!
