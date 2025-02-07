<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Rest;

use OlexinPro\Bitrix24\Entities\DTO\{
    AbstractBitrix24DTO,
    Bitrix24Field,
    Bitrix24TypeEnum
};

final class DealEntity extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, true)]
    public int $id;

    #[Bitrix24Field('TITLE', Bitrix24TypeEnum::STRING)]
    public string $title;

    #[Bitrix24Field('TYPE_ID', Bitrix24TypeEnum::STRING)]
    public string $typeId;

    #[Bitrix24Field('TypeIdTitle', Bitrix24TypeEnum::STRING)]
    public string $typeIdTitle;

    #[Bitrix24Field('CATEGORY_ID', Bitrix24TypeEnum::STRING)]
    public string $categoryId;

    #[Bitrix24Field('STAGE_ID', Bitrix24TypeEnum::STRING)]
    public string $stageId;

    #[Bitrix24Field('IS_RECURRING', Bitrix24TypeEnum::BOOLEAN)]
    public bool $isRecurring;

    #[Bitrix24Field('IS_RETURN_CUSTOMER', Bitrix24TypeEnum::BOOLEAN)]
    public bool $isReturnCustomer;

    #[Bitrix24Field('IS_REPEATED_APPROACH', Bitrix24TypeEnum::BOOLEAN)]
    public bool $isRepeatedApproach;

    #[Bitrix24Field('PROBABILITY', Bitrix24TypeEnum::INT)]
    public int $probability;

    #[Bitrix24Field('CURRENCY_ID', Bitrix24TypeEnum::STRING)]
    public string $currencyId;

    #[Bitrix24Field('OPPORTUNITY', Bitrix24TypeEnum::FLOAT)]
    public float $opportunity;

    #[Bitrix24Field('IS_MANUAL_OPPORTUNITY', Bitrix24TypeEnum::BOOLEAN)]
    public bool $isManualOpportunity;

    #[Bitrix24Field('TAX_VALUE', Bitrix24TypeEnum::FLOAT)]
    public ?float $taxValue;

    #[Bitrix24Field('COMPANY_ID', Bitrix24TypeEnum::INT)]
    public ?int $companyId;

    #[Bitrix24Field('CONTACT_ID', Bitrix24TypeEnum::INT)]
    public ?int $contactId;

    #[Bitrix24Field('BEGINDATE', Bitrix24TypeEnum::DATE)]
    public ?\DateTimeInterface $beginDate;

    #[Bitrix24Field('CLOSEDATE', Bitrix24TypeEnum::DATE)]
    public ?\DateTimeInterface $closeDate;

    #[Bitrix24Field('OPENED', Bitrix24TypeEnum::BOOLEAN)]
    public bool $opened;

    #[Bitrix24Field('CLOSED', Bitrix24TypeEnum::BOOLEAN)]
    public bool $closed;

    #[Bitrix24Field('COMMENTS', Bitrix24TypeEnum::STRING)]
    public ?string $comments;

    #[Bitrix24Field('ASSIGNED_BY_ID', Bitrix24TypeEnum::INT)]
    public int $assignedById;

    #[Bitrix24Field('SOURCE_ID', Bitrix24TypeEnum::STRING)]
    public string $sourceId;

    #[Bitrix24Field('SOURCE_DESCRIPTION', Bitrix24TypeEnum::STRING)]
    public string $sourceDescription;

    #[Bitrix24Field('ADDITIONAL_INFO', Bitrix24TypeEnum::STRING)]
    public string $additionalInfo;

    #[Bitrix24Field('LOCATION_ID')]
    public ?string $locationId;

    #[Bitrix24Field('ORIGINATOR_ID', Bitrix24TypeEnum::STRING)]
    public ?string $originatorId;

    #[Bitrix24Field('ORIGIN_ID', Bitrix24TypeEnum::STRING)]
    public ?string $originId;

    #[Bitrix24Field('UTM_SOURCE', Bitrix24TypeEnum::STRING)]
    public ?string $utmSource;

    #[Bitrix24Field('UTM_MEDIUM', Bitrix24TypeEnum::STRING)]
    public ?string $utmMedium;

    #[Bitrix24Field('UTM_CAMPAIGN', Bitrix24TypeEnum::STRING)]
    public ?string $utmCampaign;

    #[Bitrix24Field('UTM_CONTENT', Bitrix24TypeEnum::STRING)]
    public ?string $utmContent;

    #[Bitrix24Field('UTM_TERM', Bitrix24TypeEnum::STRING)]
    public ?string $utmTerm;

    #[Bitrix24Field('TRACE', Bitrix24TypeEnum::STRING)]
    public ?string $trace;
}
