<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Services\Generator;

use OlexinPro\Bitrix24\Contracts\Generator\ConfigurationInterface;

final readonly class Configuration implements ConfigurationInterface
{
    public function __construct(
        private array $config
    ) {}

    public function getNamespace(): string
    {
        return $this->config['namespace'];
    }

    public function getPath(): string
    {
        return $this->config['path'];
    }

    public function getStubPath(): string
    {
        return $this->config['stub_path'];
    }

    public function getTypeMapping(): array
    {
        return $this->config['type_mapping'];
    }
}