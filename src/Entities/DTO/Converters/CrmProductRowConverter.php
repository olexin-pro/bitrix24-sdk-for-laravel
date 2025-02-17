<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;



use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Entities\DTO\Fields\CrmContactFieldValueTypeEnum;
use OlexinPro\Bitrix24\Entities\DTO\Rest\CrmProductEntity;

final class CrmProductRowConverter implements Bitrix24TypeConverterInterface
{

    /**
     * @param $value
     * @return Collection<CrmProductEntity>|null
     */
    public function convert($value): ?Collection
    {
        if(!is_array($value)){
            return null;
        }
        return collect($value)->map(fn($productRow) => new CrmProductEntity($productRow));
    }
}
