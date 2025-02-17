<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts\Generator;

interface StubRendererInterface
{
    public function render(string $stubPath, array $replacements): string;
}