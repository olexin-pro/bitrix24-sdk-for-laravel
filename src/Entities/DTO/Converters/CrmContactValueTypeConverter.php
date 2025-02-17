<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;



use OlexinPro\Bitrix24\Entities\DTO\Fields\CrmContactFieldValueTypeEnum;

final class CrmContactValueTypeConverter implements Bitrix24TypeConverterInterface
{
    public function convert($value): CrmContactFieldValueTypeEnum
    {
        $enumValue = CrmContactFieldValueTypeEnum::tryFrom($value);

        if ($enumValue !== null) {
            return $enumValue;
        } else {
            return CrmContactFieldValueTypeEnum::OTHER;
        }
    }
}
