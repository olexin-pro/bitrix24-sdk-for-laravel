<?php

namespace OlexinPro\Bitrix24\Entities\DTO;

enum Bitrix24TypeEnum: string
{
    case STRING = 'string';
    case INT = 'int';
    case FLOAT = 'float';
    case BOOLEAN = 'boolean';
    case ARRAY = 'array';
    case COLLECTION = 'collection';
    case DATE = 'date';
    case DYNAMIC = 'dynamic';
    case CRM_CONTACT_FIELD = 'crm_multi_field';
}
