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
    case USER_FIELD_ADD = 'user.userfield.add';
    case USER_FIELD_UPDATE = 'user.userfield.update';
    case USER_FIELD_DELETE = 'user.userfield.delete';
    case USER_FIELD_LIST = 'user.userfield.list';
    case USER_FIELD_FILE_GET = 'user.userfield.file.get';
}
