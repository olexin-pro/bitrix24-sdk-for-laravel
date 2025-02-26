<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use OlexinPro\Bitrix24\API\Batch\Batch;
use OlexinPro\Bitrix24\API\Batch\BatchCommandCollection;
use OlexinPro\Bitrix24\Console\Commands\GenerateBitrix24DTO;
use OlexinPro\Bitrix24\Console\Commands\LoadOfflineEventsFromBitrix24;
use OlexinPro\Bitrix24\Contracts\CrmGroupInterface;
use OlexinPro\Bitrix24\Contracts\Rest\Bitrix24OAuthServiceInterface;
use OlexinPro\Bitrix24\Contracts\Rest\DealInterface;
use OlexinPro\Bitrix24\Contracts\Rest\EventsInterface;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;
use OlexinPro\Bitrix24\Contracts\Rest\OfferInterface;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Contracts\TokenStorageInterface;
use OlexinPro\Bitrix24\Repositories\OAuthTokenRepository;
use OlexinPro\Bitrix24\Repositories\Rest\CrmGroupRest;
use OlexinPro\Bitrix24\Repositories\Rest\Deal;
use OlexinPro\Bitrix24\Repositories\Rest\Events;
use OlexinPro\Bitrix24\Repositories\Rest\Lead;
use OlexinPro\Bitrix24\Repositories\Rest\Notify;
use OlexinPro\Bitrix24\Repositories\Rest\Offer;
use OlexinPro\Bitrix24\Repositories\Rest\User as RestUser;
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
        $this->app->bind(UserInterface::class, RestUser::class);
        $this->app->bind(TokenStorageInterface::class, OAuthTokenRepository::class);


        $this->app->singleton(Bitrix24OAuthServiceInterface::class, function ($app) {
            return new Bitrix24OAuthService(
                $app->make(TokenStorageInterface::class)
            );
        });

        $this->app->bind('bitrix24.batch', function ($app) {
            return new Batch(
                $app->make(Bitrix24Client::class),
                $app->make(BatchCommandCollection::class),
            );
        });
        $this->app->alias('bitrix24.batch', Batch::class);

        $this->app->bind('bitrix24.client', function ($app) {
            return new Bitrix24Client(
                $app->make(Bitrix24OAuthServiceInterface::class),
            );
        });
        $this->app->alias('bitrix24.client', Bitrix24Client::class);


        $this->app->bind(CrmGroupInterface::class, function ($app) {
            return new CrmGroupRest(
                $app->make(LeadInterface::class),
                $app->make(DealInterface::class),
                $app->make(OfferInterface::class),
            );
        });

        $this->app->bind('bitrix24.rest', function ($app) {
            return new Bitrix24RestFactory(
                $app->make(NotificationInterface::class),
                $app->make(UserInterface::class),
                $app->make(CrmGroupInterface::class),
                $app->make(EventsInterface::class)
            );
        });
        $this->app->alias('bitrix24.rest', Bitrix24RestFactory::class);


        $this->app->bind(LeadInterface::class, Lead::class);
        $this->app->bind(DealInterface::class, Deal::class);
        $this->app->bind(OfferInterface::class, Offer::class);
        $this->app->bind(EventsInterface::class, Events::class);
    }

    private function bootCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LoadOfflineEventsFromBitrix24::class,
                GenerateBitrix24DTO::class,
            ]);
        }
    }

    private function macrosAndMixins(): void
    {
        $bitrix24client = $this->app->make(Bitrix24Client::class);
        Http::macro('bitrix24', function () use ($bitrix24client) {
            return $bitrix24client->getHttp();
        });
    }
}
