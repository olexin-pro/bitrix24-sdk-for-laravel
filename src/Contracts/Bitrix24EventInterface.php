<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts;

use OlexinPro\Bitrix24\Entities\Bitrix24Event;

interface Bitrix24EventInterface
{
    public function getBitrix24EventDTO(): Bitrix24Event;
}
