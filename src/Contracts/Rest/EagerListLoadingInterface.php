<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use Generator;

interface EagerListLoadingInterface
{
    public function listEager(): Generator;
}
