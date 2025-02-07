<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

final class ArrayConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): array
    {
        if(is_string($value) && json_validate($value)){
            return json_decode($value);
        }
        return (array) $value;
    }
}
