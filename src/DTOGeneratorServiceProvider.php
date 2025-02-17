<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\ServiceProvider;
use OlexinPro\Bitrix24\Console\Commands\GenerateBitrix24DTO;
use OlexinPro\Bitrix24\Contracts\Generator\ConfigurationInterface;
use OlexinPro\Bitrix24\Contracts\Generator\GeneratorInterface;
use OlexinPro\Bitrix24\Contracts\Generator\StubRendererInterface;
use OlexinPro\Bitrix24\Services\Generator\Configuration;
use OlexinPro\Bitrix24\Services\Generator\Generator;
use OlexinPro\Bitrix24\Services\Generator\StubRenderer;

class DTOGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConfigurationInterface::class, function ($app) {
            return new Configuration($app['config']['bitrix24']['generator']);
        });

        $this->app->singleton(StubRendererInterface::class, StubRenderer::class);
        $this->app->singleton(GeneratorInterface::class, Generator::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateBitrix24DTO::class,
            ]);
        }
    }
}
