<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use OlexinPro\Bitrix24\Contracts\Rest\DealInterface;

class Deal extends BaseRest implements DealInterface
{

    public function add(array $fields)
    {
        // TODO: Implement add() method.
    }

    public function update(int $id, array $fields)
    {
        // TODO: Implement update() method.
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public function list(?array $select = [], ?array $filter = [], ?array $order = [], ?int $start = 0)
    {
        // TODO: Implement list() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function fields()
    {
        // TODO: Implement fields() method.
    }

    public function productRowsSet(int $id, array $products)
    {
        // TODO: Implement productRowsSet() method.
    }

    public function productRowsGet(int $id)
    {
        // TODO: Implement productRowsGet() method.
    }
}
