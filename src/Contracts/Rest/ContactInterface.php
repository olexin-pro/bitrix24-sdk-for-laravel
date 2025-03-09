<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;

interface ContactInterface extends StandardBitrixMethodsInterface,
                                   AsCollectionEntityInterface,
                                   EagerListLoadingInterface
{
}
