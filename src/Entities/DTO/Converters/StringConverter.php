<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

final class StringConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): string
    {
        return strval($value);
    }
}
