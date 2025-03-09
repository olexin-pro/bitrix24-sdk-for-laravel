<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;
use OlexinPro\Bitrix24\Contracts\AsCollectionProductsEntityInterface;

interface LeadInterface extends StandardBitrixMethodsInterface,
                                AsCollectionEntityInterface,
                                AsCollectionProductsEntityInterface,
                                ProductRowsInterface,
                                EagerListLoadingInterface
{
}
