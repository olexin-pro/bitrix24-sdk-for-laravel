<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Generator;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24FieldDescriptionDTO;
use OlexinPro\Bitrix24\Entities\DTO\Rest\UserEntity;
use OlexinPro\Bitrix24\Enums\Rest\UserApiMethod;

class User extends BaseRest implements UserInterface
{
    public function __construct()
{
    $this->defaultEntityClass = config('bitrix24.default_entity_class.user', UserEntity::class);
}

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

    public function userFields(): array
    {
        return $this->request(UserApiMethod::USER_FIELD_LIST->value);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function fieldsCollection(): \Illuminate\Support\Collection
    {
        $fields = $this->fields();
        return collect($fields)->mapWithKeys(function (mixed $item, string $key) {
            dd($item, $key);
            return [$key => Bitrix24FieldDescriptionDTO::fromArray($key, $item)];
        })->values();
    }

    public function currentAsEntity(): Bitrix24DTOInterface|array
    {
        $data = $this->current();
        return $this->convertToEntity($data);
    }

    /**
     * @return Generator<Bitrix24DTOInterface|array>
     */
    public function searchAsEntity(): Generator
    {
        $generator = $this->search(...func_get_args());

        foreach ($generator as $item) {
            yield $this->convertToEntity($item);
        }
    }


    /**
     * @return Generator<Bitrix24DTOInterface|array>
     */
    public function getUsersAsEntity(): Generator
    {
        $generator = $this->get(...func_get_args());

        foreach ($generator as $item) {
            yield $this->convertToEntity($item);
        }
    }

    private function convertToEntity(array $data): Bitrix24DTOInterface|array
    {
        if (!is_subclass_of($this->defaultEntityClass, Bitrix24DTOInterface::class)) {
            return $data;
        }
        return new $this->defaultEntityClass($data);
    }
}
