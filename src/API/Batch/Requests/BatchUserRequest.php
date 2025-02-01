<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\API\Batch\Requests;

use OlexinPro\Bitrix24\API\Batch\BatchableTrait;
use OlexinPro\Bitrix24\Contracts\Batch\BatchableInterface;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Enums\Rest\UserApiMethod;

class BatchUserRequest implements UserInterface, BatchableInterface
{
    use BatchableTrait;

    public function add(array $fields = []): self
    {
        return $this
            ->setMethod(UserApiMethod::ADD->value)
            ->setParams(['fields' => $fields]);
    }

    public function current(): self
    {
        return $this
            ->setMethod(UserApiMethod::CURRENT->value)
            ->setParams([]);
    }

    public function update(array $fields): self
    {
        return $this
            ->setMethod(UserApiMethod::UPDATE->value)
            ->setParams(['fields' => $fields]);
    }

    public function get(
        array $filter = [],
        ?string $sort = null,
        ?string $order = null,
        bool $adminMode = false,
        int $start = 0,
    ): self {
        return $this
            ->setMethod(UserApiMethod::GET->value)
            ->setParams([
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
    ): self {
        return $this
            ->setMethod(UserApiMethod::SEARCH->value)
            ->setParams([
                'filter' => $filter,
                'sort' => $sort,
                'order' => $order,
                'adminMode' => $adminMode,
                'start' => $start,
            ]);
    }

    public function fields(): self
    {
        return $this
            ->setMethod(UserApiMethod::FIELDS->value)
            ->setParams([]);
    }
}
