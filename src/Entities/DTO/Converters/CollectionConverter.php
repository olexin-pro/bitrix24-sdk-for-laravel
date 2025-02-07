<?php

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

use InvalidArgumentException;

final class CollectionConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): \Illuminate\Support\Collection
    {
        if(!is_array($value)) {
            throw new InvalidArgumentException('Collection converter requires an array');
        }
        return collect($value);
    }
}
