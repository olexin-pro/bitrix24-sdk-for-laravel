<?php

namespace OlexinPro\Bitrix24\Entities\DTO;

interface Bitrix24DTOInterface
{
    public function __construct(array $data);
    public function getRawData(): array;
}
