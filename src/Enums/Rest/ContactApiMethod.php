<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum ContactApiMethod: string
{
    case GET = 'crm.contact.get';
    case ADD = 'crm.contact.add';
    case LIST = 'crm.contact.list';
    case UPDATE = 'crm.contact.update';
    case DELETE = 'crm.contact.delete';
    case FIELDS = 'crm.contact.fields';


    case COMPANY_ADD = 'crm.contact.company.add';
    case COMPANY_GET = 'crm.contact.company.items.get';
    case COMPANY_SET = 'crm.contact.company.items.set';
    case COMPANY_DELETE = 'crm.contact.company.items.delete';
    case COMPANY_FIELDS = 'crm.contact.company.fields';
}
