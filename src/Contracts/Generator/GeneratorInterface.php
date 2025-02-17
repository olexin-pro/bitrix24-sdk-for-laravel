<?php

namespace OlexinPro\Bitrix24\Contracts\Generator;

use Illuminate\Support\Collection;

interface GeneratorInterface
{
    public function generate(string $className, Collection $fields, bool $force = false,  bool $withProducts = false): void;
}