<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts\Rest;

use Generator;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;

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

    public function fieldsCollection();

    public function getUsersAsEntity(): Generator;

    public function searchAsEntity(): Generator;

    public function currentAsEntity(): Bitrix24DTOInterface|array;
}
