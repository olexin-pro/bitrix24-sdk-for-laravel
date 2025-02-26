<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use OlexinPro\Bitrix24\Contracts\CrmFactoryInterface;
use OlexinPro\Bitrix24\Contracts\CrmGroupInterface;
use OlexinPro\Bitrix24\Contracts\NotificationFactoryInterface;
use OlexinPro\Bitrix24\Contracts\Rest\EventsInterface;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Contracts\UserFactoryInterface;

readonly class Bitrix24RestFactory implements NotificationFactoryInterface, UserFactoryInterface, CrmFactoryInterface
{
    public function __construct(
        private NotificationInterface $notification,
        private UserInterface $user,
        private CrmGroupInterface $crmGroupRest,
        private EventsInterface $events,
    ) {
    }

    public function notify(): NotificationInterface
    {
        return $this->notification;
    }

    public function user(): UserInterface
    {
        return $this->user;
    }

    public function crm(): CrmGroupInterface
    {
        return $this->crmGroupRest;
    }

    public function events(): EventsInterface
    {
        return $this->events;
    }

}
