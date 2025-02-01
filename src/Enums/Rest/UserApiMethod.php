<?php

namespace OlexinPro\Bitrix24\Enums\Rest;

enum UserApiMethod: string
{
    case ADD = 'user.add';
    case UPDATE = 'user.update';
    case CURRENT = 'user.current';
    case GET = 'user.get';
    case SEARCH = 'user.search';
    case FIELDS = 'user.fields';
}
