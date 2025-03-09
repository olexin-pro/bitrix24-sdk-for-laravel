<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Rest;

use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24Field;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24TypeEnum;

final class CompanyEntity extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, false)]
    public ?int $id;

    #[Bitrix24Field('TITLE', Bitrix24TypeEnum::STRING, true)]
    public string $title;

    #[Bitrix24Field('COMPANY_TYPE', Bitrix24TypeEnum::STRING, false)]
    public ?string $companyType;

    #[Bitrix24Field('LOGO', Bitrix24TypeEnum::ARRAY, false)]
    public ?array $logo;

    #[Bitrix24Field('ADDRESS', Bitrix24TypeEnum::STRING, false)]
    public ?string $address;

    #[Bitrix24Field('ADDRESS_2', Bitrix24TypeEnum::STRING, false)]
    public ?string $address2;

    #[Bitrix24Field('ADDRESS_CITY', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressCity;

    #[Bitrix24Field('ADDRESS_POSTAL_CODE', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressPostalCode;

    #[Bitrix24Field('ADDRESS_REGION', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressRegion;

    #[Bitrix24Field('ADDRESS_PROVINCE', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressProvince;

    #[Bitrix24Field('ADDRESS_COUNTRY', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressCountry;

    #[Bitrix24Field('ADDRESS_COUNTRY_CODE', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressCountryCode;

    #[Bitrix24Field('ADDRESS_LOC_ADDR_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $addressLocAddrId;

    #[Bitrix24Field('ADDRESS_LEGAL', Bitrix24TypeEnum::STRING, false)]
    public ?string $addressLegal;

    #[Bitrix24Field('REG_ADDRESS', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddress;

    #[Bitrix24Field('REG_ADDRESS_2', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddress2;

    #[Bitrix24Field('REG_ADDRESS_CITY', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddressCity;

    #[Bitrix24Field('REG_ADDRESS_POSTAL_CODE', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddressPostalCode;

    #[Bitrix24Field('REG_ADDRESS_REGION', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddressRegion;

    #[Bitrix24Field('REG_ADDRESS_PROVINCE', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddressProvince;

    #[Bitrix24Field('REG_ADDRESS_COUNTRY', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddressCountry;

    #[Bitrix24Field('REG_ADDRESS_COUNTRY_CODE', Bitrix24TypeEnum::STRING, false)]
    public ?string $regAddressCountryCode;

    #[Bitrix24Field('REG_ADDRESS_LOC_ADDR_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $regAddressLocAddrId;

    #[Bitrix24Field('BANKING_DETAILS', Bitrix24TypeEnum::STRING, false)]
    public ?string $bankingDetails;

    #[Bitrix24Field('INDUSTRY', Bitrix24TypeEnum::STRING, false)]
    public ?string $industry;

    #[Bitrix24Field('EMPLOYEES', Bitrix24TypeEnum::STRING, false)]
    public ?string $employees;

    #[Bitrix24Field('CURRENCY_ID', Bitrix24TypeEnum::STRING, false)]
    public ?string $currencyId;

    #[Bitrix24Field('REVENUE', Bitrix24TypeEnum::FLOAT, false)]
    public ?float $revenue;

    #[Bitrix24Field('OPENED', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $opened;

    #[Bitrix24Field('COMMENTS', Bitrix24TypeEnum::STRING, false)]
    public ?string $comments;

    #[Bitrix24Field('HAS_PHONE', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $hasPhone;

    #[Bitrix24Field('HAS_EMAIL', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $hasEmail;

    #[Bitrix24Field('HAS_IMOL', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $hasImol;

    #[Bitrix24Field('IS_MY_COMPANY', Bitrix24TypeEnum::BOOLEAN, false)]
    public ?bool $isMyCompany;

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

    #[Bitrix24Field('CONTACT_ID', Bitrix24TypeEnum::ARRAY, false)]
    public array $contactId;

    #[Bitrix24Field('LEAD_ID', Bitrix24TypeEnum::INT, false)]
    public ?int $leadId;

    #[Bitrix24Field('ORIGINATOR_ID', Bitrix24TypeEnum::STRING, false)]
    public ?string $originatorId;

    #[Bitrix24Field('ORIGIN_ID', Bitrix24TypeEnum::STRING, false)]
    public ?string $originId;

    #[Bitrix24Field('ORIGIN_VERSION', Bitrix24TypeEnum::STRING, false)]
    public ?string $originVersion;

    #[Bitrix24Field('UTM_SOURCE', Bitrix24TypeEnum::STRING, false)]
    public ?string $utmSource;

    #[Bitrix24Field('UTM_MEDIUM', Bitrix24TypeEnum::STRING, false)]
    public ?string $utmMedium;

    #[Bitrix24Field('UTM_CAMPAIGN', Bitrix24TypeEnum::STRING, false)]
    public ?string $utmCampaign;

    #[Bitrix24Field('UTM_CONTENT', Bitrix24TypeEnum::STRING, false)]
    public ?string $utmContent;

    #[Bitrix24Field('UTM_TERM', Bitrix24TypeEnum::STRING, false)]
    public ?string $utmTerm;

    #[Bitrix24Field('PARENT_ID_143', Bitrix24TypeEnum::STRING, false)]
    public ?string $parentId143;

    #[Bitrix24Field('LAST_ACTIVITY_TIME', Bitrix24TypeEnum::DATE, false)]
    public ?\DateTimeInterface $lastActivityTime;

    #[Bitrix24Field('LAST_ACTIVITY_BY', Bitrix24TypeEnum::INT, false)]
    public ?int $lastActivityBy;

    #[Bitrix24Field('PHONE', Bitrix24TypeEnum::CRM_CONTACT_FIELD, false)]
    public ?Collection $phone;

    #[Bitrix24Field('EMAIL', Bitrix24TypeEnum::CRM_CONTACT_FIELD, false)]
    public ?Collection $email;

    #[Bitrix24Field('WEB', Bitrix24TypeEnum::CRM_CONTACT_FIELD, false)]
    public ?Collection $web;

    #[Bitrix24Field('IM', Bitrix24TypeEnum::CRM_CONTACT_FIELD, false)]
    public ?Collection $im;

    #[Bitrix24Field('LINK', Bitrix24TypeEnum::CRM_CONTACT_FIELD, false)]
    public ?Collection $link;
}
