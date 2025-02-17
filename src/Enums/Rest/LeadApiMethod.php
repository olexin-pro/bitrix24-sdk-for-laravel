<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum LeadApiMethod: string
{
    case GET = 'crm.lead.get';
    case ADD = 'crm.lead.add';
    case LIST = 'crm.lead.list';
    case UPDATE = 'crm.lead.update';
    case DELETE = 'crm.lead.delete';
    case FIELDS = 'crm.lead.fields';
    case PRODUCT_ROWS_SET = 'crm.lead.productrows.set';
    case PRODUCT_ROWS_GET = 'crm.lead.productrows.get';
}
