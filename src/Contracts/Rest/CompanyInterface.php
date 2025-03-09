<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;

interface CompanyInterface extends StandardBitrixMethodsInterface,
                                   AsCollectionEntityInterface,
                                   EagerListLoadingInterface
{
}
