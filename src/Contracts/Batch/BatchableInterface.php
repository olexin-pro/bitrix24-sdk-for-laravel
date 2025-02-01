<?php

namespace OlexinPro\Bitrix24\Contracts\Batch;

interface BatchableInterface
{
    public function toBatchRequest(): array;
}
