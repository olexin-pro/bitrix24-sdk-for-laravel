<?php

namespace OlexinPro\Bitrix24\Contracts;

use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;

interface AsCollectionProductsEntityInterface
{
    public function getAsEntityWithProducts(): Bitrix24DTOInterface|array;
}
