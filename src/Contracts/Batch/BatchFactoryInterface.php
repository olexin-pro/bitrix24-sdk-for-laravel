<?php

namespace OlexinPro\Bitrix24\Contracts\Batch;

use OlexinPro\Bitrix24\API\Batch\Requests\BatchUserRequest;

interface BatchFactoryInterface
{
    public function user(): BatchUserRequest;
}
