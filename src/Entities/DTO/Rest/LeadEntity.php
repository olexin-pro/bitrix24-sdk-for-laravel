<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Rest;

use DateTimeInterface;
use OlexinPro\Bitrix24\Entities\DTO\{AbstractBitrix24DTO, Bitrix24Field, Bitrix24TypeEnum};

final class LeadEntity extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, true)]
    public int $id;

    #[Bitrix24Field('TITLE', Bitrix24TypeEnum::STRING)]
    public string $title;

    #[Bitrix24Field('ASSIGNED_BY_ID', Bitrix24TypeEnum::INT)]
    public ?int $assignedById;

    #[Bitrix24Field('COMMENTS', Bitrix24TypeEnum::STRING)]
    public ?string $comments;

    #[Bitrix24Field('COMPANY_ID', Bitrix24TypeEnum::INT)]
    public ?int $companyId;

    #[Bitrix24Field('COMPANY_TITLE', Bitrix24TypeEnum::STRING)]
    public ?string $companyTitle;

    #[Bitrix24Field('CONTACT_ID', Bitrix24TypeEnum::INT)]
    public ?int $contactId;

    #[Bitrix24Field('CONTACT_IDS', Bitrix24TypeEnum::ARRAY)]
    public ?array $contactIds;

    #[Bitrix24Field('HONORIFIC', Bitrix24TypeEnum::STRING)]
    public ?string $honorific;

    #[Bitrix24Field('LAST_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $lastName;

    #[Bitrix24Field('NAME', Bitrix24TypeEnum::STRING)]
    public ?string $name;

    #[Bitrix24Field('SECOND_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $secondName;

    #[Bitrix24Field('BIRTHDATE', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $birthdate;

    #[Bitrix24Field('POST', Bitrix24TypeEnum::STRING)]
    public ?string $post;

    #[Bitrix24Field('PHONE', Bitrix24TypeEnum::CRM_CONTACT_FIELD)]
    public ?array $phone;

    #[Bitrix24Field('EMAIL', Bitrix24TypeEnum::CRM_CONTACT_FIELD)]
    public ?array $email;

    #[Bitrix24Field('IM', Bitrix24TypeEnum::CRM_CONTACT_FIELD)]
    public ?array $im;

    #[Bitrix24Field('LINK', Bitrix24TypeEnum::CRM_CONTACT_FIELD)]
    public ?array $link;

    #[Bitrix24Field('WEB', Bitrix24TypeEnum::CRM_CONTACT_FIELD)]
    public ?array $web;

    #[Bitrix24Field('ADDRESS', Bitrix24TypeEnum::STRING)]
    public ?string $address;

    #[Bitrix24Field('ADDRESS_2', Bitrix24TypeEnum::STRING)]
    public ?string $address2;

    #[Bitrix24Field('ADDRESS_CITY', Bitrix24TypeEnum::STRING)]
    public ?string $addressCity;

    #[Bitrix24Field('ADDRESS_COUNTRY', Bitrix24TypeEnum::STRING)]
    public ?string $addressCountry;

    #[Bitrix24Field('ADDRESS_COUNTRY_CODE', Bitrix24TypeEnum::STRING)]
    public ?string $addressCountryCode;

    #[Bitrix24Field('ADDRESS_POSTAL_CODE', Bitrix24TypeEnum::STRING)]
    public ?string $addressPostalCode;

    #[Bitrix24Field('ADDRESS_PROVINCE', Bitrix24TypeEnum::STRING)]
    public ?string $addressProvince;

    #[Bitrix24Field('ADDRESS_REGION', Bitrix24TypeEnum::STRING)]
    public ?string $addressRegion;

    #[Bitrix24Field('OPENED', Bitrix24TypeEnum::BOOLEAN)]
    public bool $opened;

    #[Bitrix24Field('CURRENCY_ID', Bitrix24TypeEnum::STRING)]
    public ?string $currencyId;

    #[Bitrix24Field('OPPORTUNITY', Bitrix24TypeEnum::FLOAT)]
    public ?float $opportunity;

    #[Bitrix24Field('IS_MANUAL_OPPORTUNITY', Bitrix24TypeEnum::BOOLEAN)]
    public ?bool $isManualOpportunity;

    #[Bitrix24Field('ORIGINATOR_ID', Bitrix24TypeEnum::STRING)]
    public ?string $originatorId;

    #[Bitrix24Field('ORIGIN_ID', Bitrix24TypeEnum::STRING)]
    public ?string $originId;

    #[Bitrix24Field('SOURCE_ID', Bitrix24TypeEnum::STRING)]
    public ?string $sourceId;

    #[Bitrix24Field('SOURCE_DESCRIPTION', Bitrix24TypeEnum::STRING)]
    public ?string $sourceDescription;

    #[Bitrix24Field('STATUS_ID', Bitrix24TypeEnum::STRING)]
    public ?string $statusId;

    #[Bitrix24Field('STATUS_DESCRIPTION', Bitrix24TypeEnum::STRING)]
    public ?string $statusDescription;

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
}
