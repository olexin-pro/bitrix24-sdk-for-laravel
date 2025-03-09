# Bitrix24 SDK для Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/olexin-pro/bitrix24-sdk-for-laravel.svg?style=flat-square)](https://packagist.org/packages/olexin-pro/bitrix24-sdk-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/olexin-pro/bitrix24-sdk-for-laravel.svg?style=flat-square)](https://packagist.org/packages/olexin-pro/bitrix24-sdk-for-laravel)

[English readme](README_EN.md)

## Содержание

- [Введение](#введение)
- [Требования](#требования)
- [Установка](#установка)
- [Настройка](#настройка)
- [Использование](#использование)
    - [HTTP клиент](#http-клиент)
    - [Генерация DTO](#генерация-dto)
    - [Работа с REST API](#работа-с-rest-api)
    - [Обработка событий](#обработка-событий)
- [Лицензия](#лицензия)
- [Содействие](#содействие)

## Введение

Данный пакет предоставляет простой способ интеграции Bitrix24 API с приложениями Laravel. Он включает в себя инструменты
для авторизации, обработки событий и взаимодействия с различными сервисами Bitrix24.

### Ключевые возможности

- Удобная авторизация и работа с OAuth токенами
- Генерация DTO классов на основе полей сущностей Bitrix24
- Типизированный доступ к REST API с автодополнением в IDE
- Обработка офлайн событий через Laravel Events
- Конвертация типов данных Bitrix24 в стандартные PHP типы

## Требования

- PHP 8.2 или выше
- Laravel 10.0 или выше
- Доступ к Bitrix24 с зарегистрированным приложением

## Установка

Для установки пакета используйте Composer:

```bash
composer require olexin-pro/bitrix24-sdk-for-laravel
```

## Настройка

После установки опубликуйте конфигурационный файл:

```bash
php artisan vendor:publish --provider="OlexinPro\Bitrix24\Bitrix24ServiceProvider" --tag="config"
```

### Пример конфигурации:

```php
// config/bitrix24.php

return [
    'domain' => env('BITRIX24_DOMAIN', 'https://portal.bitrix24.kz'),
    'client_id' => env('BITRIX24_CLIENT_ID'),
    'client_secret' => env('BITRIX24_CLIENT_SECRET'),
    'redirect_uri' => env('BITRIX24_REDIRECT_URI'),
];
```

### Добавьте следующие значения в ваш .env файл:

```dotenv
BITRIX24_DOMAIN=https://portal.bitrix24.kz
BITRIX24_CLIENT_ID=your-client-id
BITRIX24_CLIENT_SECRET=your-client-secret
BITRIX24_REDIRECT_URI=your-redirect-uri
```

## Использование

### HTTP клиент

Пакет добавляет макрос `bitrix24()` в HTTP фасад Laravel для удобного взаимодействия с API:

```php
$resp = \Http::bitrix24()->get('/user.current')->json();
dump($resp); // Пользователь от которого произошла OAuth авторизация
/*
// Результат:
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

// Пример добавления нового лида
$resp = \Http::bitrix24()->post('/crm.lead.add', [
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
        "PHONE" => [
            ["VALUE" => "555888", "VALUE_TYPE" => "WORK"]
        ],
        "WEB" => [
            ["VALUE" => "www.mysite.com", "VALUE_TYPE" => "WORK"]
        ],
        "params" => ["REGISTER_SONET_EVENT" => "Y"]
    ]
])->json();

// результат:
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

### Генерация DTO

Пакет позволяет автоматически генерировать Data Transfer Objects (DTO) на основе полей сущностей Bitrix24:

```bash
php artisan bitrix24:dto deal --with-products --force
```

В результате будет создан класс DTO:

```php
<?php

declare(strict_types=1);

namespace App\DTO\Bitrix24; // может быть изменено в конфигурации

// импорты: use ...

final class DealDTO extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, false)]
    public int $id;
    
    // Стандартные поля...
    
    #[Bitrix24Field('UF_CRM_66B9CF21B5F8B', Bitrix24TypeEnum::ARRAY, false)]
    public ?array $ufCrm66b9cf21b5f8b;
    
    // Пользовательские поля...
    
    /**
     * @var Collection<\OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity>|null
     */
    #[Bitrix24Field(self::PRODUCT_ROWS_KEY, CrmProductRowConverter::class)]
    public ?Collection $products;
}
```

#### Использование команды генерации DTO

```bash
php bitrix24:dto [options] [--] <entity> [<class-name>]
```

Аргументы:

| **Имя**    | **Описание**                 |
|------------|------------------------------|
| entity     | Название сущности Bitrix24   |
| class-name | Имя класса DTO (опционально) |

Опции:

| **Имя**         | **Описание**                                      |
|-----------------|---------------------------------------------------|
| --force         | Принудительная генерация, если DTO уже существует |
| --with-products | Добавить поле products в DTO                      |

#### Кастомизация конвертеров типов

При необходимости вы можете изменить существующие конвертеры DTO или написать свои:

```php
use DateTimeInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24Field;

#[Bitrix24Field('DATE_CREATE', Bitrix24TypeEnum::DATE)]
public ?DateTimeInterface $createdAt;

// Bitrix24TypeEnum::DATE сконвертирует значение в объект Carbon
```

В атрибуте `Bitrix24Field` первым параметром указывается имя поля из данных Bitrix24. Вторым параметром можно передать
свой конвертер, реализующий интерфейс `\OlexinPro\Bitrix24\Entities\DTO\Converters\Bitrix24TypeConverterInterface`:

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

Третий параметр указывает обязательность поля. Если установлено значение `true`, то при отсутствии данных для этого поля
будет выброшено исключение.

#### Поддерживаемые сущности для генерации DTO

- ✓ Контакты
- ✓ Компании
- ✓ Лиды
- ✓ Сделки
- ✓ Предложения
- Смарт-процессы (в разработке)
- Реквизиты (в разработке)
- Задачи (в разработке)
- Структура компании (в разработке)
- Товары (в разработке)
- Предложения товаров (в разработке)

### Работа с REST API

Для работы с REST API Bitrix24 в пакете предусмотрен удобный фасад `Bitrix24Rest`. Подробную информацию о методах API
можно найти в [официальной документации](https://apidocs.bitrix24.ru/).

```php
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

// Получение лида по ID (crm.lead.get)
Bitrix24Rest::crm()->lead()->get(123);
```

Структура вызова методов соответствует структуре методов REST API Bitrix24:

```php
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

// соответствует: crm.lead.get
Bitrix24Rest::crm()->lead()->get(123);

// соответствует: crm.lead.list
Bitrix24Rest::crm()->lead()->list();

// соответствует: crm.lead.productrows.get
Bitrix24Rest::crm()->lead()->productRowsGet(123);
```

Фасад поддерживает автодополнение в IDE, что упрощает работу с API.

#### Расширенные методы сущностей

Для некоторых сущностей доступны дополнительные методы, возвращающие типизированные объекты:

```php
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

// Получение сделки в виде типизированного объекта
$deal = Bitrix24Rest::crm()->deal()->getAsEntity(123);
// Результат:
// OlexinPro\Bitrix24\Entities\DTO\Rest\DealEntity {#300 ▼
//   #data: array:113 [▶]
//   +id: 123
//   +products: null
//   // другие поля...
// }

// Получение сделки вместе с товарами
$dealWithProducts = Bitrix24Rest::crm()->deal()->getAsEntityWithProducts(123);
// Результат:
// OlexinPro\Bitrix24\Entities\DTO\Rest\DealEntity {#300 ▼
//   #data: array:113 [▶]
//   +id: 123
//   +products: Illuminate\Support\Collection{#403 ▼
//     #items: array:4 [▼
//       0 => OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity{#404 ▶}
//       1 => OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity{#434 ▶}
//       // и т.д.
//     ]
//   }
//   // другие поля...
// }
```

Все методы `AsEntity` по умолчанию возвращают DTO из пакета, но вы можете заменить их на свои сгенерированные. Для этого
измените настройки в конфигурационном файле:

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

### Обработка событий

Для работы с офлайн событиями Bitrix24 пакет предоставляет специальную команду:

```bash
php artisan bitrix24:load-offline-events
```

Вы можете запускать загрузку офлайн событий по расписанию, например, каждый час:

```php
Schedule::command('bitrix24:load-offline-events')->hourly();
```

При выполнении команды будут загружены все офлайн события из Bitrix24 и запущены соответствующие события Laravel.

#### Соответствие событий Bitrix24 и Laravel

| **Событие Bitrix24**   | **Событие Laravel** |
|------------------------|---------------------|
| CATALOG.PRODUCT.ON.ADD | CatalogProductOnAdd |
| ONCRMLEADADD           | OnCrmLeadAdd        |
| ONCRMDYNAMICITEMADD    | OnCrmDynamicItemAdd |
| ONCRMTYPEDELETE        | OnCrmTypeDelete     |

В инициируемые события Laravel в конструктор передается объект `Bitrix24Event`. Все классы обработчиков событий должны
реализовывать интерфейс `Bitrix24EventInterface` или наследоваться от абстрактного класса `BaseBitrix24Event`:

```php
namespace App\Events;

use OlexinPro\Bitrix24\Entities\Bitrix24Event;
use OlexinPro\Bitrix24\Contracts\Bitrix24EventInterface;
// другие импорты...

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

// ИЛИ

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

## Лицензия

Данный пакет распространяется под лицензией MIT. Для получения дополнительной информации смотрите
файл [LICENSE](LICENSE).

## Содействие

Если вы нашли ошибку или хотите улучшить пакет, не стесняйтесь создавать issue или pull request. Любой вклад
приветствуется!
