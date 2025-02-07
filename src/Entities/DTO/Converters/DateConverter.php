<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

use Illuminate\Support\Facades\Date;

final class DateConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): \Illuminate\Support\Carbon
    {
        return Date::parse($value);
    }
}
