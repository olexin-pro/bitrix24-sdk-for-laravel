<?php

namespace OlexinPro\Bitrix24\Contracts;

use OlexinPro\Bitrix24\Contracts\Rest\CompanyInterface;
use OlexinPro\Bitrix24\Contracts\Rest\ContactInterface;
use OlexinPro\Bitrix24\Contracts\Rest\DealInterface;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Contracts\Rest\OfferInterface;

interface CrmGroupInterface
{
    public function lead(): LeadInterface;

    public function deal(): DealInterface;

    public function offer(): OfferInterface;

    public function contact(): ContactInterface;

    public function company(): CompanyInterface;
}
