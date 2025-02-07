<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

interface Bitrix24TypeConverterInterface
{
    public function convert(mixed $value): mixed;

}
