<?php

namespace OlexinPro\Bitrix24\Contracts\Generator;

interface ConfigurationInterface
{
    public function getNamespace(): string;
    public function getPath(): string;
    public function getStubPath(): string;
    public function getTypeMapping(): array;
}