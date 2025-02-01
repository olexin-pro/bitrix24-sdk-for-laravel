<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\Facades\App;
use OlexinPro\Bitrix24\Contracts\NotifyInterface;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;

class Bitrix24Rest implements NotifyInterface
{
    public function notify(): NotificationInterface
    {
        return App::make(NotificationInterface::class);
    }

}
