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

Make sure to add these values to your .env file:

```dotenv
BITRIX24_DOMAIN=https://portal.bitrix24.kz
BITRIX24_CLIENT_ID=your-client-id
BITRIX24_CLIENT_SECRET=your-client-secret
BITRIX24_REDIRECT_URI=your-redirect-uri
```

## License

This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Contribution

If you find a bug or want to improve the package, feel free to open an issue or pull request. All contributions are
welcome!
