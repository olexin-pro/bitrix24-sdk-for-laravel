<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

final class BooleanConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): bool
    {
        return $value == 'Y';
    }
}
