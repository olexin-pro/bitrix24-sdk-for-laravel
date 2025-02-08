<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use OlexinPro\Bitrix24\Entities\DTO\Rest\LeadEntity;

interface LeadInterface
{
    public function add(array $fields);

    public function update(int $id, array $fields);

    public function get(int $id);

    /**
     * @return \Illuminate\Support\Collection<LeadEntity>
     */
    public function list(?array $select = [], ?array $filter = [], ?array $order = [], ?int $start = 0);

    public function delete(int $id);

    public function fields();
}
