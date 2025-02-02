<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use OlexinPro\Bitrix24\API\Batch\Batch;
use OlexinPro\Bitrix24\API\Batch\BatchCommandCollection;
use OlexinPro\Bitrix24\API\Client;
use OlexinPro\Bitrix24\Console\Commands\LoadOfflineEventsFromBitrix24;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;
use OlexinPro\Bitrix24\Contracts\TokenStorageInterface;
use OlexinPro\Bitrix24\Repositories\OAuthTokenRepository;
use OlexinPro\Bitrix24\Repositories\Rest\Notify;
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
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        //require_once __DIR__ . '/helpers.php';

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->macrosAndMixins();
        $this->bootCommands();
    }

    private function bindClasses(): void
    {
        $this->app->bind(NotificationInterface::class, Notify::class);
        $this->app->bind(TokenStorageInterface::class, OAuthTokenRepository::class);


        $this->app->singleton(Bitrix24OAuthService::class, function ($app) {
            return new Bitrix24OAuthService(
                $app->make(TokenStorageInterface::class)
            );
        });

        $this->app->bind('bitrix24.batch', function ($app) {
            return new Batch(
                $app->make(Client::class),
                $app->make(BatchCommandCollection::class),
            );
        });
        $this->app->alias('bitrix24.batch', Batch::class);

        $this->app->bind('bitrix24.client', function ($app) {
            return new Bitrix24Client();
        });
        $this->app->alias('bitrix24.client', Bitrix24Client::class);
    }

    private function bootCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LoadOfflineEventsFromBitrix24::class,
            ]);
        }
    }

    private function macrosAndMixins(): void
    {
        Http::macro('bitrix24', function () {
            $bitrix24client = new Bitrix24Client();
            return $bitrix24client->getHttp();
        });
    }
}
