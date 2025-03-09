<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Generator;
use Illuminate\Contracts\Container\BindingResolutionException;
use OlexinPro\Bitrix24\Contracts\Rest\ContactInterface;
use OlexinPro\Bitrix24\Entities\DTO\Rest\ContactEntity;
use OlexinPro\Bitrix24\Enums\Rest\ContactApiMethod;
use OlexinPro\Bitrix24\Exceptions\Bitrix24APIException;

class Contact extends BaseRest implements ContactInterface
{
    public function __construct()
    {
        $this->defaultEntityClass = config('bitrix24.default_entity_class.contact', ContactEntity::class);
    }

    public function add(array $fields): array
    {
        return $this->request(ContactApiMethod::ADD->value, [
            'fields' => $fields,
        ]);
    }

    public function update(int $id, array $fields): array
    {
        return $this->request(ContactApiMethod::UPDATE->value, [
            'id' => $id,
            'fields' => $fields,
        ]);
    }

    /**
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function get(int $id): array
    {
        return $this->request(ContactApiMethod::GET->value, [
            'id' => $id
        ]);
    }

    /**
     * @param array|null $select
     * @param array|null $filter
     * @param array|null $order
     * @return Generator<array>
     * @throws Bitrix24APIException
     */
    public function list(?array $select = [], ?array $filter = [], ?array $order = []): Generator
    {
        return $this->getList(ContactApiMethod::LIST->value, [
            'select' => $select,
            'filter' => $filter,
            'order' => $order,
        ]);
    }

    /**
     * @param array|null $select
     * @param array|null $filter
     * @param array|null $order
     * @return Generator
     * @throws Bitrix24APIException
     * @throws BindingResolutionException
     */
    public function listEager(?array $select = [], ?array $filter = [], ?array $order = []): Generator
    {
        return $this->fetchList(ContactApiMethod::LIST->value, [
            'select' => $select,
            'filter' => $filter,
            'order' => $order
        ]);
    }

    public function delete(int $id): array
    {
        return $this->request(ContactApiMethod::DELETE->value, [
            'id' => $id,
        ]);
    }

    public function fields(): array
    {
        return $this->request(ContactApiMethod::FIELDS->value);
    }
}
