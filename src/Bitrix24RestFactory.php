<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\Facades\App;
use OlexinPro\Bitrix24\Contracts\NotifyInterface;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;

class Bitrix24RestFactory implements NotifyInterface
{
    public function notify(): NotificationInterface
    {
        return App::make(NotificationInterface::class);
    }

    public function user(): UserInterface
    {
        return App::make(UserInterface::class);
    }

}
