<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts;

use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;

interface UserFactoryInterface
{
    public function user(): UserInterface;
}
