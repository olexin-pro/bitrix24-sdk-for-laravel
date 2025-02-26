<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Laravel\Events;

use OlexinPro\Bitrix24\Contracts\Bitrix24EventInterface;
use OlexinPro\Bitrix24\Entities\Bitrix24Event;

abstract class BaseBitrix24Event implements Bitrix24EventInterface
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public Bitrix24Event $bitrixEvent
    ) {
    }

    public function getBitrixEventDTO(): Bitrix24Event
    {
        return $this->bitrixEvent;
    }
}
