<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum LeadApiMethod: string
{
    case GET = 'crm.lead.get';
    case LIST = 'crm.lead.list';
}
