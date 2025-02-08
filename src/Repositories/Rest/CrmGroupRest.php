<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use OlexinPro\Bitrix24\Contracts\CrmGroupInterface;
use OlexinPro\Bitrix24\Contracts\Rest\DealInterface;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Contracts\Rest\OfferInterface;

final readonly class CrmGroupRest implements CrmGroupInterface
{
    public function __construct(
        private LeadInterface $lead,
        private DealInterface $deal,
        private OfferInterface $offer
    ) {
    }

    public function lead(): LeadInterface
    {
        return $this->lead;
    }

    public function deal(): DealInterface
    {
        return $this->deal;
    }

    public function offer(): OfferInterface
    {
        return $this->offer;
    }
}
