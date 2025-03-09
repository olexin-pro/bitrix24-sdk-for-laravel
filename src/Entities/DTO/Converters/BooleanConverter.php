<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

final class BooleanConverter implements Bitrix24TypeConverterInterface
{
    private const array TRUE_ITEMS = [
        'Y',
        '1',
        'true',
        'on',
        1,
        true,
    ];
    public function convert($value): bool
    {
        return in_array($value, self::TRUE_ITEMS, true);
    }
}
