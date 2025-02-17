<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

interface ProductRowsInterface
{
    public function productRowsSet(int $id, array $products);

    public function productRowsGet(int $id);
}
