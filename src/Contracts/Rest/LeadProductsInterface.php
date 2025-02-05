<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

interface LeadProductsInterface
{
    public function productRowsSet(int $id, array $products);

    public function productRowsGet(int $id);
}
