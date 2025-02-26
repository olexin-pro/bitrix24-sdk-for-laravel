<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;

interface CrmItemInterface extends AsCollectionEntityInterface,
                                   EagerListLoadingInterface
{
    public function add(int $entityTypeId, array $fields);

    public function update(int $id, int $entityTypeId, array $fields);

    public function get(int $id);

    public function list(?array $select = [], ?array $filter = [], ?array $order = []);

    public function delete(int $id);

    public function fields();
}
