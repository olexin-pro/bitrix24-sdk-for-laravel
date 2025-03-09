<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;
use OlexinPro\Bitrix24\Contracts\AsCollectionProductsEntityInterface;

interface OfferInterface extends StandardBitrixMethodsInterface,
                                 AsCollectionEntityInterface,
                                 AsCollectionProductsEntityInterface,
                                 ProductRowsInterface,
                                 EagerListLoadingInterface
{

}
