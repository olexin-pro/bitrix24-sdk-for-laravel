<?php

namespace OlexinPro\Bitrix24\Contracts;

use Generator;
use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;

interface AsCollectionEntityInterface
{
    public function listAsEntity(): Generator;

    public function listEagerAsEntity(): Generator;
    public function getAsEntity(): Bitrix24DTOInterface|array;
    public function getAsEntityWithProducts(): Bitrix24DTOInterface|array;
    public function fieldsCollection(): Collection;
}
