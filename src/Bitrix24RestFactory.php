<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Support\Facades\App;
use OlexinPro\Bitrix24\Contracts\CrmFactoryInterface;
use OlexinPro\Bitrix24\Contracts\CrmGroupRest;
use OlexinPro\Bitrix24\Contracts\NotificationFactoryInterface;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Contracts\UserFactoryInterface;

class Bitrix24RestFactory implements NotificationFactoryInterface, UserFactoryInterface, CrmFactoryInterface
{
    public function notify(): NotificationInterface
    {
        return App::make(NotificationInterface::class);
    }

    public function user(): UserInterface
    {
        return App::make(UserInterface::class);
    }

    public function crm(): CrmGroupRest
    {
        return App::make(CrmGroupRest::class);
    }

}
