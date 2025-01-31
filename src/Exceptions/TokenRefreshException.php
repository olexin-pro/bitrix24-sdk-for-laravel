<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Exceptions;

use Exception;

class TokenRefreshException extends Exception
{
    public function __construct($message = "Failed to refresh token", $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
