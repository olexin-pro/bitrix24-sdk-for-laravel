<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Facades;

use Illuminate\Support\Facades\Facade;

class Bitrix24Batch extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bitrix24.batch';
    }
}
