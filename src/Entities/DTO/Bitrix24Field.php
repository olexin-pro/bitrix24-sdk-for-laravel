<?php

namespace OlexinPro\Bitrix24\Entities\DTO;

use Attribute;
use OlexinPro\Bitrix24\Entities\DTO\Converters\Bitrix24TypeConverterInterface;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Bitrix24Field
{
    public function __construct(
        public string $fieldName,
        public Bitrix24TypeEnum|Bitrix24TypeConverterInterface $type = Bitrix24TypeEnum::DYNAMIC,
        public bool $required = false
    ) {}
}
