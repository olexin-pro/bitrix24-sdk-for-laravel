<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum CrmTypeApiMethod: string
{
    case GET = 'crm.type.get';
    case GET_BY_ENTITY_TYPE_ID = 'crm.type.getByEntityTypeId';
    case ADD = 'crm.type.add';
    case LIST = 'crm.type.list';
    case UPDATE = 'crm.type.update';
    case DELETE = 'crm.type.delete';
    case FIELDS = 'crm.type.fields';
}
