# Bitrix24 SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/olexin-pro/bitrix24-sdk-for-laravel.svg?style=flat-square)](https://packagist.org/packages/olexin-pro/bitrix24-sdk-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/olexin-pro/bitrix24-sdk-for-laravel.svg?style=flat-square)](https://packagist.org/packages/olexin-pro/bitrix24-sdk-for-laravel)

## Introduction

This package provides a simple way to integrate Bitrix24 API with Laravel applications. It includes tools to authorize,
handle events, and interact with various Bitrix24 services.

## Installation

To get started, you need to add this package to your Laravel project. Use Composer to install it:

```bash
composer require olexin-pro/bitrix24-sdk-for-laravel
```

## Configuration

After installation, publish the configuration file:

```bash
php artisan vendor:publish --provider="OlexinPro\Bitrix24\Bitrix24ServiceProvider" --tag="config"
```

## Usage

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

### Свободное использование с помощью Http клиента:

```php
$resp = \Http::bitrix24()->get('/user.current')->json();
dump($resp); // Пользователь от которого произошла OAuth авторизация
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

// Or
$resp = \Http::bitrix24()->post('/crm.lead.add',[
    'fields' => [
        "TITLE" => "ИП Титов",
        "NAME" => "Глеб",
        "SECOND_NAME" => "Егорович",
        "LAST_NAME" => "Титов",
        "STATUS_ID" => "NEW",
        "OPENED" => "Y",
        "ASSIGNED_BY_ID" => 1,
        "CURRENCY_ID" => "KZT", // RUB, USD
        "OPPORTUNITY" => 12500,
        "PHONE"=> [
            ["VALUE" => "555888" => "VALUE_TYPE" => "WORK"]
        ],
        "WEB" => [
            ["VALUE" => "www.mysite.com","VALUE_TYPE" => "WORK"]
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

### Генерация DTO на основание полей из Битрикс24

```shell
php artisan bitrix24:dto deal --with-products --force
```

Будет создано ДТО:

```php
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

Использование команды:

`php bitrix24:dto [options] [--] <entity> [<class-name>]`

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

### Обработка событий

Офлайн события можно прослушивать с помощью команды:

```shell
php artisan bitrix24:load-offline-events
```

Или к примеру получать офлайн события каждый час:

```shell
Schedule::command('bitrix24:load-offline-events')->hourly();
```

Будут загружены все офлайн события из Битрикс24 и запущены события Laravel, которые соответствуют имени события
Битрикс24

| **Bitrix24 Event**     | **Laravel Event**   |
|------------------------|---------------------|
| CATALOG.PRODUCT.ON.ADD | CatalogProductOnAdd |
| ONCRMLEADADD           | OnCrmLeadAdd        |
| ONCRMDYNAMICITEMADD    | OnCrmDynamicItemAdd |
| ONCRMTYPEDELETE        | OnCrmTypeDelete     |

В иницируемые Laravel события в конструктор передается dto объект с событием Bitrix24 `Bitrix24Event`,
по этому все события Laravel должны реализовывать интерфейс `Bitrix24EventInterface`
либо наследоваться от абстрактного класса `BaseBitrix24Event` который реализует этот интерфейс.

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

This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Contribution

If you find a bug or want to improve the package, feel free to open an issue or pull request. All contributions are
welcome!
