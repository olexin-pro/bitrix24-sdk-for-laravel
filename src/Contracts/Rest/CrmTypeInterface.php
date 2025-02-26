<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;

interface CrmTypeInterface extends StandardBitrixMethodsInterface,
                                   AsCollectionEntityInterface,
                                   EagerListLoadingInterface
{
    public function getByEntityTypeId(int $id);
}
