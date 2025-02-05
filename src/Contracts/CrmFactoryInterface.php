<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts;

interface CrmFactoryInterface
{
    public function crm(): CrmGroupRest;
}
