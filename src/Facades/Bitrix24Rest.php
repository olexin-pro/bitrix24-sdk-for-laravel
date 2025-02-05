<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade of Bitrix24 rest api
 *
 * @method \OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface notify()
 * @method \OlexinPro\Bitrix24\Contracts\Rest\UserInterface user()
 */
class Bitrix24Rest extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bitrix24.rest';
    }
}
