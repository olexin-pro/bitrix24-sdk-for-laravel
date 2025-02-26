<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum CrmItemApiMethod: string
{
    case GET = 'crm.lead.get';
    case ADD = 'crm.item.add';
    case LIST = 'crm.item.list';
    case UPDATE = 'crm.item.update';
    case DELETE = 'crm.item.delete';
    case FIELDS = 'crm.item.fields';
}
