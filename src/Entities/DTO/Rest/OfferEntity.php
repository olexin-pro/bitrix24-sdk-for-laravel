<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Rest;

use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24Field;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24TypeEnum;
use OlexinPro\Bitrix24\Entities\DTO\Converters\CrmProductRowConverter;

final class OfferEntity extends AbstractBitrix24DTO
{

    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, false)]
    public ?int $id;

    #[Bitrix24Field('QUOTE_NUMBER', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $quoteNumber;

    #[Bitrix24Field('TITLE', Bitrix24TypeEnum::DYNAMIC, true)]
    public mixed $title;

    #[Bitrix24Field('STATUS_ID', Bitrix24TypeEnum::STRING, false)]
    public ?string $statusId;

    #[Bitrix24Field('CURRENCY_ID', Bitrix24TypeEnum::STRING, false)]
    public ?string $currencyId;

    #[Bitrix24Field('OPPORTUNITY', Bitrix24TypeEnum::FLOAT, false)]
    public ?float $opportunity;

    #[Bitrix24Field('TAX_VALUE', Bitrix24TypeEnum::FLOAT, false)]
    public ?float $taxValue;

    #[Bitrix24Field('COMPANY_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $companyId;

    #[Bitrix24Field('MYCOMPANY_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $mycompanyId;

    #[Bitrix24Field('CONTACT_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $contactId;

    #[Bitrix24Field('CONTACT_IDS', Bitrix24TypeEnum::ARRAY, false)]
    public array $contactIds;

    #[Bitrix24Field('BEGINDATE', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $begindate;

    #[Bitrix24Field('CLOSEDATE', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $closedate;

    #[Bitrix24Field('ACTUAL_DATE', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $actualDate;

    #[Bitrix24Field('OPENED', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $opened;

    #[Bitrix24Field('CLOSED', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $closed;

    #[Bitrix24Field('COMMENTS', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $comments;

    #[Bitrix24Field('CONTENT', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $content;

    #[Bitrix24Field('TERMS', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $terms;

    #[Bitrix24Field('CLIENT_TITLE', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientTitle;

    #[Bitrix24Field('CLIENT_ADDR', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientAddr;

    #[Bitrix24Field('CLIENT_CONTACT', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientContact;

    #[Bitrix24Field('CLIENT_EMAIL', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientEmail;

    #[Bitrix24Field('CLIENT_PHONE', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientPhone;

    #[Bitrix24Field('CLIENT_TP_ID', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientTpId;

    #[Bitrix24Field('CLIENT_TPA_ID', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $clientTpaId;

    #[Bitrix24Field('ASSIGNED_BY_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $assignedById;

    #[Bitrix24Field('CREATED_BY_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $createdById;

    #[Bitrix24Field('MODIFY_BY_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $modifyById;

    #[Bitrix24Field('DATE_CREATE', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $dateCreate;

    #[Bitrix24Field('DATE_MODIFY', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $dateModify;

    #[Bitrix24Field('LEAD_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $leadId;

    #[Bitrix24Field('DEAL_ID', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $dealId;

    #[Bitrix24Field('PERSON_TYPE_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $personTypeId;

    #[Bitrix24Field('LOCATION_ID', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $locationId;

    #[Bitrix24Field('UTM_SOURCE', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $utmSource;

    #[Bitrix24Field('UTM_MEDIUM', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $utmMedium;

    #[Bitrix24Field('UTM_CAMPAIGN', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $utmCampaign;

    #[Bitrix24Field('UTM_CONTENT', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $utmContent;

    #[Bitrix24Field('UTM_TERM', Bitrix24TypeEnum::DYNAMIC, false)]
    public mixed $utmTerm;

    #[Bitrix24Field('LAST_ACTIVITY_TIME', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $lastActivityTime;

    #[Bitrix24Field('LAST_ACTIVITY_BY', Bitrix24TypeEnum::INT, false)]
    public ?int $lastActivityBy;

    /**
     * @var Collection<CrmProductEntity>|null
     */
    #[Bitrix24Field(self::PRODUCT_ROWS_KEY, CrmProductRowConverter::class)]
    public ?Collection $products;
}
