<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\ServiceProvider;
use OlexinPro\Bitrix24\Repository\OAuthTokenRepository;
use OlexinPro\Bitrix24\Services\Bitrix24OAuthService;

class Bitrix24ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Bitrix24OAuthService::class, function ($app) {
            return new Bitrix24OAuthService(
                $app->make(OAuthTokenRepository::class)
            );
        });
    }
}
