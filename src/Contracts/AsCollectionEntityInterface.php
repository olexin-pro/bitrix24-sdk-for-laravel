<?php

namespace OlexinPro\Bitrix24\Contracts;

use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Contracts\Rest\StandardBitrixMethodsInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;

interface AsCollectionEntityInterface
{
    public function listAsCollection(): Collection;
    public function getAsEntity(): Bitrix24DTOInterface|array;
    public function getAsEntityWithProducts(): Bitrix24DTOInterface|array;
    public function fieldsCollection(): Collection;
}