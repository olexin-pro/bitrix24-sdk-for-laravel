<?php

namespace OlexinPro\Bitrix24\Enums\Rest;

enum EventApiMethod: string
{
    case EVENTS = 'events';
    case GET = 'event.get';
    case BIND = 'event.bind';
    case UNBIND = 'event.unbind';
    case OFFLINE_CLEAR = 'event.offline.clear';
    case OFFLINE_ERROR = 'event.offline.error';
    case OFFLINE_GET = 'event.offline.get';
    case OFFLINE_LIST = 'event.offline.list';
}
