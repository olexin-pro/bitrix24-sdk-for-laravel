<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Services\Generator;

use OlexinPro\Bitrix24\Contracts\Generator\StubRendererInterface;

final class StubRenderer implements StubRendererInterface
{
    public function render(string $stubPath, array $replacements): string
    {
        $content = file_get_contents($stubPath);

        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }
}