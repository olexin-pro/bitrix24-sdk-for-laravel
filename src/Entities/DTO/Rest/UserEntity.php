<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Rest;

use DateTimeInterface;
use OlexinPro\Bitrix24\Entities\DTO\{AbstractBitrix24DTO, Bitrix24Field, Bitrix24TypeEnum};

final class UserEntity extends AbstractBitrix24DTO
{
    #[Bitrix24Field('ID', Bitrix24TypeEnum::INT, true)]
    public int $id;

    #[Bitrix24Field('XML_ID', Bitrix24TypeEnum::STRING)]
    public ?string $xmlId;

    #[Bitrix24Field('ACTIVE', Bitrix24TypeEnum::BOOLEAN)]
    public bool $active;

    #[Bitrix24Field('NAME', Bitrix24TypeEnum::STRING)]
    public string $name;

    #[Bitrix24Field('LAST_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $lastName;

    #[Bitrix24Field('SECOND_NAME', Bitrix24TypeEnum::STRING)]
    public ?string $secondName;

    #[Bitrix24Field('TITLE', Bitrix24TypeEnum::STRING)]
    public ?string $title;

    #[Bitrix24Field('EMAIL', Bitrix24TypeEnum::STRING)]
    public ?string $email;

    #[Bitrix24Field('LAST_LOGIN', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $lastLogin;

    #[Bitrix24Field('DATE_REGISTER', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $dateRegister;

    #[Bitrix24Field('TIME_ZONE', Bitrix24TypeEnum::STRING)]
    public ?string $timeZone;

    #[Bitrix24Field('IS_ONLINE', Bitrix24TypeEnum::BOOLEAN)]
    public ?bool $isOnline;

    #[Bitrix24Field('TIME_ZONE_OFFSET', Bitrix24TypeEnum::INT)]
    public ?int $timeZoneOffset;

    #[Bitrix24Field('TIMESTAMP_X', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $timestampX;

    #[Bitrix24Field('LAST_ACTIVITY_DATE', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $lastActivityDate;

    #[Bitrix24Field('PERSONAL_GENDER', Bitrix24TypeEnum::STRING)]
    public ?string $personalGender;

    #[Bitrix24Field('PERSONAL_PROFESSION', Bitrix24TypeEnum::STRING)]
    public ?string $personalProfession;

    #[Bitrix24Field('PERSONAL_WWW', Bitrix24TypeEnum::STRING)]
    public string $personalWww;

    #[Bitrix24Field('PERSONAL_BIRTHDAY', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $personalBirthday;

    #[Bitrix24Field('PERSONAL_PHOTO', Bitrix24TypeEnum::STRING)]
    public ?string $personalPhoto;

    #[Bitrix24Field('PERSONAL_ICQ', Bitrix24TypeEnum::STRING)]
    public ?string $personalIcq;

    #[Bitrix24Field('PERSONAL_PHONE', Bitrix24TypeEnum::STRING)]
    public ?string $personalPhone;

    #[Bitrix24Field('PERSONAL_FAX', Bitrix24TypeEnum::STRING)]
    public ?string $personalFax;

    #[Bitrix24Field('PERSONAL_MOBILE', Bitrix24TypeEnum::STRING)]
    public ?string $personalMobile;

    #[Bitrix24Field('PERSONAL_PAGER', Bitrix24TypeEnum::STRING)]
    public ?string $personalPager;

    #[Bitrix24Field('PERSONAL_STREET', Bitrix24TypeEnum::STRING)]
    public ?string $personalStreet;

    #[Bitrix24Field('PERSONAL_CITY', Bitrix24TypeEnum::STRING)]
    public ?string $personalCity;

    #[Bitrix24Field('PERSONAL_STATE', Bitrix24TypeEnum::STRING)]
    public ?string $personalState;

    #[Bitrix24Field('PERSONAL_ZIP', Bitrix24TypeEnum::STRING)]
    public ?string $personalZip;

    #[Bitrix24Field('PERSONAL_COUNTRY', Bitrix24TypeEnum::STRING)]
    public ?string $personalCountry;

    #[Bitrix24Field('PERSONAL_MAILBOX', Bitrix24TypeEnum::STRING)]
    public ?string $personalMailbox;

    #[Bitrix24Field('PERSONAL_NOTES', Bitrix24TypeEnum::STRING)]
    public ?string $personalNotes;

    #[Bitrix24Field('WORK_PHONE', Bitrix24TypeEnum::STRING)]
    public ?string $workPhone;

    #[Bitrix24Field('WORK_COMPANY', Bitrix24TypeEnum::STRING)]
    public ?string $workCompany;

    #[Bitrix24Field('WORK_POSITION', Bitrix24TypeEnum::STRING)]
    public ?string $workPosition;

    #[Bitrix24Field('WORK_DEPARTMENT', Bitrix24TypeEnum::STRING)]
    public ?string $workDepartment;

    #[Bitrix24Field('WORK_WWW', Bitrix24TypeEnum::STRING)]
    public ?string $workWww;

    #[Bitrix24Field('WORK_FAX', Bitrix24TypeEnum::STRING)]
    public ?string $workFax;

    #[Bitrix24Field('WORK_PAGER', Bitrix24TypeEnum::STRING)]
    public ?string $workPager;

    #[Bitrix24Field('WORK_STREET', Bitrix24TypeEnum::STRING)]
    public ?string $workStreet;

    #[Bitrix24Field('WORK_MAILBOX', Bitrix24TypeEnum::STRING)]
    public ?string $workMailbox;

    #[Bitrix24Field('WORK_CITY', Bitrix24TypeEnum::STRING)]
    public ?string $workCity;

    #[Bitrix24Field('WORK_STATE', Bitrix24TypeEnum::STRING)]
    public ?string $workState;

    #[Bitrix24Field('WORK_ZIP', Bitrix24TypeEnum::STRING)]
    public ?string $workZip;

    #[Bitrix24Field('WORK_COUNTRY', Bitrix24TypeEnum::STRING)]
    public ?string $workCountry;

    #[Bitrix24Field('WORK_PROFILE', Bitrix24TypeEnum::STRING)]
    public ?string $workProfile;

    #[Bitrix24Field('WORK_LOGO', Bitrix24TypeEnum::STRING)]
    public ?string $workLogo;

    #[Bitrix24Field('WORK_NOTES', Bitrix24TypeEnum::STRING)]
    public ?string $workNotes;

    #[Bitrix24Field('UF_SKYPE_LINK', Bitrix24TypeEnum::STRING)]
    public ?string $ufSkypeLink;

    #[Bitrix24Field('UF_ZOOM', Bitrix24TypeEnum::STRING)]
    public ?string $ufZoom;

    #[Bitrix24Field('UF_EMPLOYMENT_DATE', Bitrix24TypeEnum::DATE)]
    public ?DateTimeInterface $ufEmploymentDate;

    #[Bitrix24Field('UF_TIMEMAN', Bitrix24TypeEnum::STRING)]
    public ?string $ufTimeman;

    #[Bitrix24Field('UF_DEPARTMENT', Bitrix24TypeEnum::ARRAY)]
    public ?array $ufDepartment;

    #[Bitrix24Field('UF_INTERESTS', Bitrix24TypeEnum::STRING)]
    public ?string $ufInterests;

    #[Bitrix24Field('UF_SKILLS', Bitrix24TypeEnum::STRING)]
    public ?string $ufSkills;

    #[Bitrix24Field('UF_WEB_SITES', Bitrix24TypeEnum::STRING)]
    public ?string $ufWebSites;

    #[Bitrix24Field('UF_XING', Bitrix24TypeEnum::STRING)]
    public ?string $ufXing;

    #[Bitrix24Field('UF_LINKEDIN', Bitrix24TypeEnum::STRING)]
    public ?string $ufLinkedin;

    #[Bitrix24Field('UF_FACEBOOK', Bitrix24TypeEnum::STRING)]
    public ?string $ufFacebook;

    #[Bitrix24Field('UF_TWITTER', Bitrix24TypeEnum::STRING)]
    public ?string $ufTwitter;

    #[Bitrix24Field('UF_SKYPE', Bitrix24TypeEnum::STRING)]
    public ?string $ufSkype;

    #[Bitrix24Field('UF_DISTRICT', Bitrix24TypeEnum::STRING)]
    public ?string $ufDistrict;

    #[Bitrix24Field('UF_PHONE_INNER', Bitrix24TypeEnum::STRING)]
    public ?string $ufPhoneInner;

    #[Bitrix24Field('USER_TYPE', Bitrix24TypeEnum::STRING)]
    public ?string $userType;
}
