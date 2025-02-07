<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

final class IntConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): int
    {
        return intval($value);
    }
}
