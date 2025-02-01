<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums\Rest;

enum NotifyApiMethod: string
{
    case PERSONAL_ADD = 'im.notify.personal.add';
    case SYSTEM_ADD = 'im.notify.system.add';
    case DELETE = 'im.notify.delete';
    case READ = 'im.notify.read';
    case READ_LIST = 'im.notify.read.list';
}
