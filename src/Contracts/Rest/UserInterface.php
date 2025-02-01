<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts\Rest;

interface UserInterface
{
    public function add(array $fields);

    public function current();

    public function update(array $fields);

    public function get(
        array $filter = [],
        ?string $sort = null,
        ?string $order = null,
        bool $adminMode = false,
        int $start = 0,
    );

    public function search(
        array $filter = [],
        ?string $sort = null,
        ?string $order = null,
        bool $adminMode = false,
        int $start = 0,
    );

    public function fields();
}
