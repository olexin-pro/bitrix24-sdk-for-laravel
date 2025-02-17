<?php

namespace OlexinPro\Bitrix24\Entities\DTO\Fields;

enum CrmContactFieldValueTypeEnum: string
{
    case WORK = 'WORK';
    case MOBILE = 'MOBILE';
    case FAX = 'FAX';
    case MAILING = 'MAILING';
    case PAGER = 'PAGER';
    case HOME = 'HOME';
    case OTHER = 'OTHER';
}
