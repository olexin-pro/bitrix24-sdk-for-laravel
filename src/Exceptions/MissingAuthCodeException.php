<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Exceptions;

use Exception;

class MissingAuthCodeException extends Exception
{
    public function __construct($message = "Auth code is empty", $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
