<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Enums\Rest\UserApiMethod;

class User extends BaseRest implements UserInterface
{

    public function add(array $fields): array
    {
        return $this->request(UserApiMethod::ADD->value, $fields);
    }

    public function current(): array
    {
        return $this->request(UserApiMethod::CURRENT->value);
    }

    public function update(array $fields): array
    {
        return $this->request(UserApiMethod::UPDATE->value, $fields);
    }

    public function get(
        array $filter = [],
        ?string $sort = null,
        ?string $order = null,
        bool $adminMode = false,
        int $start = 0,
    ): array
    {
        return $this->request(UserApiMethod::GET->value, [
            'filter' => $filter,
            'sort' => $sort,
            'order' => $order,
            'adminMode' => $adminMode,
            'start' => $start,
        ]);
    }

    public function search(
        array $filter = [],
        ?string $sort = null,
        ?string $order = null,
        bool $adminMode = false,
        int $start = 0,
    ): array
    {
        return $this->request(UserApiMethod::SEARCH->value, [
            'filter' => $filter,
            'sort' => $sort,
            'order' => $order,
            'adminMode' => $adminMode,
            'start' => $start,
        ]);
    }

    public function fields(): array
    {
        return $this->request(UserApiMethod::FIELDS->value);
    }
}
