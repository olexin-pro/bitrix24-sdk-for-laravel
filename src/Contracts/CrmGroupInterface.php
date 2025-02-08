<?php

namespace OlexinPro\Bitrix24\Contracts;

use OlexinPro\Bitrix24\Contracts\Rest\DealInterface;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Contracts\Rest\OfferInterface;

interface CrmGroupInterface
{
    public function lead(): LeadInterface;

    public function deal(): DealInterface;

    public function offer(): OfferInterface;
}
