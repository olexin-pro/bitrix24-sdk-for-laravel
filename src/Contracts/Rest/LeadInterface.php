<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;

interface LeadInterface extends StandardBitrixMethodsInterface,
                                AsCollectionEntityInterface,
                                ProductRowsInterface,
                                EagerListLoadingInterface
{
}
