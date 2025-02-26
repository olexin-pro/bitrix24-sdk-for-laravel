<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum OfferApiMethod: string
{
    case GET = 'crm.quote.get';
    case ADD = 'crm.quote.add';
    case LIST = 'crm.quote.list';
    case UPDATE = 'crm.quote.update';
    case DELETE = 'crm.quote.delete';
    case FIELDS = 'crm.quote.fields';
    case PRODUCT_ROWS_SET = 'crm.quote.productrows.set';
    case PRODUCT_ROWS_GET = 'crm.quote.productrows.get';
}
