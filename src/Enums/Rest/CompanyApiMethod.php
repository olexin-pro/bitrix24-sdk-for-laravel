<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum CompanyApiMethod: string
{
    case GET = 'crm.company.get';
    case ADD = 'crm.company.add';
    case LIST = 'crm.company.list';
    case UPDATE = 'crm.company.update';
    case DELETE = 'crm.company.delete';
    case FIELDS = 'crm.company.fields';


    case CONTACT_ADD = 'crm.company.contact.add';
    case CONTACT_GET = 'crm.company.contact.items.get';
    case CONTACT_SET = 'crm.company.contact.items.set';
    case CONTACT_DELETE = 'crm.company.contact.delete';
    case CONTACT_DELETE_ITEMS = 'crm.company.contact.items.delete';
    case CONTACT_FIELDS = 'crm.company.contact.fields';
}
