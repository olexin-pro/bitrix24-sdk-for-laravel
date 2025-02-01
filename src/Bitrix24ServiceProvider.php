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
use OlexinPro\Bitrix24\Exceptions\OAuthAuthorizationRequiredException;
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

        Http::macro('bitrix24', function () {
            $bitrixOAuthService = app()->make(Bitrix24OAuthService::class);

            if ($bitrixOAuthService->needAuthorize()) {
                throw new OAuthAuthorizationRequiredException();
            }

            $authToken = $bitrixOAuthService->getValidToken();

            return Http::acceptJson()
                ->withOptions([
                    'query' => ['auth' => $authToken]
                ])
                ->baseUrl((new Bitrix24Client())->getBitrix24BaseUrl());
        });
    }

    private function bindClasses(): void
    {
        $this->app->bind(NotificationInterface::class, Notify::class);


        $this->app->singleton(Bitrix24OAuthService::class, function ($app) {
            return new Bitrix24OAuthService(
                $app->make(OAuthTokenRepository::class)
            );
        });

        $this->app->bind('bitrix24.batch', function ($app) {
            return new Batch(
                $app->make(Client::class),
                $app->make(BatchCommandCollection::class),
            );
        });
        $this->app->alias('bitrix24.batch', Batch::class);
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
