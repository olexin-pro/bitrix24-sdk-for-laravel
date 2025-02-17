<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Rest;

use DateTimeInterface;
use OlexinPro\Bitrix24\Entities\DTO\{AbstractBitrix24DTO, Bitrix24Field, Bitrix24TypeEnum, Fields\CrmContactField};
use Illuminate\Support\Collection;

final class CrmProductEntity extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, true)]
    public int $id;

    #[Bitrix24Field('OWNER_ID', Bitrix24TypeEnum::INT)]
    public int $ownerId;

    #[Bitrix24Field('OWNER_TYPE', Bitrix24TypeEnum::STRING)]
    public string $ownerType;

    #[Bitrix24Field('PRODUCT_ID', Bitrix24TypeEnum::INT)]
    public ?int $productId;

    #[Bitrix24Field('PRODUCT_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $name;

    #[Bitrix24Field('ORIGINAL_PRODUCT_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $originalName;

    #[Bitrix24Field('PRODUCT_DESCRIPTION', Bitrix24TypeEnum::STRING)]
    public ?string $description;

    #[Bitrix24Field('PRICE', Bitrix24TypeEnum::FLOAT)]
    public ?float $price;

    #[Bitrix24Field('PRICE_EXCLUSIVE', Bitrix24TypeEnum::FLOAT)]
    public ?float $priceExclusive;

    #[Bitrix24Field('PRICE_NETTO', Bitrix24TypeEnum::FLOAT)]
    public ?float $priceNetto;

    #[Bitrix24Field('PRICE_BRUTTO', Bitrix24TypeEnum::FLOAT)]
    public ?float $priceBrutto;

    #[Bitrix24Field('PRICE_ACCOUNT', Bitrix24TypeEnum::FLOAT)]
    public ?float $priceAccount;

    #[Bitrix24Field('QUANTITY', Bitrix24TypeEnum::INT)]
    public ?int $quantity;

    #[Bitrix24Field('DISCOUNT_TYPE_ID', Bitrix24TypeEnum::INT)]
    public ?int $discountTypeId;

    #[Bitrix24Field('DISCOUNT_RATE', Bitrix24TypeEnum::FLOAT)]
    public ?float $discountRate;

    #[Bitrix24Field('DISCOUNT_SUM', Bitrix24TypeEnum::FLOAT)]
    public ?float $discountSum;

    #[Bitrix24Field('TAX_RATE', Bitrix24TypeEnum::FLOAT)]
    public ?float $taxRate;

    #[Bitrix24Field('TAX_INCLUDED', Bitrix24TypeEnum::BOOLEAN)]
    public ?bool $taxIncluded;

    #[Bitrix24Field('CUSTOMIZED', Bitrix24TypeEnum::BOOLEAN)]
    public ?bool $customized;

    #[Bitrix24Field('MEASURE_CODE', Bitrix24TypeEnum::STRING)]
    public ?string $measureCode;

    #[Bitrix24Field('MEASURE_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $measureName;

    #[Bitrix24Field('SORT', Bitrix24TypeEnum::INT)]
    public ?int $sort;

    #[Bitrix24Field('STORE_ID', Bitrix24TypeEnum::STRING)]
    public ?string $storeId;

    #[Bitrix24Field('RESERVE_ID', Bitrix24TypeEnum::STRING)]
    public ?string $reserveId;

    #[Bitrix24Field('DATE_RESERVE_END', Bitrix24TypeEnum::STRING)]
    public ?string $dateReserveEnd;

    #[Bitrix24Field('RESERVE_QUANTITY', Bitrix24TypeEnum::STRING)]
    public ?string $reserveQuantity;
}
