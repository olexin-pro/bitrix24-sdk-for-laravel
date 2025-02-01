<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\ServiceProvider;
use OlexinPro\Bitrix24\Console\Commands\LoadOfflineEventsFromBitrix24;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;
use OlexinPro\Bitrix24\Repository\OAuthTokenRepository;
use OlexinPro\Bitrix24\Repository\Rest\Notify;
use OlexinPro\Bitrix24\Services\Bitrix24OAuthService;

class Bitrix24ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/../config/bitrix24.php' => config_path('bitrix24.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bitrix24.php',
            'bitrix24'
        );

        $this->bindClasses();
        $this->bootCommands();
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    private function bindClasses(): void
    {
        $this->app->bind(NotificationInterface::class, Notify::class);


        $this->app->singleton(Bitrix24OAuthService::class, function ($app) {
            return new Bitrix24OAuthService(
                $app->make(OAuthTokenRepository::class)
            );
        });
    }

    public function bootCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LoadOfflineEventsFromBitrix24::class,
            ]);
        }
    }
}
