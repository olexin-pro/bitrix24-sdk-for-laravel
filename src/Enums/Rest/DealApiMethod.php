<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum DealApiMethod: string
{
    case GET = 'crm.deal.get';
    case ADD = 'crm.deal.add';
    case LIST = 'crm.deal.list';
    case UPDATE = 'crm.deal.update';
    case DELETE = 'crm.deal.delete';
    case FIELDS = 'crm.deal.fields';
    case PRODUCT_ROWS_SET = 'crm.deal.productrows.set';
    case PRODUCT_ROWS_GET = 'crm.deal.productrows.get';
}
