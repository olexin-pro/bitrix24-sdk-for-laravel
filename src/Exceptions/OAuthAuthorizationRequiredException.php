<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Exceptions;

use Exception;

class OAuthAuthorizationRequiredException extends Exception
{
    public function __construct(
        string $message = 'OAuth authorization required',
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
