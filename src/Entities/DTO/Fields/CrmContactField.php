<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Fields;

use OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24Field;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24TypeEnum;
use OlexinPro\Bitrix24\Entities\DTO\Converters\CrmContactValueTypeConverter;

final class CrmContactField extends AbstractBitrix24DTO
{

    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT)]
    public ?int $id;

    #[Bitrix24Field('TYPE_ID', Bitrix24TypeEnum::STRING)]
    public string $typeId;

    #[Bitrix24Field('VALUE', Bitrix24TypeEnum::STRING)]
    public string $value;

    #[Bitrix24Field('VALUE_TYPE', CrmContactValueTypeConverter::class)]
    public CrmContactFieldValueTypeEnum $valueType;

}
