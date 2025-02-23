<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

interface StandardBitrixMethodsInterface
{

    public function add(array $fields);

    public function update(int $id, array $fields);

    public function get(int $id);

    public function list(?array $select = [], ?array $filter = [], ?array $order = []);

    public function delete(int $id);

    public function fields();
}
